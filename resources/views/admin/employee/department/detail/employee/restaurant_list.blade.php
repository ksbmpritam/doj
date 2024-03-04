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
                    @include('admin.head_menu_team2')
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
                                                        <label class="badge badge-success" style="color: #fff; background-color: green;">Approved</label>
                                                    @elseif($r->team_approvel == 0)
                                                        <label class="badge badge-primary" style="color: #fff; background-color: orange;">Progress</label>
                                                    @else
                                                        <label class="badge badge-warning" style="color: #fff; background-color: red;">Unapproved</label>
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
                                                    <a href="{{ route('admin.employee.team.view.restaurantDetail' , $r->id) }}" class="btn btn-secondary"><i class="fa fa-eye"></i></a>
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

@endsection