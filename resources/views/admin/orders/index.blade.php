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
            <h3 class="text-themecolor orderTitle">{{trans('lang.order_plural')}} </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.order_plural')}}</li>
            </ol>
        </div>
        <div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                 <div class="menu-tab vendorMenuTab">
                    <ul>
                        <!--<li >-->
                        <!--    <a href="">{{trans('lang.tab_basic')}}</a>-->
                        <!--</li>-->
                        <!--<li>-->
                        <!--    <a href="">{{trans('lang.tab_foods')}}</a>-->
                        <!--</li>-->
                        <li class="active">
                            <a href="{{route('admin.orders')}}">{{trans('lang.tab_orders')}}</a>
                        </li>
                        <!--<li>-->
                        <!--    <a href="">{{trans('lang.tab_promos')}}</a>-->
                        <!--</li>-->
                        <!--<li>-->
                        <!-- 	<a href="">{{trans('lang.tab_payouts')}}</a>-->
                        <!-- </li>-->
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
                            <!--<form action="{{ url ('admin/orders')}}" method="get" enctype="multipart/form-data">-->
                            <!--<div id="users-table_filter" class="pull-right">-->
                            <!--    <label>{{trans('lang.search_by')}}</label>-->
                            <!--    <div class="form-group">-->
                                    
                            <!--        <select id= "order_status" name="order_status" class="form-control">-->
                            <!--            <option value="all">{{ trans('lang.all')}}</option>-->
                            <!--            <option value="order_accepted">{{ trans('lang.order_accepted')}}</option>-->
                            <!--            <option value="order_rejected">{{ trans('lang.order_rejected')}}</option>-->
                            <!--            <option value="order_completed">{{ trans('lang.order_completed')}}</option>-->
                            <!--        </select>-->
                                    <!--<input type="text" name="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table">-->

                            <!--        <button onclick="searchtext();" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>-->
                            <!--        <a href="{{ url ('admin/orders')}}" class="btn btn-warning btn-flat"> <i class="fa fa-refresh"></i></a>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--</form>-->
                            <div class="table-responsive m-t-10">
                                <table id="data-table" class="display nowrap table-bordered table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                         
                                            <th>S.No.</th>
                                            <th>{{trans('lang.order_id')}}</th>
	                                        <th>{{trans('lang.restaurant')}}</th>
                                            <th>{{trans('lang.order_user_id')}}</th>
                                            <th class="driverClass">{{trans('lang.driver_plural')}}</th>
                                            <th>{{trans('lang.date')}}</th>
                                            <th>{{trans('lang.restaurants_payout_amount')}}</th>
                                            <th>{{trans('lang.order_type')}}</th>
                                            <th>{{trans('lang.order_order_status_id')}}</th>
                                            <th class="no-export">{{trans('lang.actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach($orders as $order_data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order_data->order_id }}</td>
                                                <td>{{ isset($order_data->restaurant)?$order_data->restaurant->name:" " }}</td>
                                                <td>{{ $order_data->users ? $order_data->users->name : '' }}</td>
                                                <td>{{ $order_data->driver->first_name ?? 'N/A' }} {{ $order_data->driver->last_name ?? '' }}</td>
                                                <td>{{ optional($order_data->created_at)->format('d/m/Y') }}</td>
                                                <td>{{ $order_data->amount }}</td>
                                                <td>
                                                    @if($order_data->order_type==1)
                                                        {{ __('Home Delevery') }}
                                                    @else
                                                        {{ __('Self') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($order_data->order_status == -1)
                                                        <span class="badge badge-danger">Cancle</span>
                                                    @elseif ($order_data->order_status == 0)
                                                        <span class="badge badge-primary">New Order</span>
                                                    @elseif ($order_data->order_status == 1)
                                                        <span class="badge badge-dark">Accept</span>
                                                    @elseif ($order_data->order_status == 2)
                                                        <span class="badge badge-info">Process</span>
                                                    @elseif ($order_data->order_status == 3)
                                                        <span class="badge badge-success">Payment Completed</span>
                                                    @elseif ($order_data->order_status == 4)
                                                        <span class="badge badge-success">Completed</span>
                                                    @endif

                                                    
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/orders/edit/' . $order_data->id) }}" class="btn btn-sm btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ url('admin/orders/delete/' . $order_data->id) }}" onclick="return confirm('Are You Sure Wants to delete this order ?');" class="btn btn-sm btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

