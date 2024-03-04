@extends('restaurant_admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">{{trans('lang.order_plural')}} </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('restaurant/orders')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.order_plural')}}</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="menu-tab vendorMenuTab">

                </div>

                <div class="card">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <!--<li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">-->
                            <!--    <a class="nav-link " href="{!! route('admin.drivers') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.driver_plural')}} List </a>-->
                            <!--</li>-->
                            <li class="nav-item" style="border: 1px solid #ff683a; border-radius: 2px;">
                                <a class="nav-link active" href="{{ url()->current() }}"><i class="fa fa-plus mr-2"></i>Order List</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>

                        <div class="table-responsive m-t-10">
                            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>{{trans('lang.order_id')}}</th>
                                        <th>{{trans('lang.order_user_id')}}</th>
                                        <th class="driverClass">{{trans('lang.driver_plural')}}</th>
                                        <th>{{trans('lang.date')}}</th>
                                        <th>{{trans('lang.restaurants_payout_amount')}}</th>
                                        <th>{{trans('lang.order_type')}}</th>
                                        <th>{{trans('lang.order_order_status_id')}}</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>


                                </thead>
                                @foreach($order as $od)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        {{$od->order_id}}
                                    </td>
                                    <td>
                                        @foreach($customer as $c)
                                        @if($c->id == $od->user_id)
                                        {{$c->name}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($driver as $d)
                                        @if($d->id == $od->drivers_id)

                                        {{$d->first_name}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        {{$od->created_at}}
                                    </td>
                                    <td>
                                        {{$od->amount}}
                                    </td>
                                    <td>
                                        <span class="badge badge-success" style="padding:10px;">{{$od->payment_type}}</span>
                                    </td>
                                    <td>
                                        @if ($od->order_status == -1)
                                        <span class="badge badge-danger">Cancle</span>
                                        @elseif ($od->order_status == 0)
                                        <span class="badge badge-primary">New Order</span>
                                        @elseif ($od->order_status == 1)
                                        <span class="badge badge-dark">Accept</span>
                                        @elseif ($od->order_status == 2)
                                        <span class="badge badge-info">Process</span>
                                        @elseif ($od->order_status == 3)
                                        <span class="badge badge-success">Payment Completed</span>
                                        @elseif ($od->order_status == 4)
                                        <span class="badge badge-success">Completed</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ url('restaurant/orders/edit/' . $od->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="{{ url('restaurant/orders/view/' . $od->id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i></a>
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