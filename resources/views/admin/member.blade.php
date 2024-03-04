@extends('admin.layouts.app')

@section('content')

<div id="main-wrapper" class="page-wrapper" style="min-height: 207px;">

	<div class="container-fluid">
		
		<!--<div id="data-table_processing" class="dataTables_processing panel panel-default"-->
  <!--           style="display: none;margin-top:20px;">{{trans('lang.processing')}}-->
  <!--      </div>-->
		
		<div class="card mb-3 business-analytics" style="background:none !important">
			
			<div class="card-body">
			
				
				<div class="row business-analytics_list">
					
					<div class="col-sm-6 col-lg-3 mb-3">
						<div class="card-box" onclick="location.href='{!! route('admin.orders') !!}'">
							<h5>Order</h5>
							<!--<strong>5245</strong>-->
							<h2 id="earnings_count">{{$countOrder}}</h2>
							<i class="fa fa-shopping-cart" style="background: #ffc107;" aria-hidden="true"></i>
						</div>
					</div>
					
					<div class="col-sm-6 col-lg-3 mb-3">
						<div class="card-box" onclick="location.href='{!! route('admin.users') !!}'">
							<h5>New Signup</h5>
							<!--<strong>561</strong>-->
							<h2 id="vendor_count">{{$count}}</h2>
							<i class="fa fa-user" aria-hidden="true" style="background:#007bff;"></i>
						</div>
					</div>
					
					<div class="col-sm-6 col-lg-3 mb-3">
						<div class="card-box" onclick="location.href='{!! route('admin.drivers') !!}'">
							<h5>Riders</h5>
							<!--<strong>20</strong>-->
							<h2 id="order_count">{{$countd}}</h2>
							<i class="fa fa-users" aria-hidden="true" style="background:#28a745;"></i>
						</div>
					</div>
					
					<div class="col-sm-6 col-lg-3 mb-3">
						<div class="card-box" onclick="location.href='{!! route('admin.products') !!}'">
							<h5>Partner</h5>
							<!--<strong>30</strong>-->
							<h2 id="product_count">{{$rcount}}</h2>
							<i class="fa fa-address-book" aria-hidden="true" style="background:#e8ffc6;"></i>
						</div>
					</div>
					
				</div>
				
				<div class="row">
				    <div class="col-xl-12 col-md-6 col-12">
				        <div class="card card-statistics">
				            <div class="card-header">
				                <h4 class="card-title">Statistics</h4>
				                <div class="d-flex align-items-center">
				                    <!--<p class="card-text font-small-2 mr-25 mb-0">Updated 1 month ago</p>-->
				                    </div>
				                    </div>
				                    <div class="card-body statistics-body">
				                        <div class="row">
				                            <div class="col-sm-6 col-xl-3 mb-2 mb-xl-0">
				                                <div class="media">
				                                    <div class="avatar bg-light-primary mr-2">
				                                    <div class="avatar-content">
				                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up avatar-icon"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
				                                        </div>
				                                        
				                                        </div>
				                                        <div class="media-body my-auto">
				                                            <h4 class="font-weight-bolder mb-0">0</h4>
				                                            <p class="card-text font-small-3 mb-0">Sales</p>
				                                            </div>
				                                        </div>
				                                    </div>
				                                <div class="col-sm-6 col-xl-3 mb-2 mb-xl-0">
				                                    <div class="media">
				                                        <div class="avatar bg-light-info mr-2">
				                                            <div class="avatar-content">
				                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user avatar-icon"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
				                                                
				                                                </div>
				                                            </div>
				                                        <div class="media-body my-auto">
				                                            <h4 class="font-weight-bolder mb-0" id="users_count">{{$count}}</h4>
				                                                <p class="card-text font-small-3 mb-0">Customers</p>
				                                                </div>
				                                            </div>
				                                        </div>
				                                        <div class="col-sm-6 col-xl-3 mb-2 mb-sm-0">
				                                            <div class="media">
				                                                <div class="avatar bg-light-danger mr-2">
				                                                    <div class="avatar-content">
				                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box avatar-icon"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
				                                                        
				                                                        </div>
				                                                    </div>
				                                                <div class="media-body my-auto"><h4 class="font-weight-bolder mb-0" id="product_count">{{$food}}</h4>
				                                                <p class="card-text font-small-3 mb-0">Products</p>
				                                                </div>
				                                                </div>
				                                                </div>
				                                                <div class="col-sm-6 col-xl-3"><div class="media">
				                                                    <div class="avatar bg-light-success mr-2">
				                                                        <div class="avatar-content">
				                                                          <i class="fa fa-inr" aria-hidden="true" style="font-size: 19px;"></i>
				                                                            </div>
				                                                            </div>
				                                                            <div class="media-body my-auto">
				                                                                <h4 class="font-weight-bolder mb-0"><i class="fa fa-inr" aria-hidden="true"></i> 0</h4>
				                                                                <p class="card-text font-small-3 mb-0">Revenue</p>
				                                                                </div>
				                                                            </div>
				                                                        </div>
				                                                    </div>
				                                                </div>
				                                            </div>
				                                        </div>
				    
				                                    </div>
				                                    

			                <!-----------end row---------------------->
			
			
				
				<div class="row match-height ng-star-inserted">
	<div class="col-lg-4 col-12">
		<div class="row match-height">
			
			<div class="col-lg-12 col-md-6 col-6">
				<div class="card card-tiny-line-stats">
					<div class="card-body pb-50" style="height:400px">
						<h6>Profit</h6>
						<h2 class="font-weight-bolder mb-1">0</h2>
					
						<div class="p-6 m-20 bg-white rounded shadow">
                        <!--<h1>{{ $chart1->options['chart_title'] }}</h1>-->
                                        {!! $chart1->renderHtml() !!}
                        </div>
					</div>
				</div>
			</div>
		
		</div>
	</div>
	<div class="col-lg-8 col-12">
		<div class="card card-revenue-budget">
			<div class="row mx-0">

				<div class="col-md-12 col-12 revenue-report-wrapper" style="height:400px;">
					<div class="d-sm-flex justify-content-between align-items-center mb-3">
						<h4 class="card-title mb-50 mb-sm-0">Revenue Report</h4>
						<div class="d-flex align-items-center">
							<div class="d-flex align-items-center mr-2"><span
									class="bullet bullet-primary font-small-3 mr-50 cursor-pointer"></span><span>Earning</span>
							</div>
							<div class="d-flex align-items-center ml-75"><span
									class="bullet bullet-warning font-small-3 mr-50 cursor-pointer"></span><span>Expense</span>
							</div>
						</div>
					</div>
						<div class="p-6 m-20 bg-white rounded shadow">
                        <!--<h1>{{ $chart1->options['chart_title'] }}</h1>-->
                                        {!! $chart2->renderHtml() !!}
                        </div>
				
				</div>
			
			</div>
		</div>
	</div>
