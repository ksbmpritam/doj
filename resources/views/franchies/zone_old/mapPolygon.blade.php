<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style type="text/css">
        #map {
            height: 100%;
        }
        #map-canvas {
            height: 750px;
            margin: 0px;
            padding: 0px
        }
            .pac-card {
            background-color: #fff;
            border: 0;
            border-radius: 2px;
            box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
            margin: 10px;
            padding: 0 0.5em;
            font: 400 18px Roboto, Arial, sans-serif;
            overflow: hidden;
            font-family: Roboto;
            padding: 0;
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }
        #searchMapCityOnly {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
            margin-bottom: 15px;
        }

        #searchMapCityOnly:focus {
            border-color: #4d90fe;
        }

        #floating-panel {
            position: absolute;
            top: 50px;
            right: 9%;
            z-index: 5;
            background-color: #ffffffd1;
            padding: 5px;
            text-align: center;
            font-family: "Roboto", "sans-serif";
            line-height: 30px;
        }
        #floating-panel #save_polygon{
            display: none;
        }
        #floating-panel #clear_polygon{
            display: none;
        }
    </style>
</head>
<body>
    <div class="content-body">
        <div class="card">
            <div class="card-header border-bottom mx-2 px-0">
                <h4 class="card-title pb-1">{{!empty($zone->map_polygon) ? 'Update' : 'Assign'}} Zone Geofencing : {{$zone->name}} {{!empty($zone->city_full_address) ? "[".$zone->city_full_address."]" : ""}}</h4>
            </div>
            <div class="card-body">
                <input type="hidden" name="zone_id" id="zone_id" value="{{ $id }}">
                <input type="hidden" name="map_polygon" id="polygon" value="">
                <input type="hidden" id="city" value="">
                <input type="hidden" id="state" value="">
                <input type="hidden" id="latitude" value="">
                <input type="hidden" id="longitude" value="">
                <div class="row">
                    <div class="col-md-12 text-center mt-1">
                        <input id="searchMapCityOnly" class="controls" type="text" placeholder="Search Cities" />
                        <div id="floating-panel">
                            <button type="button" id="save_polygon" onclick="save_polygon()" class="btn btn-icon btn-success waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Save Zone Geofencing">Save</button>
                            <button type="button" id="clear_polygon" onclick="clear_polygon()" class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Remove Zone Geofencing">Clear</button>
                        </div>
                        <div id="map-canvas" class="google_map_initialize"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&libraries=places,drawing,geometry&callback=initMap" async defer></script>
