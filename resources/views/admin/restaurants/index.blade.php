@extends('admin.layouts.app')

@section('content')

    <div class="page-wrapper">


        <div class="row page-titles">

            <div class="col-md-5 align-self-center">

                <h3 class="text-themecolor">{{trans('lang.restaurant_plural')}}</h3>

            </div>

            <div class="col-md-7 align-self-center">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

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

                    <div class="card">
                            <div class="card-header">
                            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                                <li class="nav-item">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.restaurants_table')}}</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="{!! route('admin.restaurants.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.create_restaurant')}}</a>
                                </li>

                            </ul>
                        </div>
                        @if(session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif
                    
                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                        <!--<div id="users-table_filter" class="pull-right"><label>{{trans('lang.search_by')}}-->
                        <!--    <select name="selected_search" id="selected_search" class="form-control input-sm">-->
                        <!--        <option value="title">{{trans('lang.title')}}</option>-->
                        <!--    </select>-->
                        <!--    <div class="form-group">-->
                        <!--    <input type="search" id="search" class="search form-control" placeholder="Search" ></label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">{{trans('lang.search')}}</button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">{{trans('lang.clear')}}</button>-->
                        <!--</div>-->
                        <!--</div>-->
                            <div class="table-responsive m-t-10">
                                <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>{{trans('lang.restaurant_name')}}</th>
                                            <th>{{trans('lang.restaurant_image')}}</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <!--<th>Category</th>-->
                                            
                                            <th >Status</th>

                                           <th class="no-export">Action</th>

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
                                                <!--<td>-->
                                                <!--    {{$r->category}}-->
                                                <!--</td>-->
                                                <td>
                                                    @if($r->restaurant_status == 1)
                                                        <label class="badge badge-success" style="color:#fff;background:green;">Active</label>
                                                    @else
                                                        <label class="badge badge-danger">Deactive</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/restaurants/edit/' . $r->id) }}" class="btn btn-primary"> <i class="fa fa-edit"></i> </a>
                                                    <!--<a href="{{ url('restaurants/delete/' . $r->id) }}" class="btn btn-danger">Delete</a>-->
                                                </td>
                                            </tr>
                                        
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="data-table_paginate">
                                <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                        <li class="page-item ">
                                            <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()"  data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>
                                        </li>
                                        <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);" id="users_table_next_btn" onclick="next()"  data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

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

@endsection

