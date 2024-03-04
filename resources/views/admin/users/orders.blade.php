@extends('admin.layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.user_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.user_table')}}</li>
            </ol>
        </div>
        <div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                   
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                        <div class="menu-tab">
                            <ul>
                                <li >
                                    <a href="{{route('admin.users.view',$id)}}">{{trans('lang.tab_basic')}}</a>
                                </li>
                                <li class="active">
                                    <a href="{{route('admin.users.orders',$id)}}">{{trans('lang.tab_orders')}}</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.users.payout',$id)}}">Wallet Transaction</a>
                                </li>
                            </ul>
                        </div>
                        <!--<div id="users-table_filter" class="pull-right"><label>{{ trans('lang.search_by')}}-->
                        <!--    <div class="form-group">-->
                        <!--        <input type="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table"></label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">Search</button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">Clear</button>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="table-responsive m-t-10">
                            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                    <!--<th class="delete-all"><input type="checkbox" id="is_active"><label-->
                                    <!--        class="col-3 control-label" for="is_active"-->
                                    <!--><a id="deleteAll" class="do_not_delete"-->
                                    <!--    href="javascript:void(0)"><i-->
                                    <!--                class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>-->
                                        <th>S.no.</th>
                                        <th>Order ID</th>
                                        <th>Restaurant</th>
                                        <th >User Name</th>
                                        <th>Drivers</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Order Type</th>
                                        <th >Order Status</th>
                                        <th class="no-export">{{trans('lang.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $or)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        
                                        <td>
                                            {{$or->order_id}}
                                        </td>
                                        <td>{{$or->restaurant->name}}</td>
                                        <td>{{$or->users->name}}</td>
                                        <td>
                                            @if (!empty($or->driver->first_name) && !empty($or->driver->last_name))
                                                {{ $or->driver->first_name }} {{ $or->driver->last_name }}
                                            @else
                                                N/A
                                            @endif
                                        </td>

                                        <td>{{$or->created_at}}</td>
                                        <td>{{$or->amount}}</td>
                                        <td>
                                         @if($or->order_type == 1)
                                            <span class="">Home Delevery</span>
                                        @else
                                            <span class="">Self</span>
                                        @endif
                                        </td>
                                        <td>
                                            @if ($or->order_status == -1)
                                                <span class="badge badge-danger">Cancle</span>
                                            @elseif ($or->order_status == 0)
                                                <span class="badge badge-primary breathe-effect">New Order</span>
                                            @elseif ($or->order_status == 1)
                                                <span class="badge badge-dark">Accept</span>
                                            @elseif ($or->order_status == 2)
                                                <span class="badge badge-info">Process</span>
                                            @elseif ($or->order_status == 3)
                                                <span class="badge badge-success">Payment Completed</span>
                                            @elseif ($or->order_status == 4)
                                                <span class="badge badge-success">Completed</span>
                                            @endif
                                        </td>
                                       
                                        <td>
                                            <!--<a href="{{ url('admin/users/view/' . $or->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> </a>-->
                                            <a href="{{ url('admin/users/order_details/' . $or->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="{{ url('admin/users/delete/' . $or->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--<nav aria-label="Page navigation example">-->
                            <!--    <ul class="pagination justify-content-center">-->
                            <!--        <li class="page-item ">-->
                            <!--            <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()"  data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>-->
                            <!--        </li>-->
                            <!--        <li class="page-item">-->
                            <!--            <a class="page-link" href="javascript:void(0);" id="users_table_next_btn" onclick="next()"  data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>-->
                            <!--        </li>-->
                            <!--    </ul>-->
                            <!--</nav>-->
                            
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

