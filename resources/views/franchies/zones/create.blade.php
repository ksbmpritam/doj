@extends('franchies.layouts.app')

@section('content')
<div class="page-wrapper">
    <form id="polygonForm">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Create Zone</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('franchies/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('franchies.zone') !!}">Zone</a></li>
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
                                    <a class="nav-link " href="{!! route('franchies.zone') !!}"><i class="fa fa-list mr-2"></i>Zone List</a>
                                </li>
                                <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>Create Zone</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">

                            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                            <div class="row restaurant_payout_create">

                                <div class="restaurant_payout_create-inner">
                                    <fieldset>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Name <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                                <div class="form-text text-muted">
                                                    <span class="text-danger " style="display:none" id="name_v" >Name field is required</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">State <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}">
                                                <div class="form-text text-muted">
                                                    <span class="text-danger " style="display:none" id="state_v" >State field is required</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">City <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                                                <div class="form-text text-muted">
                                                     <span class="text-danger " style="display:none" id="city_v" >city field is required</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check form-group row width-50">
                                            <label class="col-3 control-label text-white">.</label>
                                            <input type="checkbox" class="item_publish" name="status" id="item_publish" value="1">
                                            <label class="col-3 control-label" for="item_publish">{{ trans('lang.item_publish') }}</label>
                                            @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label">Full Address. <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" id="city_full_address" autocomplete="off" data-prevent-blank="1" class="form-control city_full_address rm-r-br address_input" name="city_full_address" placeholder=""/>
                                                <input type="hidden" name="from_latitude"   value="" id="from_latitude" placeholder="">
                                                <input type="hidden" name="from_longitude" value=""  id="from_longitude" placeholder="">
                                                <input type="hidden" name="from_city" value=""  id="from_city" placeholder="">
                                                <input type="hidden" name="from_state"  value="" id="from_state" placeholder="">
                                                <input type="hidden" name="from_state_short" value=""  id="from_state_short" placeholder="">
                                                <input type="hidden" name="from_pincode"  value=""  id="from_pincode" placeholder="">
                                                <input type="hidden" name="from_loc_transporter" id="from_loc_transporter" placeholder="">
                                                <div class="form-text text-muted">
                                                    <span class="text-danger " style="display:none" id="city_full_address_v" >Address field is required</span>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row width-100">
                                            <div id="map" style="height: 400px;"></div>
                                        </div>
                                    </fieldset>

                                </div>

                            </div>

                        </div>
                        <div class="form-group col-12 text-center btm-btn">
                            <button id="savePolygon" class="btn btn-primary save_attribute_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
                            <a href="{!! route('franchies.zone') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                            <button type="button" class="btn btn-primary" id="removePolygon">Remove Polygon</button>
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDn46rFOSG_dhB4c4D5wKECcKMXfzFb4-w&libraries=places,drawing,geometry&callback=initMap"></script>

<script>

    var map;
    var polygon;
    var polygonCoords = [];
     let componentForm = {
            locality: "long_name",
            administrative_area_level_1: "long_name",
            administrative_area_level_2: "long_name",
            postal_code: "short_name",
        };
        
    function initMap() {
        
        let options = {
                types: ['(regions)'],
                componentRestrictions: { country: "IN" },
            };
            
        let selected = false;
        
        let inputs = document.getElementById('city_full_address');
        
        if (inputs) {
            var autocompleteTo = new google.maps.places.Autocomplete(inputs, options);
            google.maps.event.addListener(autocompleteTo, "place_changed", function () {
                var place = this.getPlace();
                if(place.geometry !== undefined){
                    if(place.geometry.location !== undefined){
                        map.fitBounds(place.geometry.viewport);
                    }else{
                        map.setCenter(place.geometry.location);
                        map.setZoom(12);
                    }
                    
                    document.getElementById("from_latitude").value = "";
                    document.getElementById("from_longitude").value = "";
                    document.getElementById("from_city").value = "";
                    document.getElementById("from_state").value = "";
                    document.getElementById("from_state_short").value = "";
                    document.getElementById("from_pincode").value = "";
                    document.getElementById("from_loc_transporter").value = "";
    
                    var latTo = place.geometry.location.lat();
                    var lngTo = place.geometry.location.lng();
                    document.getElementById("from_latitude").value = latTo;
                    document.getElementById("from_longitude").value = lngTo;
                    for (const component of place.address_components) {
                        const addressType = component.types[0];
                        if (componentForm[addressType]) {
                            if (addressType == "locality") {
                                const val = component[componentForm[addressType]];
                                document.getElementById("from_city").value = val;
                            }
                            if (addressType == "administrative_area_level_1") {
                                const val = component[componentForm[addressType]];
                                document.getElementById("from_state").value = val;
                            }
                            if (addressType == "administrative_area_level_2") {
                                const val = component[componentForm[addressType]];
                                document.getElementById("from_state_short").value = val;
                            }
                            if (addressType == "postal_code") {
                                const val = component[componentForm[addressType]];
                                document.getElementById("from_pincode").value = val;
                            }
                        }
                    }
                    document.getElementById("from_loc_transporter").value =
                        document.getElementById("from_city").value +
                        ", " +
                        document.getElementById("from_state").value;
                }
            });
            
            $('.city_full_address').on('focus', function() {
                selected = false;
            }).on('blur', function() {
                if (!selected) {
                    $(this).val('');
                }
            });
        }
        
        
        
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 28.635216,
                lng: 78.254136
            },
            zoom: 12,
        });

        var drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: false,
        });

        drawingManager.setMap(map);

        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
            if (event.type === 'polygon') {
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
            
            if(validation()){
                savePolygon(polygonCoords);
            }
                event.preventDefault();
        });
        
        document.getElementById('removePolygon').addEventListener('click', function() {
            if (polygon) {
                polygon.setMap(null); 
                polygonCoords = []; 
            }
        });
    }

    function savePolygon(coords) {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var formData = new FormData(document.getElementById('polygonForm'));
        formData.append('polygonData', JSON.stringify(coords));
        
        
        var insertRoute = "{{ route('franchies.zone.insert') }}";
        var mainUrl = "{{ route('franchies.zone') }}";
    
        fetch(insertRoute, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.href = mainUrl;  
                } else {
                    alert('Failed to save polygon');
                }
            })
            .catch(error => {
                // alert(error);
                console.error('Error:', error);
            });
    }
    
    function validation() {
        let name = document.getElementById('name').value;
        let state = document.getElementById('state').value;
        let city = document.getElementById('city').value;
        let city_full_address = document.getElementById('city_full_address').value;

        let isValidate = true;

        if (name.trim() === '') {
            let field = document.getElementById('name_v');
            field.style.display = 'block';
            isValidate = false;
        } else {
            let field = document.getElementById('name_v');
            field.style.display = 'none';
        }

        if (state.trim() === '') {
            let field = document.getElementById('state_v');
            field.style.display = 'block';
            isValidate = false;
        } else {
            let field = document.getElementById('state_v');
            field.style.display = 'none';
        }

        if (city.trim() === '') {
            let field = document.getElementById('city_v');
            field.style.display = 'block';
            isValidate = false;
        } else {
            let field = document.getElementById('city_v');
            field.style.display = 'none';
        }

        if (city_full_address.trim() === '') {
            let field = document.getElementById('city_full_address_v');
            field.style.display = 'block';
            isValidate = false;
        } else {
            let field = document.getElementById('city_full_address_v');
            field.style.display = 'none';
        }

        return isValidate;
    }
    
    initMap();
</script>
@endsection