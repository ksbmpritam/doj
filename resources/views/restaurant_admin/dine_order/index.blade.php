@extends('restaurant_admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">Dine {{trans('lang.order_plural')}} </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('restaurant/orders')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Dine {{trans('lang.order_plural')}}</li>
            </ol>
        </div>
        <div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                 <div class="menu-tab vendorMenuTab">
                    
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
                           
                            <div class="table-responsive m-t-10">
                                <table id="data-table1" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>No. of Guests</th>
                                            <th>Book Time</th>
                                            <th>Book Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                       
                                    </thead>
                                    <body>
                                        @foreach($book as $b)  
                                         <tr>
                                             <td>{{$loop->iteration}}</td>
                                            <td>
                                                @foreach($customer as $c)
                                                    @if($c->id == $b->customer_id)
                                                        {{$c->name ?? 'N/A'}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($customer as $c)
                                                    @if($c->id == $b->customer_id)
                                                        {{$c->mobile_number ?? 'N/A'}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                {{$b->number_of_guests}}
                                            </td>
                                            <td>
                                                {{$b->booking_time}}
                                            </td>
                                            <td>
                                                {{$b->booking_date}}
                                            </td>
                                            <td>
                                                @if($b->status == '-1')
                                                    <span class="badge badge-danger">Cancel</span>
                                                @elseif($b->status == '1')
                                                    <span class="badge badge-success">Accept</span>
                                                @elseif($b->status =='2')
                                                    <span class="badge badge-success">Complete</span>
                                                @elseif($b->status == '0')
                                                    <span class="badge badge-warning">New Order</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('restaurant/dine_orders/edit/' . $b->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                <a href="{{ url('restaurant/dine_orders/view/' . $b->id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i></a>
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


