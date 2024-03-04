@extends('employee.layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">Product </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('employee/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Product</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
               
                <div class="card">
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>


                        <div class="table-responsive m-t-10">


                            <table id="data-table" class="display nowrap table table-bordered" cellspacing="0" width="100%">

                                <thead>

                                    <tr>
                                     
                                        <th>S.No.</th>
                                        <th>{{trans('lang.food_image')}}</th>
                                        <th>Product Name</th>
                                        <th>Franchies Name</th>
                                        <th>Employee Name</th>
                                        <th>Team Name</th>
                                        <th>{{trans('lang.food_restaurant_id')}}</th>
                                        <th>{{trans('lang.food_category_id')}}</th>
                                        <th>Approved</th>
                                        <th>{{trans('lang.food_publish')}}</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>

                                </thead>
                                @foreach($foods as $f)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <img class="thumbnail-image" src="{{ asset('images/foods/' . $f->images) }}" onerror="this.src='{{ asset('public/assets/default-image_600.png') }}'" width="100" height="100" alt="...">
                                    </td>
                                    <td>{{$f->name}}</td>
                                    @if(isset($f->team->franchies_id))
                                        <?php
                                            $franchise = \App\Models\Franchise::find($f->team->franchies_id);
                                            $franchiseName = $franchise ? $franchise->franchies_name : 'N/A';
                                        ?>
                                        <td class="franchise-name" data-franchise-id="{{ $f->team->franchies_id }}" style="cursor:pointer;" data-franchise-name="{{ $franchiseName }}">
                                            {{ $franchiseName }}
                                        </td>
                                    @else
                                        <td class="franchise-name" data-franchise-id="{{ $f->team->franchies_id ?? '' }}" style="cursor:pointer;">N/A</td>
                                    @endif

                                    <td class="employee-name" data-employee-id="{{ $f->team->employee_id ?? '' }}"
                                    data-employee-name="{{ $f->team && $f->team->employee_id ? App\Models\Employee::find($f->team->employee_id) : 'N/A' }}" style="cursor:pointer;">
                                        @if ($f->team && $f->team->employee_id)
                                            {{ App\Models\Employee::find($f->team->employee_id)->name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    
                                    <td class="team-name" data-team-id="{{ $f->team->id ?? '' }}" style="cursor:pointer;" data-team-name="{{ $f->team ? $f->team->name : 'N/A' }}">{{ $f->team ? $f->team->name : 'N/A' }}</td>


                                    <td>{{$f->restaurant ? $f->restaurant->name : " "}}</td>
                                    <td>
                                        {{$f->category ? $f->category->name : " "}}
                                    </td>
                                    
                                    <td>
                                        @if($f->team_approvel == 1)
                                            <!--<i class="fa fa-check text-success" aria-hidden="true"></i>-->
                                            <label class="badge badge-success open-modal"
                                                style="color:#fff;background:green;cursor:pointer"
                                                data-toggle="tooltip" data-placement="top" data-restaurant-id="{{ $f->id }}" title="{{ $f->approved_by_name }}">Approved</label>
                                        @elseif($f->team_approvel == 0)
                                            <!--<i class="fa fa-tasks text-primary" aria-hidden="true"></i>-->
                                            <label class="badge badge-primary"
                                                data-toggle="tooltip" data-placement="top"
                                                title="{{ $f->cancel_reason }}">Progress</label>
                                        @elseif($f->team_approvel == -1)
                                            <!--<i class="fa fa-ban text-danger" aria-hidden="true"></i>-->
                                            <label class="badge badge-danger open-modal" data-restaurant-id="{{ $f->id }}"
                                                data-toggle="tooltip" data-placement="top"
                                                title="{{ $f->cancel_reason }}" style="cursor:pointer"> Reject</label>
                                        @elseif($f->team_approvel == 2)
                                            <label class="badge badge-warning" data-toggle="tooltip" data-placement="top"
                                                title="{{ $f->cancel_reason }}">Pending</label>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @if($f->publish==1)
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-danger">Deactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('employee.product.request.edit' , $f->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </a>
                                        <a href="{{ route('employee.product.request.view' , $f->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
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
<!-- Modal for Restaurant Data -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-hidden="true">
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
<script>
    $(document).ready(function () {
        $('.open-modal').on('click', function () {
            var restaurantId = $(this).data('restaurant-id');
            $('#productModal.modal-content').empty();

            $.ajax({
                url: '/employee/product/request/' + restaurantId,
                type: 'GET',
                success: function (data) {
                    $('#productModal .modal-content').html(data);
                    $('#productModal').modal('show');
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
                    url: '/employee/rider/request/franchiesName/' + franchiesId,
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
                    url: '/employee/rider/request/employeeName/' + employeeId,
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
                    url: '/employee/rider/request/teamName/' + teamId,
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