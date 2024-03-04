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
						<div class="card-box" onclick="location.href='{!! route('admin.restaurants') !!}'">
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
						<!--<div id="statistics-line-chart"><apx-chart _nghost-ihp-c131="" style="position: relative;">-->
						<!--		<div _ngcontent-ihp-c131="" style="min-height: 85px;">-->
						<!--			<div id="apexchartsq78tcagh"-->
						<!--				class="apexcharts-canvas apexchartsq78tcagh apexcharts-theme-light"-->
						<!--				style="width: 144px; height: 70px;"><svg id="SvgjsSvg3062" width="144"-->
						<!--					height="70" xmlns="http://www.w3.org/2000/svg" version="1.1"-->
						<!--					xmlns:xlink="http://www.w3.org/1999/xlink"-->
						<!--					xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"-->
						<!--					xmlns:data="ApexChartsNS" transform="translate(0, 0)"-->
						<!--					style="background: transparent;">-->
						<!--					<g id="SvgjsG3064" class="apexcharts-inner apexcharts-graphical"-->
						<!--						transform="translate(12, 0)">-->
						<!--						<defs id="SvgjsDefs3063">-->
						<!--							<clipPath id="gridRectMaskq78tcagh">-->
						<!--								<rect id="SvgjsRect3069" width="129" height="68" x="-3.5"-->
						<!--									y="-1.5" rx="0" ry="0" opacity="1" stroke-width="0"-->
						<!--									stroke="none" stroke-dasharray="0" fill="#fff"></rect>-->
						<!--							</clipPath>-->
						<!--							<clipPath id="gridRectMarkerMaskq78tcagh">-->
						<!--								<rect id="SvgjsRect3070" width="134" height="77" x="-6" y="-6"-->
						<!--									rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"-->
						<!--									stroke-dasharray="0" fill="#fff"></rect>-->
						<!--							</clipPath>-->
						<!--						</defs>-->
						<!--						<line id="SvgjsLine3068" x1="-0.5" y1="0" x2="-0.5" y2="65"-->
						<!--							stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs"-->
						<!--							x="-0.5" y="0" width="1" height="65" fill="#b1b9c4" filter="none"-->
						<!--							fill-opacity="0.9" stroke-width="1"></line>-->
						<!--						<g id="SvgjsG3087" class="apexcharts-xaxis" transform="translate(0, 0)">-->
						<!--							<g id="SvgjsG3088" class="apexcharts-xaxis-texts-g"-->
						<!--								transform="translate(0, -4)"><text id="SvgjsText3090"-->
						<!--									font-family="Helvetica, Arial, sans-serif" x="0" y="94"-->
						<!--									text-anchor="middle" dominant-baseline="auto"-->
						<!--									font-size="0px" font-weight="400" fill="#373d3f"-->
						<!--									class="apexcharts-text apexcharts-xaxis-label "-->
						<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
						<!--									<tspan id="SvgjsTspan3091">1</tspan>-->
						<!--									<title>1</title>-->
						<!--								</text><text id="SvgjsText3093"-->
						<!--									font-family="Helvetica, Arial, sans-serif"-->
						<!--									x="24.399999999999995" y="94" text-anchor="middle"-->
						<!--									dominant-baseline="auto" font-size="0px" font-weight="400"-->
						<!--									fill="#373d3f"-->
						<!--									class="apexcharts-text apexcharts-xaxis-label "-->
						<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
						<!--									<tspan id="SvgjsTspan3094">2</tspan>-->
						<!--									<title>2</title>-->
						<!--								</text><text id="SvgjsText3096"-->
						<!--									font-family="Helvetica, Arial, sans-serif" x="48.8" y="94"-->
						<!--									text-anchor="middle" dominant-baseline="auto"-->
						<!--									font-size="0px" font-weight="400" fill="#373d3f"-->
						<!--									class="apexcharts-text apexcharts-xaxis-label "-->
						<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
						<!--									<tspan id="SvgjsTspan3097">3</tspan>-->
						<!--									<title>3</title>-->
						<!--								</text><text id="SvgjsText3099"-->
						<!--									font-family="Helvetica, Arial, sans-serif"-->
						<!--									x="73.19999999999999" y="94" text-anchor="middle"-->
						<!--									dominant-baseline="auto" font-size="0px" font-weight="400"-->
						<!--									fill="#373d3f"-->
						<!--									class="apexcharts-text apexcharts-xaxis-label "-->
						<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
						<!--									<tspan id="SvgjsTspan3100">4</tspan>-->
						<!--									<title>4</title>-->
						<!--								</text><text id="SvgjsText3102"-->
						<!--									font-family="Helvetica, Arial, sans-serif"-->
						<!--									x="97.59999999999998" y="94" text-anchor="middle"-->
						<!--									dominant-baseline="auto" font-size="0px" font-weight="400"-->
						<!--									fill="#373d3f"-->
						<!--									class="apexcharts-text apexcharts-xaxis-label "-->
						<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
						<!--									<tspan id="SvgjsTspan3103">5</tspan>-->
						<!--									<title>5</title>-->
						<!--								</text><text id="SvgjsText3105"-->
						<!--									font-family="Helvetica, Arial, sans-serif"-->
						<!--									x="121.99999999999999" y="94" text-anchor="middle"-->
						<!--									dominant-baseline="auto" font-size="0px" font-weight="400"-->
						<!--									fill="#373d3f"-->
						<!--									class="apexcharts-text apexcharts-xaxis-label "-->
						<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
						<!--									<tspan id="SvgjsTspan3106">6</tspan>-->
						<!--									<title>6</title>-->
						<!--								</text></g>-->
						<!--						</g>-->
						<!--						<g id="SvgjsG3108" class="apexcharts-grid">-->
						<!--							<g id="SvgjsG3109" class="apexcharts-gridlines-horizontal"></g>-->
						<!--							<g id="SvgjsG3110" class="apexcharts-gridlines-vertical">-->
						<!--								<line id="SvgjsLine3111" x1="0" y1="0" x2="0" y2="65"-->
						<!--									stroke="#ebebeb" stroke-dasharray="5"-->
						<!--									class="apexcharts-gridline"></line>-->
						<!--								<line id="SvgjsLine3112" x1="24.4" y1="0" x2="24.4" y2="65"-->
						<!--									stroke="#ebebeb" stroke-dasharray="5"-->
						<!--									class="apexcharts-gridline"></line>-->
						<!--								<line id="SvgjsLine3113" x1="48.8" y1="0" x2="48.8" y2="65"-->
						<!--									stroke="#ebebeb" stroke-dasharray="5"-->
						<!--									class="apexcharts-gridline"></line>-->
						<!--								<line id="SvgjsLine3114" x1="73.19999999999999" y1="0"-->
						<!--									x2="73.19999999999999" y2="65" stroke="#ebebeb"-->
						<!--									stroke-dasharray="5" class="apexcharts-gridline"></line>-->
						<!--								<line id="SvgjsLine3115" x1="97.6" y1="0" x2="97.6" y2="65"-->
						<!--									stroke="#ebebeb" stroke-dasharray="5"-->
						<!--									class="apexcharts-gridline"></line>-->
						<!--								<line id="SvgjsLine3116" x1="122" y1="0" x2="122" y2="65"-->
						<!--									stroke="#ebebeb" stroke-dasharray="5"-->
						<!--									class="apexcharts-gridline"></line>-->
						<!--							</g>-->
						<!--							<line id="SvgjsLine3118" x1="0" y1="65" x2="122" y2="65"-->
						<!--								stroke="transparent" stroke-dasharray="0"></line>-->
						<!--							<line id="SvgjsLine3117" x1="0" y1="1" x2="0" y2="65"-->
						<!--								stroke="transparent" stroke-dasharray="0"></line>-->
						<!--						</g>-->
						<!--						<g id="SvgjsG3071"-->
						<!--							class="apexcharts-line-series apexcharts-plot-series">-->
						<!--							<g id="SvgjsG3072" class="apexcharts-series" seriesName="seriesx1"-->
						<!--								data:longestSeries="true" rel="1" data:realIndex="0">-->
						<!--								<path id="SvgjsPath3086"-->
						<!--									d="M 0 65L 24.400000000000002 39L 48.800000000000004 58.5L 73.2 26L 97.60000000000001 45.5L 122.00000000000001 6.5"-->
						<!--									fill="none" fill-opacity="1" stroke="rgba(0,207,232,0.85)"-->
						<!--									stroke-opacity="1" stroke-linecap="butt" stroke-width="3"-->
						<!--									stroke-dasharray="0" class="apexcharts-line" index="0"-->
						<!--									clip-path="url(#gridRectMaskq78tcagh)"-->
						<!--									pathTo="M 0 65L 24.400000000000002 39L 48.800000000000004 58.5L 73.2 26L 97.60000000000001 45.5L 122.00000000000001 6.5"-->
						<!--									pathFrom="M -1 65L -1 65L 24.400000000000002 65L 48.800000000000004 65L 73.2 65L 97.60000000000001 65L 122.00000000000001 65">-->
						<!--								</path>-->
						<!--								<g id="SvgjsG3073" class="apexcharts-series-markers-wrap"-->
						<!--									data:realIndex="0">-->
						<!--									<g id="SvgjsG3075" class="apexcharts-series-markers"-->
						<!--										clip-path="url(#gridRectMarkerMaskq78tcagh)">-->
						<!--										<circle id="SvgjsCircle3076" r="2" cx="0" cy="65"-->
						<!--											class="apexcharts-marker no-pointer-events w3mlw69cb"-->
						<!--											stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"-->
						<!--											stroke-width="2" stroke-opacity="1" rel="0" j="0"-->
						<!--											index="0" default-marker-size="2"></circle>-->
						<!--										<circle id="SvgjsCircle3077" r="2"-->
						<!--											cx="24.400000000000002" cy="39"-->
						<!--											class="apexcharts-marker no-pointer-events wlsp16akq"-->
						<!--											stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"-->
						<!--											stroke-width="2" stroke-opacity="1" rel="1" j="1"-->
						<!--											index="0" default-marker-size="2"></circle>-->
						<!--									</g>-->
						<!--									<g id="SvgjsG3078" class="apexcharts-series-markers"-->
						<!--										clip-path="url(#gridRectMarkerMaskq78tcagh)">-->
						<!--										<circle id="SvgjsCircle3079" r="2"-->
						<!--											cx="48.800000000000004" cy="58.5"-->
						<!--											class="apexcharts-marker no-pointer-events wyrcxl0mg"-->
						<!--											stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"-->
						<!--											stroke-width="2" stroke-opacity="1" rel="2" j="2"-->
						<!--											index="0" default-marker-size="2"></circle>-->
						<!--									</g>-->
						<!--									<g id="SvgjsG3080" class="apexcharts-series-markers"-->
						<!--										clip-path="url(#gridRectMarkerMaskq78tcagh)">-->
						<!--										<circle id="SvgjsCircle3081" r="2" cx="73.2" cy="26"-->
						<!--											class="apexcharts-marker no-pointer-events wtz4l2thm"-->
						<!--											stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"-->
						<!--											stroke-width="2" stroke-opacity="1" rel="3" j="3"-->
						<!--											index="0" default-marker-size="2"></circle>-->
						<!--									</g>-->
						<!--									<g id="SvgjsG3082" class="apexcharts-series-markers"-->
						<!--										clip-path="url(#gridRectMarkerMaskq78tcagh)">-->
						<!--										<circle id="SvgjsCircle3083" r="2"-->
						<!--											cx="97.60000000000001" cy="45.5"-->
						<!--											class="apexcharts-marker no-pointer-events wu7moycvb"-->
						<!--											stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"-->
						<!--											stroke-width="2" stroke-opacity="1" rel="4" j="4"-->
						<!--											index="0" default-marker-size="2"></circle>-->
						<!--									</g>-->
						<!--									<g id="SvgjsG3084" class="apexcharts-series-markers"-->
						<!--										clip-path="url(#gridRectMarkerMaskq78tcagh)">-->
						<!--										<circle id="SvgjsCircle3085" r="5"-->
						<!--											cx="122.00000000000001" cy="6.5"-->
						<!--											class="apexcharts-marker no-pointer-events wsz9xk5p5"-->
						<!--											stroke="#00cfe8" fill="#ffffff" fill-opacity="1"-->
						<!--											stroke-width="2" stroke-opacity="1" rel="5" j="5"-->
						<!--											index="0" default-marker-size="5"></circle>-->
						<!--									</g>-->
						<!--								</g>-->
						<!--							</g>-->
						<!--							<g id="SvgjsG3074" class="apexcharts-datalabels" data:realIndex="0">-->
						<!--							</g>-->
						<!--						</g>-->
						<!--						<line id="SvgjsLine3119" x1="0" y1="0" x2="122" y2="0" stroke="#b6b6b6"-->
						<!--							stroke-dasharray="0" stroke-width="1"-->
						<!--							class="apexcharts-ycrosshairs"></line>-->
						<!--						<line id="SvgjsLine3120" x1="0" y1="0" x2="122" y2="0"-->
						<!--							stroke-dasharray="0" stroke-width="0"-->
						<!--							class="apexcharts-ycrosshairs-hidden"></line>-->
						<!--						<g id="SvgjsG3121" class="apexcharts-yaxis-annotations"></g>-->
						<!--						<g id="SvgjsG3122" class="apexcharts-xaxis-annotations"></g>-->
						<!--						<g id="SvgjsG3123" class="apexcharts-point-annotations"></g>-->
						<!--					</g>-->
						<!--					<rect id="SvgjsRect3067" width="0" height="0" x="0" y="0" rx="0" ry="0"-->
						<!--						opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"-->
						<!--						fill="#fefefe"></rect>-->
						<!--					<g id="SvgjsG3107" class="apexcharts-yaxis" rel="0"-->
						<!--						transform="translate(-18, 0)"></g>-->
						<!--					<g id="SvgjsG3065" class="apexcharts-annotations"></g>-->
						<!--				</svg>-->
						<!--				<div class="apexcharts-legend" style="max-height: 35px;"></div>-->
						<!--				<div class="apexcharts-tooltip apexcharts-theme-light"-->
						<!--					style="left: 27.1875px; top: 31px;">-->
						<!--					<div class="apexcharts-tooltip-series-group apexcharts-active"-->
						<!--						style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker"-->
						<!--							style="background-color: rgb(0, 207, 232);"></span>-->
						<!--						<div class="apexcharts-tooltip-text"-->
						<!--							style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">-->
						<!--							<div class="apexcharts-tooltip-y-group"><span-->
						<!--									class="apexcharts-tooltip-text-y-label">series-1:-->
						<!--								</span><span class="apexcharts-tooltip-text-y-value">0</span>-->
						<!--							</div>-->
						<!--							<div class="apexcharts-tooltip-goals-group"><span-->
						<!--									class="apexcharts-tooltip-text-goals-label"></span><span-->
						<!--									class="apexcharts-tooltip-text-goals-value"></span></div>-->
						<!--							<div class="apexcharts-tooltip-z-group"><span-->
						<!--									class="apexcharts-tooltip-text-z-label"></span><span-->
						<!--									class="apexcharts-tooltip-text-z-value"></span></div>-->
						<!--						</div>-->
						<!--					</div>-->
						<!--				</div>-->
						<!--				<div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light"-->
						<!--					style="left: -2.2125px; top: 67px;">-->
						<!--					<div class="apexcharts-xaxistooltip-text"-->
						<!--						style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; min-width: 6px;">-->
						<!--						1</div>-->
						<!--				</div>-->
						<!--				<div-->
						<!--					class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">-->
						<!--					<div class="apexcharts-yaxistooltip-text"></div>-->
						<!--				</div>-->
						<!--			</div>-->
						<!--		</div>-->
						<!--		<div class="resize-triggers">-->
						<!--			<div class="expand-trigger">-->
						<!--				<div style="width: 136px; height: 86px;"></div>-->
						<!--			</div>-->
						<!--			<div class="contract-trigger"></div>-->
						<!--		</div>-->
						<!--	</apx-chart></div>-->
						<div class="p-6 m-20 bg-white rounded shadow">
                        <!--<h1>{{ $chart1->options['chart_title'] }}</h1>-->
                                        {!! $chart1->renderHtml() !!}
                        </div>
					</div>
				</div>
			</div>
			<!--<div class="col-lg-12 col-md-6 col-12">-->
			<!--	<div class="card earnings-card" style="height:200px;">-->
			<!--		<div class="card-body">-->
			<!--			<div class="row">-->
			<!--				<div class="col-6">-->
			<!--					<h4 class="card-title mb-1">Earnings</h4>-->
			<!--					<div class="font-small-2">This Month</div>-->
			<!--					<h5 class="mb-1"><i class="fa fa-inr" aria-hidden="true"></i>-->
			<!--						20.31</h5>-->
			<!--					<p class="card-text text-muted font-small-2"><span-->
			<!--							class="font-weight-bolder">68.2%</span><span> more earnings than last-->
			<!--							month.</span></p>-->
			<!--				</div>-->
			<!--				<div class="col-6">-->
			<!--					<div id="earnings-donut-chart"><apx-chart _nghost-ihp-c131=""-->
			<!--							style="position: relative;">-->
			<!--							<div _ngcontent-ihp-c131="" style="min-height: 126.8px;">-->
			<!--								<div id="apexcharts7k7au1bh"-->
			<!--									class="apexcharts-canvas apexcharts7k7au1bh apexcharts-theme-light"-->
			<!--									style="width: 165px; height: 126.8px;"><svg id="SvgjsSvg3124"-->
			<!--										width="165" height="126.8" xmlns="http://www.w3.org/2000/svg"-->
			<!--										version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"-->
			<!--										xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"-->
			<!--										xmlns:data="ApexChartsNS" transform="translate(0, 0)"-->
			<!--										style="background: transparent;">-->
			<!--										<g id="SvgjsG3126" class="apexcharts-inner apexcharts-graphical"-->
			<!--											transform="translate(2.5, 0)">-->
			<!--											<defs id="SvgjsDefs3125">-->
			<!--												<clipPath id="gridRectMask7k7au1bh">-->
			<!--													<rect id="SvgjsRect3128" width="164" height="128" x="-2"-->
			<!--														y="0" rx="0" ry="0" opacity="1" stroke-width="0"-->
			<!--														stroke="none" stroke-dasharray="0" fill="#fff">-->
			<!--													</rect>-->
			<!--												</clipPath>-->
			<!--												<clipPath id="gridRectMarkerMask7k7au1bh">-->
			<!--													<rect id="SvgjsRect3129" width="164" height="132" x="-2"-->
			<!--														y="-2" rx="0" ry="0" opacity="1" stroke-width="0"-->
			<!--														stroke="none" stroke-dasharray="0" fill="#fff">-->
			<!--													</rect>-->
			<!--												</clipPath>-->
			<!--											</defs>-->
			<!--											<g id="SvgjsG3130" class="apexcharts-pie">-->
			<!--												<g id="SvgjsG3131" transform="translate(0, 0) scale(1)">-->
			<!--													<circle id="SvgjsCircle3132" r="37.98536585365854"-->
			<!--														cx="80" cy="64" fill="transparent"></circle>-->
			<!--													<g id="SvgjsG3133" class="apexcharts-slices">-->
			<!--														<g id="SvgjsG3134"-->
			<!--															class="apexcharts-series apexcharts-pie-series"-->
			<!--															seriesName="App" rel="1" data:realIndex="0">-->
			<!--															<path id="SvgjsPath3135"-->
			<!--																d="M 69.85216991000085 6.448795702018273 A 58.43902439024391 58.43902439024391 0 1 1 73.79003134337525 122.10813936934534 L 75.96352037319392 101.77029059007447 A 37.98536585365854 37.98536585365854 0 1 0 73.40391044150056 26.591717206311877 L 69.85216991000085 6.448795702018273 z"-->
			<!--																fill="#28c76f66" fill-opacity="1"-->
			<!--																stroke-opacity="1" stroke-linecap="butt"-->
			<!--																stroke-width="0" stroke-dasharray="0"-->
			<!--																class="apexcharts-pie-area apexcharts-donut-slice-0"-->
			<!--																index="0" j="0" data:angle="196.1"-->
			<!--																data:startAngle="-10" data:strokeWidth="0"-->
			<!--																data:value="53"-->
			<!--																data:pathOrig="M 69.85216991000085 6.448795702018273 A 58.43902439024391 58.43902439024391 0 1 1 73.79003134337525 122.10813936934534 L 75.96352037319392 101.77029059007447 A 37.98536585365854 37.98536585365854 0 1 0 73.40391044150056 26.591717206311877 L 69.85216991000085 6.448795702018273 z">-->
			<!--															</path>-->
			<!--														</g>-->
			<!--														<g id="SvgjsG3136"-->
			<!--															class="apexcharts-series apexcharts-pie-series"-->
			<!--															seriesName="Service" rel="2" data:realIndex="1">-->
			<!--															<path id="SvgjsPath3137"-->
			<!--																d="M 73.79003134337525 122.10813936934534 A 58.43902439024391 58.43902439024391 0 0 1 26.90766845477986 88.41974411774098 L 45.489984495606905 79.87283367653163 A 37.98536585365854 37.98536585365854 0 0 0 75.96352037319392 101.77029059007447 L 73.79003134337525 122.10813936934534 z"-->
			<!--																fill="#28c76f33" fill-opacity="1"-->
			<!--																stroke-opacity="1" stroke-linecap="butt"-->
			<!--																stroke-width="0" stroke-dasharray="0"-->
			<!--																class="apexcharts-pie-area apexcharts-donut-slice-1"-->
			<!--																index="0" j="1"-->
			<!--																data:angle="59.20000000000002"-->
			<!--																data:startAngle="186.1" data:strokeWidth="0"-->
			<!--																data:value="16"-->
			<!--																data:pathOrig="M 73.79003134337525 122.10813936934534 A 58.43902439024391 58.43902439024391 0 0 1 26.90766845477986 88.41974411774098 L 45.489984495606905 79.87283367653163 A 37.98536585365854 37.98536585365854 0 0 0 75.96352037319392 101.77029059007447 L 73.79003134337525 122.10813936934534 z">-->
			<!--															</path>-->
			<!--														</g>-->
			<!--														<g id="SvgjsG3138"-->
			<!--															class="apexcharts-series apexcharts-pie-series"-->
			<!--															seriesName="Product" rel="3" data:realIndex="2">-->
			<!--															<path id="SvgjsPath3139"-->
			<!--																d="M 26.90766845477986 88.41974411774098 A 58.43902439024391 58.43902439024391 0 0 1 79.98980046617915 5.56097649983333 L 79.99337030301645 26.014634724891664 A 37.98536585365854 37.98536585365854 0 0 0 45.489984495606905 79.87283367653163 L 26.90766845477986 88.41974411774098 z"-->
			<!--																fill="rgba(40,199,111,1)" fill-opacity="1"-->
			<!--																stroke-opacity="1" stroke-linecap="butt"-->
			<!--																stroke-width="0" stroke-dasharray="0"-->
			<!--																class="apexcharts-pie-area apexcharts-donut-slice-2"-->
			<!--																index="0" j="2"-->
			<!--																data:angle="114.69999999999999"-->
			<!--																data:startAngle="245.3" data:strokeWidth="0"-->
			<!--																data:value="31"-->
			<!--																data:pathOrig="M 26.90766845477986 88.41974411774098 A 58.43902439024391 58.43902439024391 0 0 1 79.98980046617915 5.56097649983333 L 79.99337030301645 26.014634724891664 A 37.98536585365854 37.98536585365854 0 0 0 45.489984495606905 79.87283367653163 L 26.90766845477986 88.41974411774098 z">-->
			<!--															</path>-->
			<!--														</g>-->
			<!--													</g>-->
			<!--												</g>-->
			<!--												<g id="SvgjsG3140" class="apexcharts-datalabels-group"-->
			<!--													transform="translate(0, 0) scale(1)"><text-->
			<!--														id="SvgjsText3141"-->
			<!--														font-family="Helvetica, Arial, sans-serif" x="80"-->
			<!--														y="79" text-anchor="middle" dominant-baseline="auto"-->
			<!--														font-size="16px" font-weight="400" fill="#373d3f"-->
			<!--														class="apexcharts-text apexcharts-datalabel-label"-->
			<!--														style="font-family: Helvetica, Arial, sans-serif;">App</text><text-->
			<!--														id="SvgjsText3142"-->
			<!--														font-family="Helvetica, Arial, sans-serif" x="80"-->
			<!--														y="65" text-anchor="middle" dominant-baseline="auto"-->
			<!--														font-size="20px" font-weight="400" fill="#373d3f"-->
			<!--														class="apexcharts-text apexcharts-datalabel-value"-->
			<!--														style="font-family: Helvetica, Arial, sans-serif;">53%</text>-->
			<!--												</g>-->
			<!--											</g>-->
			<!--											<line id="SvgjsLine3143" x1="0" y1="0" x2="160" y2="0"-->
			<!--												stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"-->
			<!--												class="apexcharts-ycrosshairs"></line>-->
			<!--											<line id="SvgjsLine3144" x1="0" y1="0" x2="160" y2="0"-->
			<!--												stroke-dasharray="0" stroke-width="0"-->
			<!--												class="apexcharts-ycrosshairs-hidden"></line>-->
			<!--										</g>-->
			<!--										<g id="SvgjsG3127" class="apexcharts-annotations"></g>-->
			<!--									</svg>-->
			<!--									<div class="apexcharts-legend"></div>-->
			<!--									<div class="apexcharts-tooltip apexcharts-theme-dark">-->
			<!--										<div class="apexcharts-tooltip-series-group" style="order: 1;"><span-->
			<!--												class="apexcharts-tooltip-marker"-->
			<!--												style="background-color: rgba(40, 199, 111, 0.4);"></span>-->
			<!--											<div class="apexcharts-tooltip-text"-->
			<!--												style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">-->
			<!--												<div class="apexcharts-tooltip-y-group"><span-->
			<!--														class="apexcharts-tooltip-text-y-label"></span><span-->
			<!--														class="apexcharts-tooltip-text-y-value"></span>-->
			<!--												</div>-->
			<!--												<div class="apexcharts-tooltip-goals-group"><span-->
			<!--														class="apexcharts-tooltip-text-goals-label"></span><span-->
			<!--														class="apexcharts-tooltip-text-goals-value"></span>-->
			<!--												</div>-->
			<!--												<div class="apexcharts-tooltip-z-group"><span-->
			<!--														class="apexcharts-tooltip-text-z-label"></span><span-->
			<!--														class="apexcharts-tooltip-text-z-value"></span>-->
			<!--												</div>-->
			<!--											</div>-->
			<!--										</div>-->
			<!--										<div class="apexcharts-tooltip-series-group" style="order: 2;"><span-->
			<!--												class="apexcharts-tooltip-marker"-->
			<!--												style="background-color: rgba(40, 199, 111, 0.2);"></span>-->
			<!--											<div class="apexcharts-tooltip-text"-->
			<!--												style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">-->
			<!--												<div class="apexcharts-tooltip-y-group"><span-->
			<!--														class="apexcharts-tooltip-text-y-label"></span><span-->
			<!--														class="apexcharts-tooltip-text-y-value"></span>-->
			<!--												</div>-->
			<!--												<div class="apexcharts-tooltip-goals-group"><span-->
			<!--														class="apexcharts-tooltip-text-goals-label"></span><span-->
			<!--														class="apexcharts-tooltip-text-goals-value"></span>-->
			<!--												</div>-->
			<!--												<div class="apexcharts-tooltip-z-group"><span-->
			<!--														class="apexcharts-tooltip-text-z-label"></span><span-->
			<!--														class="apexcharts-tooltip-text-z-value"></span>-->
			<!--												</div>-->
			<!--											</div>-->
			<!--										</div>-->
			<!--										<div class="apexcharts-tooltip-series-group" style="order: 3;"><span-->
			<!--												class="apexcharts-tooltip-marker"-->
			<!--												style="background-color: rgb(40, 199, 111);"></span>-->
			<!--											<div class="apexcharts-tooltip-text"-->
			<!--												style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">-->
			<!--												<div class="apexcharts-tooltip-y-group"><span-->
			<!--														class="apexcharts-tooltip-text-y-label"></span><span-->
			<!--														class="apexcharts-tooltip-text-y-value"></span>-->
			<!--												</div>-->
			<!--												<div class="apexcharts-tooltip-goals-group"><span-->
			<!--														class="apexcharts-tooltip-text-goals-label"></span><span-->
			<!--														class="apexcharts-tooltip-text-goals-value"></span>-->
			<!--												</div>-->
			<!--												<div class="apexcharts-tooltip-z-group"><span-->
			<!--														class="apexcharts-tooltip-text-z-label"></span><span-->
			<!--														class="apexcharts-tooltip-text-z-value"></span>-->
			<!--												</div>-->
			<!--											</div>-->
			<!--										</div>-->
			<!--									</div>-->
			<!--								</div>-->
			<!--							</div>-->
			<!--							<div class="resize-triggers">-->
			<!--								<div class="expand-trigger">-->
			<!--									<div style="width: 157px; height: 128px;"></div>-->
			<!--								</div>-->
			<!--								<div class="contract-trigger"></div>-->
			<!--							</div>-->
			<!--						</apx-chart></div>-->
			<!--				</div>-->
			<!--			</div>-->
			<!--		</div>-->
			<!--	</div>-->
			<!--</div>-->
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
					<!--<div id="revenue-report-chart"><apx-chart _nghost-ihp-c131="" style="position: relative;">-->
					<!--		<div _ngcontent-ihp-c131="" style="min-height: 245px;">-->
					<!--			<div id="apexchartsq4f8hkllk"-->
					<!--				class="apexcharts-canvas apexchartsq4f8hkllk apexcharts-theme-light"-->
					<!--				style="width: 509px; height: 230px;"><svg id="SvgjsSvg3145" width="509" height="230"-->
					<!--					xmlns="http://www.w3.org/2000/svg" version="1.1"-->
					<!--					xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"-->
					<!--					class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"-->
					<!--					style="background: transparent;">-->
					<!--					<g id="SvgjsG3147" class="apexcharts-inner apexcharts-graphical"-->
					<!--						transform="translate(54.75, 10)">-->
					<!--						<defs id="SvgjsDefs3146">-->
					<!--							<linearGradient id="SvgjsLinearGradient3151" x1="0" y1="0" x2="0"-->
					<!--								y2="1">-->
					<!--								<stop id="SvgjsStop3152" stop-opacity="0.4"-->
					<!--									stop-color="rgba(216,227,240,0.4)" offset="0"></stop>-->
					<!--								<stop id="SvgjsStop3153" stop-opacity="0.5"-->
					<!--									stop-color="rgba(190,209,230,0.5)" offset="1"></stop>-->
					<!--								<stop id="SvgjsStop3154" stop-opacity="0.5"-->
					<!--									stop-color="rgba(190,209,230,0.5)" offset="1"></stop>-->
					<!--							</linearGradient>-->
					<!--							<clipPath id="gridRectMaskq4f8hkllk">-->
					<!--								<rect id="SvgjsRect3156" width="448.25" height="190.40640030860902"-->
					<!--									x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0"-->
					<!--									stroke="none" stroke-dasharray="0" fill="#fff"></rect>-->
					<!--							</clipPath>-->
					<!--							<clipPath id="gridRectMarkerMaskq4f8hkllk">-->
					<!--								<rect id="SvgjsRect3157" width="448.25" height="194.40640030860902"-->
					<!--									x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0"-->
					<!--									stroke="none" stroke-dasharray="0" fill="#fff"></rect>-->
					<!--							</clipPath>-->
					<!--						</defs>-->
					<!--						<rect id="SvgjsRect3155" width="8.391388888888889"-->
					<!--							height="190.40640030860902" x="0" y="0" rx="0" ry="0" opacity="1"-->
					<!--							stroke-width="0" stroke-dasharray="3"-->
					<!--							fill="url(#SvgjsLinearGradient3151)" class="apexcharts-xcrosshairs"-->
					<!--							y2="190.40640030860902" filter="none" fill-opacity="0.9"></rect>-->
					<!--						<g id="SvgjsG3181" class="apexcharts-xaxis" transform="translate(0, 0)">-->
					<!--							<g id="SvgjsG3182" class="apexcharts-xaxis-texts-g"-->
					<!--								transform="translate(0, -4)"><text id="SvgjsText3184"-->
					<!--									font-family="Helvetica, Arial, sans-serif"-->
					<!--									x="24.680555555555557" y="219.40640030860902"-->
					<!--									text-anchor="middle" dominant-baseline="auto"-->
					<!--									font-size="0.86rem" font-weight="400" fill="#b9b9c3"-->
					<!--									class="apexcharts-text apexcharts-xaxis-label "-->
					<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--									<tspan id="SvgjsTspan3185">Jan</tspan>-->
					<!--									<title>Jan</title>-->
					<!--								</text><text id="SvgjsText3187"-->
					<!--									font-family="Helvetica, Arial, sans-serif" x="74.04166666666667"-->
					<!--									y="219.40640030860902" text-anchor="middle"-->
					<!--									dominant-baseline="auto" font-size="0.86rem" font-weight="400"-->
					<!--									fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label "-->
					<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--									<tspan id="SvgjsTspan3188">Feb</tspan>-->
					<!--									<title>Feb</title>-->
					<!--								</text><text id="SvgjsText3190"-->
					<!--									font-family="Helvetica, Arial, sans-serif"-->
					<!--									x="123.40277777777779" y="219.40640030860902"-->
					<!--									text-anchor="middle" dominant-baseline="auto"-->
					<!--									font-size="0.86rem" font-weight="400" fill="#b9b9c3"-->
					<!--									class="apexcharts-text apexcharts-xaxis-label "-->
					<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--									<tspan id="SvgjsTspan3191">Mar</tspan>-->
					<!--									<title>Mar</title>-->
					<!--								</text><text id="SvgjsText3193"-->
					<!--									font-family="Helvetica, Arial, sans-serif" x="172.7638888888889"-->
					<!--									y="219.40640030860902" text-anchor="middle"-->
					<!--									dominant-baseline="auto" font-size="0.86rem" font-weight="400"-->
					<!--									fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label "-->
					<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--									<tspan id="SvgjsTspan3194">Apr</tspan>-->
					<!--									<title>Apr</title>-->
					<!--								</text><text id="SvgjsText3196"-->
					<!--									font-family="Helvetica, Arial, sans-serif" x="222.125"-->
					<!--									y="219.40640030860902" text-anchor="middle"-->
					<!--									dominant-baseline="auto" font-size="0.86rem" font-weight="400"-->
					<!--									fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label "-->
					<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--									<tspan id="SvgjsTspan3197">May</tspan>-->
					<!--									<title>May</title>-->
					<!--								</text><text id="SvgjsText3199"-->
					<!--									font-family="Helvetica, Arial, sans-serif"-->
					<!--									x="271.48611111111114" y="219.40640030860902"-->
					<!--									text-anchor="middle" dominant-baseline="auto"-->
					<!--									font-size="0.86rem" font-weight="400" fill="#b9b9c3"-->
					<!--									class="apexcharts-text apexcharts-xaxis-label "-->
					<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--									<tspan id="SvgjsTspan3200">Jun</tspan>-->
					<!--									<title>Jun</title>-->
					<!--								</text><text id="SvgjsText3202"-->
					<!--									font-family="Helvetica, Arial, sans-serif" x="320.8472222222223"-->
					<!--									y="219.40640030860902" text-anchor="middle"-->
					<!--									dominant-baseline="auto" font-size="0.86rem" font-weight="400"-->
					<!--									fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label "-->
					<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--									<tspan id="SvgjsTspan3203">Jul</tspan>-->
					<!--									<title>Jul</title>-->
					<!--								</text><text id="SvgjsText3205"-->
					<!--									font-family="Helvetica, Arial, sans-serif"-->
					<!--									x="370.20833333333337" y="219.40640030860902"-->
					<!--									text-anchor="middle" dominant-baseline="auto"-->
					<!--									font-size="0.86rem" font-weight="400" fill="#b9b9c3"-->
					<!--									class="apexcharts-text apexcharts-xaxis-label "-->
					<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--									<tspan id="SvgjsTspan3206">Aug</tspan>-->
					<!--									<title>Aug</title>-->
					<!--								</text><text id="SvgjsText3208"-->
					<!--									font-family="Helvetica, Arial, sans-serif"-->
					<!--									x="419.56944444444446" y="219.40640030860902"-->
					<!--									text-anchor="middle" dominant-baseline="auto"-->
					<!--									font-size="0.86rem" font-weight="400" fill="#b9b9c3"-->
					<!--									class="apexcharts-text apexcharts-xaxis-label "-->
					<!--									style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--									<tspan id="SvgjsTspan3209">Sep</tspan>-->
					<!--									<title>Sep</title>-->
					<!--								</text></g>-->
					<!--						</g>-->
					<!--						<g id="SvgjsG3224" class="apexcharts-grid">-->
					<!--							<g id="SvgjsG3225" class="apexcharts-gridlines-horizontal"></g>-->
					<!--							<g id="SvgjsG3226" class="apexcharts-gridlines-vertical"></g>-->
					<!--							<line id="SvgjsLine3228" x1="0" y1="190.40640030860902" x2="444.25"-->
					<!--								y2="190.40640030860902" stroke="transparent" stroke-dasharray="0">-->
					<!--							</line>-->
					<!--							<line id="SvgjsLine3227" x1="0" y1="1" x2="0" y2="190.40640030860902"-->
					<!--								stroke="transparent" stroke-dasharray="0"></line>-->
					<!--						</g>-->
					<!--						<g id="SvgjsG3158" class="apexcharts-bar-series apexcharts-plot-series">-->
					<!--							<g id="SvgjsG3159" class="apexcharts-series" seriesName="Earning"-->
					<!--								rel="1" data:realIndex="0">-->
					<!--								<path id="SvgjsPath3161"-->
					<!--									d="M 20.484861111111112 114.24384018516541L 20.484861111111112 78.06662412652969Q 20.484861111111112 78.06662412652969 20.484861111111112 78.06662412652969L 28.87625 78.06662412652969Q 28.87625 78.06662412652969 28.87625 78.06662412652969L 28.87625 78.06662412652969L 28.87625 114.24384018516541L 28.87625 114.24384018516541z"-->
					<!--									fill="rgba(115,103,240,0.85)" fill-opacity="1"-->
					<!--									stroke-opacity="1" stroke-linecap="round" stroke-width="0"-->
					<!--									stroke-dasharray="0" class="apexcharts-bar-area" index="0"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 20.484861111111112 114.24384018516541L 20.484861111111112 78.06662412652969Q 20.484861111111112 78.06662412652969 20.484861111111112 78.06662412652969L 28.87625 78.06662412652969Q 28.87625 78.06662412652969 28.87625 78.06662412652969L 28.87625 78.06662412652969L 28.87625 114.24384018516541L 28.87625 114.24384018516541z"-->
					<!--									pathFrom="M 20.484861111111112 114.24384018516541L 20.484861111111112 114.24384018516541L 28.87625 114.24384018516541L 28.87625 114.24384018516541L 28.87625 114.24384018516541L 28.87625 114.24384018516541L 28.87625 114.24384018516541L 20.484861111111112 114.24384018516541"-->
					<!--									cy="78.06662412652969" cx="69.84597222222223" j="0" val="95"-->
					<!--									barHeight="36.177216058635715" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3162"-->
					<!--									d="M 69.84597222222223 114.24384018516541L 69.84597222222223 46.83997447591781Q 69.84597222222223 46.83997447591781 69.84597222222223 46.83997447591781L 78.23736111111111 46.83997447591781Q 78.23736111111111 46.83997447591781 78.23736111111111 46.83997447591781L 78.23736111111111 46.83997447591781L 78.23736111111111 114.24384018516541L 78.23736111111111 114.24384018516541z"-->
					<!--									fill="rgba(115,103,240,0.85)" fill-opacity="1"-->
					<!--									stroke-opacity="1" stroke-linecap="round" stroke-width="0"-->
					<!--									stroke-dasharray="0" class="apexcharts-bar-area" index="0"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 69.84597222222223 114.24384018516541L 69.84597222222223 46.83997447591781Q 69.84597222222223 46.83997447591781 69.84597222222223 46.83997447591781L 78.23736111111111 46.83997447591781Q 78.23736111111111 46.83997447591781 78.23736111111111 46.83997447591781L 78.23736111111111 46.83997447591781L 78.23736111111111 114.24384018516541L 78.23736111111111 114.24384018516541z"-->
					<!--									pathFrom="M 69.84597222222223 114.24384018516541L 69.84597222222223 114.24384018516541L 78.23736111111111 114.24384018516541L 78.23736111111111 114.24384018516541L 78.23736111111111 114.24384018516541L 78.23736111111111 114.24384018516541L 78.23736111111111 114.24384018516541L 69.84597222222223 114.24384018516541"-->
					<!--									cy="46.83997447591781" cx="119.20708333333334" j="1" val="177"-->
					<!--									barHeight="67.4038657092476" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3163"-->
					<!--									d="M 119.20708333333334 114.24384018516541L 119.20708333333334 6.093004809875481Q 119.20708333333334 6.093004809875481 119.20708333333334 6.093004809875481L 127.59847222222223 6.093004809875481Q 127.59847222222223 6.093004809875481 127.59847222222223 6.093004809875481L 127.59847222222223 6.093004809875481L 127.59847222222223 114.24384018516541L 127.59847222222223 114.24384018516541z"-->
					<!--									fill="rgba(115,103,240,0.85)" fill-opacity="1"-->
					<!--									stroke-opacity="1" stroke-linecap="round" stroke-width="0"-->
					<!--									stroke-dasharray="0" class="apexcharts-bar-area" index="0"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 119.20708333333334 114.24384018516541L 119.20708333333334 6.093004809875481Q 119.20708333333334 6.093004809875481 119.20708333333334 6.093004809875481L 127.59847222222223 6.093004809875481Q 127.59847222222223 6.093004809875481 127.59847222222223 6.093004809875481L 127.59847222222223 6.093004809875481L 127.59847222222223 114.24384018516541L 127.59847222222223 114.24384018516541z"-->
					<!--									pathFrom="M 119.20708333333334 114.24384018516541L 119.20708333333334 114.24384018516541L 127.59847222222223 114.24384018516541L 127.59847222222223 114.24384018516541L 127.59847222222223 114.24384018516541L 127.59847222222223 114.24384018516541L 127.59847222222223 114.24384018516541L 119.20708333333334 114.24384018516541"-->
					<!--									cy="6.093004809875481" cx="168.56819444444446" j="2" val="284"-->
					<!--									barHeight="108.15083537528993" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3164"-->
					<!--									d="M 168.56819444444446 114.24384018516541L 168.56819444444446 16.755763227157587Q 168.56819444444446 16.755763227157587 168.56819444444446 16.755763227157587L 176.95958333333334 16.755763227157587Q 176.95958333333334 16.755763227157587 176.95958333333334 16.755763227157587L 176.95958333333334 16.755763227157587L 176.95958333333334 114.24384018516541L 176.95958333333334 114.24384018516541z"-->
					<!--									fill="rgba(115,103,240,0.85)" fill-opacity="1"-->
					<!--									stroke-opacity="1" stroke-linecap="round" stroke-width="0"-->
					<!--									stroke-dasharray="0" class="apexcharts-bar-area" index="0"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 168.56819444444446 114.24384018516541L 168.56819444444446 16.755763227157587Q 168.56819444444446 16.755763227157587 168.56819444444446 16.755763227157587L 176.95958333333334 16.755763227157587Q 176.95958333333334 16.755763227157587 176.95958333333334 16.755763227157587L 176.95958333333334 16.755763227157587L 176.95958333333334 114.24384018516541L 176.95958333333334 114.24384018516541z"-->
					<!--									pathFrom="M 168.56819444444446 114.24384018516541L 168.56819444444446 114.24384018516541L 176.95958333333334 114.24384018516541L 176.95958333333334 114.24384018516541L 176.95958333333334 114.24384018516541L 176.95958333333334 114.24384018516541L 176.95958333333334 114.24384018516541L 168.56819444444446 114.24384018516541"-->
					<!--									cy="16.755763227157587" cx="217.92930555555557" j="3" val="256"-->
					<!--									barHeight="97.48807695800782" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3165"-->
					<!--									d="M 217.92930555555557 114.24384018516541L 217.92930555555557 74.2584961203575Q 217.92930555555557 74.2584961203575 217.92930555555557 74.2584961203575L 226.32069444444446 74.2584961203575Q 226.32069444444446 74.2584961203575 226.32069444444446 74.2584961203575L 226.32069444444446 74.2584961203575L 226.32069444444446 114.24384018516541L 226.32069444444446 114.24384018516541z"-->
					<!--									fill="rgba(115,103,240,0.85)" fill-opacity="1"-->
					<!--									stroke-opacity="1" stroke-linecap="round" stroke-width="0"-->
					<!--									stroke-dasharray="0" class="apexcharts-bar-area" index="0"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 217.92930555555557 114.24384018516541L 217.92930555555557 74.2584961203575Q 217.92930555555557 74.2584961203575 217.92930555555557 74.2584961203575L 226.32069444444446 74.2584961203575Q 226.32069444444446 74.2584961203575 226.32069444444446 74.2584961203575L 226.32069444444446 74.2584961203575L 226.32069444444446 114.24384018516541L 226.32069444444446 114.24384018516541z"-->
					<!--									pathFrom="M 217.92930555555557 114.24384018516541L 217.92930555555557 114.24384018516541L 226.32069444444446 114.24384018516541L 226.32069444444446 114.24384018516541L 226.32069444444446 114.24384018516541L 226.32069444444446 114.24384018516541L 226.32069444444446 114.24384018516541L 217.92930555555557 114.24384018516541"-->
					<!--									cy="74.2584961203575" cx="267.2904166666667" j="4" val="105"-->
					<!--									barHeight="39.9853440648079" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3166"-->
					<!--									d="M 267.2904166666667 114.24384018516541L 267.2904166666667 90.25263374628068Q 267.2904166666667 90.25263374628068 267.2904166666667 90.25263374628068L 275.6818055555556 90.25263374628068Q 275.6818055555556 90.25263374628068 275.6818055555556 90.25263374628068L 275.6818055555556 90.25263374628068L 275.6818055555556 114.24384018516541L 275.6818055555556 114.24384018516541z"-->
					<!--									fill="rgba(115,103,240,0.85)" fill-opacity="1"-->
					<!--									stroke-opacity="1" stroke-linecap="round" stroke-width="0"-->
					<!--									stroke-dasharray="0" class="apexcharts-bar-area" index="0"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 267.2904166666667 114.24384018516541L 267.2904166666667 90.25263374628068Q 267.2904166666667 90.25263374628068 267.2904166666667 90.25263374628068L 275.6818055555556 90.25263374628068Q 275.6818055555556 90.25263374628068 275.6818055555556 90.25263374628068L 275.6818055555556 90.25263374628068L 275.6818055555556 114.24384018516541L 275.6818055555556 114.24384018516541z"-->
					<!--									pathFrom="M 267.2904166666667 114.24384018516541L 267.2904166666667 114.24384018516541L 275.6818055555556 114.24384018516541L 275.6818055555556 114.24384018516541L 275.6818055555556 114.24384018516541L 275.6818055555556 114.24384018516541L 275.6818055555556 114.24384018516541L 267.2904166666667 114.24384018516541"-->
					<!--									cy="90.25263374628068" cx="316.6515277777778" j="5" val="63"-->
					<!--									barHeight="23.99120643888474" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3167"-->
					<!--									d="M 316.6515277777778 114.24384018516541L 316.6515277777778 50.267289681472775Q 316.6515277777778 50.267289681472775 316.6515277777778 50.267289681472775L 325.0429166666667 50.267289681472775Q 325.0429166666667 50.267289681472775 325.0429166666667 50.267289681472775L 325.0429166666667 50.267289681472775L 325.0429166666667 114.24384018516541L 325.0429166666667 114.24384018516541z"-->
					<!--									fill="rgba(115,103,240,0.85)" fill-opacity="1"-->
					<!--									stroke-opacity="1" stroke-linecap="round" stroke-width="0"-->
					<!--									stroke-dasharray="0" class="apexcharts-bar-area" index="0"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 316.6515277777778 114.24384018516541L 316.6515277777778 50.267289681472775Q 316.6515277777778 50.267289681472775 316.6515277777778 50.267289681472775L 325.0429166666667 50.267289681472775Q 325.0429166666667 50.267289681472775 325.0429166666667 50.267289681472775L 325.0429166666667 50.267289681472775L 325.0429166666667 114.24384018516541L 325.0429166666667 114.24384018516541z"-->
					<!--									pathFrom="M 316.6515277777778 114.24384018516541L 316.6515277777778 114.24384018516541L 325.0429166666667 114.24384018516541L 325.0429166666667 114.24384018516541L 325.0429166666667 114.24384018516541L 325.0429166666667 114.24384018516541L 325.0429166666667 114.24384018516541L 316.6515277777778 114.24384018516541"-->
					<!--									cy="50.267289681472775" cx="366.0126388888889" j="6" val="168"-->
					<!--									barHeight="63.976550503692636" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3168"-->
					<!--									d="M 366.0126388888889 114.24384018516541L 366.0126388888889 31.226649650611876Q 366.0126388888889 31.226649650611876 366.0126388888889 31.226649650611876L 374.4040277777778 31.226649650611876Q 374.4040277777778 31.226649650611876 374.4040277777778 31.226649650611876L 374.4040277777778 31.226649650611876L 374.4040277777778 114.24384018516541L 374.4040277777778 114.24384018516541z"-->
					<!--									fill="rgba(115,103,240,0.85)" fill-opacity="1"-->
					<!--									stroke-opacity="1" stroke-linecap="round" stroke-width="0"-->
					<!--									stroke-dasharray="0" class="apexcharts-bar-area" index="0"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 366.0126388888889 114.24384018516541L 366.0126388888889 31.226649650611876Q 366.0126388888889 31.226649650611876 366.0126388888889 31.226649650611876L 374.4040277777778 31.226649650611876Q 374.4040277777778 31.226649650611876 374.4040277777778 31.226649650611876L 374.4040277777778 31.226649650611876L 374.4040277777778 114.24384018516541L 374.4040277777778 114.24384018516541z"-->
					<!--									pathFrom="M 366.0126388888889 114.24384018516541L 366.0126388888889 114.24384018516541L 374.4040277777778 114.24384018516541L 374.4040277777778 114.24384018516541L 374.4040277777778 114.24384018516541L 374.4040277777778 114.24384018516541L 374.4040277777778 114.24384018516541L 366.0126388888889 114.24384018516541"-->
					<!--									cy="31.226649650611876" cx="415.37375" j="7" val="218"-->
					<!--									barHeight="83.01719053455354" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3169"-->
					<!--									d="M 415.37375 114.24384018516541L 415.37375 86.8253185407257Q 415.37375 86.8253185407257 415.37375 86.8253185407257L 423.7651388888889 86.8253185407257Q 423.7651388888889 86.8253185407257 423.7651388888889 86.8253185407257L 423.7651388888889 86.8253185407257L 423.7651388888889 114.24384018516541L 423.7651388888889 114.24384018516541z"-->
					<!--									fill="rgba(115,103,240,0.85)" fill-opacity="1"-->
					<!--									stroke-opacity="1" stroke-linecap="round" stroke-width="0"-->
					<!--									stroke-dasharray="0" class="apexcharts-bar-area" index="0"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 415.37375 114.24384018516541L 415.37375 86.8253185407257Q 415.37375 86.8253185407257 415.37375 86.8253185407257L 423.7651388888889 86.8253185407257Q 423.7651388888889 86.8253185407257 423.7651388888889 86.8253185407257L 423.7651388888889 86.8253185407257L 423.7651388888889 114.24384018516541L 423.7651388888889 114.24384018516541z"-->
					<!--									pathFrom="M 415.37375 114.24384018516541L 415.37375 114.24384018516541L 423.7651388888889 114.24384018516541L 423.7651388888889 114.24384018516541L 423.7651388888889 114.24384018516541L 423.7651388888889 114.24384018516541L 423.7651388888889 114.24384018516541L 415.37375 114.24384018516541"-->
					<!--									cy="86.8253185407257" cx="464.73486111111106" j="8" val="72"-->
					<!--									barHeight="27.4185216444397" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--							</g>-->
					<!--							<g id="SvgjsG3170" class="apexcharts-series" seriesName="Expense"-->
					<!--								rel="2" data:realIndex="1">-->
					<!--								<path id="SvgjsPath3172"-->
					<!--									d="M 20.484861111111112 114.24384018516541L 20.484861111111112 169.46169627466202Q 20.484861111111112 169.46169627466202 20.484861111111112 169.46169627466202L 28.87625 169.46169627466202Q 28.87625 169.46169627466202 28.87625 169.46169627466202L 28.87625 169.46169627466202L 28.87625 114.24384018516541L 28.87625 114.24384018516541z"-->
					<!--									fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1"-->
					<!--									stroke-linecap="round" stroke-width="0" stroke-dasharray="0"-->
					<!--									class="apexcharts-bar-area" index="1"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 20.484861111111112 114.24384018516541L 20.484861111111112 169.46169627466202Q 20.484861111111112 169.46169627466202 20.484861111111112 169.46169627466202L 28.87625 169.46169627466202Q 28.87625 169.46169627466202 28.87625 169.46169627466202L 28.87625 169.46169627466202L 28.87625 114.24384018516541L 28.87625 114.24384018516541z"-->
					<!--									pathFrom="M 20.484861111111112 114.24384018516541L 20.484861111111112 114.24384018516541L 28.87625 114.24384018516541L 28.87625 114.24384018516541L 28.87625 114.24384018516541L 28.87625 114.24384018516541L 28.87625 114.24384018516541L 20.484861111111112 114.24384018516541"-->
					<!--									cy="169.46169627466202" cx="69.84597222222223" j="0" val="-145"-->
					<!--									barHeight="-55.21785608949662" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3173"-->
					<!--									d="M 69.84597222222223 114.24384018516541L 69.84597222222223 144.70886423454286Q 69.84597222222223 144.70886423454286 69.84597222222223 144.70886423454286L 78.23736111111111 144.70886423454286Q 78.23736111111111 144.70886423454286 78.23736111111111 144.70886423454286L 78.23736111111111 144.70886423454286L 78.23736111111111 114.24384018516541L 78.23736111111111 114.24384018516541z"-->
					<!--									fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1"-->
					<!--									stroke-linecap="round" stroke-width="0" stroke-dasharray="0"-->
					<!--									class="apexcharts-bar-area" index="1"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 69.84597222222223 114.24384018516541L 69.84597222222223 144.70886423454286Q 69.84597222222223 144.70886423454286 69.84597222222223 144.70886423454286L 78.23736111111111 144.70886423454286Q 78.23736111111111 144.70886423454286 78.23736111111111 144.70886423454286L 78.23736111111111 144.70886423454286L 78.23736111111111 114.24384018516541L 78.23736111111111 114.24384018516541z"-->
					<!--									pathFrom="M 69.84597222222223 114.24384018516541L 69.84597222222223 114.24384018516541L 78.23736111111111 114.24384018516541L 78.23736111111111 114.24384018516541L 78.23736111111111 114.24384018516541L 78.23736111111111 114.24384018516541L 78.23736111111111 114.24384018516541L 69.84597222222223 114.24384018516541"-->
					<!--									cy="144.70886423454286" cx="119.20708333333334" j="1" val="-80"-->
					<!--									barHeight="-30.465024049377444" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3174"-->
					<!--									d="M 119.20708333333334 114.24384018516541L 119.20708333333334 137.0926082221985Q 119.20708333333334 137.0926082221985 119.20708333333334 137.0926082221985L 127.59847222222223 137.0926082221985Q 127.59847222222223 137.0926082221985 127.59847222222223 137.0926082221985L 127.59847222222223 137.0926082221985L 127.59847222222223 114.24384018516541L 127.59847222222223 114.24384018516541z"-->
					<!--									fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1"-->
					<!--									stroke-linecap="round" stroke-width="0" stroke-dasharray="0"-->
					<!--									class="apexcharts-bar-area" index="1"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 119.20708333333334 114.24384018516541L 119.20708333333334 137.0926082221985Q 119.20708333333334 137.0926082221985 119.20708333333334 137.0926082221985L 127.59847222222223 137.0926082221985Q 127.59847222222223 137.0926082221985 127.59847222222223 137.0926082221985L 127.59847222222223 137.0926082221985L 127.59847222222223 114.24384018516541L 127.59847222222223 114.24384018516541z"-->
					<!--									pathFrom="M 119.20708333333334 114.24384018516541L 119.20708333333334 114.24384018516541L 127.59847222222223 114.24384018516541L 127.59847222222223 114.24384018516541L 127.59847222222223 114.24384018516541L 127.59847222222223 114.24384018516541L 127.59847222222223 114.24384018516541L 119.20708333333334 114.24384018516541"-->
					<!--									cy="137.0926082221985" cx="168.56819444444446" j="2" val="-60"-->
					<!--									barHeight="-22.848768037033086" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3175"-->
					<!--									d="M 168.56819444444446 114.24384018516541L 168.56819444444446 182.79014429626466Q 168.56819444444446 182.79014429626466 168.56819444444446 182.79014429626466L 176.95958333333334 182.79014429626466Q 176.95958333333334 182.79014429626466 176.95958333333334 182.79014429626466L 176.95958333333334 182.79014429626466L 176.95958333333334 114.24384018516541L 176.95958333333334 114.24384018516541z"-->
					<!--									fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1"-->
					<!--									stroke-linecap="round" stroke-width="0" stroke-dasharray="0"-->
					<!--									class="apexcharts-bar-area" index="1"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 168.56819444444446 114.24384018516541L 168.56819444444446 182.79014429626466Q 168.56819444444446 182.79014429626466 168.56819444444446 182.79014429626466L 176.95958333333334 182.79014429626466Q 176.95958333333334 182.79014429626466 176.95958333333334 182.79014429626466L 176.95958333333334 182.79014429626466L 176.95958333333334 114.24384018516541L 176.95958333333334 114.24384018516541z"-->
					<!--									pathFrom="M 168.56819444444446 114.24384018516541L 168.56819444444446 114.24384018516541L 176.95958333333334 114.24384018516541L 176.95958333333334 114.24384018516541L 176.95958333333334 114.24384018516541L 176.95958333333334 114.24384018516541L 176.95958333333334 114.24384018516541L 168.56819444444446 114.24384018516541"-->
					<!--									cy="182.79014429626466" cx="217.92930555555557" j="3" val="-180"-->
					<!--									barHeight="-68.54630411109925" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3176"-->
					<!--									d="M 217.92930555555557 114.24384018516541L 217.92930555555557 152.32512024688722Q 217.92930555555557 152.32512024688722 217.92930555555557 152.32512024688722L 226.32069444444446 152.32512024688722Q 226.32069444444446 152.32512024688722 226.32069444444446 152.32512024688722L 226.32069444444446 152.32512024688722L 226.32069444444446 114.24384018516541L 226.32069444444446 114.24384018516541z"-->
					<!--									fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1"-->
					<!--									stroke-linecap="round" stroke-width="0" stroke-dasharray="0"-->
					<!--									class="apexcharts-bar-area" index="1"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 217.92930555555557 114.24384018516541L 217.92930555555557 152.32512024688722Q 217.92930555555557 152.32512024688722 217.92930555555557 152.32512024688722L 226.32069444444446 152.32512024688722Q 226.32069444444446 152.32512024688722 226.32069444444446 152.32512024688722L 226.32069444444446 152.32512024688722L 226.32069444444446 114.24384018516541L 226.32069444444446 114.24384018516541z"-->
					<!--									pathFrom="M 217.92930555555557 114.24384018516541L 217.92930555555557 114.24384018516541L 226.32069444444446 114.24384018516541L 226.32069444444446 114.24384018516541L 226.32069444444446 114.24384018516541L 226.32069444444446 114.24384018516541L 226.32069444444446 114.24384018516541L 217.92930555555557 114.24384018516541"-->
					<!--									cy="152.32512024688722" cx="267.2904166666667" j="4" val="-100"-->
					<!--									barHeight="-38.081280061721806" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3177"-->
					<!--									d="M 267.2904166666667 114.24384018516541L 267.2904166666667 137.0926082221985Q 267.2904166666667 137.0926082221985 267.2904166666667 137.0926082221985L 275.6818055555556 137.0926082221985Q 275.6818055555556 137.0926082221985 275.6818055555556 137.0926082221985L 275.6818055555556 137.0926082221985L 275.6818055555556 114.24384018516541L 275.6818055555556 114.24384018516541z"-->
					<!--									fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1"-->
					<!--									stroke-linecap="round" stroke-width="0" stroke-dasharray="0"-->
					<!--									class="apexcharts-bar-area" index="1"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 267.2904166666667 114.24384018516541L 267.2904166666667 137.0926082221985Q 267.2904166666667 137.0926082221985 267.2904166666667 137.0926082221985L 275.6818055555556 137.0926082221985Q 275.6818055555556 137.0926082221985 275.6818055555556 137.0926082221985L 275.6818055555556 137.0926082221985L 275.6818055555556 114.24384018516541L 275.6818055555556 114.24384018516541z"-->
					<!--									pathFrom="M 267.2904166666667 114.24384018516541L 267.2904166666667 114.24384018516541L 275.6818055555556 114.24384018516541L 275.6818055555556 114.24384018516541L 275.6818055555556 114.24384018516541L 275.6818055555556 114.24384018516541L 275.6818055555556 114.24384018516541L 267.2904166666667 114.24384018516541"-->
					<!--									cy="137.0926082221985" cx="316.6515277777778" j="5" val="-60"-->
					<!--									barHeight="-22.848768037033086" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3178"-->
					<!--									d="M 316.6515277777778 114.24384018516541L 316.6515277777778 146.61292823762895Q 316.6515277777778 146.61292823762895 316.6515277777778 146.61292823762895L 325.0429166666667 146.61292823762895Q 325.0429166666667 146.61292823762895 325.0429166666667 146.61292823762895L 325.0429166666667 146.61292823762895L 325.0429166666667 114.24384018516541L 325.0429166666667 114.24384018516541z"-->
					<!--									fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1"-->
					<!--									stroke-linecap="round" stroke-width="0" stroke-dasharray="0"-->
					<!--									class="apexcharts-bar-area" index="1"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 316.6515277777778 114.24384018516541L 316.6515277777778 146.61292823762895Q 316.6515277777778 146.61292823762895 316.6515277777778 146.61292823762895L 325.0429166666667 146.61292823762895Q 325.0429166666667 146.61292823762895 325.0429166666667 146.61292823762895L 325.0429166666667 146.61292823762895L 325.0429166666667 114.24384018516541L 325.0429166666667 114.24384018516541z"-->
					<!--									pathFrom="M 316.6515277777778 114.24384018516541L 316.6515277777778 114.24384018516541L 325.0429166666667 114.24384018516541L 325.0429166666667 114.24384018516541L 325.0429166666667 114.24384018516541L 325.0429166666667 114.24384018516541L 325.0429166666667 114.24384018516541L 316.6515277777778 114.24384018516541"-->
					<!--									cy="146.61292823762895" cx="366.0126388888889" j="6" val="-85"-->
					<!--									barHeight="-32.36908805246354" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3179"-->
					<!--									d="M 366.0126388888889 114.24384018516541L 366.0126388888889 142.80480023145677Q 366.0126388888889 142.80480023145677 366.0126388888889 142.80480023145677L 374.4040277777778 142.80480023145677Q 374.4040277777778 142.80480023145677 374.4040277777778 142.80480023145677L 374.4040277777778 142.80480023145677L 374.4040277777778 114.24384018516541L 374.4040277777778 114.24384018516541z"-->
					<!--									fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1"-->
					<!--									stroke-linecap="round" stroke-width="0" stroke-dasharray="0"-->
					<!--									class="apexcharts-bar-area" index="1"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 366.0126388888889 114.24384018516541L 366.0126388888889 142.80480023145677Q 366.0126388888889 142.80480023145677 366.0126388888889 142.80480023145677L 374.4040277777778 142.80480023145677Q 374.4040277777778 142.80480023145677 374.4040277777778 142.80480023145677L 374.4040277777778 142.80480023145677L 374.4040277777778 114.24384018516541L 374.4040277777778 114.24384018516541z"-->
					<!--									pathFrom="M 366.0126388888889 114.24384018516541L 366.0126388888889 114.24384018516541L 374.4040277777778 114.24384018516541L 374.4040277777778 114.24384018516541L 374.4040277777778 114.24384018516541L 374.4040277777778 114.24384018516541L 374.4040277777778 114.24384018516541L 366.0126388888889 114.24384018516541"-->
					<!--									cy="142.80480023145677" cx="415.37375" j="7" val="-75"-->
					<!--									barHeight="-28.560960046291356" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--								<path id="SvgjsPath3180"-->
					<!--									d="M 415.37375 114.24384018516541L 415.37375 152.32512024688722Q 415.37375 152.32512024688722 415.37375 152.32512024688722L 423.7651388888889 152.32512024688722Q 423.7651388888889 152.32512024688722 423.7651388888889 152.32512024688722L 423.7651388888889 152.32512024688722L 423.7651388888889 114.24384018516541L 423.7651388888889 114.24384018516541z"-->
					<!--									fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1"-->
					<!--									stroke-linecap="round" stroke-width="0" stroke-dasharray="0"-->
					<!--									class="apexcharts-bar-area" index="1"-->
					<!--									clip-path="url(#gridRectMaskq4f8hkllk)"-->
					<!--									pathTo="M 415.37375 114.24384018516541L 415.37375 152.32512024688722Q 415.37375 152.32512024688722 415.37375 152.32512024688722L 423.7651388888889 152.32512024688722Q 423.7651388888889 152.32512024688722 423.7651388888889 152.32512024688722L 423.7651388888889 152.32512024688722L 423.7651388888889 114.24384018516541L 423.7651388888889 114.24384018516541z"-->
					<!--									pathFrom="M 415.37375 114.24384018516541L 415.37375 114.24384018516541L 423.7651388888889 114.24384018516541L 423.7651388888889 114.24384018516541L 423.7651388888889 114.24384018516541L 423.7651388888889 114.24384018516541L 423.7651388888889 114.24384018516541L 415.37375 114.24384018516541"-->
					<!--									cy="152.32512024688722" cx="464.73486111111106" j="8" val="-100"-->
					<!--									barHeight="-38.081280061721806" barWidth="8.391388888888889">-->
					<!--								</path>-->
					<!--							</g>-->
					<!--							<g id="SvgjsG3160" class="apexcharts-datalabels" data:realIndex="0"></g>-->
					<!--							<g id="SvgjsG3171" class="apexcharts-datalabels" data:realIndex="1"></g>-->
					<!--						</g>-->
					<!--						<line id="SvgjsLine3229" x1="0" y1="0" x2="444.25" y2="0" stroke="#b6b6b6"-->
					<!--							stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs">-->
					<!--						</line>-->
					<!--						<line id="SvgjsLine3230" x1="0" y1="0" x2="444.25" y2="0"-->
					<!--							stroke-dasharray="0" stroke-width="0"-->
					<!--							class="apexcharts-ycrosshairs-hidden"></line>-->
					<!--						<g id="SvgjsG3231" class="apexcharts-yaxis-annotations"></g>-->
					<!--						<g id="SvgjsG3232" class="apexcharts-xaxis-annotations"></g>-->
					<!--						<g id="SvgjsG3233" class="apexcharts-point-annotations"></g>-->
					<!--					</g>-->
					<!--					<g id="SvgjsG3210" class="apexcharts-yaxis" rel="0"-->
					<!--						transform="translate(24.75, 0)">-->
					<!--						<g id="SvgjsG3211" class="apexcharts-yaxis-texts-g"><text id="SvgjsText3212"-->
					<!--								font-family="Helvetica, Arial, sans-serif" x="20" y="11.5"-->
					<!--								text-anchor="end" dominant-baseline="auto" font-size="0.86rem"-->
					<!--								font-weight="400" fill="#b9b9c3"-->
					<!--								class="apexcharts-text apexcharts-yaxis-label "-->
					<!--								style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--								<tspan id="SvgjsTspan3213">300</tspan>-->
					<!--								<title>300</title>-->
					<!--							</text><text id="SvgjsText3214"-->
					<!--								font-family="Helvetica, Arial, sans-serif" x="20"-->
					<!--								y="49.581280061721806" text-anchor="end" dominant-baseline="auto"-->
					<!--								font-size="0.86rem" font-weight="400" fill="#b9b9c3"-->
					<!--								class="apexcharts-text apexcharts-yaxis-label "-->
					<!--								style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--								<tspan id="SvgjsTspan3215">200</tspan>-->
					<!--								<title>200</title>-->
					<!--							</text><text id="SvgjsText3216"-->
					<!--								font-family="Helvetica, Arial, sans-serif" x="20"-->
					<!--								y="87.66256012344361" text-anchor="end" dominant-baseline="auto"-->
					<!--								font-size="0.86rem" font-weight="400" fill="#b9b9c3"-->
					<!--								class="apexcharts-text apexcharts-yaxis-label "-->
					<!--								style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--								<tspan id="SvgjsTspan3217">100</tspan>-->
					<!--								<title>100</title>-->
					<!--							</text><text id="SvgjsText3218"-->
					<!--								font-family="Helvetica, Arial, sans-serif" x="20"-->
					<!--								y="125.74384018516542" text-anchor="end" dominant-baseline="auto"-->
					<!--								font-size="0.86rem" font-weight="400" fill="#b9b9c3"-->
					<!--								class="apexcharts-text apexcharts-yaxis-label "-->
					<!--								style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--								<tspan id="SvgjsTspan3219">0</tspan>-->
					<!--								<title>0</title>-->
					<!--							</text><text id="SvgjsText3220"-->
					<!--								font-family="Helvetica, Arial, sans-serif" x="20"-->
					<!--								y="163.82512024688722" text-anchor="end" dominant-baseline="auto"-->
					<!--								font-size="0.86rem" font-weight="400" fill="#b9b9c3"-->
					<!--								class="apexcharts-text apexcharts-yaxis-label "-->
					<!--								style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--								<tspan id="SvgjsTspan3221">-100</tspan>-->
					<!--								<title>-100</title>-->
					<!--							</text><text id="SvgjsText3222"-->
					<!--								font-family="Helvetica, Arial, sans-serif" x="20"-->
					<!--								y="201.90640030860902" text-anchor="end" dominant-baseline="auto"-->
					<!--								font-size="0.86rem" font-weight="400" fill="#b9b9c3"-->
					<!--								class="apexcharts-text apexcharts-yaxis-label "-->
					<!--								style="font-family: Helvetica, Arial, sans-serif;">-->
					<!--								<tspan id="SvgjsTspan3223">-200</tspan>-->
					<!--								<title>-200</title>-->
					<!--							</text></g>-->
					<!--					</g>-->
					<!--					<g id="SvgjsG3148" class="apexcharts-annotations"></g>-->
					<!--				</svg>-->
					<!--				<div class="apexcharts-legend" style="max-height: 115px;"></div>-->
					<!--				<div class="apexcharts-tooltip apexcharts-theme-light">-->
					<!--					<div class="apexcharts-tooltip-title"-->
					<!--						style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>-->
					<!--					<div class="apexcharts-tooltip-series-group" style="order: 1;"><span-->
					<!--							class="apexcharts-tooltip-marker"-->
					<!--							style="background-color: rgb(115, 103, 240);"></span>-->
					<!--						<div class="apexcharts-tooltip-text"-->
					<!--							style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">-->
					<!--							<div class="apexcharts-tooltip-y-group"><span-->
					<!--									class="apexcharts-tooltip-text-y-label"></span><span-->
					<!--									class="apexcharts-tooltip-text-y-value"></span></div>-->
					<!--							<div class="apexcharts-tooltip-goals-group"><span-->
					<!--									class="apexcharts-tooltip-text-goals-label"></span><span-->
					<!--									class="apexcharts-tooltip-text-goals-value"></span></div>-->
					<!--							<div class="apexcharts-tooltip-z-group"><span-->
					<!--									class="apexcharts-tooltip-text-z-label"></span><span-->
					<!--									class="apexcharts-tooltip-text-z-value"></span></div>-->
					<!--						</div>-->
					<!--					</div>-->
					<!--					<div class="apexcharts-tooltip-series-group" style="order: 2;"><span-->
					<!--							class="apexcharts-tooltip-marker"-->
					<!--							style="background-color: rgb(255, 159, 67);"></span>-->
					<!--						<div class="apexcharts-tooltip-text"-->
					<!--							style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">-->
					<!--							<div class="apexcharts-tooltip-y-group"><span-->
					<!--									class="apexcharts-tooltip-text-y-label"></span><span-->
					<!--									class="apexcharts-tooltip-text-y-value"></span></div>-->
					<!--							<div class="apexcharts-tooltip-goals-group"><span-->
					<!--									class="apexcharts-tooltip-text-goals-label"></span><span-->
					<!--									class="apexcharts-tooltip-text-goals-value"></span></div>-->
					<!--							<div class="apexcharts-tooltip-z-group"><span-->
					<!--									class="apexcharts-tooltip-text-z-label"></span><span-->
					<!--									class="apexcharts-tooltip-text-z-value"></span></div>-->
					<!--						</div>-->
					<!--					</div>-->
					<!--				</div>-->
					<!--				<div-->
					<!--					class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">-->
					<!--					<div class="apexcharts-yaxistooltip-text"></div>-->
					<!--				</div>-->
					<!--			</div>-->
					<!--		</div>-->
					<!--		<div class="resize-triggers">-->
					<!--			<div class="expand-trigger">-->
					<!--				<div style="width: 487px; height: 246px;"></div>-->
					<!--			</div>-->
					<!--			<div class="contract-trigger"></div>-->
					<!--		</div>-->
					<!--	</apx-chart></div>-->
				</div>
				<!--<div class="col-md-4 col-12 budget-wrapper">-->
				<!--	<div class="btn-group">-->
				<!--		<div ngbdropdown="" class="dropdown"><button type="button" data-toggle="dropdown"-->
				<!--				aria-haspopup="true" aria-expanded="false" ngbdropdowntoggle="" rippleeffect=""-->
				<!--				class="dropdown-toggle btn btn-outline-primary btn-sm budget-dropdown waves-effect">-->
				<!--				2020 </button>-->
				<!--			<div ngbdropdownmenu="" x-placement="bottom-left" class="dropdown-menu"-->
				<!--				style="top: 0px; left: 0px; will-change: transform;"><a ngbdropdownitem=""-->
				<!--					href="javascript:void(0);" class="dropdown-item">2020</a><a ngbdropdownitem=""-->
				<!--					href="javascript:void(0);" class="dropdown-item">2019</a><a ngbdropdownitem=""-->
				<!--					href="javascript:void(0);" class="dropdown-item">2018</a></div>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--	<h2 class="mb-25"><i class="fa fa-inr" aria-hidden="true"></i> 3250</h2>-->
				<!--	<div class="d-flex justify-content-center"><span-->
				<!--			class="font-weight-bolder mr-25">Budget:</span><span>56,800</span></div>-->
				<!--	<div id="budget-chart"><apx-chart _nghost-ihp-c131="" style="position: relative;">-->
				<!--			<div _ngcontent-ihp-c131="" style="min-height: 80px;">-->
				<!--				<div id="apexchartsjvq6onll"-->
				<!--					class="apexcharts-canvas apexchartsjvq6onll apexcharts-theme-light"-->
				<!--					style="width: 192px; height: 80px;"><svg id="SvgjsSvg3234" width="192" height="80"-->
				<!--						xmlns="http://www.w3.org/2000/svg" version="1.1"-->
				<!--						xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"-->
				<!--						class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"-->
				<!--						style="background: transparent;">-->
				<!--						<g id="SvgjsG3236" class="apexcharts-inner apexcharts-graphical"-->
				<!--							transform="translate(0, 0)">-->
				<!--							<defs id="SvgjsDefs3235">-->
				<!--								<clipPath id="gridRectMaskjvq6onll">-->
				<!--									<rect id="SvgjsRect3241" width="198" height="82" x="-3" y="-1"-->
				<!--										rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"-->
				<!--										stroke-dasharray="0" fill="#fff"></rect>-->
				<!--								</clipPath>-->
				<!--								<clipPath id="gridRectMarkerMaskjvq6onll">-->
				<!--									<rect id="SvgjsRect3242" width="196" height="84" x="-2" y="-2"-->
				<!--										rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"-->
				<!--										stroke-dasharray="0" fill="#fff"></rect>-->
				<!--								</clipPath>-->
				<!--							</defs>-->
				<!--							<line id="SvgjsLine3240" x1="0" y1="0" x2="0" y2="80" stroke="#b6b6b6"-->
				<!--								stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0"-->
				<!--								width="1" height="80" fill="#b1b9c4" filter="none" fill-opacity="0.9"-->
				<!--								stroke-width="1"></line>-->
				<!--							<g id="SvgjsG3252" class="apexcharts-xaxis" transform="translate(0, 0)">-->
				<!--								<g id="SvgjsG3253" class="apexcharts-xaxis-texts-g"-->
				<!--									transform="translate(0, -4)"></g>-->
				<!--							</g>-->
				<!--							<g id="SvgjsG3266" class="apexcharts-grid">-->
				<!--								<g id="SvgjsG3267" class="apexcharts-gridlines-horizontal"-->
				<!--									style="display: none;">-->
				<!--									<line id="SvgjsLine3269" x1="0" y1="0" x2="192" y2="0"-->
				<!--										stroke="#e0e0e0" stroke-dasharray="0"-->
				<!--										class="apexcharts-gridline"></line>-->
				<!--									<line id="SvgjsLine3270" x1="0" y1="20" x2="192" y2="20"-->
				<!--										stroke="#e0e0e0" stroke-dasharray="0"-->
				<!--										class="apexcharts-gridline"></line>-->
				<!--									<line id="SvgjsLine3271" x1="0" y1="40" x2="192" y2="40"-->
				<!--										stroke="#e0e0e0" stroke-dasharray="0"-->
				<!--										class="apexcharts-gridline"></line>-->
				<!--									<line id="SvgjsLine3272" x1="0" y1="60" x2="192" y2="60"-->
				<!--										stroke="#e0e0e0" stroke-dasharray="0"-->
				<!--										class="apexcharts-gridline"></line>-->
				<!--									<line id="SvgjsLine3273" x1="0" y1="80" x2="192" y2="80"-->
				<!--										stroke="#e0e0e0" stroke-dasharray="0"-->
				<!--										class="apexcharts-gridline"></line>-->
				<!--								</g>-->
				<!--								<g id="SvgjsG3268" class="apexcharts-gridlines-vertical"-->
				<!--									style="display: none;"></g>-->
				<!--								<line id="SvgjsLine3275" x1="0" y1="80" x2="192" y2="80"-->
				<!--									stroke="transparent" stroke-dasharray="0"></line>-->
				<!--								<line id="SvgjsLine3274" x1="0" y1="1" x2="0" y2="80"-->
				<!--									stroke="transparent" stroke-dasharray="0"></line>-->
				<!--							</g>-->
				<!--							<g id="SvgjsG3243" class="apexcharts-line-series apexcharts-plot-series">-->
				<!--								<g id="SvgjsG3244" class="apexcharts-series" seriesName="seriesx1"-->
				<!--									data:longestSeries="true" rel="1" data:realIndex="0">-->
				<!--									<path id="SvgjsPath3247"-->
				<!--										d="M 0 19C 6.72 19 12.48 32 19.2 32C 25.919999999999998 32 31.68 11 38.4 11C 45.12 11 50.879999999999995 28 57.599999999999994 28C 64.32 28 70.08 20 76.8 20C 83.52 20 89.28 40 96 40C 102.72 40 108.47999999999999 1 115.19999999999999 1C 121.91999999999999 1 127.68 20 134.4 20C 141.12 20 146.88 21 153.6 21C 160.32 21 166.07999999999998 37 172.79999999999998 37C 179.51999999999998 37 185.28 18 192 18"-->
				<!--										fill="none" fill-opacity="1" stroke="rgba(115,103,240,0.85)"-->
				<!--										stroke-opacity="1" stroke-linecap="butt" stroke-width="2"-->
				<!--										stroke-dasharray="0" class="apexcharts-line" index="0"-->
				<!--										clip-path="url(#gridRectMaskjvq6onll)"-->
				<!--										pathTo="M 0 19C 6.72 19 12.48 32 19.2 32C 25.919999999999998 32 31.68 11 38.4 11C 45.12 11 50.879999999999995 28 57.599999999999994 28C 64.32 28 70.08 20 76.8 20C 83.52 20 89.28 40 96 40C 102.72 40 108.47999999999999 1 115.19999999999999 1C 121.91999999999999 1 127.68 20 134.4 20C 141.12 20 146.88 21 153.6 21C 160.32 21 166.07999999999998 37 172.79999999999998 37C 179.51999999999998 37 185.28 18 192 18"-->
				<!--										pathFrom="M -1 80L -1 80L 19.2 80L 38.4 80L 57.599999999999994 80L 76.8 80L 96 80L 115.19999999999999 80L 134.4 80L 153.6 80L 172.79999999999998 80L 192 80">-->
				<!--									</path>-->
				<!--									<g id="SvgjsG3245" class="apexcharts-series-markers-wrap"-->
				<!--										data:realIndex="0"></g>-->
				<!--								</g>-->
				<!--								<g id="SvgjsG3248" class="apexcharts-series" seriesName="seriesx2"-->
				<!--									data:longestSeries="true" rel="2" data:realIndex="1">-->
				<!--									<path id="SvgjsPath3251"-->
				<!--										d="M 0 60C 6.72 60 12.48 70 19.2 70C 25.919999999999998 70 31.68 50 38.4 50C 45.12 50 50.879999999999995 65 57.599999999999994 65C 64.32 65 70.08 57 76.8 57C 83.52 57 89.28 80 96 80C 102.72 80 108.47999999999999 55 115.19999999999999 55C 121.91999999999999 55 127.68 65 134.4 65C 141.12 65 146.88 60 153.6 60C 160.32 60 166.07999999999998 75 172.79999999999998 75C 179.51999999999998 75 185.28 53 192 53"-->
				<!--										fill="none" fill-opacity="1" stroke="rgba(220,218,227,0.85)"-->
				<!--										stroke-opacity="1" stroke-linecap="butt" stroke-width="1"-->
				<!--										stroke-dasharray="5" class="apexcharts-line" index="1"-->
				<!--										clip-path="url(#gridRectMaskjvq6onll)"-->
				<!--										pathTo="M 0 60C 6.72 60 12.48 70 19.2 70C 25.919999999999998 70 31.68 50 38.4 50C 45.12 50 50.879999999999995 65 57.599999999999994 65C 64.32 65 70.08 57 76.8 57C 83.52 57 89.28 80 96 80C 102.72 80 108.47999999999999 55 115.19999999999999 55C 121.91999999999999 55 127.68 65 134.4 65C 141.12 65 146.88 60 153.6 60C 160.32 60 166.07999999999998 75 172.79999999999998 75C 179.51999999999998 75 185.28 53 192 53"-->
				<!--										pathFrom="M -1 80L -1 80L 19.2 80L 38.4 80L 57.599999999999994 80L 76.8 80L 96 80L 115.19999999999999 80L 134.4 80L 153.6 80L 172.79999999999998 80L 192 80">-->
				<!--									</path>-->
				<!--									<g id="SvgjsG3249" class="apexcharts-series-markers-wrap"-->
				<!--										data:realIndex="1"></g>-->
				<!--								</g>-->
				<!--								<g id="SvgjsG3246" class="apexcharts-datalabels" data:realIndex="0"></g>-->
				<!--								<g id="SvgjsG3250" class="apexcharts-datalabels" data:realIndex="1"></g>-->
				<!--							</g>-->
				<!--							<line id="SvgjsLine3276" x1="0" y1="0" x2="192" y2="0" stroke="#b6b6b6"-->
				<!--								stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs">-->
				<!--							</line>-->
				<!--							<line id="SvgjsLine3277" x1="0" y1="0" x2="192" y2="0" stroke-dasharray="0"-->
				<!--								stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>-->
				<!--							<g id="SvgjsG3278" class="apexcharts-yaxis-annotations"></g>-->
				<!--							<g id="SvgjsG3279" class="apexcharts-xaxis-annotations"></g>-->
				<!--							<g id="SvgjsG3280" class="apexcharts-point-annotations"></g>-->
				<!--						</g>-->
				<!--						<rect id="SvgjsRect3239" width="0" height="0" x="0" y="0" rx="0" ry="0"-->
				<!--							opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"-->
				<!--							fill="#fefefe"></rect>-->
				<!--						<g id="SvgjsG3265" class="apexcharts-yaxis" rel="0"-->
				<!--							transform="translate(-18, 0)"></g>-->
				<!--						<g id="SvgjsG3237" class="apexcharts-annotations"></g>-->
				<!--					</svg>-->
				<!--					<div class="apexcharts-legend" style="max-height: 40px;"></div>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--			<div class="resize-triggers">-->
				<!--				<div class="expand-trigger">-->
				<!--					<div style="width: 91px; height: 81px;"></div>-->
				<!--				</div>-->
				<!--				<div class="contract-trigger"></div>-->
				<!--			</div>-->
				<!--		</apx-chart></div><button type="button" rippleeffect=""-->
				<!--		class="btn btn-primary waves-effect waves-float waves-light">Increase Budget</button>-->
				<!--</div>-->
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
                                @if($todayOrders)
                                    @foreach($todayOrders as $today)
                                    <tr>
                                        <td>{{$today->order_id}}</td>
                                        <td>{{$today->restaurant->name}}</td>
                                        <td>{{$today->amount}}</td>
                                        <td>{{count($today->order_items)}}</td>
                                    </tr>
                                    @endforeach
                                @endif
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

