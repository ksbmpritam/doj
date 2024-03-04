<?php 
header('Access-Control-Allow-Origin: *');
?>
@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.app_setting_global')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.app_setting_global')}}</li>
                </ol>
            </div>
        </div>

        <div class="card-body">
            <div id="data-table_processing" class="dataTables_processing panel panel-default"
                 style="display: none;">{{trans('lang.processing')}}</div>
            <div class="error_top" style="display:none"></div>     
            <div class="row restaurant_payout_create">
                <div class="restaurant_payout_create-inner">
                    <fieldset>
                        <legend><i class="mr-3 mdi mdi-settings"></i>{{trans('lang.app_setting_global')}}</legend>

                        <div class="form-group row width-100">
                            <label class="col-5 control-label">{{trans('lang.app_setting_app_name')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control application_name">
                                <div class="form-text text-muted">
                                    {{ trans("lang.app_setting_app_name_help") }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row width-100">
                            <label class="col-5 control-label">{{trans('lang.app_setting_meta_title')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control meta_title">
                                <div class="form-text text-muted">
                                    {{ trans("lang.app_setting_meta_title_help") }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.upload_app_logo')}}</label>
                            <input type="file" class="col-7" onChange="handleFileSelect(event)">
                            <div id="uploding_image"></div>
                            <div class="logo_img_thumb"></div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.menu_placeholder_image')}}</label>
                            <input type="file" class="col-7" onChange="handleFileSelectplaceholder(event)">
                            <div id="uploading_placeholder"></div>
                            <div class="placeholder_img_thumb">
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.upload_favicon')}}</label>
                            <input type="file" class="col-7" onChange="handleFileSelectFavicon(event)">
                            <div id="uploding_favicon"></div>
                            <div class="favicon_img_thumb"></div>
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.website_color_settings')}}</label>
                            <input type="color" class="ml-3" name="website_color" id="website_color">
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.admin_panel_color_settings')}}</label>
                            <input type="color" class="ml-3" name="admin_color" id="admin_color">
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.store_panel_color_settings')}}</label>
                            <input type="color" class="ml-3" name="store_color" id="store_color">
                        </div>

                    </fieldset>
                    <fieldset>
                        <legend>{{trans('lang.google_map_api_key_title')}}</legend>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.google_map_api_key')}}</label>
                            <div class="col-7">
                                <input type="password" class="form-control address_line1" name="map_key"
                                        id="map_key">
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend><i class="mr-3 fa fa-solid fa-address-book"></i>{{trans('lang.contact_us')}}</legend>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.contact_us_address')}}</label>
                            <div class="col-7">
                                <textarea class="form-control contact_us_address" rows="3"></textarea>
                                <div class="form-text text-muted">
                                    {{ trans("lang.contact_us_address_help") }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.contact_us_email')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control contact_us_email">
                                <div class="form-text text-muted">
                                    {{ trans("lang.contact_us_email_help") }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.contact_us_phone')}}</label>
                            <div class="col-7">
                                <input type="number" class="form-control contact_us_phone">
                                <div class="form-text text-muted">
                                    {{ trans("lang.contact_us_phone_help") }}
                                </div>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset>
                        <legend><i class="mr-3 mdi mdi-cash-100"></i>{{trans('lang.wallet_settings')}}</legend>
                        <div class="form-group row width-100">
                            <label class="col-4 control-label">{{ trans('lang.minimum_deposit_amount')}}</label>
                            <div class="col-7">
                                <div class="control-inner">
                                    <input type="number" class="form-control minimum_deposit_amount">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row width-100">
                            <label class="col-4 control-label">{{ trans('lang.minimum_withdrawal_amount')}}</label>
                            <div class="col-7">
                                <div class="control-inner">
                                    <input type="number" class="form-control minimum_withdrawal_amount">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    
                    <fieldset>
                        <legend><i class="mr-3 mdi mdi-share"></i>{{trans('lang.referral_settings')}}</legend>
                        <div class="form-group row width-100">
                            <label class="col-4 control-label">{{ trans('lang.referral_amount')}}</label>
                            <div class="col-7">
                                <div class="control-inner">
                                    <input type="number" class="form-control referral_amount">
                                    <span class="currentCurrency"></span>
                                    <div class="form-text text-muted">
                                        {{ trans("lang.referral_amount_help") }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend><i class="mr-3 mdi mdi-shopping"></i>{{trans('lang.restaurant_settings')}}</legend>
                        <div class="form-group row width-100">
                            <div class="form-check width-100">
                            	<input type="checkbox" class="form-check-inline" id="restaurant_can_upload_story">
                                <label class="col-5 control-label" for="restaurant_can_upload_story">{{ trans('lang.restaurant_can_upload_story')}}</label>
                                <input type="checkbox" class="form-check-inline" id="auto_approve_restaurant">
                                <label class="col-5 control-label" for="auto_approve_restaurant">{{ trans('lang.auto_approve_restaurant')}}</label>
                            </div>
                        </div>
                        <div class="form-group row width-50" id="story_upload_time_div" style="display:none;">
                            <label class="col-5 control-label">{{trans('lang.story_upload_time')}}</label>
                            <div class="col-7">
                                <input type="number" class="form-control" id="story_upload_time" value="30" min="0">
                                <div class="form-text text-muted">
                                    {{ trans("lang.story_upload_time_help") }}
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><i class="mr-3 fa fa-solid fa fa-android"></i>{{trans('lang.version')}}</legend>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.app_version')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control app_version">

                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.web_version')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="web_version">

                            </div>
                        </div>

                    </fieldset>
                </div>
            </div>
        </div>

        <div class="form-group col-12 text-center btm-btn">
            <button type="button" class="btn btn-primary save_global_settings_btn"><i
                        class="fa fa-save"></i> {{trans('lang.save')}}</button>
            <a href="{{url('/dashboard')}}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}
            </a>
        </div>
    </div>

@endsection

@section('scripts')
    
    <script>

        var database = firebase.firestore();
        var ref = database.collection('settings').doc("globalSettings");
        var mapKey = database.collection('settings').doc("googleMapKey");
        var refPlaceholderImage = database.collection('settings').doc("placeHolderImage");
        var contactUs = database.collection('settings').doc("ContactUs");
        var version = database.collection('settings').doc("Version");
        var restaurant = database.collection('settings').doc("restaurant");
        var story = database.collection('settings').doc("story");
        var DriverNearByRef  = database.collection('settings').doc("DriverNearBy");
        var referralAmountRef  = database.collection('settings').doc("referral_amount");

        var photo = "";
        var placeholderphoto = '';
        
        var refCurrency = database.collection('currencies').where('isActive', '==' , true);
        refCurrency.get().then(async function (snapshots) {
            var currencyData = snapshots.docs[0].data();
            $(".currentCurrency").text(currencyData.symbol);
        });

        $(document).ready(function () {

            jQuery("#data-table_processing").show();
            
            ref.get().then(async function (snapshots) {

                var globalSettings = snapshots.data();
                
                if (globalSettings == undefined) {
                    database.collection('settings').doc('globalSettings').set({});
                }
                
                try {
                    $(".application_name").val(globalSettings.applicationName);
                    $(".meta_title").val(globalSettings.meta_title)
                    $("#website_color").val(globalSettings.website_color);
                    $("#admin_color").val(globalSettings.admin_panel_color);
                    $("#store_color").val(globalSettings.store_panel_color);
                   
                    photo = globalSettings.appLogo;
                    $(".logo_img_thumb").append('<img class="rounded" style="width:50px" src="' + photo + '" alt="image">');

                    favicon = globalSettings.favicon;
                    $(".favicon_img_thumb").append('<img class="rounded" style="width:50px" src="' + favicon + '" alt="image">');
                } catch (error) {

                }

                jQuery("#data-table_processing").hide();
            })

            refPlaceholderImage.get().then(async function (snapshots) {
                var placeholderImage = snapshots.data();
                jQuery("#data-table_processing").hide();
                placeholderphoto = placeholderImage.image;
                $(".placeholder_img_thumb").append('<img class="rounded" style="width:50px" src="' + placeholderphoto + '" alt="image">');
            })

            restaurant.get().then( async function(snapshots){
          		var restaurantdata = snapshots.data();
          		if(restaurantdata == undefined){
              		database.collection('settings').doc('restaurant').set({});
          		}	
				try{
		           	if(restaurantdata.auto_approve_restaurant){
						$("#auto_approve_restaurant").prop('checked',true);
		           	}
		         }catch (error){
		
		         }
          		jQuery("#data-table_processing").hide();
        	})
        	
        	story.get().then(async function (snapshots) {
                var story_data = snapshots.data();

                if (story_data == undefined) {
                    database.collection('settings').doc('story').set({});
                }
                try {
                	if(story_data.isEnabled){
		             	$("#restaurant_can_upload_story").prop('checked',true);
		             	$("#story_upload_time_div").show();
		           	}
                    $("#story_upload_time").val(story_data.videoDuration);
                } catch (error) {

                }
            });

            version.get().then(async function (snapshots) {
                var version_data = snapshots.data();

                if (version_data == undefined) {
                    database.collection('settings').doc('Version').set({});
                }
                try {
                    $('.app_version').val(version_data.app_version);
                    $('#web_version').val(version_data.web_version);

                } catch (error) {

                }

            });

            contactUs.get().then(async function (snapshots) {
                var contactUsData = snapshots.data();

                if (contactUsData == undefined) {
                    database.collection('settings').doc('ContactUs').set({});
                }

                try {
                    $('.contact_us_address').val(contactUsData.Address);
                    $('.contact_us_email').val(contactUsData.Email);
                    $('.contact_us_phone').val(contactUsData.Phone);

                } catch (error) {

                }
            })

            mapKey.get().then(async function (snapshots) {
                var key = snapshots.data();

                if (key == undefined) {
                    database.collection('settings').doc('googleMapKey').set({});
                }
                try {
                    $('#map_key').val(key.key);

                } catch (error) {

                }

            });

            DriverNearByRef.get().then(async function (snapshots) {
        
                var DriverNearData = snapshots.data();

                if (DriverNearData == undefined) {
                    database.collection('settings').doc('DriverNearBy').set({});
                }

                try {
                    $(".minimum_deposit_amount").val(DriverNearData.minimumDepositToRideAccept);
                    $(".minimum_withdrawal_amount").val(DriverNearData.minimumAmountToWithdrawal);

                } catch (error) {

                }
            
            })

            referralAmountRef.get().then(async function (snapshots) {

                var referralAmountData = snapshots.data();

                if (referralAmountData == undefined) {
                    database.collection('settings').doc('referral_amount').set({});
                }

                try {
                    $(".referral_amount").val(referralAmountData.referralAmount);
                    
                } catch (error) {

                }
                
                jQuery("#data-table_processing").hide();
            })


            $(".save_global_settings_btn").click(function () {

                var website_color = $("#website_color").val();
                var admin_color = $("#admin_color").val();
                var googleApiKey = $("#map_key").val();
                var store_color = $("#store_color").val();
                var contact_us_address = $('.contact_us_address').val();
                var contact_us_email = $('.contact_us_email').val();
                var contact_us_phone = $('.contact_us_phone').val();
                var app_version = $('.app_version').val();
                var web_version = $('#web_version').val();
                var auto_approve_restaurant = $("#auto_approve_restaurant").is(":checked");
                var restaurant_can_upload_story = $("#restaurant_can_upload_story").is(":checked");
                var story_upload_time = parseInt($('#story_upload_time').val());
                var minimumDepositToRideAccept = $(".minimum_deposit_amount").val();
                var minimumAmountToWithdrawal = $(".minimum_withdrawal_amount").val();
                var referralAmount = $(".referral_amount").val();
                
                if (admin_color != null) {
                    setCookie('admin_panel_color', admin_color, 365);
                }

                var applicationName = $(".application_name").val();
                var meta_title = $(".meta_title").val();
                
                if (applicationName == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_app_name_error')}}</p>");
                    window.scrollTo(0, 0);
                }else if (minimumDepositToRideAccept == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_minimum_deposit_amount_error')}}</p>");
                    window.scrollTo(0, 0);
                }else if (minimumAmountToWithdrawal == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_minimum_withdrawal_amount_error')}}</p>");
                    window.scrollTo(0, 0);
                }else if (referralAmount == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_referral_amount_error')}}</p>");
                    window.scrollTo(0, 0);
                    window.scrollTo(0, 0);
                } else {

                    jQuery("#data-table_processing").show();

                    database.collection('settings').doc("globalSettings").update({
                        'website_color': website_color,
                        'admin_panel_color': admin_color,
                        'store_panel_color': store_color,
                        'applicationName': applicationName,
                        'meta_title':meta_title,
                        'appLogo': photo,
                        'favicon': favicon,
                    });

                    database.collection('settings').doc('placeHolderImage').update({
                        'image': placeholderphoto
                    });
                    
                    database.collection('settings').doc("ContactUs").update({
                        'Address': contact_us_address,
                        'Email': contact_us_email,
                        'Phone': contact_us_phone
                    });

                    database.collection('settings').doc("Version").update({
                        'app_version': app_version,
                        'web_version': web_version,
                    });
                    
                    database.collection('settings').doc("restaurant").update({
                        'auto_approve_restaurant':auto_approve_restaurant,
                    });
                    
                    database.collection('settings').doc("story").update({
                        'isEnabled':restaurant_can_upload_story,
                        'videoDuration':story_upload_time,
                    });

                    database.collection('settings').doc("googleMapKey").update({
                        'key': googleApiKey,
                    });
                    
                    database.collection('settings').doc("DriverNearBy").update({
                        'minimumDepositToRideAccept': minimumDepositToRideAccept,
                        'minimumAmountToWithdrawal': minimumAmountToWithdrawal
                    });

                    database.collection('settings').doc("referral_amount").update({
                        'referralAmount': referralAmount
                    }).then(function(result) {
                        window.location.href = '{{ url("settings/app/globals")}}';
                    })
                    
                }

            })
        })
		
		 $("#restaurant_can_upload_story").click(function () {
		 	if($(this).is(':checked')){
		 		$("#story_upload_time_div").show();	
		 	}else{
		 		$("#story_upload_time_div").hide();
		 	}
		 });	

        var storageRef = firebase.storage().ref('images');

        function handleFileSelect(evt) {

            var f = evt.target.files[0];
            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {

                    var filePayload = e.target.result;
                    var val = f.name;
                    var ext = val.split('.')[1];
                    var docName = val.split('fakepath')[1];
                    var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                    var timestamp = Number(new Date());
                    var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                    var uploadTask = storageRef.child(filename).put(theFile);
                    uploadTask.on('state_changed', function (snapshot) {
                        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                        jQuery("#uploding_image").text("Image is uploading...");

                    }, function (error) {

                    }, function () {
                        uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                            jQuery("#uploding_image").text("Upload is completed");
                            photo = downloadURL;

                        });
                    });

                };
            })(f);
            reader.readAsDataURL(f);
        }


        function handleFileSelectplaceholder(evt) {

            var f = evt.target.files[0];
            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {

                    var filePayload = e.target.result;
                    var val = f.name;
                    var ext = val.split('.')[1];
                    var docName = val.split('fakepath')[1];
                    var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                    var timestamp = Number(new Date());
                    var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                    var uploadTask = storageRef.child(filename).put(theFile);
                    console.log(uploadTask);
                    uploadTask.on('state_changed', function (snapshot) {
                        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                        console.log('Upload is ' + progress + '% done');
                        jQuery("#uploading_placeholder").text("Image is uploading...");

                    }, function (error) {

                    }, function () {
                        uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                            jQuery("#uploading_placeholder").text("Upload is completed");
                            placeholderphoto = downloadURL;

                        });
                    });

                };
            })(f);
            reader.readAsDataURL(f);
        }

        function handleFileSelectFavicon(evt) {

        var f = evt.target.files[0];
        var reader = new FileReader();

        reader.onload = (function (theFile) {
            return function (e) {

                var filePayload = e.target.result;
                var val = f.name;
                var ext = val.split('.')[1];
                var docName = val.split('fakepath')[1];
                var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                var timestamp = Number(new Date());
                var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                var uploadTask = storageRef.child(filename).put(theFile);
                console.log(uploadTask);
                uploadTask.on('state_changed', function (snapshot) {
                    var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                    console.log('Upload is ' + progress + '% done');
                    jQuery("#uploding_favicon").text("Image is uploading...");

                }, function (error) {

                }, function () {
                    uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                        jQuery("#uploding_favicon").text("Upload is completed");
                        favicon = downloadURL;

                    });
                });

            };
        })(f);
        reader.readAsDataURL(f);
        }

    </script>

@endsection
