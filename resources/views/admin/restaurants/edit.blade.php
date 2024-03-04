@extends('admin.layouts.app')

@section('content')
    <div class="page-wrapper">
        <form action="{{ url ('admin/restaurants/update/'.$restaurant->id)}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.restaurant_plural')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{!! route('admin.restaurants') !!}">{{trans('lang.restaurant_plural')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.restaurant_edit')}}</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="resttab-sec">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}</div>
                        <div class="error_top"></div>
                        <div class="row restaurant_payout_create">
                            <div class="restaurant_payout_create-inner">

                                <fieldset>
                                    <legend>{{trans('lang.admin_area')}}</legend>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.first_name')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control user_first_name" value="{{$restaurant_admin->first_name}}" name="first_name" >
                                            <!--<div class="form-text text-muted">-->
                                            <!--    {{ trans("lang.user_first_name_help") }}-->
                                            <!--</div>-->
                                            @if (!$errors->has('first_name'))
                                                <div class="form-text text-muted">
                                                    {{ trans('lang.user_first_name_help') }}
                                                </div>
                                            @endif
                                            @if ($errors->has('first_name'))
                                                <span class="text-danger text-muted">
                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.last_name')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control user_last_name" value="{{$restaurant_admin->last_name}}" name="last_name" >
                                            <!--<div class="form-text text-muted">-->
                                            <!--    {{ trans("lang.user_last_name_help") }}-->
                                            <!--</div>-->
                                            @if (!$errors->has('last_name'))
                                                <div class="form-text text-muted">
                                                    {{ trans('lang.user_last_name_help') }}
                                                </div>
                                            @endif
                                            @if ($errors->has('last_name'))
                                                <span class="text-danger text-muted">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.email')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="email" class="form-control user_email" value="{{$restaurant_admin->email}}" name="email" >
                                            <!--<div class="form-text text-muted">-->
                                            <!--    {{ trans("lang.user_email_help") }}-->
                                            <!--</div>-->
                                            @if (!$errors->has('email'))
                                                <div class="form-text text-muted">
                                                    {{ trans('lang.user_email_help') }}
                                                </div>
                                            @endif
                                            @if ($errors->has('email'))
                                                <span class="text-danger text-muted">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.password')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control user_password" value="{{$restaurant_admin->password}}" name="password" >
                                            <!--<div class="form-text text-muted">-->
                                            <!--    {{ trans("lang.user_password_help") }}-->
                                            <!--</div>-->
                                            @if (!$errors->has('password'))
                                                <div class="form-text text-muted">
                                                    {{ trans('lang.user_password_help') }}
                                                </div>
                                            @endif
                                            @if ($errors->has('password'))
                                                <span class="text-danger text-muted">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.user_phone')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control user_phone" value="{{$restaurant_admin->phone}}" name="phone" id="phone" onkeypress="return numeralsOnly(event)" maxlength="10">
                                            <!--<div class="form-text text-muted w-50">-->
                                            <!--    {{ trans("lang.user_phone_help") }}-->
                                            <!--</div>-->
                                            @if (!$errors->has('phone'))
                                                <div class="form-text text-muted">
                                                    {{ trans('lang.user_phone_help') }}
                                                </div>
                                            @endif
                                            @if ($errors->has('phone'))
                                                <span class="text-danger text-muted">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_image')}}</label>
                                        <input type="file" name="profile_image" class="col-7">
                                        <div id="uploding_image_owner"></div>

                                        <div class="uploaded_image_owner" >
                                            <img id="uploaded_image_owner" src="{{ asset('images/restaurants/profile/'.$restaurant_admin->image)}}" width="150px" height="150px;" style="border-radius:3px;">
                                        </div>
                                    </div>

                                </fieldset>
                                    
                                <fieldset>
                                    <legend>{{trans('lang.restaurant_details')}}</legend>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_name')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control restaurant_name" value="{{ $restaurant->name }}" name="restaurant_name" >
                                            <!--<div class="form-text text-muted">-->
                                            <!--    {{ trans("lang.restaurant_name_help") }}-->
                                            <!--</div>-->
                                            @if (!$errors->has('restaurant_name'))
                                                <div class="form-text text-muted">
                                                    {{ trans('lang.restaurant_name_help') }}
                                                </div>
                                            @endif
                                            @if ($errors->has('restaurant_name'))
                                                <span class="text-danger text-muted">
                                                    <strong>{{ $errors->first('restaurant_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Category   <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <select name="category_id" class="form-control"  >
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == $restaurant->category_id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <!--<div class="form-text text-muted">-->
                                            <!--    {{ trans("lang.restaurant_cuisines_help") }}-->
                                            <!--</div>-->
                                            @if (!$errors->has('category_id'))
                                                <div class="form-text text-muted">
                                                    {{ trans('Select Category') }}
                                                </div>
                                            @endif
                                            @if ($errors->has('category_id'))
                                                <span class="text-danger text-muted">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_phone')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control restaurant_phone" name="restaurant_phone" value="{{$restaurant->phone}}" id="restaurant_phone" onkeypress="return numeralsOnly(event)" maxlength="10">
                                            <!--<div class="form-text text-muted">-->
                                            <!--    {{ trans("lang.restaurant_phone_help") }}-->
                                            <!--</div>-->
                                            @if (!$errors->has('restaurant_phone'))
                                                <div class="form-text text-muted">
                                                    {{ trans('lang.restaurant_phone_help') }}
                                                </div>
                                            @endif
                                            @if ($errors->has('restaurant_phone'))
                                                <span class="text-danger text-muted">
                                                    <strong>{{ $errors->first('restaurant_phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_address')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control restaurant_address" name="address" value="{{$restaurant->address}}" >
                                            <!--<div class="form-text text-muted">-->
                                            <!--    {{ trans("lang.restaurant_address_help") }}-->
                                            <!--</div>-->
                                            @if (!$errors->has('address'))
                                                <div class="form-text text-muted">
                                                    {{ trans('lang.restaurant_address_help') }}
                                                </div>
                                            @endif
                                            @if ($errors->has('address'))
                                                <span class="text-danger text-muted">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <div class="col-12">
                                            <h6>* Don't Know your cordinates ? use <a target="_blank"
                                                                                      href="https://www.latlong.net/">Latitude
                                                    and Longitude Finder</a></h6>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_latitude')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control restaurant_latitude" name="latitude" value="{{$restaurant->latitude}}">
                                            <!--<div class="form-text text-muted">-->
                                            <!--    {{ trans("lang.restaurant_latitude_help") }}-->
                                            <!--</div>-->
                                            @if (!$errors->has('latitude'))
                                                <div class="form-text text-muted">
                                                    {{ trans('lang.restaurant_latitude_help') }}
                                                </div>
                                            @endif
                                            @if ($errors->has('latitude'))
                                                <span class="text-danger text-muted">
                                                    <strong>{{ $errors->first('latitude') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_longitude')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control restaurant_longitude" name="longitude" value="{{$restaurant->longitude}}">
                                            <!--<div class="form-text text-muted">-->
                                            <!--    {{ trans("lang.restaurant_longitude_help") }}-->
                                            <!--</div>-->
                                            @if (!$errors->has('longitude'))
                                                <div class="form-text text-muted">
                                                    {{ trans('lang.restaurant_longitude_help') }} 
                                                </div>
                                            @endif
                                            @if ($errors->has('longitude'))
                                                <span class="text-danger text-muted">
                                                    <strong>{{ $errors->first('longitude') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label ">{{trans('lang.restaurant_description')}}</label>
                                        <div class="col-7">
                                            <textarea rows="7" class="restaurant_description form-control"
                                                      id="restaurant_description" name="description">{{$restaurant->description}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_image')}}</label>
                                        <div class="col-7">
                                            <input type="file" onChange="handleFileSelect(event,'photo')" name="restaurant_image">
                                            <div id="uploding_image"></div>
                                            <div class="uploaded_image" >
                                                <img id="uploaded_image" src="{{ asset('images/restaurants/'.$restaurant->image)}}" width="150px" height="150px;">
                                            </div>
                                            <div class="form-text text-muted">
                                                {{ trans("lang.restaurant_image_help") }}
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>

                                 <fieldset>
                                    <legend>{{ trans('lang.gallery') }}</legend>
                            
                                    <div class="form-group row width-100 restaurant_image">
                                        <div class="uploaded_image">
                                            @foreach($galleryImages as $imagePath)
                                                <img src="{{ asset('images/restaurants/gallery/'.$imagePath->image_path) }}" alt="Gallery Image" width="150px" height="150px;" style="border-radius:5px; margin:5px">
                                            @endforeach
                                        </div>
                                    </div>
                            
                                    <div class="form-group row">
                                        <div>
                                            <input type="file" id="galleryImage" name="gallery_images[]" multiple>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.services')}}</legend>
    
                                    <div class="form-group row">
                                        <?php
                                            $ser=json_decode($restaurant->services);
                                            $hasFreeWiFi='';
                                            if(!empty($ser)){
                                                $hasFreeWiFi = in_array("Free Wi Fi", $ser);
                                            }
                                        ?>
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Free_Wi_Fi" name="services[]" value="Free Wi Fi" <?php echo $hasFreeWiFi ? 'checked' : ''; ?>>
                                            <label class="col-3 control-label" for="Free_Wi_Fi">{{trans('lang.free_wi_fi')}}</label>
                                        </div>
                                        <?php
                                        $hasGoodForBreak='';
                                        if(!empty($ser)){
                                            $hasGoodForBreak = in_array("Good for Breakfast", $ser);
                                        }
                                        ?>
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Good_for_Breakfast" name="services[]" value="Good for Breakfast" <?php echo $hasGoodForBreak ? 'checked' : ''; ?>>
                                            <label class="col-3 control-label" for="Good_for_Breakfast">{{trans('lang.good_for_breakfast')}}</label>
                                        </div>
                                        <?php
                                        $hasGoodForDinner='';
                                        if(!empty($ser)){
                                            $hasGoodForDinner = in_array("Good for Dinner", $ser);
                                        }
                                        ?>
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Good_for_Dinner" name="services[]" value="Good for Dinner" <?php echo $hasGoodForDinner ? 'checked' : ''; ?>>
                                            <label class="col-3 control-label" for="Good_for_Dinner">{{trans('lang.good_for_dinner')}}</label>
                                        </div>
                                        <?php
                                        $hasGoodForLunch='';
                                        if(!empty($ser)){
                                            $hasGoodForLunch = in_array("Good for Lunch", $ser);
                                        }
                                        ?>
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Good_for_Lunch" name="services[]" value="Good for Lunch" <?php echo $hasGoodForLunch ? 'checked' : ''; ?>>
                                            <label class="col-3 control-label" for="Good_for_Lunch">{{trans('lang.good_for_lunch')}}</label>
                                        </div>
                                        <?php
                                        $hasLiveMusic='';
                                        if(!empty($ser)){
                                            $hasLiveMusic = in_array("Live Music", $ser);
                                        }
                                        ?>
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Live_Music" name="services[]" value="Live Music" <?php echo $hasLiveMusic ? 'checked' : ''; ?>>
                                            <label class="col-3 control-label" for="Live_Music">{{trans('lang.live_music')}}</label>
                                        </div>
                                        <?php
                                        $hasOutDoor='';
                                        if(!empty($ser)){
                                            $hasOutDoor = in_array("Outdoor Seating", $ser);
                                        }
                                        ?>
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Outdoor_Seating" name="services[]" value="Outdoor Seating" <?php echo $hasOutDoor ? 'checked' : ''; ?>>
                                            <label class="col-3 control-label" for="Outdoor_Seating">{{trans('lang.outdoor_seating')}}</label>
                                        </div>
                                        <?php
                                        $hasTakesReservations='';
                                        if(!empty($ser)){
                                            $hasTakesReservations = in_array("Takes Reservations", $ser);
                                        }
                                        ?>
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Takes_Reservations" name="services[]" value="Takes Reservations" <?php echo $hasTakesReservations ? 'checked' : ''; ?>>
                                            <label class="col-3 control-label" for="Takes_Reservations">{{trans('lang.takes_reservations')}}</label>
                                        </div>
                                        <?php
                                        $hasVegetrain='';
                                        if(!empty($ser)){
                                            $hasVegetrain = in_array("Vegetarian Friendly", $ser);
                                        }
                                        ?>
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Vegetarian_Friendly" name="services[]" vlaue="Vegetarian Friendly" <?php echo $hasVegetrain ? 'checked' : ''; ?>>
                                            <label class="col-3 control-label" for="Vegetarian_Friendly">{{trans('lang.vegetarian_friendly')}}</label>
                                        </div>
    
                                    </div>
                                </fieldset>
                                
                               <fieldset>
                                    <legend>Working Hours</legend>
                                    <div class="working-hours-container">
                                        <!-- JavaScript will add input fields for each day here -->
                                        @foreach($days as $day)
                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{ $day }}</label> 
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary add-working-hours" data-days="{{ $day }}">
                                                        Add
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="working-hours-options {{ strtolower($day) }}-optionss">
                                                <!-- Existing working hours data for this day -->
                                                @foreach($workingHours[$day] as $timeSlot)
                                                    <div class="mb-2 row">
                                                        <div class="col-5">
                                                            <label>Start Time</label>
                                                            <input type="time" class="form-control" name="{{ strtolower($day) }}_start[]" value="{{ $timeSlot['start_time'] }}">
                                                        </div>
                                                        <div class="col-5">
                                                            <label>End Time</label>
                                                            <input type="time" class="form-control" name="{{ strtolower($day) }}_end[]" value="{{ $timeSlot['end_time'] }}">
                                                        </div>
                                                        <div class="col-2">
                                                            <label style="display:block;width:100%;color:#fff">.</label>
                                                            <button type="button" class="btn btn-danger remove-working-hours">X</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                          
                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('restaurant')}} {{trans('lang.active_deactive')}}</legend>
                                    <div class="form-group row">

                                        <div class="form-group row width-50">
                                            <div class="form-check width-100">
                                                <input type="checkbox" id="is_active" value="1" name="restaurant_status" @if($restaurant->restaurant_status == 1) checked @endif>
                                                <label class="col-3 control-label" for="is_active">{{trans('lang.active')}}</label>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.dine_in_future_setting')}}</legend>
    
                                    <div class="form-group row">
    
                                        <div class="form-group row width-100">
                                            <div class="form-check width-100">
                                                <input type="checkbox" name="enable_dine" value="1" id="dine_in_feature" {{ $restaurant->enable_dine == 1 ? 'checked' : '' }}>
                                                <label class="col-3 control-label" for="dine_in_feature">{{trans('lang.enable_dine_in_feature')}}</label>
                                            </div>
                                        </div>
                                        <div class="divein_div" style="display: {{ $restaurant->enable_dine == 1 ? 'block' : 'none' }}">
    
    
                                            <div class="form-group row width-50">
                                                <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                <div class="col-7">
                                                    <input type="time" name="dine_open_time" class="form-control" id="openDineTime" value="{{$restaurant->dine_open_time}}">
                                                </div>
                                            </div>
    
                                            <div class="form-group row width-50">
                                                <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                <div class="col-7">
                                                    <input type="time" name="dine_close_time" class="form-control" id="closeDineTime" value="{{$restaurant->dine_close_time}}">
                                                </div>
                                            </div>
    
                                            <div class="form-group row width-50">
                                                <label class="col-3 control-label">Cost</label>
                                                <div class="col-7">
                                                    <input type="number" name="dine_cost_price" class="form-control restaurant_cost" value="{{$restaurant->dine_cost_price}}">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row width-100 restaurant_image">
                                                <label class="col-3 control-label">Menu Card Images</label>
                                                <div class="uploaded_image">
                                                    @foreach($dineImages as $dineImagePath)
                                                        <img src="{{ asset('images/restaurants/dine/'.$dineImagePath->dine_images) }}" alt="Dine Image" width="150px" height="150px;" style="border-radius:5px; margin:5px">
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div>
                                                    <input type="file" name="dine_images[]" multiple>
                                                </div>
                                            </div>
                                        </div>
    
                                    </div>
                                </fieldset>


                                <fieldset>
                                    <legend>{{trans('lang.deliveryCharge')}}</legend>

                                    <div class="form-group row">

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{ trans('lang.delivery_charges_per_km')}}</label>
                                            <div class="col-7">
                                                <input type="number" class="form-control" id="delivery_charges_per_km" value="{{$restaurant->charges_per_km}}" name="charges_per_km" >
                                            </div>
                                        </div>
                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{ trans('lang.minimum_delivery_charges')}}</label>
                                            <div class="col-7">
                                                <input type="number" class="form-control" id="minimum_delivery_charges" value="{{$restaurant->charges_km_min}}" name="charges_km_min" >
                                            </div>
                                        </div>
                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{ trans('lang.minimum_delivery_charges_within_km')}}</label>
                                            <div class="col-7">
                                                <input type="number" class="form-control" id="minimum_delivery_charges_within_km" value="{{$restaurant->charges_km_min}}" name="charge_within_km" >
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.bankdetails')}}</legend>

                                    <div class="form-group row">

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{trans('lang.bank_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="bank_name" class="form-control" id="bankName" value="{{$restaurant->bank_name}}">
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{trans('lang.branch_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="branch_name" class="form-control"
                                                       id="branchName" value="{{$restaurant->branch_name}}">
                                            </div>
                                        </div>


                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{trans('lang.holer_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="holder_name" class="form-control"
                                                       id="holderName" value="{{$restaurant->holder_name}}">
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{trans('lang.account_number')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="account_number" class="form-control"
                                                       id="accountNumber" value="{{$restaurant->account_number}}">
                                            </div>
                                        </div>
                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">IFSC Code</label>
                                            <div class="col-7">
                                                <input type="text" name="ifsc_code" class="form-control"
                                                       id="accountNumber" value="{{$restaurant->ifsc_code}}">
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{trans('lang.other_information')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="other_information" class="form-control"
                                                       id="otherDetails" value="{{$restaurant->other_information}}">
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                              
                                <fieldset>
                                    <legend>Special Offers</legend>
                                    <div class="special-offer-container">
                                        <!-- JavaScript will add input fields for each day here -->
                                        @foreach($days as $day)
                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{ $day }}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary add-special-offer" data-day="{{ $day }}">
                                                        Add
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="special-offer-options {{ strtolower($day) }}-options">
                                                <!-- Existing special offers data for this day -->
                                                @foreach($specialOffers[$day] as $offer)
                                                    <div class="mb-2 row">
                                                        <div class="col-3">
                                                            <label>Opening Time</label>
                                                            <input type="time" class="form-control" name="{{ strtolower($day) }}_start_offer[]" value="{{ $offer['opening_time'] }}">
                                                        </div>
                                                        <div class="col-3">
                                                            <label>Closing Time</label>
                                                            <input type="time" class="form-control" name="{{ strtolower($day) }}_end_offer[]" value="{{ $offer['closing_time'] }}">
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <label>Discount</label>
                                                                    <input type="text" class="form-control" name="{{ strtolower($day) }}_discount[]" value="{{ $offer['discount'] }}">
                                                                </div>
                                                                <div class="col-6">
                                                                    <label>%/₹</label>
                                                                    <select id="discount_type{{ ucfirst(strtolower($day)) }}" name="{{ strtolower($day) }}_discount_type[]" class="form-control">
                                                                        <option value="percentage" @if($offer['discount_sign'] === 'percentage') selected @endif>%</option>
                                                                        <option value="amount" @if($offer['discount_sign'] === 'amount') selected @endif>₹</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <label>Type</label>
                                                            <select id="type{{ ucfirst(strtolower($day)) }}" name="{{ strtolower($day) }}_delivery_type[]" class="form-control">
                                                                <option value="delivery" @if($offer['discount_type'] === 'delivery') selected @endif>Delivery Discount</option>
                                                                <option value="dinein" @if($offer['discount_type'] === 'dinein') selected @endif>Dine-In Discount</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                </fieldset>
                                <fieldset id="story_upload_div" style="display: none;">
                                    <legend>Story</legend>

                                    <div class="form-group row vendor_image">
                                        <label class="col-12 control-label">Choose humbling GIF/Image</label>
                                        <div class="col-12">
                                            <div id="story_thumbnail" class="row"></div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-12">
                                            <input type="file" id="file" onChange="handleStoryThumbnailFileSelect(event)">
                                            <div id="uploding_story_thumbnail"></div>
                                        </div>
                                    </div>

                                    <div class="restaurant_uploadStory_div">
                                    <div class="form-group row vendor_image">
                                        <label class="col-12 control-label">Select Story Video</label>
                                        <div class="col-12">
                                            <div id="story_vedios" class="row"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12">
                                            <input type="file" id="video_file" onChange="handleStoryFileSelect(event)">
                                            <div id="uploding_story_video"></div>
                                        </div>
                                    </div>
                                    </div>
                                </fieldset>
                                
                                <fieldset>
                                    <div class="form-group col-12 text-center btm-btn">
                                        <button type="submit" class="btn btn-primary  save_restaurant_btn"><i
                                                    class="fa fa-save"></i> {{trans('lang.save')}}</button>
                                        <a href="{!! route('admin.restaurants') !!}" class="btn btn-default"><i
                                                    class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                                    </div>
                                </fieldset>
                            </div>
                           
                        </div>
                    </div>

                </div>
               

            </div>
        </div>
        </form>
    </div>


@endsection
@section('scripts')
<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Your JavaScript code here
    var countAddButton = 1;
    var currentCurrency = '₹';
  
    $(document).ready(function () {
     


    $("#dine_in_feature").change(function () {
        if (this.checked) {
            $(".divein_div").show();
        } else {
            $(".divein_div").hide();
        }
    });


    });
</script>

<script>
    function numeralsOnly(evt) {
        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 46)) {
             const mon= document.getElementById('restaurant_phone');
             mon.style.border="1px solid red";
            return false;
        }else{
         const mon= document.getElementById('restaurant_phone');
             mon.style.border="none";
        return true;
        }
    }
    function numeralsOnly(evt) {
            evt = (evt) ? evt : event;
            var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
            if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 46)) {
                 const mon= document.getElementById('phone');
                 mon.style.border="1px solid red";
                return false;
            }else{
             const mon= document.getElementById('phone');
                 mon.style.border="none";
            return true;
            }
        }
</script>

 <script>
        $(document).ready(function () {
            const dayOptions = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            let dayIndex = 0;

            function updateAddButton() {
                if (dayIndex < dayOptions.length) {
                    $('.add-working-hours-btn').prop('disabled', false);
                    $('.add-working-hours-btn').css('color', 'black');
                } else {
                    $('.add-working-hours-btn').prop('disabled', true);
                }
            }

            $('.add-working-hours-btn').click(function () {
                // Dynamically create input fields for working hours
                let workingHoursContainer = $('.working-hours-container');
                let day = dayOptions[dayIndex]; // Get the day from the array using the dayIndex

                let workingHoursDiv = `
                    <div class="form-group row">
                        <label class="col-1 control-label">${day}</label>
                        <div class="col-12">
                            <button type="button" class="btn btn-primary add-working-hours" data-days="${day}">
                                Add
                            </button>
                        </div>
                    </div>
                    <div class="working-hours-options ${day.toLowerCase()}-optionss">
                        <!-- Input fields for working hours will be dynamically added here -->
                    </div>
                `;

                workingHoursContainer.append(workingHoursDiv);

                dayIndex++;
                updateAddButton();
            });
            updateAddButton();

            $(document).on('click', '.add-working-hours', function () {
                let day = $(this).data('days');
                let workingHoursOptions = $(`.${day.toLowerCase()}-optionss`);

                let workingHoursRow = `
                    <div class="mb-2 row">
                        <div class="col-5">
                            <label>Start Time</label>
                            <input type="time" class="form-control" name="${day.toLowerCase()}_start[]">
                        </div>
                        <div class="col-5">
                            <label>End Time</label>
                            <input type="time" class="form-control" name="${day.toLowerCase()}_end[]">
                        </div>
                        <div class="col-2">
                            <label style="display:block;width:100%;color:#fff">.</label>
                            <button type="button" class="btn btn-danger remove-working-hours">X</button>
                        </div>
                    </div>
                `;

                workingHoursOptions.append(workingHoursRow);
            });

            $(document).on('click', '.remove-working-hours', function () {
                $(this).closest('.mb-2').remove();
            });
        });

        $(document).ready(function () {
            const dayOptionss = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            let dayIndex = 0;

            function updateAdButton() {
                if (dayIndex < dayOptionss.length) {
                    $('.add-special-offer-btn').prop('disabled', false);
                    $('.add-special-offer-btn').css('color', 'black');
                } else {
                    $('.add-special-offer-btn').prop('disabled', true);
                }
            }

            $('.add-special-offer-btn').click(function () {
                let specialOfferContainer = $('.special-offer-container');
                let day = dayOptionss[dayIndex];

                let offerDiv = `
                    <div class="form-group row">
                        <label class="col-1 control-label">${day}</label>
                        <div class="col-12">
                            <button type="button" class="btn btn-primary add-special-offer" data-day="${day}">
                                Add
                            </button>
                        </div>
                    </div>
                    <div class="special-offer-options ${day.toLowerCase()}-options">

                    </div>
                `;

                specialOfferContainer.append(offerDiv);

                dayIndex++;
                updateAdButton();
            });
            updateAdButton();

            $(document).on('click', '.add-special-offer', function () {
                let day = $(this).data('day');
                let specialOfferOptions = $(`.${day.toLowerCase()}-options`);

                let specialOfferRow = `
                    <div class="mb-2 row">
                        <div class="col-3">
                            <label>Opening Time</label>
                            <input type="time" class="form-control" name="${day.toLowerCase()}_start_offer[]">
                        </div>
                        <div class="col-3">
                            <label>Closing Time</label>
                            <input type="time" class="form-control" name="${day.toLowerCase()}_end_offer[]">
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-6">
                                    <label>Discount</label>
                                    <input type="text" class="form-control" name="${day.toLowerCase()}_discount[]">
                                </div>
                                <div class="col-6">
                                    <label>%/₹</label>
                                    <select id="discount_typeThursday2" name="${day.toLowerCase()}_discount_type[]" class="form-control">
                                        <option value="percentage">%</option>
                                        <option value="amount">₹</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <label>Type</label>
                            <select id="typeThursday2" name="${day.toLowerCase()}_delivery_type[]" class="form-control">
                                <option value="delivery">Delivery Discount</option>
                                <option value="dinein">Dine-In Discount</option>
                            </select>
                        </div>
                    </div>
                `;

                specialOfferOptions.append(specialOfferRow);
            });

            $(document).on('click', '.remove-special-offer', function () {
                $(this).closest('.mb-2').remove();
            });
        });
    </script>
@endsection