</div>

</div>
		
	
        
        <div class="row daes-sec-sec mb-3">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header no-border d-flex justify-content-between">
                        <h3 class="card-title">{{trans('lang.restaurant_plural')}}</h3>
                        <div class="card-tools">
                            <a href="{{route('admin.restaurants')}}" class="btn btn-tool btn-sm"><i class="fa fa-bars"></i> </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                            <tr>
                                <th style="text-align:center">{{trans('lang.restaurant_image')}}</th>
                                <th>{{trans('lang.restaurant')}}</th>
                                <th>{{trans('lang.restaurant_review_review')}}</th>
                                <th>{{trans('lang.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody id="append_list">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header no-border d-flex justify-content-between">
                        <h3 class="card-title">{{trans('lang.recent_orders')}}</h3>
                        <div class="card-tools">
                            <a href="{{route('admin.orders')}}" class="btn btn-tool btn-sm"><i class="fa fa-bars"></i> </a>
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
        </div>
        
        <div class="row daes-sec-sec">
        	
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header no-border d-flex justify-content-between">
                        <h3 class="card-title">{{trans('lang.top_drivers')}}</h3>
                        <div class="card-tools">
                            <a href="{{route('admin.drivers')}}" class="btn btn-tool btn-sm"><i class="fa fa-bars"></i> </a>
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
            
            <div class="col-lg-6">
            </div>	
        </div>
        
        <!-- ============================================================== -->

        <!-- End Right sidebar -->

        <!-- ============================================================== -->

    </div>

    <!-- ============================================================== -->

    <!-- End Container fluid  -->

    <!-- ============================================================== -->

    <!-- ============================================================== -->

    <!-- footer -->

    <!-- ============================================================== -->


    <!-- ============================================================== -->

    <!-- End footer -->

    <!-- ============================================================== -->
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
    
    {!! $chart2->renderChartJsLibrary() !!}
    {!! $chart2->renderJs() !!}

</div>

@endsection

@section('scripts')

<script src="{{asset('js/chart.js')}}"></script>


@endsection

