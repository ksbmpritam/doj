<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <title></title>
</head>
<body>
    <div class="container">
        <br>
        <center><h3>Create Rider</h3></center>
        <form method="POST" action="{{ route('rider.create.store') }}">
            @csrf
            <div class="form-group">
                <label>Rider Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label>Rider Mobile Number</label>
                <input type="text" name="mobile_number" class="form-control">
            </div>
            <div class="form-group">
                <label>Assign Address</label>
                <input type="text" id="searchMapInput" autocomplete="off" prevent-blank="1" class="form-control rm-r-br address_input" name="from_loc" placeholder="">
                <input type="hidden" name="from_latitude" id="from_latitude" placeholder="">
                <input type="hidden" name="from_longitude" id="from_longitude" placeholder="">
                <input type="hidden" name="from_city" id="from_city" placeholder="">
                <input type="hidden" name="from_state" id="from_state" placeholder="">
                <input type="hidden" name="from_state_short" id="from_state_short" placeholder="">
                <input type="hidden" name="from_pincode" id="from_pincode" placeholder="">
                <input type="hidden" name="from_loc_transporter" id="from_loc_transporter" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&libraries=places,drawing,geometry&callback=initMap" async defer></script>

    <script type="text/javascript">
        function initMap() {
            var options = {
                //types: ['(regions)'],
                //types: ['(cities)'],
                componentRestrictions: {country: "IN"}
            };
            var selected = false;
            var input = document.getElementById('searchMapInput');
            if (input) {
                var autocompleteTo = new google.maps.places.Autocomplete(input,options);
                //document.getElementById('searchMapInput1').value ='';
                google.maps.event.addListener(autocompleteTo, 'place_changed', function () {
                    var place = this.getPlace();
                    document.getElementById('from_latitude').value ='';
                    document.getElementById('from_longitude').value ='';
                    document.getElementById('from_city').value='';
                    document.getElementById('from_state').value ='';
                    document.getElementById('from_state_short').value ='';
                    document.getElementById('from_pincode').value ='';
                    document.getElementById('from_loc_transporter').value ='';

                    latTo = place.geometry.location.lat();
                    lngTo = place.geometry.location.lng();
                    document.getElementById('from_latitude').value = latTo;
                    document.getElementById('from_longitude').value = lngTo;
                    for (const component of place.address_components) {
                        const addressType = component.types[0];
                        if (componentForm[addressType]) {
                            if (addressType == 'locality') {
                                const val = component[componentForm[addressType]];
                                document.getElementById('from_city').value = val;
                            }

                            if (addressType == 'administrative_area_level_1') {
                                const val = component[componentForm[addressType]];
                                document.getElementById('from_state').value = val;
                            }

                            if (addressType == 'administrative_area_level_1') {
                                const val = component[componentForm['administrative_area_level_2']];
                                document.getElementById('from_state_short').value = val;
                            } 

                            if (addressType == 'postal_code') {
                                const val = component[componentForm[addressType]];
                                document.getElementById('from_pincode').value = val;
                            }
                        }
                    }
                    document.getElementById('from_loc_transporter').value =document.getElementById('from_city').value+', '+document.getElementById('from_state').value;
                });
            }
            $('#searchMapInput').on('focus', function() {
                selected = false;
                }).on('blur', function(e) {
                    if (!selected) {
                        if($(this).attr('prevent-blank') == '1'){
                            setTimeout(function(){
                                if(autocompleteTo.getPlace().address_components !== undefined){}else{$('#searchMapInput').val('');}
                            },400);
                    }else{
                        $(this).val('');
                    }
                }
            });
            var options = {
                //types: ['(regions)'],
                //types: ['(cities)'],
                componentRestrictions: {country: "IN"}
            };
        }
    </script>

</body>
</html>