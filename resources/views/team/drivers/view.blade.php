@extends('team.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor restaurantTitle">{{trans('lang.driver_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('team.riders') !!}">{{trans('lang.driver_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.restaurant_details')}}</li>
            </ol>
        </div>

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="resttab-sec">
                    <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
                    <div class="menu-tab">

                        <ul>
                            <li class="active">
                                <a href="{{route('team.riders.view',$id)}}">{{trans('lang.tab_basic')}}</a>
                            </li>
                            <li>
                                <a href="{{route('team.riders.orders',$id)}}">{{trans('lang.tab_orders')}}</a>
                            </li>
                            <li>
                                <a href="{{route('team.riders.order.balance',$id)}}">{{trans('lang.tab_payouts')}}</a>
                            </li>

                        </ul>

                    </div>
                    <div class="row daes-top-sec mb-3">
                        <div class="col-lg-6 col-md-6">

                            <a href="">

                                <div class="card">

                                    <div class="flex-row">

                                        <div class="p-10 bg-info col-md-12 text-center">

                                            <h3 class="text-white box m-b-0"><i class="mdi mdi-cart"></i></h3>
                                        </div>

                                        <div class="align-self-center pt-3 col-md-12 text-center">

                                            <h3 class="m-b-0 text-info" id="total_orders">{{$orderCount}}</h3>

                                            <h5 class="text-muted m-b-0">{{trans('lang.dashboard_total_orders')}}</h5>

                                        </div>

                                    </div>

                                </div>
                            </a>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <a href="">
                                <div class="card">

                                    <div class="flex-row">

                                        <div class="p-10 bg-info col-md-12 text-center">

                                            <h3 class="text-white box m-b-0"><i class="mdi mdi-bank"></i></h3>
                                        </div>

                                        <div class="align-self-center pt-3 col-md-12 text-center">

                                            <h3 class="m-b-0 text-info" id="wallet_amount">{{$driver->wallet}}</h3>

                                            <h5 class="text-muted m-b-0">{{trans('lang.wallet_Balance')}}</h5>

                                        </div>

                                    </div>

                                </div>
                            </a>
                        </div>

                    </div>

                    <div class="row restaurant_payout_create driver_details">
                        <div class="restaurant_payout_create-inner">
                            <fieldset>
                                <legend>{{trans('lang.driver_details')}}</legend>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.first_name')}}</label>
                                    <div class="col-7" class="driver_name">
                                        <span class="driver_name" id="driver_name">{{$driver->first_name}}</span>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.email')}}</label>
                                    <div class="col-7">
                                        <span class="email">{{$driver->email}}</span>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.user_phone')}}</label>
                                    <div class="col-7">
                                        <span class="phone">{{$driver->phone}}</span>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.profile_image')}}</label>
                                    <div class="col-7 profile_image">
                                        <img src="{{ asset('images/driver/profile/' . $driver->profile_image) }}" width="100" height="100" alt="profile Photo">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{trans('lang.car_details')}}</legend>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.car_number')}}</label>
                                    <div class="col-7">
                                        <span class="car_number">{{$driver->car_number}}</span>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.car_name')}}</label>
                                    <div class="col-7">
                                        <span class="car_name">{{$driver->car_name}}</span>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.car_image')}}</label>
                                    <div class="col-7 car_image">
                                        <img src="{{ asset('images/driver/car_image/' . $driver->car_image) }}" width="100" height="100" alt="image Photo">
                                    </div>
                                </div>

                            </fieldset>
                            <fieldset>
                                <legend>{{trans('lang.bankdetails')}}</legend>
                                <div class="form-group row width-50">
                                    <label class="col-4 control-label">{{trans('lang.bank_name')}}</label>
                                    <div class="col-7">
                                        <span class="bank_name">{{$driver->bank_name}}</span>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-4 control-label">{{trans('lang.branch_name')}}</label>
                                    <div class="col-7">
                                        <span class="branch_name">{{$driver->branch_name}}</span>
                                    </div>
                                </div>


                                <div class="form-group row width-50">
                                    <label class="col-4 control-label">{{trans('lang.holer_name')}}</label>
                                    <div class="col-7">
                                        <span class="holer_name">{{$driver->holder_name}}</span>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-4 control-label">{{trans('lang.account_number')}}</label>
                                    <div class="col-7">
                                        <span class="account_number">{{$driver->account_number}}</span>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-4 control-label">IFSC Code</label>
                                    <div class="col-7">
                                        <span class="account_number">{{$driver->ifsc_code}}</span>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-4 control-label">{{trans('lang.other_information')}}</label>
                                    <div class="col-7">
                                        <span class="other_information">{{$driver->other_information}}</span>
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                    </div>


                </div>

            </div>
            <div class="form-group col-12 text-center btm-btn">
                <a href="{!! route('team.riders') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            </div>

        </div>
    </div>
</div>
</div>


@endsection