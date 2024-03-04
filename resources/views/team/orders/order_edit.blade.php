@extends('team.layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.order_plural')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('team/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                    <li class="breadcrumb-item"><a href="{!! route('team.orders') !!}">{{trans('lang.order_plural')}}</a></li>

                    <li class="breadcrumb-item">Order Details</li>
                </ol>
            </div>
        </div>

        <div class="card-body">
            <div id="data-table_processing" class="dataTables_processing panel panel-default"
                 style="display: none;">{{trans('lang.processing')}}</div>
            <div class="text-right print-btn">
                <a href="">
                   <a href="{{ url('team/orders/pdf/'.$orders->id) }}"  class="btn btn-sm btn-primary"> <i class="fa fa-print"></i> </a>
                </a>
            </div>

            <div class="order_detail" id="order_detail">
                <div class="order_detail-top">
                    <div class="row">
                        <div class="order_edit-genrl col-md-6">

                            <h3>{{trans('lang.general_details')}}</h3>
                            <div class="order_detail-top-box bg-light">

                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label">
                                        <strong>{{trans('lang.date_created')}}: </strong>
                                        <span id="createdAt">{{$orders->updated_at}}</span>
                                    </label>
                                </div>

                                <div class="form-group row widt-100 gendetail-col payment_method">
                                    <label class="col-12 control-label">
                                        <strong>{{trans('lang.payment_methods')}}:</strong>
                                        <span id="payment_method">{{$orders->payment_type}}</span>
                                    </label>
                                </div>

                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label">
                                        <strong>{{trans('lang.order_type')}}:</strong>
                                        <span id="order_type">
                                            @if($orders->order_type==1)
                                                {{ __('Home Delevery') }}
                                            @else
                                                {{ __('Self') }}
                                            @endif
                                        </span>
                                    </label>
                                </div>
                                
                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label"><strong>{{trans('lang.status')}}:</strong>
                                        <span id="order_type">
                                            @if($orders->order_status == 1)
                                                Accepted
                                            @elseif($orders->order_status == 0)
                                                New Order
                                            @elseif($orders->order_status == -1)
                                                Cancele
                                            @elseif($orders->order_status == 2)
                                                Order Dishpatch
                                            @elseif($orders->order_status == 3)
                                                Payment Completed
                                            @elseif($orders->order_status == 4)
                                                Order Complete
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
                                    <strong>{{trans('lang.name')}}: </strong><span id="billing_name">{{isset($orders->users->name)?$orders->users->name:""}}</span>
                                </p>
                                <p>
                                    <strong>{{trans('lang.address')}}: </strong>
                                    <span id="billing_line1">{{isset($orders->users->address)?$orders->users->address:""}}</span>
                                </p>
                                <p><strong>Email:</strong>
                                    <span id="billing_email">{{isset($orders->users->email)?$orders->users->email:""}}</span> 
                                </p>
                                <p><strong>{{trans('lang.phone')}}:</strong>
                                    <span id="billing_phone">{{isset($orders->users->mobile_number)?$orders->users->mobile_number:""}}</span>
                                </p>
                            </div>
                        </div>
                        @if($orders->driver)
                        <div class="order_addre-edit col-md-6 driver_details_hide">
                            <h3>{{ trans('lang.driver_detail')}}</h3>

                            <div class="address order_detail-top-box">
                                <p>
                                    <strong>{{trans('lang.name')}}: </strong><span id="driver_firstName"></span> 
                                    <span id="driver_lastName">{{$orders->driver->first_name.' '. $orders->driver->last_name}}</span><br>
                                </p>
                                <p>
                                    <strong>{{trans('lang.email_address')}}:</strong>
                                    <span id="driver_email">{{$orders->driver->email}}</span>
                                </p>
                                <p>
                                    <strong>{{trans('lang.phone')}}:</strong>
                                    <span id="driver_phone">{{$orders->driver->phone}}</span>
                                </p>
                                <p>
                                    <strong>{{trans('lang.address')}}:</strong>
                                    <span id="driver_phone">{{$orders->driver->address}}</span>
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
                                                <img src="{{ asset('images/restaurants/' . $orders->restaurant->image) }}" class="resturant-img" alt="vendor"
                                                     width="70px" height="70px">
                                            </div>
                                            <div class="col-8">
                                                <h4 class="vendor-title">
                                                   
                                                </h4>
                                            </div>
                                        </a>

                                        <h5 class="contact-info">{{trans('lang.contact_info')}}:</h5>
                                    
                                        <p><strong>{{trans('lang.phone')}}:</strong>
                                            <span id="vendor_phone"> {{$orders->restaurant->phone}}</span>
                                        </p>
                                        <p><strong>{{trans('lang.address')}}:</strong>
                                            <span id="vendor_address">{{$orders->restaurant->address}}</span>
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
                                                <th>{{trans('lang.total')}}</th>
                                            </tr>

                                            </thead>

                                            <tbody id="order_products">
                                                @if($orders->order_items)
                                                    @foreach($orders->order_items as $item_data)
                                                    <!--{{$item_data}}-->
                                                        <tr>
                                                            <td>
                                                              <img src="{{ $item_data->foodImage }}" class="resturant-img" alt="vendor" width="70px" height="70px">
                                                            </td>
                                                            <td>{{$item_data->foodName}}</td>
                                                            <td>{{$item_data->amount}}</td>
                                                            <td>{{$item_data->size}}</td>
                                                            <td>{{$orders->amount}}</td>
                                                        </tr>
                                                        
                                                    @endforeach
                                                @endif
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
                                               @if($orders->reviews)
                                                    @foreach($orders->reviews as $reviews)
                                                        <tr class="w-100">
                                                            <td>Product Rating</td>
                                                            <td>
                                                            @php
                                                                $rating = $reviews->product_rating; 
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
                                                        <tr>
                                                            <td>Restaurant Rating</td>
                                                            <td>
                                                            @php
                                                                $rating = $reviews->product_rating; 
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
                                                        <tr>
                                                            <td>Driver Rating</td>
                                                            <td>
                                                            @php
                                                                $rating = $reviews->driver_rating; 
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
                                                        <tr>
                                                            <td>Comments </td>
                                                        </tr>
                                                        <tr>
                                                             <td colspan="2">
                                                                <p style="border: 1px solid gray;padding: 12px;border-radius: 5px;height: 7rem;overflow: auto; color:#000;">{{$reviews->comment}}</p>
                                                            </td>
                                                        </tr>
                                                        
                                                    @endforeach
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
            <button type="button" class="btn btn-primary save_order_btn"><i
                        class="fa fa-save"></i> {{trans('lang.save')}}</button>

            <?php if(isset($_GET['eid']) && $_GET['eid'] != ''){?>
            <a href="{{route('team.restaurants.orders',$_GET['eid'])}}" class="btn btn-default"><i
                        class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            <?php }else{ ?>
            <a href="{!! route('team.orders') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}
            </a>
        <?php } ?>

        </div>

    </div>

    </div>
    </div>


@endsection

@section('style')
    
@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js"></script>


@endsection
