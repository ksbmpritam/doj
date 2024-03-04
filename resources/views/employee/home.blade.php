@extends('employee.layouts.app')

@section('content')

<div id="main-wrapper" class="page-wrapper" style="min-height: 207px;">

    <div class="container-fluid">

        <div class="card mb-3 business-analytics" style="background:none !important">

            <div class="card-body">


                <div class="row business-analytics_list">

                    <div class="col-sm-6 col-lg-3 mb-3">
                        <div class="card-box" onclick="location.href='{!! route('employee.department') !!}'">
                            <h5>Department</h5>
                            <!--<strong>5245</strong>-->
                            <h2 id="earnings_count">{{$departments_count}}</h2>
                            <i class="fa fa-shopping-cart" style="background: #ffc107;" aria-hidden="true"></i>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3 mb-3">
                        <div class="card-box" onclick="location.href='{!! route('employee.team') !!}'">
                            <h5>Team</h5>
                            <!--<strong>20</strong>-->
                            <h2 id="order_count">{{$team_count}}</h2>
                            <i class="fa fa-users" aria-hidden="true" style="background:#28a745;"></i>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-3">
                        <div class="card-box" onclick="location.href='{!! route('employee.zone') !!}'">
                            <h5>Zone</h5>
                            <!--<strong>20</strong>-->
                            <h2 id="order_count">{{$zone_count}}</h2>
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </div>
                    </div>

                </div>

                <!--<div class="row">-->
                <!--    <div class="col-xl-12 col-md-6 col-12">-->
                <!--        <div class="card card-statistics">-->
                <!--            <div class="card-header">-->
                <!--                <h4 class="card-title">Statistics</h4>-->
                <!--                <div class="d-flex align-items-center">-->
                                    <!--<p class="card-text font-small-2 mr-25 mb-0">Updated 1 month ago</p>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="card-body statistics-body">-->
                <!--                <div class="row">-->
                <!--                    <div class="col-sm-6 col-xl-3 mb-2 mb-xl-0">-->
                <!--                        <div class="media">-->
                <!--                            <div class="avatar bg-light-primary mr-2">-->
                <!--                                <div class="avatar-content">-->
                <!--                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up avatar-icon">-->
                <!--                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>-->
                <!--                                        <polyline points="17 6 23 6 23 12"></polyline>-->
                <!--                                    </svg>-->
                <!--                                </div>-->

                <!--                            </div>-->
                <!--                            <div class="media-body my-auto">-->
                <!--                                <h4 class="font-weight-bolder mb-0">0</h4>-->
                <!--                                <p class="card-text font-small-3 mb-0">Sales</p>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                    <div class="col-sm-6 col-xl-3 mb-2 mb-xl-0">-->
                <!--                        <div class="media">-->
                <!--                            <div class="avatar bg-light-info mr-2">-->
                <!--                                <div class="avatar-content">-->
                <!--                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user avatar-icon">-->
                <!--                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>-->
                <!--                                        <circle cx="12" cy="7" r="4"></circle>-->
                <!--                                    </svg>-->

                <!--                                </div>-->
                <!--                            </div>-->
                <!--                            <div class="media-body my-auto">-->
                <!--                                <h4 class="font-weight-bolder mb-0" id="users_count">{{$zone_count}}</h4>-->
                <!--                                <p class="card-text font-small-3 mb-0">Customers</p>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                    <div class="col-sm-6 col-xl-3 mb-2 mb-sm-0">-->
                <!--                        <div class="media">-->
                <!--                            <div class="avatar bg-light-danger mr-2">-->
                <!--                                <div class="avatar-content">-->
                <!--                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box avatar-icon">-->
                <!--                                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>-->
                <!--                                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>-->
                <!--                                        <line x1="12" y1="22.08" x2="12" y2="12"></line>-->
                <!--                                    </svg>-->

                <!--                                </div>-->
                <!--                            </div>-->
                <!--                            <div class="media-body my-auto">-->
                <!--                                <h4 class="font-weight-bolder mb-0" id="product_count">{{$zone_count}}</h4>-->
                <!--                                <p class="card-text font-small-3 mb-0">Products</p>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                    <div class="col-sm-6 col-xl-3">-->
                <!--                        <div class="media">-->
                <!--                            <div class="avatar bg-light-success mr-2">-->
                <!--                                <div class="avatar-content">-->
                <!--                                    <i class="fa fa-inr" aria-hidden="true" style="font-size: 19px;"></i>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                            <div class="media-body my-auto">-->
                <!--                                <h4 class="font-weight-bolder mb-0"><i class="fa fa-inr" aria-hidden="true"></i> 0</h4>-->
                <!--                                <p class="card-text font-small-3 mb-0">Revenue</p>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->

                <!--</div>-->

            </div>
            <div class="row daes-sec-sec mb-3">
               
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header no-border d-flex justify-content-between">
                            <h3 class="card-title">{{trans('lang.recent_orders')}}</h3>
                            <div class="card-tools">
                                <a href="" class="btn btn-tool btn-sm"><i class="fa fa-bars"></i> </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">{{trans('lang.order_id')}}</th>
                                        <th>{{trans('lang.restaurant')}}</th>
                                        <th>{{trans('lang.total_amount')}}</th>
                                        <th>{{trans('lang.quantity')}}</th>
                                    </tr>
                                </thead>
                                <tbody id="append_list_recent_order">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header no-border d-flex justify-content-between">
                            <h3 class="card-title">{{trans('lang.top_drivers')}}</h3>
                            <div class="card-tools">
                                <a href="{{route('restaurant.drivers')}}" class="btn btn-tool btn-sm"><i class="fa fa-bars"></i> </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">{{trans('lang.restaurant_image')}}</th>
                                        <th>{{trans('lang.driver')}}</th>
                                        <th>{{trans('lang.order_completed')}}</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody id="append_list_top_drivers">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>

    @endsection

    @section('scripts')

    <script src="{{asset('js/chart.js')}}"></script>


    @endsection