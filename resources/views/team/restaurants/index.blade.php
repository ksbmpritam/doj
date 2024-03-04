@extends('team.layouts.app')

@section('content')

    <div class="page-wrapper">


        <div class="row page-titles">

            <div class="col-md-5 align-self-center">

                <h3 class="text-themecolor">{{trans('lang.restaurant_plural')}}</h3>

            </div>

            <div class="col-md-7 align-self-center">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                    <li class="breadcrumb-item">{{trans('lang.restaurant_plural')}}</li>

                    <li class="breadcrumb-item active">{{trans('lang.restaurant_table')}}</li>

                </ol>

            </div>

            <div>

            </div>

        </div>


        <div class="container-fluid">

            <div class="row">

                <div class="col-12">
                    
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                                <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Restaurant List</a>
                                </li>
                                <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                    <a class="nav-link" href="{!! route('team.restaurants.create') !!}"><i class="fa fa-plus mr-2"></i>Create Restaurant</a>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

                        
                            <div class="table-responsive m-t-10">


                                <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                    <thead>

                                        <tr>
                                    

                                            <th>S.No.</th>

                                            <th>{{trans('lang.restaurant_name')}}</th>

                                            <th>{{trans('lang.restaurant_image')}}</th>
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
                                                <td>
                                                    {{$r->phone}}
                                                </td>
                                                <td>{{$r->address}}</td>
                                                
                                                 <td>
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
                                                     <a href="{{ url('team/restaurants/view/' . $r->id) }}" class="btn  btn-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    <a href="{{ url('team/restaurants/edit/' . $r->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="{{ url('team/restaurants/delete/' . $r->id) }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    
                                              
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
</div>
<div class="modal fade" id="restaurantModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <!-- Data will be loaded here using AJAX -->
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('scripts')

<script>
    $(document).ready(function () {
        $('.open-modal').on('click', function () {
            var restaurantId = $(this).data('restaurant-id');
            // console.log(restaurantId);
            $('#restaurantModal .modal-content').empty();

            $.ajax({
                url: '/team/restaurants/showRestaurants/' + restaurantId,
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
    });
</script>
@endsection