<script type="text/javascript">
    var map; // Global declaration of the map
    var drawingManager;
    var newPolygon = [];
    var newPolygonCenter = {};
    let allZonePolygon = @json(getAllZoneLatLngForGmap($zone->city,$zone->state,$zone->dc_hub_id));
    var map_center = { lat:"{{$mapCenter['lat']}}",lng:"{{$mapCenter['lng']}}" };

    // NOTE: DO NOT CHANGE FUNCTION NAME, this function name is set in 
    function google_map_initialize() {
        var myLatlng = new google.maps.LatLng({{$mapCenter['lat']}},{{$mapCenter['lng']}});

        var myOptions = {
            zoom: 12,
            center: myLatlng,
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        //This custom function get's bound pincodes by polygon area
        google.maps.Polygon.prototype.getBoundingBox = function() {
            var bounds = new google.maps.LatLngBounds();

            this.getPath().forEach(function(element,index) {
                bounds.extend(element)
            });

            return(bounds);
        };
        //This custom function calculates center of polygon
        google.maps.Polygon.prototype.getApproximateCenter = function() {
            var boundsHeight = 0,
            boundsWidth = 0,
            centerPoint,
            heightIncr = 0,
            maxSearchLoops,
            maxSearchSteps = 10,
            n = 1,
            northWest,
            polygonBounds = this.getBoundingBox(),
            testPos,
            widthIncr = 0;

            // Get polygon Centroid
            centerPoint = polygonBounds.getCenter();

            if (google.maps.geometry.poly.containsLocation(centerPoint, this)) {
                // Nothing to do Centroid is in polygon use it as is
                return centerPoint;
            } else {
                maxSearchLoops = maxSearchSteps / 2;
            
                // Calculate NorthWest point so we can work out height of polygon NW->SE
                northWest = new google.maps.LatLng(polygonBounds.getNorthEast().lat(), polygonBounds.getSouthWest().lng());

                // Work out how tall and wide the bounds are and what our search increment will be
                boundsHeight = google.maps.geometry.spherical.computeDistanceBetween(northWest, polygonBounds.getSouthWest());
                heightIncr = boundsHeight / maxSearchSteps;
                boundsWidth = google.maps.geometry.spherical.computeDistanceBetween(northWest, polygonBounds.getNorthEast());
                widthIncr = boundsWidth / maxSearchSteps;

                // Expand out from Centroid and find a point within polygon at 0, 90, 180, 270 degrees
                for (; n <= maxSearchLoops; n++) {
                    // Test point North of Centroid
                    testPos = google.maps.geometry.spherical.computeOffset(centerPoint, (heightIncr * n), 0);
                    if (google.maps.geometry.poly.containsLocation(testPos, this)) {
                        break;
                    }

                    // Test point East of Centroid
                    testPos = google.maps.geometry.spherical.computeOffset(centerPoint, (widthIncr * n), 90);
                    if (google.maps.geometry.poly.containsLocation(testPos, this)) {
                        break;
                    }

                    // Test point South of Centroid
                    testPos = google.maps.geometry.spherical.computeOffset(centerPoint, (heightIncr * n), 180);
                    if (google.maps.geometry.poly.containsLocation(testPos, this)) {
                        break;
                    }

                    // Test point West of Centroid
                    testPos = google.maps.geometry.spherical.computeOffset(centerPoint, (widthIncr * n), 270);
                    if (google.maps.geometry.poly.containsLocation(testPos, this)) {
                        break;
                    }
                }

                return(testPos);
            }
        };
        map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
        setCurrentPolygon();
        // setAllZonePolygon();

        var autocomplete_options = {
            componentRestrictions: {country: "IN"}
        };
        var searchMapCityOnly = document.getElementById('searchMapCityOnly');
        var autocompleteCities = new google.maps.places.Autocomplete(searchMapCityOnly,autocomplete_options);

        google.maps.event.addListener(autocompleteCities, 'place_changed', function () {
            var place = this.getPlace();
            if(place.geometry !== undefined){
                if(place.geometry.location !== undefined){
                    map.fitBounds(place.geometry.viewport);
                }else{
                    map.setCenter(place.geometry.location);
                    map.setZoom(12);
                }
                latFrom = place.geometry.location.lat();
                lngFrom = place.geometry.location.lng();
                // empty the value once selected from dropdown
                document.getElementById('latitude').value ='';
                document.getElementById('longitude').value ='';
                document.getElementById('city').value='';
                document.getElementById('state').value ='';
                // set latitude longitude from geometry
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
                
                for (const component of place.address_components) {
                    const addressType = component.types[0];
                    if (componentForm[addressType]) {
                        if (addressType == 'locality') {
                            const val = component[componentForm[addressType]];
                            document.getElementById('city').value = val;
                        }

                        if (addressType == 'administrative_area_level_1') {
                            const val = component[componentForm[addressType]];
                            document.getElementById('state').value = val;
                        }
                    }
                }
            }
        });

        $('.searchMapCityOnly').on('focus', function() {
            selected = false;
        }).on('blur', function() {
            if (!selected) {
                $(this).val('');
            }
        });
    }

    function checkMapLoaded() {
        if (typeof google === "undefined") {
            setTimeout(checkMapLoaded, 1000);
        } else {
            // do some work here
            google_map_initialize();
        }
    }
    checkMapLoaded();

    // google.maps.event.addDomListener(window, 'load', google_map_initialize);

    function setCurrentPolygon() {
        const currentPolygon = @json($currentPolygon);
        if(currentPolygon.path !== undefined){
                const existingPolygon = new google.maps.Polygon(currentPolygon);
                existingPolygon.setMap(map);
                const marker = new google.maps.Marker({
                    position:new google.maps.LatLng(currentPolygon.zone_center_latitude, currentPolygon.zone_center_longitude),
                    map,
                    label: {
                        text: currentPolygon.zone_name,
                        color: "#203334",
                        fontWeight: "bold",
                        fontSize: "16px",
                        className: "badge badge-warning"
                    },
                    optimized: false,
                });
                map.setCenter(new google.maps.LatLng(currentPolygon.zone_center_latitude, currentPolygon.zone_center_longitude));
                map.setZoom(13);
                // newPolygon.push(existingPolygon);
                $('#floating-panel').show();
                    $('#save_polygon').hide();
                    $('#clear_polygon').show();
                setAllZonePolygon(currentPolygon.id);
            }else{
                $('#floating-panel').hide();
                $('#save_polygon').hide();
                $('#clear_polygon').hide();
            drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [google.maps.drawing.OverlayType.POLYGON]
                },
                polygonOptions: {
                    editable: false
                }
            });
            drawingManager.setMap(map);
            google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
                var newShape = event.overlay;
                newShape.type = event.type;
            });

            google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
                newPolygon = [];
                newPolygonCenter = {};
                var polygon_center = event.overlay.getApproximateCenter();
            newPolygonCenter.lat = polygon_center.lat();
            newPolygonCenter.lng = polygon_center.lng();

            event.overlay.getPath().forEach(function(x){
                    newPolygon.push({'lat':x.lat(),'lng':x.lng()});
                });
                    $('#save_polygon').show();
                    $('#clear_polygon').show();
                $('#floating-panel').show();
                // newPolygon
                // $('#polygon').val(newPolygon);
            });
            setAllZonePolygon();
        }
    }

    function setAllZonePolygon(exceptId){
        if(allZonePolygon){
            Object.values(allZonePolygon).forEach(function(newPolygon) {
                if(exceptId !== undefined && exceptId != '' && exceptId == newPolygon.id){
                    
                }else{
                    new google.maps.Polygon(newPolygon).setMap(map);
                    new google.maps.Marker({
                        position:new google.maps.LatLng(newPolygon.zone_center_latitude, newPolygon.zone_center_longitude),
                        map,
                        label: {
                            text: newPolygon.zone_name,
                            color: "#ffffff",
                            fontWeight: "normal",
                            fontSize: "14px",
                            className: "badge badge-danger"
                        },
                        optimized: false,
                    });
                }
            });
        }
    }

  function save_polygon(){
            $('#floating-panel').hide();
            $('#save_polygon').hide();
            $('#clear_polygon').hide();
            
            //iterate polygon vertices?
            $.ajax({
                type: "POST",
                dataType: "json",
                headers : {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: "{{route('zone.map_polygon.store')}}",
                data: {"_token": "{{ csrf_token() }}",polygon_center:newPolygonCenter,map_polygon:newPolygon,zone_id: $('#zone_id').val()},
                success: function(data){
                    if(!$.isEmptyObject(data.dberror)){
                        location.href = ($('#back_url').length && $('#back_url').val() != '') ? $('#back_url').val() : window.location;
                    }else{
                        location.href = ($('#back_url').length && $('#back_url').val() != '') ? $('#back_url').val() : window.location;
                    }
                }
            });
    }

    function clear_polygon(){
        $('#floating-panel').hide();
        $('#save_polygon').hide();
        $('#clear_polygon').hide();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route('zone.map_polygon.clear')}}",
            data: {_token:'{{ csrf_token() }}',zone_id: $('#zone_id').val()},
            success: function(data){
                if(!$.isEmptyObject(data.dberror)){
                    location.reload(true);
                }else{
                    location.reload();
                }
            }
        });
    }

    function initMap() {
        var mapProp= {
            center:new google.maps.LatLng(51.508742,-0.120850),
            zoom:5,
        };
        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
</script>


</body>
</html>   