@extends('admin.layouts.app')

@section('content')

    <div class="page-wrapper">


        <div class="row page-titles">

            <div class="col-md-5 align-self-center">

                <h3 class="text-themecolor">{{trans('lang.restaurant_plural')}}</h3>

            </div>

            <div class="col-md-7 align-self-center">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="#">{{trans('lang.dashboard')}}</a></li>

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
                                <!--<li class="nav-item">-->
                                <!--<a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.restaurants_table')}}</a>-->
                                <!--</li>-->
                                <!--<li class="nav-item">-->
                                <!--<a class="nav-link" href="{!! route('admin.restaurants.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.create_restaurant')}}</a>-->
                                <!--</li>-->

                            </ul>
                        </div>
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
                                            <th>Amount</th>
                                            <th>Image</th>
                                            <th >Status</th>
                                            <th>Date</th>
                                           <th class="no-export">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="append_restaurants">
                                        @foreach($restaurant as $r)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{$r->resturant->name ?? ''}}
                                                </td>
                                                <td>
                                                    {{$r->amount}}
                                                </td>
                                                <td>
                                                    @if(isset($r->image))
                                                        <img src="{{ asset('images/restaurants/transaction/' . $r->image) }}" width="100" height="100" alt="restaurants Photo">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                
                                                <td>
                                                    @if($r->status == 3)
                                                        <label class="badge badge-success" style="color:#fff;background:green;">Approved</label>
                                                    @elseif($r->status == 2)
                                                        <label class="badge badge-danger">Cancel</label>
                                                    @elseif($r->status == 1)
                                                        <label class="badge badge-warning">Pending</label>
                                                    @endif
                                                </td>
                                                <td>{{$r->date}}</td>
                                                <td>
                                                    <a href="{{ route('admin.resturant.withdrawal.edit',['id'=> $r->id])}}" class="btn btn-primary edit-btn"> <i class="fa fa-edit"></i> </a>
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
</div>
@endsection

