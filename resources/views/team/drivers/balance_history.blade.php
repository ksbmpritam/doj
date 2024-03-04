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

                    <?php if(isset($_GET['eid']) && $_GET['eid'] != ''){?>
                    <li class="breadcrumb-item"><a
                                href="{{route('team.restaurants.orders',$_GET['eid'])}}">{{trans('lang.order_plural')}}</a>
                    </li>
                    <?php }else{ ?>
                    <li class="breadcrumb-item"><a href="{!! route('team.riders') !!}">{{trans('lang.order_plural')}}</a>
                    </li>
                    <?php } ?>

                    <li class="breadcrumb-item">{{trans('lang.order_edit')}}</li>
                </ol>
            </div>
        </div>

        <div class="card-body">
            <div id="data-table_processing" class="dataTables_processing panel panel-default"
                 style="display: none;">{{trans('lang.processing')}}</div>
            <div class="text-right print-btn">
                <a href="">
                    <a href="{{ url('team/riders/order/pdf/'.$orders->id) }}"  class="btn btn-sm btn-primary"> <i class="fa fa-print"></i> </a>
                </a>
            </div>

            <div class="order_detail" id="order_detail">
                <div class="order_detail-top">
                    <div class="row">
                        <div class="order_edit-genrl col-md-7">

                            <h3>{{trans('lang.general_details')}}</h3>
                            <div class="order_detail-top-box">

                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label"><strong>{{trans('lang.date_created')}}
                                            : </strong><span id="createdAt">{{$orders->restaurant->updated_at}}</span></label>
                                </div>

                                <div class="form-group row widt-100 gendetail-col payment_method">
                                    <label class="col-12 control-label"><strong>{{trans('lang.payment_methods')}}
                                            : </strong><span id="payment_method">{{$orders->restaurant->payment_type}}</span></label>
                                </div>

                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label"><strong>{{trans('lang.order_type')}}:</strong>
                                        <span id="order_type">{{$orders->restaurant->order_type}}</span></label>
                                </div>
                                
                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label"><strong>{{trans('lang.status')}}:</strong>
                                        <span id="order_type">{{$orders->restaurant->order_status}}</span></label>
                                </div>
                                <!--<div class="form-group row width-100 ">-->
                                <!--    <label class="col-3 control-label">{{trans('lang.status')}}:</label>-->
                                <!--    <div class="col-7">-->
                                <!--        <select id="order_status" class="form-control">-->
                                <!--            <option value="Order Placed"-->
                                <!--                    id="order_placed">{{ trans('lang.order_placed')}}</option>-->
                                <!--            <option value="Order Accepted"-->
                                <!--                    id="order_accepted">{{ trans('lang.order_accepted')}}</option>-->
                                <!--            <option value="Order Rejected"-->
                                <!--                    id="order_rejected">{{ trans('lang.order_rejected')}}</option>-->
                                <!--            <option value="Driver Pending"-->
                                <!--                    id="driver_pending">{{ trans('lang.driver_pending')}}</option>-->
                                <!--            <option value="Driver Rejected"-->
                                <!--                    id="driver_rejected">{{ trans('lang.driver_rejected')}}</option>-->
                                <!--            <option value="Order Shipped"-->
                                <!--                    id="order_shipped">{{ trans('lang.order_shipped')}}</option>-->
                                <!--            <option value="In Transit"-->
                                <!--                    id="in_transit">{{ trans('lang.in_transit')}}</option>-->
                                <!--            <option value="Order Completed"-->
                                <!--                    id="order_completed">{{ trans('lang.order_completed')}}</option>-->
                                <!--        </select>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <!--<div class="form-group row width-100">-->
                                <!--    <label class="col-3 control-label"></label>-->
                                <!--    <div class="col-7 text-right">-->
                                <!--        <button type="button" class="btn btn-primary save_order_btn"><i-->
                                <!--                    class="fa fa-save"></i> {{trans('lang.update')}}</button>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>

                        </div>

                        <div class="order_addre-edit col-md-5">
                            <h3>{{ trans('lang.billing_details')}}</h3>

                            <div class="address order_detail-top-box">
                                <p>
                                    <strong>{{trans('lang.name')}}: </strong><span id="billing_name">{{$orders->users->name}}</span>
                                </p>
                                <p>
                                    <strong>{{trans('lang.address')}}: </strong>
                                    <span id="billing_line1">{{$orders->users->address}}</span>
                                </p>
                                <p><strong>{{trans('lang.email_address')}}:</strong>
                                    <span id="billing_email">{{$orders->users->email}}</span> 
                                </p>
                                <p><strong>{{trans('lang.phone')}}:</strong>
                                    <span id="billing_phone">{{$orders->users->mobile_number}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="order_addre-edit col-md-6 driver_details_hide">
                            <h3>{{ trans('lang.driver_detail')}}</h3>

                            <div class="address order_detail-top-box">
                                <p>
                                    <strong>{{trans('lang.name')}}: </strong><span id="driver_firstName"></span> <span
                                            id="driver_lastName"></span><br>
                                </p>
                                <p><strong>{{trans('lang.email_address')}}:</strong>
                                    <span id="driver_email"></span>
                                </p>
                                <p><strong>{{trans('lang.phone')}}:</strong>
                                    <span id="driver_phone"></span>
                                </p>
                                <p><strong>{{trans('lang.car_name')}}:</strong>
                                    <span id="driver_carName"></span>
                                </p>
                                <p><strong>{{trans('lang.car_number')}}:</strong>
                                    <span id="driver_carNumber"></span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="resturant-detail">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-header-title">{{trans('lang.restaurant')}}</h4>
                                    </div>

                                    <div class="card-body">
                                        <a href="#" class="row redirecttopage" id="resturant-view">
                                            <div class="col-4">
                                                <img src="" class="resturant-img rounded-circle" alt="vendor"
                                                     width="70px" height="70px">
                                            </div>
                                            <div class="col-8">
                                                <h4 class="vendor-title"></h4>
                                            </div>
                                        </a>

                                        <h5 class="contact-info">{{trans('lang.contact_info')}}:</h5>
                                    
                                        <p><strong>{{trans('lang.phone')}}:</strong>
                                            <span id="vendor_phone"></span>
                                        </p>
                                        <p><strong>{{trans('lang.address')}}:</strong>
                                            <span id="vendor_address"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                <!--</div>-->


                <div class="order-deta-btm mt-4">
                    <div class="row">
                        <div class="col-md-8 order-deta-btm-left">
                            <div class="order-items-list ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table cellpadding="0" cellspacing="0"
                                               class="table table-striped table-valign-middle">

                                            <thead>
                                            <tr>
                                                <th>{{trans('lang.item')}}</th>
                                                <th>{{trans('lang.price')}}</th>
                                                <th>{{trans('lang.qty')}}</th>
                                                <th>{{trans('lang.extras')}}</th>
                                                <th>{{trans('lang.total')}}</th>
                                            </tr>

                                            </thead>

                                            <tbody id="order_products">
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="order-data-row order-totals-items">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="order-totals">

                                            <tbody id="order_products_total">
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                    </div>
                </div>

                <div class="order_detail-review mt-4">
                    <div class="row">
                        <div class="rental-review col-md-12">
                            <div class="review-inner">
                                <h3>{{trans("lang.customer_reviews")}}</h3>
                                <div id="customers_rating_and_review">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="form-group col-12 text-center btm-btn">
            <!--<button type="button" class="btn btn-primary save_order_btn"><i-->
            <!--            class="fa fa-save"></i> {{trans('lang.save')}}</button>-->

            <?php if(isset($_GET['eid']) && $_GET['eid'] != ''){?>
            <a href="{{route('team.restaurants.orders',$_GET['eid'])}}" class="btn btn-default"><i
                        class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            <?php }else{ ?>
            <a href="{!! route('team.riders') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}
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