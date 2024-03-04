@extends('admin.layouts.app')

@section('content')
<style>
    #data-table tbody tr td,th {
        font-size: 15px;
        padding: 10px;
    } 
</style>
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">Team </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Restaurant</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="menu-tab vendorMenuTab">
                    @include('admin.head_menu_team')
                </div>
                <div class="card">
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

                        
                            <div class="table-responsive m-t-10">


                                <table id="data-table" class="display nowrap table table-bordered" cellspacing="0" width="100%">

                                    <thead>

                                        <tr>
                                    

                                            <th>S.No.</th>

                                            <th>{{trans('lang.restaurant_name')}}</th>

                                            <th>{{trans('lang.restaurant_image')}}</th>
                                            <th>Franchies Name</th>
                                           <th>Employee Name</th>
                                           <th>Team Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Approved</th>
                                            
                                            <th >Status</th>

                                           <th >Action</th>

                                        </tr>

                                    </thead>

                                    <tbody id="append_restaurants">

                                        @foreach($restaurant as $r)
                                        
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{$r->name}}
                                                </td>
                                                <td>
                                                    <img src="{{ asset('images/restaurants/' . $r->image) }}" width="100" height="100" alt="restaurants Photo">
                                                </td>
                                                   <td class="franchise-name" data-franchise-id="{{ $r->team->franchies_id ?? '' }}"   style="cursor:pointer;"
                                        data-franchise-name="{{ $r->team && $r->team->franchies_id ? App\Models\Franchise::find($r->team->franchies_id)->franchies_name : 'N/A' }}">
                                        @if ($r->team && $r->team->franchies_id)
                                            {{ App\Models\Franchise::find($r->team->franchies_id)->franchies_name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                     <td class="employee-name" data-employee-id="{{ $r->team->employee_id ?? '' }}"
                                    data-employee-name="{{ $r->team && $r->team->employee_id ? App\Models\Employee::find($r->team->employee_id)->name : 'N/A' }}" style="cursor:pointer;">
                                        @if ($r->team && $r->team->employee_id)
                                            {{ App\Models\Employee::find($r->team->employee_id)->name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="team-name" data-team-id="{{ $r->team->id ?? '' }}" style="cursor:pointer;" data-team-name="{{ $r->team ? $r->team->name : 'N/A' }}">{{ $r->team ? $r->team->name : 'N/A' }}</td>
                                                
                                                
                                                <td>
                                                    {{$r->phone}}
                                                </td>
                                                <td>{{$r->address}}</td>
                                                
                                               <td >
                                        @if($r->team_approvel == 1)
                                            <!--<i class="fa fa-check text-success" aria-hidden="true"></i>-->
                                            <label class="badge badge-success open-modal"
                                                style="color:#fff;background:green;cursor:pointer;"
                                                data-toggle="tooltip" data-placement="top" data-restaurant-id="{{ $r->id }}" title="{{ $r->approved_by_name }}">Approved</label>
                                        @elseif($r->team_approvel == 0)
                                            <!--<i class="fa fa-tasks text-primary" aria-hidden="true"></i>-->
                                            <label class="badge badge-primary"
                                                data-toggle="tooltip" data-placement="top"
                                                title="{{ $r->cancel_reason }}">Progress</label>
                                        @elseif($r->team_approvel == -1)
                                            <!--<i class="fa fa-ban text-danger" aria-hidden="true"></i>-->
                                            <label class="badge badge-danger open-modal" data-restaurant-id="{{ $r->id }}"
                                                data-toggle="tooltip" data-placement="top"
                                                title="{{ $r->cancel_reason }}" style="cursor:pointer"> Reject</label>
                                        @elseif($r->team_approvel == 2)
                                            <label class="badge badge-warning" data-toggle="tooltip" data-placement="top"
                                                title="{{ $r->cancel_reason }}">Pending</label>
                                        @endif
                                    </td>

                                                <td>
                                                    @if($r->restaurant_status == 1)
                                                        <label class="badge badge-success" style="color:#fff;background:green;">Active</label>
                                                    @else
                                                        <label class="badge badge-danger">Deactive</label>
                                                    @endif
                                                </td>
                                                
                                                <td>
                                                  <a href="{{ route('admin.franchies.team.restaurantedit', $r->id) }}"
                                                class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-edit"></i></a>
                                            
                                                    <a href="{{ route('admin.franchies.team.view.restaurantDetail' , $r->id) }}" class="btn btn-secondary"><i class="fa fa-eye"></i></a>
                                                   
                                                </td>
                                            </tr>
                                        
                                        @endforeach
                                    </tbody>

                                </table>
                            

                            </div>

                            <!-- Popup -->

                            <div class="modal fade" id="create_vendor" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered notification-main" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">{{trans('lang.copy_vendor')}} <span id="vendor_title_lable"></span></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <div id="data-table_processing2" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                                                <div class="error_top"></div>
                                            <!-- Form -->
                                                <div class="form-row">
                                                    <div class="col-md-12 form-group">
                                                        <label class="form-label">{{trans('lang.first_name')}}</label>
                                                        <div class="input-group">
                                                            <input placeholder="Name" type="text" id="user_name" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label class="form-label">{{trans('lang.last_name')}}</label>
                                                        <div class="input-group">
                                                            <input placeholder="Name" type="text" id="user_last_name" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label class="form-label">{{trans('lang.vendor_title')}}</label>
                                                        <div class="input-group">
                                                            <input placeholder="Vendor Title" type="text" id="vendor_title" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 form-group"><label class="form-label">{{trans('lang.email')}}</label><input placeholder="Email" value="" id="user_email" type="text" class="form-control"></div>
                                                    <div class="col-md-12 form-group"><label class="form-label">{{trans('lang.password')}}</label><input placeholder="Password" id="user_password" type="password" class="form-control">
                                                    </div>

                                                </div>
                                                <!-- Form -->
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="create_vendor_submit">{{trans('lang.create')}}</button>
                                            </div>
                                        </div>
                                        </div>
                                </div>

                            <!-- Popup -->


                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="restaurantModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <!-- Data will be loaded here using AJAX -->
        </div>
    </div>
</div>
<div class="modal fade" id="franchiseModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <!-- Data will be loaded here using AJAX -->
        </div>
    </div>
</div>
<div class="modal fade" id="employeeModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <!-- Data will be loaded here using AJAX -->
        </div>
    </div>
</div>
<div class="modal fade" id="teamModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <!-- Data will be loaded here using AJAX -->
        </div>
    </div>
</div>

@endsection
@section('scripts')
<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.open-modal').on('click', function () {
            var restaurantId = $(this).data('restaurant-id');
            $('#restaurantModal .modal-content').empty();

            $.ajax({
                url: '/admin/rider/request/' + restaurantId,
                type: 'GET',
                success: function (data) {
                    $('#restaurantModal .modal-content').html(data);
                    $('#restaurantModal').modal('show');
                },
                error: function (xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
        
        $('.franchise-name').on('click', function () {
            let franchiesId = $(this).data('franchise-id');
            let franchiesName = $(this).data('franchise-name');
            if (franchiesName !== 'N/A') {
                $('#franchiseModel .modal-content').empty();
        
                $.ajax({
                    url: '/admin/rider/request/franchiesName/' + franchiesId,
                    type: 'GET',
                    success: function (data) {
                        $('#franchiseModel .modal-content').html(data);
                        $('#franchiseModel').modal('show');
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr);
                    }
                });
            }
        });

        
        $('.employee-name').on('click', function () {
            var employeeId = $(this).data('employee-id');
            var employeeName = $(this).data('employee-name');
        
            if (employeeName !== 'N/A') {
                $('#employeeModel .modal-content').empty();
        
                $.ajax({
                    url: '/admin/rider/request/employeeName/' + employeeId,
                    type: 'GET',
                    success: function (data) {
                        $('#employeeModel .modal-content').html(data);
                        $('#employeeModel').modal('show');
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr);
                    }
                });
            }
        });
        
        
        $('.team-name').on('click', function () {
            let teamId = $(this).data('team-id');
            let teamName = $(this).data('team-name');
        
            if (teamName !== 'N/A') {
                $('#teamModel .modal-content').empty();
        
                $.ajax({
                    url: '/admin/rider/request/teamName/' + teamId,
                    type: 'GET',
                    success: function (data) {
                        console.log(data);
                        $('#teamModel .modal-content').html(data);
                        $('#teamModel').modal('show');
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr);
                    }
                });
            }
        });

    });
</script>