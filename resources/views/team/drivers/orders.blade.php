@extends('team.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">{{trans('lang.order_plural')}} </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('team/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.order_plural')}}</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="menu-tab vendorMenuTab">
                    <ul>
                        <li>
                            <a href="{{route('team.riders.view',$id)}}">{{trans('lang.tab_basic')}}</a>
                        </li>
                        <li class="active">
                            <a href="{{route('team.riders.orders',$id)}}">{{trans('lang.tab_orders')}}</a>
                        </li>
                        <li>
                            <a href="{{route('team.riders.order.balance',$id)}}">{{trans('lang.tab_payouts')}}</a>
                        </li>

                    </ul>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>

                        <div class="table-responsive m-t-10">
                            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>{{trans('lang.order_id')}}</th>
                                        <th>{{trans('lang.restaurant')}}</th>
                                        <th>{{trans('lang.order_user_id')}}</th>
                                        <th class="driverClass">{{trans('lang.driver_plural')}}</th>
                                        <th>{{trans('lang.date')}}</th>
                                        <th>{{trans('lang.restaurants_payout_amount')}}</th>
                                        <th>Payment Type</th>
                                        <th>{{trans('lang.order_order_status_id')}}</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order_data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order_data->order_id }}</td>
                                        <td>{{ isset($order_data->restaurant)?$order_data->restaurant->name:"" }}</td>
                                        <td>{{ isset($order_data->users->name)?$order_data->users->name:"" }}</td>
                                        <td>{{ $order_data->driver->first_name.' ' .$order_data->driver->last_name }}</td>
                                        <td>{{ $order_data->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $order_data->amount }}</td>
                                        <td>{{ $order_data->payment_type }}</td>
                                        <td>
                                            @if($order_data->order_status==3)
                                                <span class="badge badge-primary">Process</span>
                                            @else
                                                <span class="badge badge-success">Completed</span>
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ url('team/riders/orders/edit/' . $order_data->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                            <a href="{{ url('team/orders/delete/' . $order_data->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item ">
                                        <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()" data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);" id="users_table_next_btn" onclick="next()" data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection