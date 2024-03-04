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
                <li class="breadcrumb-item active">Rider</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="menu-tab vendorMenuTab">
                    @include('admin.head_menu_team2')
                </div>

                <div class="card">
                   <div class="card-body">
                        <div class="table-responsive m-t-10">

                            <table id="data-table" class="display nowrap table table-bordered" cellspacing="0" width="100%">

                                <thead>

                                    <tr>

                                        <th>S.No.</th>
                                        <th>{{trans('lang.extra_image')}}</th>

                                        <th>{{trans('lang.user_name')}}</th>
                                        <th>{{trans('lang.phone')}}</th>

                                       
                                         <th>Franchies Name</th>
                                        <th>Employee Name</th>
                                        <th>Team Name</th>
                                        <th>{{trans('lang.dashboard_total_orders')}}</th>
                                      
                                        <th>Approved</th>

                                        <th>{{trans('lang.status')}}</th>
                                         <th>{{trans('lang.driver_available')}}</th>
                                        <th class="no-export">{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>
                                @foreach($driver as $d)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td>
                                        @if($d->profile_image)
                                           <img src="{{ asset('images/driver/profile/' . $d->profile_image) }}" width="100" height="100" alt="profile Photo">
                                        @else
                                            Profile Image not Uploaded
                                        @endif
                                        
                                    </td>
                                    <td>{{$d->first_name}}&nbsp;{{$d->last_name}}</td>
                                    <td>{{$d->phone}}</td>
                                  
                                      <td class="franchise-name" data-franchise-id="{{ $d->team->franchies_id ?? '' }}"   style="cursor:pointer;"
                                        data-franchise-name="{{ $d->team && $d->team->franchies_id ? App\Models\Franchise::find($d->team->franchies_id)->franchies_name : 'N/A' }}">
                                        @if ($d->team && $d->team->franchies_id)
                                            {{ App\Models\Franchise::find($d->team->franchies_id)->franchies_name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                            
                                       <td class="employee-name" data-employee-id="{{ $d->team->employee_id ?? '' }}"
                                        data-employee-name="{{ $d->team && $d->team->employee_id ? App\Models\Employee::find($d->team->employee_id)->name : 'N/A' }}" style="cursor:pointer;">
                                        @if ($d->team && $d->team->employee_id)
                                            {{ App\Models\Employee::find($d->team->employee_id)->name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                         <td class="team-name" data-team-id="{{ $d->team->id ?? '' }}" style="cursor:pointer;" data-team-name="{{ $d->team ? $d->team->name : 'N/A' }}">{{ $d->team ? $d->team->name : 'N/A' }}</td>

                                    
                                    
                                    <td>{{count($d->order)}}</td>
                                             <td>
                                            @if($d->team_approvel == 1)
                                                <!--<i class="fa fa-check text-success" aria-hidden="true"></i>-->
                                                <label class="badge badge-success open-modal"
                                                    style="color:#fff;background:green;cursor:pointer"
                                                    data-toggle="tooltip" data-placement="top" data-restaurant-id="{{ $d->id }}">Approved</label>
                                            @elseif($d->team_approvel == 0)
                                                <!--<i class="fa fa-tasks text-primary" aria-hidden="true"></i>-->
                                                <label class="badge badge-primary"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="{{ $d->cancel_reason }}">Progress</label>
                                            @elseif($d->team_approvel == -1)
                                                <!--<i class="fa fa-ban text-danger" aria-hidden="true"></i>-->
                                                <label class="badge badge-danger open-modal" data-restaurant-id="{{ $d->id }}"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="{{ $d->cancel_reason }}" style="cursor:pointer"> Reject</label>
                                            @elseif($f->team_approvel == 2)
                                                <label class="badge badge-warning " data-toggle="tooltip" data-placement="top"
                                                    title="{{$d->cancel_reason }}">Pending</label>
                                            @endif
                                        </td>
                                          <td>
                                        @if($d->status==1)
                                            <span class="badge badge-success" >Active</span>
                                        @else
                                            <span class="badge badge-danger" >InActive</span>
                                        @endif
                                    </td>
                                       
                                    <td>
                                        @if($d->status==1)
                                            <span class="badge badge-success" >Active</span>
                                        @else
                                            <span class="badge badge-danger" >InActive</span>
                                        @endif
                                    </td>
                                    <td>
                                           <a href="{{ url('admin/employee/team/rider/ridersEdit/' . $d->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                   
                                        <a href="{{ url('admin/employee/team/rider/riderDetail/' . $d->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <!--<a href="{{ url('team/riders/delete/' . $d->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure wants to delete');"><i class="fa fa-trash"></i></a>-->
                                    </td>
                                </tr>
                                @endforeach


                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
<div class="modal fade" id="restaurantModal" tabindex="-1" role="dialog" aria-hidden="true">
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
<div class="modal fade" id="teamModel" tabindex="-1" role="dialog" aria-hidden="true">
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('scripts')

<script>
    $(document).ready(function () {
        $('.open-modal').on('click', function () {
            var restaurantId = $(this).data('restaurant-id');
            console.log(restaurantId);
            $('#restaurantModal .modal-content').empty();

            $.ajax({
                url: '/team/riders/showRiders/' + restaurantId,
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    $('#restaurantModal .modal-content').html(data);
                    $('#restaurantModal').modal('show');
                },
                error: function (xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
           $('.employee-name').on('click', function () {
            var employeeId = $(this).data('employee-id');
                
            var employeeName = $(this).data('employee-name');
                // console.log(employeeId);
            if (employeeName !== 'N/A') {
                $('#employeeModel .modal-content').empty();
        
                $.ajax({
                    url: '/admin/drivers/request/' + employeeId,
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


        $('.team-name').on('click', function () {
    let teamId = $(this).data('team-id');
    let teamName = $(this).data('team-name');

    if (teamName !== 'N/A') {
        $('#teamModel .modal-content').empty();

        $.ajax({
            url: '/admin/drivers/showteamrequest/' + teamId,
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
@endsection

