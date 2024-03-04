@extends('restaurant_admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('restaurant/dine_orders/update/'.$order->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Dine {{trans('lang.order_plural')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                 <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('restaurant/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                    <li class="breadcrumb-item"><a href="{!! route('restaurant.dine_orders') !!}">Dine {{trans('lang.order_plural')}}</a></li>

                    <li class="breadcrumb-item">Dine Order Details</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link " href="{!! route('restaurant.dine_orders') !!}"><i class="fa fa-list mr-2"></i>Dine {{trans('lang.order_plural')}} List </a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a; border-radius: 2px;">
                                <a class="nav-link active" href="{{ url()->current() }}"><i class="fa fa-plus mr-2"></i>Dine {{trans('lang.order_plural')}} View</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                       
                        <div class="error_top"></div>

                        <div class="row restaurant_payout_create">
                            <div class="restaurant_payout_create-inner">

                                <fieldset>
                                    <legend>Users Details</legend>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Order Id</label>
                                        <div class="form-check width-100">
                                          <input type="text" class="form-control" name="name" value="{{$order->order_id}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Status</label>
                                        <div class="form-check width-100">
                                            <select class="form-control form-select" name="status" @if($order->status != 2  && $order->status != -1) id="statusSelect" @endif>
                                                <option value="0" @if($order->status == 0) selected @endif>New Order</option>
                                                <option value="-1" @if($order->status == -1) selected @endif>Cancel</option>
                                                <option value="1" @if($order->status == 1) selected @endif>Accept</option>
                                                <option value="2" @if($order->status == 2) selected @endif>Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                    @if($order->status == 2)
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Total Amount</label>
                                        <div class="col-7" >
                                           <input type="number" min="0" class="form-control" name="total_amount" value="{{$order->total_amount}}">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group row width-50" id="completedInput" style="display: none;">
                                        <label class="col-3 control-label">Total Amount</label>
                                        <div class="col-7" id="total_amt">
                                           
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label"> Name</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control " name="name" value="{{$order->users->name ?? ''}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Email</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control " name="date" value="{{$order->users->email ?? ''}}" readonly>
                                       
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Mobile No.</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control " name="phone" value="{{$order->users->mobile_number ?? ''}}" readonly>
                                       
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Total Guest</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control " name="guest" value="{{$order->number_of_guests}}" readonly>
                                       
                                        </div>
                                    </div>
                                   
                                </fieldset>
                                
                              
                            </div>
                        </div>
                        <div class="form-group col-12 text-center btm-btn">
                           
                            <a href="{!! route('restaurant.dine_orders') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
       </div>
    </form>
</div>
</div>
@endsection


@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js"></script>
<script>
$(document).ready(function() {
    var $statusSelect = $('#statusSelect');
    var $completedInput = $('#completedInput');
    var $totalAmt = $('#total_amt'); 

    $statusSelect.on('change', function() {
        if ($(this).val() == '2') { 
            $completedInput.show();
            let input = '<input type="number" min="0" class="form-control" name="total_amount" required>';
            $totalAmt.append(input); 
        } else {
            $completedInput.hide();
            $totalAmt.empty(); 
        }
    });
});

</script>

@endsection
