@extends('restaurant_admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('restaurant/orders/update/'.$order->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.order_plural')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                 <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('restaurant/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                    <li class="breadcrumb-item"><a href="{!! route('restaurant.orders') !!}">{{trans('lang.order_plural')}}</a></li>

                    <li class="breadcrumb-item">Order Details</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link " href="{!! route('restaurant.orders') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.order_plural')}} List </a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a; border-radius: 2px;">
                                <a class="nav-link active" href="{{ url()->current() }}"><i class="fa fa-plus mr-2"></i>{{trans('lang.order_plural')}} Edit</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                       
                        <div class="error_top"></div>

                        <div class="row restaurant_payout_create">
                            <div class="restaurant_payout_create-inner">
                                @foreach($order->order_items as $orderItem)
                                  
                                <fieldset>
                                    <legend>Order Item</legend>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Product Name</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control " name="food_name" value=" {{ $orderItem->foodName }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Quantity</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control " name="quantity" value="{{ $orderItem->quantity }}" readonly>
                                       
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Size</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control " name="size" value="{{ $orderItem->size }}" readonly>
                                       
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Price</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control " name="size" value="{{ $orderItem->amount }}" readonly>
                                       
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Product Image</label>
                                        <div class="col-7">
                                            <img src="{{ $orderItem->foodImage}}" class="product-img" alt="vendor" width="70px" height="70px">                                       
                                        </div>
                                    </div>
                                </fieldset>
                                
                              @endforeach
                              <fieldset>
                                    <legend>{{trans('user')}} Details</legend>

                                      <div class="form-group row width-50">
                                        <label class="col-3 control-label">Name</label>
                                        <div class="form-check width-100">
                                          <input type="text" class="form-control" name="name" value="{{$order->users->name ?? ''}}" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group row width-50">
                                          <label class="col-3 control-label">Mobile Number</label>
                                        <div class="form-check width-100">
                                          <input type="text" class="form-control" name="mobile_number" value="{{$order->users->mobile_number ?? ''}}" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group row width-50">
                                        <label class="col-3 control-label">Email</label>
                                        <div class="form-check width-100">
                                          <input type="text" class="form-control" name="mobile_number" value="{{$order->users->email ?? ''}}" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group row width-100">
                                        <label class="col-3 control-label">Address</label>
                                        <div class="form-check width-100">
                                            <textarea row="2" cols="3" class="form-control">{{$order->users->address ?? ''}}</textarea>
                                        </div>
                                      </div>
                        
                                </fieldset>
                              <fieldset>
                                    <legend>{{trans('Order')}} Status</legend>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Name</label>
                                        <div class="form-check width-100">
                                          <input type="text" class="form-control" name="name" value="{{$order->order_id}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Status</label>
                                        <div class="form-check width-100">
                                            <select class="form-control form-select" name="order_status">
                                                <option value="0" @if($order->order_status == 0) selected @endif>New Order</option>
                                                <option value="-1" @if($order->order_status == -1) selected @endif>Cancel</option>
                                                <option value="1" @if($order->order_status == 1) selected @endif>Accept</option>
                                                <option value="2" @if($order->order_status == 2) selected @endif>Order Dispatch</option>
                                                <option value="3" @if($order->order_status == 3) selected @endif>payment Completed</option>
                                                <option value="4" @if($order->order_status == 4) selected @endif>Completed</option>
                                            </select>
                                        </div>
                                    </div>

                                     
                        
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group col-12 text-center btm-btn">
                            @if($order->order_status != 4 && $order->order_status != -1)
                                <button type="submit" class="btn btn-primary save_driver_btn"><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>
                            @endif
                            <a href="{!! route('restaurant.orders') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
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


@endsection
