@extends('restaurant_admin.layouts.app')

@section('content')

<div class="page-wrapper">


    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.order_transaction_table')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('restaurant/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.order_transaction_table')}}</li>
            </ol>
        </div>

    </div>



    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.order_transaction_table')}}</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

                        <div class="table-responsive m-t-10">


                            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="data-table_info" style="width: 100%;">
                                <thead>

                                    <tr>
                                        <th>{{ trans('lang.order_id')}}</th>
                                        <th>Transaction Id</th>
                                        <th>{{ trans('lang.driver')}}</th>
                                        <th>User Name</th>
                                        <th>{{trans('lang.amount')}}</th>
                                        <th>{{trans('lang.date')}}</th>
                                        <th>Order Type</th>
                                        <th>{{trans('lang.order_order_status_id')}}</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        
                                    </tr>

                                </thead>
                                
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td>{{$order->order_id}}</td>
                                            <td>{{$order->transactionId}}</td>
                                            <td>{{ optional($order->driver)->first_name ?? '-' }} {{ optional($order->driver)->last_name ?? '-' }}</td>
                                            <td>{{ optional($order->customer)->name ?? '-' }}</td>
                                            <td>{{$order->amount}}</td>
                                            <td>{{$order->date}}</td>
                                            <td>{{$order->type}}</td>
                                            <td>{{$order->code}}</td>
                                            <td>
                                                @if ($order->order_status == -1)
                                                <span class="badge badge-danger">Cancle</span>
                                                @elseif ($order->order_status == 0)
                                                <span class="badge badge-primary">New Order</span>
                                                @elseif ($order->order_status == 1)
                                                <span class="badge badge-dark">Accept</span>
                                                @elseif ($order->order_status == 2)
                                                <span class="badge badge-info">Process</span>
                                                @elseif ($order->order_status == 3)
                                                <span class="badge badge-success">Payment Completed</span>
                                                @elseif ($order->order_status == 4)
                                                <span class="badge badge-success">Completed</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('restaurant/orders/details/' . $order->id) }}" class="btn btn-secondary"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">No orders available</td>
                                        </tr>
                                    @endforelse
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

@endsection


