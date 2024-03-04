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

            <h3 class="text-themecolor">Employee</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('employee/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Employee</li>
            </ol>
        </div>
    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">
                <div class="menu-tab vendorMenuTab">
                    @include('admin.head_menu2')
                </div>
                <div class="card">

                    <!--<div class="card-header">-->
                    <!--    <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">-->
                    <!--        <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">-->
                    <!--            <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Department List</a>-->
                    <!--        </li>-->
                    <!--        <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">-->
                    <!--            <a class="nav-link" href="{!! route('franchies.department.create') !!}"><i class="fa fa-plus mr-2"></i>Create Department</a>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</div>-->

                    <div class="card-body">

                        <div class="table-responsive m-t-10">

                            <table id="data-table" class="display nowrap table table-bordered" cellspacing="0" width="100%">

                                <thead>

                                    <tr>
                                        <th>S.no.</th>
                                        <th> Department Name </th>
                                        <th>Franchies Name</th>
                                        <th>Employee Name</th>
                                        <th>Team Name</th>
                                         <th>Approved</th>

                                        <th> Status </th>
                                        <th>{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>
                                @foreach($departments as $d)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    
                                    <td>
                                        {{$d->name}}
                                    </td>
                                     <td class="franchise-name" data-franchise-id="{{ $d->team->franchies_id ?? '' }}"   style="cursor:pointer;"
                                        data-franchise-name="{{ $d->team && $d->team->franchies_id ? App\Models\Franchise::find($d->team->franchies_id)->franchies_name : 'N/A' }}">
                                        @if ($d->team && $d->team->franchies_id)
                                            {{ App\Models\Franchise::find($d->team->franchies_id)->franchies_name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="employee-name" data-employee-id="{{ $d->team->employee_id ?? '' }}"
                                    data-employee-name="{{$d->team && $d->team->employee_id ? App\Models\Employee::find($d->team->employee_id)->name : 'N/A' }}" style="cursor:pointer;">
                                        @if ($d->team && $d->team->employee_id)
                                            {{ App\Models\Employee::find($d->team->employee_id)->name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                   <td class="team-name" data-team-id="{{ $d->team->id ?? '' }}" style="cursor:pointer;" data-team-name="{{ $d->team ? $d->team->name : 'N/A' }}">{{ $d->team ? $d->team->name : 'N/A' }}</td>
                                   
                                      <td >
                                        @if($d->team_approvel == 1)
                                            <!--<i class="fa fa-check text-success" aria-hidden="true"></i>-->
                                            <label class="badge badge-success open-modal"
                                                style="color:#fff;background:green;cursor:pointer;"
                                                data-toggle="tooltip" data-placement="top" data-restaurant-id="{{ $d->id }}" title="{{ $d->approved_by_name }}">Approved</label>
                                        @elseif($d->team_approvel == 0)
                                            <!--<i class="fa fa-tasks text-primary" aria-hidden="true"></i>-->
                                            <label class="badge badge-primary"
                                                data-toggle="tooltip" data-placement="top"
                                                title="{{ $d->cancel_reason }}">Progress</label>
                                        @elseif($d->team_approvel == -1)
                                            <!--<i class="fa fa-ban text-danger" aria-hidden="true"></i>-->
                                            <label class="badge badge-danger open-modal" data-restaurant-id="{{$d->id }}"
                                                data-toggle="tooltip" data-placement="top"
                                                title="{{ $d->cancel_reason }}" style="cursor:pointer"> Reject</label>
                                        @elseif($d->team_approvel == 2)
                                            <label class="badge badge-warning" data-toggle="tooltip" data-placement="top"
                                                title="{{ $d->cancel_reason }}">Pending</label>
                                        @endif
                                    </td>
                                   
                                    <td>
                                        @if ($d->status == 1 )
                                        <span class="badge badge-success" style="padding:5px;">Active</span>
                                        @else
                                        <span class="badge badge-danger" style="padding:5px;">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                          <a href="{{ route('admin.employee.department.departmentEdit' , $d->id) }}" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
                                          
                                        <a href="{{ route('admin.employee.department.departmentDetail' , $d->id) }}" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></a>
                                        <!--<a href="{{ url('franchies/department/delete/' . $d->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Department ?')"><i class="fa fa-trash"></i></a>-->
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









