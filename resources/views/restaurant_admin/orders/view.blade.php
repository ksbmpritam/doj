@extends('restaurant_admin.layouts.app')

@section('content')
    <div class="page-wrapper">
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

        <div class="card-body">
            <div id="data-table_processing" class="dataTables_processing panel panel-default"
                 style="display: none;">{{trans('lang.processing')}}</div>
            <div class="text-right print-btn">
                <a href="{{ url('restaurant/orders/pdf/'.$orderId) }}" class="btn btn-success text-white"> <i class="fa fa-print"></i> </a>
            </div>

            <div class="order_detail" id="order_detail">
                <div class="order_detail-top">
                    <div class="row">
                        <div class="order_edit-genrl col-md-6">

                            <h3>{{trans('lang.general_details')}}</h3>
                            <div class="order_detail-top-box bg-light">
                                <div class="form-group row widt-100 gendetail-col payment_method">
                                    <label class="col-12 control-label">
                                        <strong>{{trans('lang.order_id')}}:</strong>
                                        <span id="payment_method">{{$order->order_id}}</span>
                                    </label>
                                </div>
                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label">
                                        <strong>{{trans('lang.date_created')}}: </strong>
                                        <span id="createdAt">{{$order->updated_at}}</span>
                                    </label>
                                </div>

                                <div class="form-group row widt-100 gendetail-col payment_method">
                                    <label class="col-12 control-label">
                                        <strong>{{trans('lang.payment_methods')}}:</strong>
                                        <span id="payment_method">{{$order->type}}</span>
                                        
                                    </label>
                                </div>

                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label">
                                        <strong>{{trans('lang.order_type')}}:</strong>
                                        <span id="payment_method">{{$order->responseCode}}</span>
                                    </label>
                                </div>
                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label">
                                        <strong>Transaction Id</strong>
                                        <span id="payment_method">{{$order->transactionId}}</span>
                                    </label>
                                </div>
                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label">
                                        <strong>Account Type</strong>
                                        <span id="payment_method">{{$order->accountType}}</span>
                                    </label>
                                </div>
                                
                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label"><strong>{{trans('lang.status')}}:</strong>
                                        <span id="order_type">
                                            @if($order->order_status == 1)
                                                <span class="text-info">Accepted</span>
                                            @elseif($order->order_status == 0)
                                                <span class="text-primary">New Order</span>
                                            @elseif($order->order_status == -1)
                                                <span class="text-danger">Cancele</span>
                                            @elseif($order->order_status == 2)
                                                <span class="text-primary">Order Dishpatch</span>
                                            @elseif($order->order_status == 3)
                                                <span class="text-success">Payment Completed</span>
                                            @elseif($order->order_status == 4)
                                                <span class="text-success">Order Complete</span>
                                            @endif
                                        </span>
                                    </label>
                                </div>
                                
                            </div>

                        </div>

                        <div class="order_addre-edit col-md-6">
                            <h3>{{ trans('lang.billing_details')}}</h3>
                            <div class="address order_detail-top-box">
                                <p>
                                    <strong>{{trans('lang.name')}}: </strong><span id="billing_name">{{isset($order->users->name)?$order->users->name:""}}</span>
                                </p>
                                <p>
                                    <strong>{{trans('lang.address')}}: </strong>
                                    <span id="billing_line1">{{isset($order->users->address)?$order->users->address:""}}</span>
                                </p>
                                <p><strong>Email:</strong>
                                    <span id="billing_email">{{isset($order->users->email)?$order->users->email:""}}</span> 
                                </p>
                                <p><strong>{{trans('lang.phone')}}:</strong>
                                    <span id="billing_phone">{{isset($order->users->mobile_number)?$order->users->mobile_number:""}}</span>
                                </p>
                                <p><strong>{{trans('lang.amount')}}:</strong>
                                    <span id="billing_phone">{{isset($order->amount)?$order->amount:""}}</span>
                                </p>
                            </div>
                        </div>
                        @if($order->driver)
                        <div class="order_addre-edit col-md-6 driver_details_hide">
                            <h3>{{ trans('lang.driver_detail')}}</h3>

                            <div class="address order_detail-top-box">
                                <p>
                                    <strong>{{trans('lang.name')}}: </strong><span id="driver_firstName"></span> 
                                    <span id="driver_lastName">{{$order->driver->first_name.' '. $order->driver->last_name}}</span><br>
                                </p>
                                <p>
                                    <strong>{{trans('lang.email_address')}}:</strong>
                                    <span id="driver_email">{{$order->driver->email}}</span>
                                </p>
                                <p>
                                    <strong>{{trans('lang.phone')}}:</strong>
                                    <span id="driver_phone">{{$order->driver->phone}}</span>
                                </p>
                                <p>
                                    <strong>{{trans('lang.address')}}:</strong>
                                    <span id="driver_phone">{{$order->driver->address}}</span>
                                </p>
                               
                            </div>
                        </div>
                        @endif
                        <div class="col-md-6 mt-3">
                            <div class="resturant-detail">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-header-title">{{trans('lang.restaurant')}}</h4>
                                    </div>

                                    <div class="card-body">
                                        <a href="#" class="row redirecttopage" id="resturant-view">
                                            <div class="col-4">
                                                <img src="{{ asset('images/restaurants/' . $order->restaurant->image) }}" class="resturant-img" alt="vendor"
                                                     width="70px" height="70px">
                                            </div>
                                            <div class="col-8">
                                                <h4 class="vendor-title">
                                                   
                                                </h4>
                                            </div>
                                        </a>

                                        <h5 class="contact-info">{{trans('lang.contact_info')}}:</h5>
                                    
                                        <p><strong>{{trans('lang.phone')}}:</strong>
                                            <span id="vendor_phone"> {{$order->restaurant->phone}}</span>
                                        </p>
                                        <p><strong>{{trans('lang.address')}}:</strong>
                                            <span id="vendor_address">{{$order->restaurant->address}}</span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        
                      
                        <div class="col-md-6 mt-3 order-deta-btm-left">
                            <div class="order-items-list ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table cellpadding="0" cellspacing="0"
                                               class="table table-striped table-valign-middle">

                                            <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Size</th>
                                            </tr>

                                            </thead>

                                            <tbody id="order_products">
                                                @foreach($order->items as $item)
                                                   
                                                   <tr>
                                                        <td><img src="{{$item->food->image_url ?? ''}}" class="restaurant-img" alt="{{ $item->food->name ?? '' }}" width="70px" height="70px"></td>
                                                        <td>{{$item->food->name ?? ''}}</td>
                                                        <td>{{$item->amount ?? ''}}</td>
                                                        <td>{{$item->size ?? ''}}</td>

                                                   </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
    
                        <div class="col-md-6">
                            <div class="order_detail-review mt-4">
                                <div class="row">
                                    <div class="rental-review col-md-12">
                                        <div class="review-inner">
                                            <h3>{{trans("lang.customer_reviews")}}</h3>
                                            <div id="customers_rating_and_review">
                                                <table cellpadding="0" cellspacing="0" class="table table-striped table-valign-middle">
                                                @if($order->foodreviews)
                                                        <tr class="w-100">
                                                            <td>Product Rating</td>
                                                            <td>
                                                            @php
                                                                $rating = $order->foodreviews->value ?? ''; 
                                                                $totalStars = 5; 
                                                                $filledStars = $rating; 
                                                            @endphp
                                                            @for ($i = 1; $i <= $totalStars; $i++)
                                                                @if ($i <= $filledStars)
                                                                    <span class="star-filled text-success" style="font-size: 30px;">&#9733;</span> {{-- Filled star --}}
                                                                @else
                                                                    <span class="star-empty" style="font-size: 30px;">&#9734;</span> {{-- Empty star --}}
                                                                @endif
                                                            @endfor
                                                            </td>
                                                        </tr>
                                                @endif
                                                @if($order->resturantreviews)
                                                        <tr>
                                                            <td>Restaurant Rating</td>
                                                            <td>
                                                            @php
                                                                $rating = $order->resturantreviews->value ?? ''; 
                                                                $totalStars = 5; 
                                                                $filledStars = $rating; 
                                                            @endphp
                                                            @for ($i = 1; $i <= $totalStars; $i++)
                                                                @if ($i <= $filledStars)
                                                                    <span class="star-filled text-success" style="font-size: 30px;">&#9733;</span> {{-- Filled star --}}
                                                                @else
                                                                    <span class="star-empty" style="font-size: 30px;">&#9734;</span> {{-- Empty star --}}
                                                                @endif
                                                            @endfor
                                                            </td>
                                                        </tr>
                                                @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                           
                    </div>

                <!--</div>-->
            </div>

        </div>

        <div class="form-group col-12 text-center btm-btn">
            <!--<button type="button" class="btn btn-primary save_order_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>-->

            <a href="{!! route('restaurant.orders') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>

        </div>

    </div>

    </div>
    </div>


@endsection

@section('style')
    
@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js"></script>


@endsection
