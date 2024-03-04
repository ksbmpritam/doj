@extends('employee.layouts.app')

@section('content')
    <style type="text/css">
        .dt-buttons button{
            border:none;
            cursor:pointer;
        }
    
        .w-5{
            width:15px;
        }
       .flex.justify-between.flex-1.sm\:hidden{
           display:none;
       }
       .btn-primary{
            color: #fff;
            background-color: #007bff !important;
            border-color: #007bff !important;
       }
       .dataTables_length{
           margin-right:50px;
       }
        .topbar {
            background: #ff683a;
        }

        .left-sidebar {
            background: #ff683a;
        }

        .sidebar-nav ul li a {
            border-bottom: #ff683a;
        }

        .sidebar-nav {
            background: #ff683a;
        }

        .sidebar-nav ul li a:hover i {
            color: #ff683a;
        }

        .vendor_payout_create-inner fieldset legend {
            background: #ff683a;
        }

        .restaurant_payout_create-inner fieldset legend {
            background: #ff683a;
        }

        a {
            color: #ff683a;
        }

        a:hover, a:focus {
            color: #ff683a;
        }

        a.link:hover, a.link:focus {
            color: #ff683a;
        }

        html body blockquote {
            border-left: 5px solid#ff683a;
        }

        .text-warning {
            color: #ff683a   !important;
        }

        .text-info {
            color: #ff683a   !important;
        }

        .sidebar-nav ul li a:hover {
            color: #ff683a;
        }

        .btn-primary {
            background: #ff683a;
            border: 1px solid#ff683a;
        }

        .sidebar-nav > ul > li.active > a {
            color: #ff683a;
            border-left: 3px solid#ff683a;
        }

        .sidebar-nav > ul > li.active > a i {
            color: #ff683a;
        }

        .bg-info {
            background-color: #ff683a   !important;
        }

        .bellow-text ul li > span {
            color: #ff683a

        }

        .table tr td.redirecttopage {
            color: #ff683a

        }

        ul.rating {
            color: #ff683a;
        }

        .nav-tabs.card-header-tabs .nav-link.active, .nav-tabs.card-header-tabs .nav-link:hover {
            background: #ff683a;
            border-color: #ff683a #ff683a #fff;
        }

        .btn-warning, .btn-warning.disabled {
            background: #ff683a;
            border: 1px solid#ff683a;
            box-shadow: none;
        }

        .payment-top-tab .nav-tabs.card-header-tabs .nav-link.active, .payment-top-tab .nav-tabs.card-header-tabs .nav-link:hover {
            border-color: #ff683a;
        }

        .nav-tabs.card-header-tabs .nav-link span.badge-success {
            background: #ff683a;
        }

        .nav-tabs.card-header-tabs .nav-link.active span.badge-success, .nav-tabs.card-header-tabs .nav-link:hover span.badge-success, .sidebar-nav ul li a.active, .sidebar-nav ul li a.active:hover, .sidebar-nav ul li.active a.has-arrow:hover, .topbar ul.dropdown-user li a:hover {
            color: #ff683a;
        }

        .sidebar-nav ul li a.has-arrow:hover::after, .sidebar-nav .active > .has-arrow::after, .sidebar-nav li > .has-arrow.active::after, .sidebar-nav .has-arrow[aria-expanded="true"]::after, .sidebar-nav ul li a:hover {
            border-color: #ff683a;
        }

        [type="checkbox"]:checked + label::before {
            border-right: 2px solid#ff683a;
            border-bottom: 2px solid#ff683a;
        }

        .btn-primary:hover, .btn-primary.disabled:hover {
            background: #ff683a;
            border: 1px solid#ff683a;
        }

        .btn-primary.active, .btn-primary:active, .btn-primary:focus, .btn-primary.disabled.active, .btn-primary.disabled:active, .btn-primary.disabled:focus, .btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary.focus:active, .btn-primary:active:focus, .btn-primary:active:hover, .open > .dropdown-toggle.btn-primary.focus, .open > .dropdown-toggle.btn-primary:focus, .open > .dropdown-toggle.btn-primary:hover, .btn-primary.focus, .btn-primary:focus, .btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active:focus, .show > .btn-primary.dropdown-toggle:focus, .btn-warning:hover, .btn-warning:hover, .btn-warning.disabled:hover, .btn-warning.active.focus, .btn-warning.active:focus, .btn-warning.active:hover, .btn-warning.focus:active, .btn-warning:active:focus, .btn-warning:active:hover, .open > .dropdown-toggle.btn-warning.focus, .open > .dropdown-toggle.btn-warning:focus, .open > .dropdown-toggle.btn-warning:hover, .btn-warning.focus, .btn-warning:focus {
            background: #ff683a;
            border-color: #ff683a;
            box-shadow: 0 0 0 0.2rem#ff683a;
        }

        .language-options select option, .pagination > li > a.page-link:hover {
            background: #ff683a;
        }

        .mini-sidebar .sidebar-nav #sidebarnav > li:hover a i, .mini-sidebar .sidebar-nav ul li a, .sidebar-nav ul li a.active i, .sidebar-nav ul li a.active:hover i, .sidebar-nav ul li.active a:hover i {
            color: #ff683a;
        }

        .cat-slider .cat-item a.cat-link:hover, .cat-slider .cat-item.section-selected a.cat-link {
            border-color: #ff683a;
        }

        .cat-slider .cat-item a.cat-link {
            border-bottom-color: #ff683a ;
        }

        .cat-slider .cat-item.section-selected a.cat-link:after {
            border-color: #ff683a;
            background: #ff683a;
        }

        .cat-slider {
            border-color: #ff683a;
        }

        .business-analytics .card-box i {
            background: #ff683a;
        }

        .order-status .data i, .order-status span.count {
            color: #ff683a;
        }

        @media screen and ( max-width: 767px ) {

            .mini-sidebar .sidebar-nav ul li a:hover, .sidebar-nav > ul > li.active > a {
                color: #ff683a   !important;
            }
            .mini-sidebar .sidebar-nav #sidebarnav > li:hover a i, .mini-sidebar .sidebar-nav ul li a, .sidebar-nav ul li a.active i, .sidebar-nav ul li a.active:hover i, .sidebar-nav ul li.active a:hover i{color: #fff;}
            .sidebar-nav > ul > li.active > a,.sidebar-nav > ul > li.active > a i,.sidebar-nav > ul > li > a:hover i{color: #ff683a   !important;}
        }
        .nav-tabs .nav-item {
            margin-left: 5px;
        }
        
    </style>

<div class="page-wrapper">
    <form action="{{ url ('employee/zone/update/'. $zone->id)}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Create Zone</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('employee/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('employee.zone') !!}">Zone</a></li>
                    <li class="breadcrumb-item active"> Create Zone </li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <div class="card-header">
                            <ul class="nav nav-tabs align-items-end card-header-tabs justify-content-center w-100">
                                <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                    <a class="nav-link " href="{!! route('employee.zone') !!}"><i class="fa fa-list mr-2"></i>Zone List</a>
                                </li>
                                <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>Create Zone</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">

                            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                            <div class="error_top" style="display:none"></div>
                            <div class="row restaurant_payout_create">

                                <div class="restaurant_payout_create-inner">
                                    <fieldset>
                                        <legend>Manager Details</legend>
                                        <div class="form-group row width-50">
                                            <input type="hidden" id="polygonId" name="polygonId" value="{{ $zone->id }}">
                                            <label class="col-3 control-label">Name</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="name" value="{{ $zone->name }}">
                                                <div class="form-text text-muted">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">State</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="state" value="{{ $zone->state }}">
                                                <div class="form-text text-muted">
                                                    @error('state')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group row width-50">
                                            <label class="col-3 control-label">City</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="city" value="{{ $zone->city }}">
                                                <div class="form-text text-muted">
                                                    @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check row width-50">
                                            <input type="checkbox" class="item_publish" name="status" id="item_publish" value="1" @if($zone->status == 1) checked @endif>
                                            <label class="col-3 control-label" for="item_publish">{{ trans('lang.item_publish') }}</label>
                                            @error('status')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label">Full Address.</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="city_full_address"  name="city_full_address" value="{{ $zone->city_full_address }}">
                                                <div class="form-text text-muted">
                                                    @error('city_full_address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-check row width-100">
                                           <div id="map" style="height: 400px;"></div>
                                        </div>
                                        
                                    </fieldset>

                                </div>

                            </div>

                        </div>
                        <div class="form-group col-12 text-center btm-btn">
                            <button type="submit" class="btn btn-primary save_attribute_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
                            <a href="{!! route('employee.zone') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
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
 <script>
        var map;
        var polygon;
        var polygonCoords = @json($map_polygon);
    
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 28.635216, lng: 78.254136 },
                zoom: 12,
            });
    
            var drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: false,
            });

            drawingManager.setMap(map);

            google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
                if (event.type === 'polygon') {
                    if (polygon) {
                        polygon.setMap(null); // Remove the existing polygon
                    }
                    polygon = event.overlay;
                    polygon.getPath().forEach(function(coord, index) {
                        polygonCoords.push({
                            lat: coord.lat(),
                            lng: coord.lng(),
                        });
                    });
                }
            });
            
            document.getElementById('savePolygon').addEventListener('click', function(event) {
                event.preventDefault(); 
                savePolygon(polygonCoords);
            });

            document.getElementById('removePolygon').addEventListener('click', function() {
                if (polygon) {
                    polygon.setMap(null); // Remove the polygon from the map
                    polygonCoords = []; // Clear the coordinates
                }
            });

            polygon = new google.maps.Polygon({
                paths: polygonCoords,
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
            });
    
            polygon.setMap(map);
        }
        
        function savePolygon(coords) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Get the form data including polygon coordinates
            var formData = new FormData(document.getElementById('polygonForm'));
            formData.append('polygonData', JSON.stringify(coords));

            fetch('/employee/zone/update/', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Polygon saved successfully');
                    location.reload(); // Reload the page after saving
                } else {
                    alert('Failed to save polygon');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        initMap();
</script>
@endsection