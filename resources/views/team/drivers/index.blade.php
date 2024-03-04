@extends('team.layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.driver_plural')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item active">{{trans('lang.driver_table')}}</li>

            </ol>

        </div>

    </div>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100 justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! route('team.riders') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.driver_table')}}</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link" href="{!! route('team.riders.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.drivers_create')}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive m-t-10">

                            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                <thead>

                                    <tr>

                                        <th>S.No.</th>
                                        
                                        <th>{{trans('lang.extra_image')}}</th>

                                        <th>{{trans('lang.user_name')}}</th>
                                        <th>{{trans('lang.phone')}}</th>

                                        <th>{{trans('lang.driver_available')}}</th>

                                        <th>{{trans('lang.dashboard_total_orders')}}</th>
                                        <th>Approved</th>
                                        <th>{{trans('lang.status')}}</th>
                                        <th class="no-export">{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>
                                @foreach($driver as $d)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('images/driver/profile/' . $d->profile_image) }}"   onerror="this.src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSjUt44i013i_WJ-l3hKPaJ2u3vJd5z1GIvOpN30is&s'"  width="100" height="100" alt="..."/>
                                    </td>
                                     <!--<td class="employee-name" data-employee-id="{{ $d->employee_id ?? '' }}"-->
                                     <!--  data-employee-name="{{ $d->first_name && $d->last_name ? $d->name : 'N/A' }}" style="cursor:pointer;">-->
                                     <!--    @if ($d->employee_id)-->
                                     <!--    {{ $d->name ?? 'N/A' }}-->
                                     <!--      @else-->
                                     <!--     N/A-->
                                     <!--          @endif-->
                                     <!--         </td>-->
                                         <td>{{$d->first_name}}&nbsp;{{$d->last_name}}</td>
                                    <!--<td class="employee-name" data-employee-id="{{ $d->team->employee_id ?? '' }}"-->
                                    <!--data-employee-name="{{ $d->team && $d->team->employee_id ? App\Models\Employee::find($d->employee_id)->name : 'N/A' }}" style="cursor:pointer;">-->
                                    <!--    @if ($d->team && $d->team->employee_id)-->
                                    <!--        {{ App\Models\Employee::find($d->team->employee_id)->name ?? 'N/A' }}-->
                                    <!--    @else-->
                                    <!--        N/A-->
                                    <!--    @endif-->
                                    <!--</td>-->
                                 
                                    <!--<td class="employee-name" data-team-id="employee-id" style="cursor:pointer;" data-team-name="{{ $d->first_name ? $d->last_name : 'N/A' }}">{{$d->first_name}}&nbsp;{{$d->last_name}} </td>-->
                               

                                    <td>{{$d->phone}}</td>
                                    <td>
                                        @if($d->available==1)
                                            <span class="badge badge-success" >Available</span>
                                        @else
                                            <span class="badge badge-danger" >Not Available</span>
                                        @endif
                                    </td>
                                    
                                    <td>{{count($d->order)}}</td>
                                    <td>
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
                                            <label class="badge badge-danger open-modal" data-restaurant-id="{{ $d->id }}"
                                                data-toggle="tooltip" data-placement="top"
                                                title="{{ $d->cancel_reason }}" style="cursor:pointer"> Reject</label>
                                        @elseif($d->team_approvel == 2)
                                            <label class="badge badge-warning" data-toggle="tooltip" data-placement="top"
                                                title="{{ $d->cancel_reason }}">Pending</label>
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
                                        <a href="{{ url('team/riders/view/' . $d->id) }}" class="btn  btn-secondary btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="{{ url('team/riders/edit/' . $d->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </a>
                              
                                        <a href="{{ url('team/riders/delete/' . $d->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure wants to delete');"><i class="fa fa-trash"></i></a>
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
</div

@endsection
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
                    url: '/team/riders/employeeName/' + employeeId,
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
    });
</script>
@endsection



