@extends('team.layouts.app')

@section('content')

    <div class="page-wrapper">
        <form action="{{ url('team/restaurants/insert') }}" method="post" enctype="multipart/form-data"> 
        @csrf
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.restaurant_plural')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{!! url('team/restaurants') !!}">{{trans('lang.restaurant_plural')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.create_restaurant')}}</li>
                </ol>
            </div>
            <div>

                <div class="card-body">
                    <div id="data-table_processing" class="dataTables_processing panel panel-default"
                         style="display: none;">{{trans('lang.processing')}}
                    </div>
                    <div class="error_top"></div>
                    <div class="row restaurant_payout_create">
                        <div class="restaurant_payout_create-inner">
                            <fieldset>
                                <legend>{{trans('lang.admin_area')}}</legend>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.first_name')}}<sup style="color:red;">*</sup></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control user_first_name" name="first_name" value="{{ old('first_name') }}">
                                        @if ($errors->has('first_name'))
                                            <div class="text-danger form-text text-muted" style="color:red;">
                                                {{ $errors->first('first_name') }}
                                            </div>
                                        @else
                                            <div class="form-text text-muted">
                                                {{ trans("lang.user_first_name_help") }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.last_name')}}<sup style="color:red;">*</sup></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control user_last_name" name="last_name" value="{{ old('last_name') }}">
                                        @if ($errors->has('last_name'))
                                            <div class="text-danger form-text text-muted" style="color:red;">
                                                {{ $errors->first('last_name') }}
                                            </div>
                                        @else
                                            <div class="form-text text-muted">
                                                {{ trans("lang.user_last_name_help") }}
                                            </div>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.email')}}<sup style="color:red;">*</sup></label>
                                    <div class="col-7">
                                        <input type="email" class="form-control user_email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <div class="text-danger form-text text-muted" style="color:red;">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @else
                                            <div class="form-text text-muted">
                                                {{ trans("lang.user_email_help") }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.password')}}<sup style="color:red;">*</sup></label>
                                    <div class="col-7">
                                        <input type="password" class="form-control user_password" name="password" value="{{ old('password') }}">
                                        @if ($errors->has('password'))
                                            <div class="text-danger form-text text-muted" style="color:red;">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @else
                                            <div class="form-text text-muted">
                                                {{ trans("lang.user_password_help") }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.user_phone')}}<sup style="color:red;">*</sup></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control user_phone" name="phone" value="{{ old('phone') }}">
                                         @error('phone')
                                            <div class="text-danger form-text text-muted" style="color:red;">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="form-text text-muted">
                                                {{ trans("lang.user_phone_help") }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <!--<div class="form-group row width-50">-->
                                <!--    <label class="col-3 control-label">Selfie Pic</label>-->
                                <!--    <input type="file" name="image" class="col-7">-->
                                <!--    <div id="uploding_image_owner"></div>-->
                                <!--</div>-->
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">Selfie Pic</label>
                                    <div class="col-7">
                                        <input type="file" class="form-control" id="image" name="image" style="height: 18px;" value="{{ old('image') }}">
                                        <div class="form-text text-muted">
                                            Insert Selfie Pic
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">PAN Card</label>
                                    <div class="col-7">
                                        <input type="file" class="form-control" id="pan_card" name="pan_card" style="height: 18px;" value="{{ old('pan_card') }}">
                                        <div class="form-text text-muted">
                                            Insert Pan Card
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">Aadhar Card</label>
                                    <div class="col-7">
                                      <input type="file" class="form-control" id="aadhar" name="aadhar" style="height: 18px;" value="{{ old('aadhar') }}">
                                      <div class="form-text text-muted">
                                            Insert Aadhar Card
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">Other Details</label>
                                    <div class="col-7">
                                      <input type="file" class="form-control" id="other_details" name="other_details" style="height: 18px;" value="{{ old('other_details') }}">
                                      <div class="form-text text-muted">
                                            Insert Other Details
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">Permanent Address<sup style="color:red;">*</sup></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control" id="permanent_address" name="permanent_address" value="{{ old('permanent_address') }}">
                                        <div class="form-text text-muted">
                                            @error('permanent_address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check row width-100">
                                    <input type="checkbox" class="item_publish" name="address_same" id="address_same" value="1"
                                        @if(old('address_same', 0) == 1) checked @endif>
                                    <label class="col-3 control-label" for="address_same">Communication Address Same as Permanent Address</label>
                                    @error('address_same')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label"> Communication Address<sup style="color:red;">*</sup></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control" id="communication_address" name="communication_address" value="{{ old('communication_address') }}">
                                        <div class="form-text text-muted">
                                            @error('communication_address')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{trans('lang.restaurant_details')}}</legend>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_name')}}<sup style="color:red;">*</sup></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control restaurant_name" name="restaurant_name" value="{{ old('restaurant_name') }}">
                                        @if ($errors->has('restaurant_name'))
                                            <div class="text-danger form-text text-muted" style="color:red;">
                                                {{ $errors->first('restaurant_name') }}
                                            </div>
                                        @else
                                            <div class="form-text text-muted">
                                                {{ trans("lang.restaurant_name_help") }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!--<div class="form-group row width-50">-->
                                <!--    <label class="col-3 control-label">{{trans('lang.category')}}</label>-->
                                <!--    <div class="col-7">-->
                                <!--        <select id='restaurant_cuisines1' class="form-control" name="category_id" required>-->
                                <!--            <option value="">{{ trans("lang.select_cuisines") }}</option>-->
                                <!--            @foreach($category as $c)-->
                                <!--                <option value="{{$c->id}}">{{$c->name}}</option>-->
                                <!--            @endforeach-->
                                <!--        </select>-->
                                        
                                <!--    </div>-->
                                <!--</div>-->

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_phone')}}<sup style="color:red;">*</sup></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control restaurant_phone" name="restaurant_phone" value="{{ old('restaurant_phone') }}">
                                        @if ($errors->has('restaurant_phone'))
                                            <div class="text-danger form-text text-muted" style="color:red;">
                                                {{ $errors->first('restaurant_phone') }}
                                            </div>
                                        @else
                                            <div class="form-text text-muted">
                                                {{ trans("lang.restaurant_phone_help") }}
                                            </div>
                                        @endif

                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_address')}}<sup style="color:red;">*</sup></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control restaurant_address" name="address" value="{{ old('address') }}">
                                        @if ($errors->has('address'))
                                            <div class="text-danger form-text text-muted" style="color:red;">
                                                {{ $errors->first('address') }}
                                            </div>
                                        @else
                                            <div class="form-text text-muted">
                                                {{ trans("lang.restaurant_address_help") }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <div class="col-12">
                                        <h6>* Don't Know your cordinates ? use <a target="_blank" href="https://www.latlong.net/">
                                            Latitude and Longitude Finder</a></h6>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_latitude')}}<sup style="color:red;">*</sup></label>
                                    <div class="col-7">
                                        <input class="form-control restaurant_latitude" type="number" name="latitude"  step="0.0000000001" value="{{ old('latitude') }}">
                                        @if ($errors->has('latitude'))
                                            <div class="text-danger form-text text-muted" style="color:red;">
                                                {{ $errors->first('latitude') }}
                                            </div>
                                        @else
                                            <div class="form-text text-muted">
                                                {{ trans("lang.restaurant_latitude_help") }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_longitude')}}<sup style="color:red;">*</sup></label>
                                    <div class="col-7">
                                        <input class="form-control restaurant_longitude" name="longitude" type="number"step="0.0000000001" value="{{ old('longitude') }}" >
                                        @if ($errors->has('longitude'))
                                            <div class="text-danger form-text text-muted" style="color:red;">
                                                {{ $errors->first('longitude') }}
                                            </div>
                                        @else
                                            <div class="form-text text-muted">
                                                {{ trans("lang.restaurant_longitude_help") }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_image')}}</label>
                                    <div class="col-7">
                                        <input type="file" name="restaurant_image" onChange="handleFileSelect(event,'photo')" value="{{ old('restaurant_image') }}" >
                                        <div id="uploding_image_restaurant"></div>
                                        <div class="uploaded_image" style="display:none;">
                                        <img id="uploaded_image" src="" width="150px" height="150px;"></div>
                                        <div class="form-text text-muted">
                                            {{ trans("lang.restaurant_image_help") }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label ">{{trans('lang.restaurant_description')}}</label>
                                    <div class="col-7">
                                    <textarea rows="7" name="description" class="restaurant_description form-control"
                                              id="restaurant_description"  value="{{ old('description') }}" ></textarea>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{trans('lang.gallery')}}</legend>

                                <div class="form-group row width-50 restaurant_image">
                                    <div class="">
                                        <div id="photos"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div>
                                        <input type="file" id="galleryImage" name="gallery_images[]" value="{{ old('gallery_images') }}" multiple>
                                        <div id="uploding_image_photos"></div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{trans('lang.services')}}</legend>

                                <div class="form-group row">

                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Free_Wi_Fi" name="services[]" value="Free Wi Fi">
                                        <label class="col-3 control-label" for="Free_Wi_Fi">{{trans('lang.free_wi_fi')}}</label>
                                    </div>
                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Good_for_Breakfast" name="services[]" value="Good for Breakfast">
                                        <label class="col-3 control-label" for="Good_for_Breakfast">{{trans('lang.good_for_breakfast')}}</label>
                                    </div>
                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Good_for_Dinner" name="services[]" value="Good for Dinner">
                                        <label class="col-3 control-label" for="Good_for_Dinner">{{trans('lang.good_for_dinner')}}</label>
                                    </div>
                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Good_for_Lunch" name="services[]" value="Good for Lunch">
                                        <label class="col-3 control-label" for="Good_for_Lunch">{{trans('lang.good_for_lunch')}}</label>
                                    </div>

                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Live_Music" name="services[]" value="Live Music">
                                        <label class="col-3 control-label" for="Live_Music">{{trans('lang.live_music')}}</label>
                                    </div>

                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Outdoor_Seating" name="services[]" value="Outdoor Seating">
                                        <label class="col-3 control-label" for="Outdoor_Seating">{{trans('lang.outdoor_seating')}}</label>
                                    </div>

                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Takes_Reservations" name="services[]" value="Takes Reservations">
                                        <label class="col-3 control-label" for="Takes_Reservations">{{trans('lang.takes_reservations')}}</label>
                                    </div>

                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Vegetarian_Friendly" name="services[]" vlaue="Vegetarian Friendly">
                                        <label class="col-3 control-label" for="Vegetarian_Friendly">{{trans('lang.vegetarian_friendly')}}</label>
                                    </div>

                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Working Hours</legend>
                            
                                <div class="working-hours-container">
                                    <!-- JavaScript will add input fields for each day here -->
                                </div>
                            
                                <div class="form-group row">
                                    <div class="col-7">
                                        <button type="button" class="btn btn-primary add-working-hours-btn">
                                            Add Working Hours
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
 

                            <fieldset>
                                <legend>{{trans('restaurant')}} {{trans('lang.active_deactive')}}</legend>
                                <div class="form-group row">

                                    <div class="form-group row width-50">
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="is_active" value="1" name="restaurant_status">
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
                                            <input type="checkbox" name="enable_dine" value="1" id="dine_in_feature" >
                                            <label class="col-3 control-label" for="dine_in_feature">{{trans('lang.enable_dine_in_feature')}}</label>
                                        </div>
                                    </div>
                                    <div class="divein_div" style="display:none">


                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                            <div class="col-7">
                                                <input type="time" name="dine_open_time" class="form-control" id="openDineTime" value="{{ old('dine_open_time') }}">
                                            </div>
                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                            <div class="col-7">
                                                <input type="time" name="dine_close_time" class="form-control" id="closeDineTime"  value="{{ old('dine_close_time') }}" >
                                            </div>
                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Cost</label>
                                            <div class="col-7">
                                                <input type="number" name="dine_cost_price" class="form-control restaurant_cost"  value="{{ old('dine_cost_price') }}" >
                                            </div>
                                        </div>
                                        <div class="form-group row width-100 restaurant_image">
                                            <label class="col-3 control-label">Menu Card Images</label>
                                            <div class="">
                                                <div id="photos_menu_card"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div>
                                                <input type="file" name="dine_image" >
                                                <div id="uploaded_image_menu"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{trans('lang.deliveryCharge')}}</legend>

                                <div class="form-group row">

                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{trans('lang.delivery_charges_per_km')}}</label>
                                        <div class="col-7">
                                            <input type="number" class="form-control" name="charges_per_km" id="delivery_charges_per_km" name="restaurants_per_km" value="{{ old('charges_per_km') }}" >
                                        </div>
                                    </div>
                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{trans('lang.minimum_delivery_charges')}}</label>
                                        <div class="col-7">
                                            <input type="number" class="form-control" name="charges_km_min" id="minimum_delivery_charges" name="restaurants_charges"  value="{{ old('charges_km_min') }}" >
                                        </div>
                                    </div>
                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{trans('lang.minimum_delivery_charges_within_km')}}</label>
                                        <div class="col-7">
                                            <input type="number" class="form-control" name="charge_within_km" id="minimum_delivery_charges_within_km" name="restaurants_km" value="{{ old('charge_within_km') }}">
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
                                                <input type="text" name="bank_name" class="form-control" id="bankName" value="{{ old('bank_name') }}" >
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{trans('lang.branch_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="branch_name" class="form-control"
                                                       id="branchName" value="{{ old('branch_name') }}"  >
                                            </div>
                                        </div>


                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{trans('lang.holer_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="holder_name" class="form-control"
                                                       id="holderName" value="{{ old('holder_name') }}" >
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{trans('lang.account_number')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="account_number" class="form-control"
                                                       id="accountNumber"  value="{{ old('account_number') }}"  >
                                            
                                                @error('account_number')
                                                    <div class="text-danger form-text text-muted">
                                                        {{ $message }} 
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">IFSC Code</label>
                                            <div class="col-7">
                                                <input type="text" name="ifsc_code" class="form-control"
                                                       id="ifscCode"   value="{{ old('ifsc_code') }}"   >
                                            
                                                @error('ifsc_code')
                                                    <div class="text-danger form-text text-muted " style="color:red;">
                                                        {{ $message }} 
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{trans('lang.other_information')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="other_information" class="form-control"
                                                       id="otherDetails"    value="{{ old('other_information') }}"  >
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>
                            
                            <fieldset>
                                <legend>Special Offers</legend>
                            
                                <div class="special-offer-container">
                                    <!-- JavaScript will add input fields for each day here -->
                                </div>
                            
                                <div class="form-group row">
                                    <div class="col-7">
                                        <button type="button" class="btn btn-primary add-special-offer-btn">
                                            Add Special Offer
                                        </button>
                                    </div>
                                </div>
                            </fieldset>

                            
                          
                            <!--<fieldset id="story_upload_div" style="display: none;">-->
                            <!--    <legend>Story</legend>-->

                            <!--    <div class="form-group row width-50 vendor_image">-->
                            <!--        <label class="col-3 control-label">Choose humbling GIF/Image</label>-->
                            <!--        <div class="">-->
                            <!--            <div id="story_thumbnail"></div>-->
                            <!--        </div>-->
                            <!--    </div>-->


                            <!--    <div class="form-group row">-->
                            <!--        <div>-->
                            <!--            <input type="file" id="file" onChange="handleStoryThumbnailFileSelect(event)">-->
                            <!--            <div id="uploding_story_thumbnail"></div>-->
                            <!--        </div>-->
                            <!--    </div>-->


                            <!--    <div class="form-group row vendor_image">-->
                            <!--        <label class="col-3 control-label">Select Story Video</label>-->
                            <!--        <div class="">-->
                            <!--            <div id="story_vedios" class="row"></div>-->
                            <!--        </div>-->
                            <!--    </div>-->

                            <!--    <div class="form-group row">-->
                            <!--        <div>-->
                            <!--            <input type="file" id="video_file" onChange="handleStoryFileSelect(event)">-->
                            <!--            <div id="uploding_story_video"></div>-->
                            <!--        </div>-->
                            <!--    </div>-->


                            <!--</fieldset>-->
                        </div>
                    </div>
                </div>

                <div class="form-group col-12 text-center">
                    <button type="submit" class="btn btn-primary  create_restaurant_btn"><i class="fa fa-save"></i>
                        {{trans('lang.save')}}
                    </button>
                    <a href="{!! route('team.restaurants') !!}" class="btn btn-default"><i
                                class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
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
    // var workingHours = [];
    // var timeslotworkSunday = [];
    // var timeslotworkMonday = [];
    // var timeslotworkTuesday = [];
    // var timeslotworkWednesday = [];
    // var timeslotworkFriday = [];
    // var timeslotworkSatuarday = [];
    // var timeslotworkThursday = [];

    // var specialDiscount = [];
    // var timeslotSunday = [];
    // var timeslotMonday = [];
    // var timeslotTuesday = [];
    // var timeslotWednesday = [];
    // var timeslotFriday = [];
    // var timeslotSatuarday = [];
    // var timeslotThursday = [];
    // var storevideoDuration = 0;
    
    
    // function addMoreButton(day, day2, count) {
    //     count = countAddButton;
    //     $(".restaurant_discount_options_" + day + "_div").show();
       
    //     $('#special_offer_table_' + day + ' tr:last').after('<tr>' +
    //         '<td class="" style="width:10%;"><input type="time" class="form-control" id="openTime' + day + count + '"></td>' +
    //         '<td class="" style="width:10%;"><input type="time" class="form-control" id="closeTime' + day + count + '"></td>' +
    //         '<td class="" style="width:30%;">' +
    //         '<input type="number" class="form-control" id="discount' + day + count + '" style="width:60%;">' +
    //         '<select id="discount_type' + day + count + '" class="form-control" style="width:40%;"><option value="percentage"/>%</option><option value="amount"/>' + currentCurrency + '</option></select>' +
    //         '</td>' +
    //         '<td style="width:30%;"><select id="type' + day + count + '" class="form-control"><option value="delivery"/>Delivery Discount</option><option value="dinein"/>Dine-In Discount</option></select></td>' +
    //         '<td class="action-btn" style="width:20%;">' +
    //         '<button type="button" class="btn btn-primary save_option_day_button' + day + count + '" onclick="addMoreFunctionButton(`' + day2 + '`,`' + day + '`,' + countAddButton + ')" style="width:62%;"><i class="fa fa-save"></i> Save</button>' +
    //         '</td></tr>');
    //     countAddButton++;

    // }

    // function addMoreFunctionButton(day1, day2, count) {
    //     var discount = $("#discount" + day2 + count).val();
    //     var discount_type = $('#discount_type' + day2 + count).val();
    //     var type = $('#type' + day2 + count).val();
    //     var closeTime = $("#closeTime" + day2 + count).val();
    //     var openTime = $("#openTime" + day2 + count).val();
    //     if (discount == "" && closeTime == '' && openTime == '') {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>Please Enter valid time or discount</p>");
    //         window.scrollTo(0, 0);
    //     } else if (discount > 100 || discount == 0) {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>Please Enter valid discount</p>");
    //         window.scrollTo(0, 0);
    //     } else {

    //         var timeslotVar = {
    //             'discount': discount,
    //             'from': openTime,
    //             'to': closeTime,
    //             'type': discount_type,
    //             'discount_type': type
    //         };
    //         console.log(timeslotVar);

    //         if (day1 == 'sunday') {
    //             timeslotSunday.push(timeslotVar);
    //         } else if (day1 == 'monday') {
    //             timeslotMonday.push(timeslotVar);
    //         } else if (day1 == 'tuesday') {
    //             timeslotTuesday.push(timeslotVar);
    //         } else if (day1 == 'wednesday') {
    //             timeslotWednesday.push(timeslotVar);
    //         } else if (day1 == 'thursday') {
    //             timeslotThursday.push(timeslotVar);
    //         } else if (day1 == 'friday') {
    //             timeslotFriday.push(timeslotVar);
    //         } else if (day1 == 'satuarday') {
    //             timeslotSatuarday.push(timeslotVar);
    //         }

    //         /*$("#discount"+day2+"").remove();
    //     $("#discount_type"+day2+"").remove();
    //         $("#closeTime"+day2+"").remove();
    //         $("#openTime"+day2+"").remove();*/
    //         $(".save_option_day_button" + day2 + count).hide();
    //         $("#discount" + day2 + count).attr('disabled', "true");
    //         $("#discount_type" + day2 + count).attr('disabled', "true");
    //         $("#type" + day2 + count).attr('disabled', "true");
    //         $("#closeTime" + day2 + count).attr('disabled', "true");
    //         $("#openTime" + day2 + count).attr('disabled', "true");
    //     }

    // }
    
    //   var countAddhours = 1;

    // function addMorehour(day, day2, count) {
    //     count = countAddhours;
    //     $(".restaurant_discount_options_" + day + "_div").show();
    //     $('#working_hour_table_' + day + ' tr:last').after('<tr>' +
    //         '<td class="" style="width:50%;"><input type="time" class="form-control" id="from' + day + count + '"></td>' +
    //         '<td class="" style="width:50%;"><input type="time" class="form-control" id="to' + day + count + '"></td>' +
    //         '<td><button type="button" class="btn btn-primary save_option_day_button' + day + count + '" onclick="addMoreFunctionhour(`' + day2 + '`,`' + day + '`,' + countAddhours + ')" style="width:62%;"><i class="fa fa-save" title="Save""></i></button>' +
    //         '</td></tr>');
    //     countAddhours++;

    // }

    // function addMoreFunctionhour(day1, day2, count) {
    //     var to = $("#to" + day2 + count).val();
    //     var from = $("#from" + day2 + count).val();
    //     if (to == '' && from == '') {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>Please Enter valid time</p>");
    //         window.scrollTo(0, 0);

    //     } else {

    //         var timeslotworkVar = {'from': from, 'to': to,};
    //         console.log(timeslotworkVar);

    //         if (day1 == 'sunday') {
    //             timeslotworkSunday.push(timeslotworkVar);
    //         } else if (day1 == 'monday') {
    //             timeslotworkMonday.push(timeslotworkVar);
    //         } else if (day1 == 'tuesday') {
    //             timeslotworkTuesday.push(timeslotworkVar);
    //         } else if (day1 == 'wednesday') {
    //             timeslotworkWednesday.push(timeslotworkVar);
    //         } else if (day1 == 'thursday') {
    //             timeslotworkThursday.push(timeslotworkVar);
    //         } else if (day1 == 'friday') {
    //             timeslotworkFriday.push(timeslotworkVar);
    //         } else if (day1 == 'satuarday') {
    //             timeslotworkSatuarday.push(timeslotworkVar);
    //         }

    //         $(".save_option_day_button" + day2 + count).hide();
    //         $("#to" + day2 + count).attr('disabled', "true");
    //         $("#from" + day2 + count).attr('disabled', "true");
    //     }

    // }


    $(document).ready(function () {
     

    // $(".create_restaurant_btn").click(function () {

    //     $(".error_top").hide();
        
    //     var restaurantname = $(".restaurant_name").val();
    //     var cuisines = $("#restaurant_cuisines option:selected").val();
    //     var restaurantOwner = $("#restaurant_owners option:selected").val();
    //     var address = $(".restaurant_address").val();
    //     var latitude = parseFloat($(".restaurant_latitude").val());
    //     var longitude = parseFloat($(".restaurant_longitude").val());
    //     var description = $(".restaurant_description").val();
    //     var phonenumber = $(".restaurant_phone").val();
    //     var categoryTitle = $("#restaurant_cuisines option:selected").text();

    //     var userFirstName = $(".user_first_name").val();
    //     var userLastName = $(".user_last_name").val();
    //     var email = $(".user_email").val();
    //     var password = $(".user_password").val();
    //     var userPhone = $(".user_phone").val();

        // var enabledDiveInFuture = $("#dine_in_feature").is(':checked');
    //     var reststatus = false;
    //     var restaurantCost = $(".restaurant_cost").val();

    //     var restaurant_active = false;
    //     if ($("#is_active").is(':checked')) {
    //         restaurant_active = true;
    //     }

    //     var user_name = userFirstName + " " + userLastName;
    //     var user_id = "<?php echo uniqid(); ?>";
    //     var name = userFirstName + " " + userLastName;


    //     var openDineTime = $("#openDineTime").val();
    //     var openDineTime_val = $("#openDineTime").val();
    //     if (openDineTime) {
    //         openDineTime = new Date('1970-01-01T' + openDineTime + 'Z')
    //             .toLocaleTimeString('en-US',
    //                 {timeZone: 'UTC', hour12: true, hour: 'numeric', minute: 'numeric'}
    //             );
    //     }

    //     var closeDineTime = $("#closeDineTime").val();
    //     var closeDineTime_val = $("#closeDineTime").val();
    //     if (closeDineTime) {
    //         closeDineTime = new Date('1970-01-01T' + closeDineTime + 'Z')
    //             .toLocaleTimeString('en-US',
    //                 {timeZone: 'UTC', hour12: true, hour: 'numeric', minute: 'numeric'}
    //             );
    //     }

    //     var specialDiscount = [];

    //     var sunday = {'day': 'Sunday', 'timeslot': timeslotSunday};
    //     var monday = {'day': 'Monday', 'timeslot': timeslotMonday};
    //     var tuesday = {'day': 'Tuesday', 'timeslot': timeslotTuesday};
    //     var wednesday = {'day': 'Wednesday', 'timeslot': timeslotWednesday};
    //     var thursday = {'day': 'Thursday', 'timeslot': timeslotThursday};
    //     var friday = {'day': 'Friday', 'timeslot': timeslotFriday};
    //     var satuarday = {'day': 'Satuarday', 'timeslot': timeslotSatuarday};

    //     specialDiscount.push(monday);
    //     specialDiscount.push(tuesday);
    //     specialDiscount.push(wednesday);
    //     specialDiscount.push(thursday);
    //     specialDiscount.push(friday);
    //     specialDiscount.push(satuarday);
    //     specialDiscount.push(sunday);

    //     var workingHours = [];

    //     var sunday = {'day': 'Sunday', 'timeslot': timeslotworkSunday};
    //     var monday = {'day': 'Monday', 'timeslot': timeslotworkMonday};
    //     var tuesday = {'day': 'Tuesday', 'timeslot': timeslotworkTuesday};
    //     var wednesday = {'day': 'Wednesday', 'timeslot': timeslotworkWednesday};
    //     var thursday = {'day': 'Thursday', 'timeslot': timeslotworkThursday};
    //     var friday = {'day': 'Friday', 'timeslot': timeslotworkFriday};
    //     var satuarday = {'day': 'Satuarday', 'timeslot': timeslotworkSatuarday};

    //     workingHours.push(monday);
    //     workingHours.push(tuesday);
    //     workingHours.push(wednesday);
    //     workingHours.push(thursday);
    //     workingHours.push(friday);
    //     workingHours.push(satuarday);
    //     workingHours.push(sunday);

    //     var Free_Wi_Fi = "No";
    //     if ($("#Free_Wi_Fi").is(":checked")) {
    //         Free_Wi_Fi = "Yes";
    //     }
    //     var Good_for_Breakfast = "No";
    //     if ($("#Good_for_Breakfast").is(':checked')) {
    //         Good_for_Breakfast = "Yes";
    //     }
    //     var Good_for_Dinner = "No";
    //     if ($("#Good_for_Dinner").is(':checked')) {
    //         Good_for_Dinner = "Yes";
    //     }
    //     var Good_for_Lunch = "No";
    //     if ($("#Good_for_Lunch").is(':checked')) {
    //         Good_for_Lunch = "Yes";
    //     }
    //     var Live_Music = "No";
    //     if ($("#Live_Music").is(':checked')) {
    //         Live_Music = "Yes";
    //     }
    //     var Outdoor_Seating = "No";
    //     if ($("#Outdoor_Seating").is(':checked')) {
    //         Outdoor_Seating = "Yes";
    //     }
    //     var Takes_Reservations = "No";
    //     if ($("#Takes_Reservations").is(':checked')) {
    //         Takes_Reservations = "Yes";
    //     }
    //     var Vegetarian_Friendly = "No";
    //     if ($("#Vegetarian_Friendly").is(':checked')) {
    //         Vegetarian_Friendly = "Yes";
    //     }

    //     var filters_new = {
    //         "Free Wi-Fi": Free_Wi_Fi,
    //         "Good for Breakfast": Good_for_Breakfast,
    //         "Good for Dinner": Good_for_Dinner,
    //         "Good for Lunch": Good_for_Lunch,
    //         "Live Music": Live_Music,
    //         "Outdoor Seating": Outdoor_Seating,
    //         "Takes Reservations": Takes_Reservations,
    //         "Vegetarian Friendly": Vegetarian_Friendly
    //     };
    //     console.log(filters_new);

    //     if (userFirstName == '') {

    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>{{trans('lang.enter_owners_name_error')}}</p>");
    //         window.scrollTo(0, 0);
    //     } else if (email == '') {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>{{trans('lang.enter_owners_email')}}</p>");
    //         window.scrollTo(0, 0);
    //     } else if (password == '') {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>{{trans('lang.enter_owners_password_error')}}</p>");
    //         window.scrollTo(0, 0);
    //     } else if (userPhone == '') {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>{{trans('lang.enter_owners_phone')}}</p>");
    //         window.scrollTo(0, 0);
    //     } else if (restaurantname == '') {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>{{trans('lang.restaurant_name_error')}}</p>");
    //         window.scrollTo(0, 0);
    //     } else if (cuisines == '') {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>{{trans('lang.restaurant_cuisine_error')}}</p>");
    //         window.scrollTo(0, 0);
    //     } else if (phonenumber == '') {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>{{trans('lang.restaurant_phone_error')}}</p>");
    //         window.scrollTo(0, 0);
    //     } else if (address == '') {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>{{trans('lang.restaurant_address_error')}}</p>");
    //         window.scrollTo(0, 0);
    //     } else if (isNaN(latitude)) {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>{{trans('lang.restaurant_lattitude_error')}}</p>");
    //         window.scrollTo(0, 0);
    //     } else if (latitude < -90 || latitude > 90) {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>{{trans('lang.restaurant_lattitude_limit_error')}}</p>");
    //         window.scrollTo(0, 0);
    //     } else if (isNaN(longitude)) {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>{{trans('lang.restaurant_longitude_error')}}</p>");
    //         window.scrollTo(0, 0);

    //     } else if (longitude < -180 || longitude > 180) {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>{{trans('lang.restaurant_longitude_limit_error')}}</p>");
    //         window.scrollTo(0, 0);

    //     } else if (description == '') {
    //         $(".error_top").show();
    //         $(".error_top").html("");
    //         $(".error_top").append("<p>{{trans('lang.restaurant_description_error')}}</p>");
    //         window.scrollTo(0, 0);
            
    //     } else {
            
    //             if(story_vedios.length > 0 || story_thumbnail != ''){
    //             if(story_vedios.length > 0 && story_thumbnail == ''){
    //                 $(".error_top").show();
    //                 $(".error_top").html("");
    //                 $(".error_top").append("<p>{{trans('lang.story_error')}}</p>");
    //                 window.scrollTo(0, 0);
    //                 return false;
    //             }else if(story_thumbnail && story_vedios.length == 0){
    //                 $(".error_top").show();
    //                 $(".error_top").html("");
    //                 $(".error_top").append("<p>{{trans('lang.story_error')}}</p>");
    //                 window.scrollTo(0, 0);
    //                 return false;	
    //             }else{
    //                 database.collection('story').doc(restaurant_id).set({
    //                     'createdAt': new Date(),
    //                     'vendorID': restaurant_id,
    //                     'videoThumbnail': story_thumbnail,
    //                     'videoUrl': story_vedios,
    //                 });
    //             }	
    //         }

    //         var delivery_charges_per_km = parseInt($("#delivery_charges_per_km").val());
    //         var minimum_delivery_charges = parseInt($("#minimum_delivery_charges").val());
    //         var minimum_delivery_charges_within_km = parseInt($("#minimum_delivery_charges_within_km").val());
    //         var DeliveryCharge = {
    //             'delivery_charges_per_km': delivery_charges_per_km,
    //             'minimum_delivery_charges': minimum_delivery_charges,
    //             'minimum_delivery_charges_within_km': minimum_delivery_charges_within_km
    //         };

    //         firebase.auth().createUserWithEmailAndPassword(email, password)
    //             .then(function (firebaseUser) {
    //                 user_id = firebaseUser.user.uid;
    //                 database.collection('users').doc(user_id).set({
    //                     'firstName': userFirstName,
    //                     'lastName': userLastName,
    //                     'email': email,
    //                     'phoneNumber': userPhone,
    //                     'profilePictureURL': ownerphoto,
    //                     'role': 'vendor',
    //                     'id': user_id,
    //                     'vendorID': restaurant_id,
    //                     'active': restaurant_active,
    //                     'createdAt': createdAt
    //                 }).then(function (result) {

    //                     coordinates = new firebase.firestore.GeoPoint(latitude, longitude);


    //                     geoFirestore.collection('vendors').doc(restaurant_id).set({
    //                         'title': restaurantname,
    //                         'description': description,
    //                         // 'latitude': latitude,
    //                         'longitude': longitude,
    //                         'location': address,
    //                         'photo': restaurantPhoto,
    //                         'categoryID': cuisines,
    //                         'phonenumber': phonenumber,
    //                         'categoryTitle': categoryTitle,
    //                         'coordinates': coordinates,
    //                         'id': restaurant_id,
    //                         'filters': filters_new,
    //                         'photos': restaurnt_photos,
    //                         'author': user_id,
    //                         'authorName': name,
    //                         'authorProfilePic': ownerphoto,
    //                         'reststatus': reststatus,
    //                         hidephotos: false,
    //                         createdAt: createdAt,
    //                         'enabledDiveInFuture': enabledDiveInFuture,
    //                         'restaurantMenuPhotos': restaurant_menu_photos,
    //                         'restaurantCost': restaurantCost,
    //                         'openDineTime': openDineTime,
    //                         'closeDineTime': closeDineTime,
    //                         'workingHours': workingHours,
    //                         'specialDiscount': specialDiscount,

    //                     }).then(function (result) {

    //                         window.location.href = '{{ route("admin.restaurants")}}';
                            
    //                     });

    //                 })

    //             }).catch(function (error) {

    //             $(".error_top").show();
    //             $(".error_top").html("");
    //             $(".error_top").append("<p>" + error + "</p>");
    //         });
    //     }

    // })


    // $(document).on("click", ".remove-btn", function () {
    //     var id = $(this).attr('data-id');
    //     var photo_remove = $(this).attr('data-img');
    //     firebase.storage().refFromURL(photo_remove).delete();
    //     $("#photo_" + id).remove();
    //     index = restaurnt_photos.indexOf(photo_remove);
    //     if (index > -1) {
    //         restaurnt_photos.splice(index, 1); // 2nd parameter means remove one item only
    //     }

    // });

    // function handleFileSelectowner(evt) {
    //     var f = evt.target.files[0];
    //     var reader = new FileReader();

    //     new Compressor(f, {
    //         quality: <?php echo env('IMAGE_COMPRESSOR_QUALITY', 0.8); ?>,
    //         success(result) {
    //             f = result;

    //             reader.onload = (function (theFile) {
    //                 return function (e) {

    //                     var filePayload = e.target.result;
    //                     var val = f.name;
    //                     var ext = val.split('.')[1];
    //                     var docName = val.split('fakepath')[1];
    //                     var filename = (f.name).replace(/C:\\fakepath\\/i, '')

    //                     var timestamp = Number(new Date());
    //                     var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                        
    //                     var uploadTask = storageRef.child(filename).put(theFile);
    //                     console.log(uploadTask);
    //                     uploadTask.on('state_changed', function (snapshot) {

    //                         var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
    //                         console.log('Upload is ' + progress + '% done');
    //                         jQuery("#uploding_image_owner").text("Image is uploading...");
    //                     }, function (error) {
    //                     }, function () {
    //                         uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
    //                             jQuery("#uploding_image_owner").text("Upload is completed");
    //                             ownerphoto = downloadURL;

    //                             $("#uploaded_image_owner").attr('src', ownerphoto);
    //                             $(".uploaded_image_owner").show();

    //                         });
    //                     });

    //                 };
    //             })(f);
    //             reader.readAsDataURL(f);

    //         },
    //         error(err) {
    //             console.log(err.message);
    //         },
    //     });
    // }


    // function handleFileSelect(evt, type) {
    //     var f = evt.target.files[0];
    //     var reader = new FileReader();

    //     new Compressor(f, {
    //         quality: <?php echo env('IMAGE_COMPRESSOR_QUALITY', 0.8); ?>,
    //         success(result) {
    //             f = result;

    //             reader.onload = (function (theFile) {
    //                 return function (e) {

    //                     var filePayload = e.target.result;
    //                     var val = f.name;
    //                     var ext = val.split('.')[1];
    //                     var docName = val.split('fakepath')[1];
    //                     var filename = (f.name).replace(/C:\\fakepath\\/i, '')

    //                     var timestamp = Number(new Date());
    //                     var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                        
    //                     var uploadTask = storageRef.child(filename).put(theFile);
    //                     console.log(uploadTask);
    //                     uploadTask.on('state_changed', function (snapshot) {

    //                         var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
    //                         console.log('Upload is ' + progress + '% done');
    //                         if (type == "photo") {
    //                             jQuery("#uploding_image_restaurant").text("Image is uploading...");
    //                         } else {
    //                             jQuery("#uploding_image_photos").text("Image is uploading...");
    //                         }

    //                     }, function (error) {
    //                     }, function () {
    //                         uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {

    //                             if (type == "photo") {
    //                                 jQuery("#uploding_image_restaurant").text("Upload is completed");
    //                             } else {
    //                                 jQuery("#uploding_image_photos").text("Upload is completed");
    //                             }

    //                             photo = downloadURL;
    //                             if (type == "photo") {
    //                                 restaurantPhoto = downloadURL;
    //                             }

    //                             if (photo) {
    //                                 if (type == 'photo') {
    //                                     $("#uploaded_image").attr('src', photo);
    //                                     $(".uploaded_image").show();
    //                                 } else if (type == 'photos') {

    //                                     photocount++;
    //                                     photos_html = '<span class="image-item" id="photo_' + photocount + '"><span class="remove-btn" data-id="' + photocount + '" data-img="' + photo + '"><i class="fa fa-remove"></i></span><img width="100px" id="" height="auto" src="' + photo + '"></span>';
    //                                     $("#photos").append(photos_html);
    //                                     restaurnt_photos.push(photo);
    //                                 }
    //                             }


    //                         });
    //                     });

    //                 };
    //             })(f);
    //             reader.readAsDataURL(f);
    //         },
    //         error(err) {
    //             console.log(err.message);
    //         },
    //     });
    // }

    // function handleStoryFileSelect(evt) {
    //     var f = evt.target.files[0];
    //     var reader = new FileReader();
    //     var story_video_duration = $("#story_video_duration").val();
    //     var isVideo= document.getElementById('video_file');
    //     var videoValue= isVideo.value;
    //     var allowedExtensions =/(\.mp4)$/i;;
            
    //     if (!allowedExtensions.exec(videoValue)) {
    //         $(".error_top").show();
    //             $(".error_top").html("");
    //             $(".error_top").append("<p>Error: Invalid video type</p>");
    //             window.scrollTo(0, 0);
    //             isVideo.value = '';
    //         return false;
    //     }
    
    //     var video = document.createElement('video');
        
            
    //     video.preload = 'metadata';
        
    //     video.onloadedmetadata = function() {
        
    //         window.URL.revokeObjectURL(video.src);
            
            
    //             if (video.duration > storevideoDuration){
    //             $(".error_top").show();
    //             $(".error_top").html("");
    //             $(".error_top").append("<p>Error: Story video duration maximum allow to "+storevideoDuration+" seconds</p>");
    //             window.scrollTo(0, 0);
    //             evt.target.value = '';
    //             return false;
    //         }
        
    //     reader.onload = (function (theFile) {
    //         return function (e) {

    //             var filePayload = e.target.result;
    //             var val = f.name;
    //             var ext = val.split('.')[1];
    //             var docName = val.split('fakepath')[1];
    //             var filename = (f.name).replace(/C:\\fakepath\\/i, '')

    //             var timestamp = Number(new Date());
    //             var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;

    //             var uploadTask = storyRef.child(filename).put(theFile);
    //             console.log(uploadTask);
    //             uploadTask.on('state_changed', function (snapshot) {

    //                 var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
    //                 console.log('Upload is ' + progress + '% done');
    //                 jQuery("#uploding_story_video").text("video is uploading...");
    //             }, function (error) {
    //             }, function () {
    //                 uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
    //                     jQuery("#uploding_story_video").text("Upload is completed");
    //                     setTimeout(function(){jQuery("#uploding_story_video").empty();},3000);

    //                     var nextCount = $("#story_vedios").children().length;
    //                     html = '<div class="col-md-3" id="story_div_' + nextCount + '">\n' +
    //                         '<div class="video-inner"><video width="320px" height="240px"\n' +
    //                         '                                   controls="controls">\n' +
    //                         '                            <source src="' + downloadURL + '"\n' +
    //                         '            type="video/mp4"></video><span class="remove-story-video" data-id="' + nextCount + '" data-img="' + downloadURL + '"><i class="fa fa-remove"></i></span></div></div>';

    //                     jQuery("#story_vedios").append(html);
    //                     story_vedios.push(downloadURL);
    //                     $("#video_file").val('');
    //                 });
    //             });

    //         };
    //     })(f);
    //     reader.readAsDataURL(f);
    //     }
    //     video.src = URL.createObjectURL(f);
    // }


    // $(document).on("click", ".remove-story-video", function () {
    //     var id = $(this).attr('data-id');
    //     var photo_remove = $(this).attr('data-img');
    //     firebase.storage().refFromURL(photo_remove).delete();
    //     $("#story_div_" + id).remove();
    //     index = story_vedios.indexOf(photo_remove);
    //     $("#video_file").val('');
    //     if (index > -1) {
    //         story_vedios.splice(index, 1); // 2nd parameter means remove one item only
    //     }
        
    //     var newhtml = '';
    //     if(story_vedios.length > 0){
    //         for (var i = 0; i < story_vedios.length; i++) {
    //             newhtml += '<div class="col-md-3" id="story_div_' + i + '">\n' +
    //                 '<div class="video-inner"><video width="320px" height="240px"\n' +
    //                 'controls="controls">\n' +
    //                 '<source src="' + story_vedios[i] + '"\n' +
    //                 'type="video/mp4"></video><span class="remove-story-video" data-id="'+i+'" data-img="'+story_vedios[i]+'"><i class="fa fa-remove"></i></span></div></div>';
    //         }
    //     }
    //     jQuery("#story_vedios").html(newhtml);
    //     deleteStoryfromCollection();
    // });

    // $(document).on("click", ".remove-story-thumbnail", function () {
    //     var photo_remove = $(this).attr('data-img');
    //     firebase.storage().refFromURL(photo_remove).delete();
    //     $("#story_thumbnail").empty();
    //     story_thumbnail = '';
    //     deleteStoryfromCollection();
    // });
    
    // function deleteStoryfromCollection(){
    //         if(story_vedios.length == 0 && story_thumbnail == ''){
    //         database.collection('story').where('vendorID','==',restaurant_id).get().then(async function (snapshot) {
    //             if(snapshot.docs.length > 0){
    //                 database.collection('story').doc(restaurant_id).delete();		
    //             }
    //         });
    //     }
    // }

    // function handleStoryThumbnailFileSelect(evt) {

    //     var f = evt.target.files[0];
    //     var reader = new FileReader();

    //     var fileInput =
    //         document.getElementById('file');
            
    //     var filePath = fileInput.value;
        
    //     // Allowing file type
    //     var allowedExtensions =/(\.jpg|\.jpeg|\.png|\.gif)$/i;;
            
    //     if (!allowedExtensions.exec(filePath)) {
    //         $(".error_top").show();
    //             $(".error_top").html("");
    //             $(".error_top").append("<p>Error: Invalid File type</p>");
    //             window.scrollTo(0, 0);
    //         fileInput.value = '';
    //         return false;
    //     }
    //     reader.onload = (function (theFile) {
    //         return function (e) {

    //             var filePayload = e.target.result;
    //             var val = f.name;
    //             var ext = val.split('.')[1];
    //             var docName = val.split('fakepath')[1];
    //             var filename = (f.name).replace(/C:\\fakepath\\/i, '')

    //             var timestamp = Number(new Date());
    //             var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;

    //             var uploadTask = storyImagesRef.child(filename).put(theFile);
    //             console.log(uploadTask);
    //             uploadTask.on('state_changed', function (snapshot) {

    //                 var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
    //                 console.log('Upload is ' + progress + '% done');
    //                 jQuery("#uploding_story_thumbnail").text("Image is uploading...");
    //             }, function (error) {
    //             }, function () {
    //                 uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
    //                     jQuery("#uploding_story_thumbnail").text("Upload is completed");
    //                     setTimeout(function(){jQuery("#uploding_story_thumbnail").empty();},3000);
    //                     var html = '<div class="col-md-3"><div class="thumbnail-inner"><span class="remove-story-thumbnail" data-img="'+downloadURL+'"><i class="fa fa-remove"></i></span><img id="story_thumbnail_image" src="' + downloadURL + '" width="150px" height="150px;"></div></div>';
    //                     jQuery("#story_thumbnail").html(html);
    //                     story_thumbnail = downloadURL;
    //                     $("#file").val('');
    //                 });
    //             });

    //         };
    //     })(f);
    //     reader.readAsDataURL(f);
    // }

    // function handleFileSelectMenuCard(evt) {
    //     var f = evt.target.files[0];
    //     var reader = new FileReader();

    //     new Compressor(f, {
    //         quality: <?php echo env('IMAGE_COMPRESSOR_QUALITY', 0.8); ?>,
    //         success(result) {
    //             f = result;

    //             reader.onload = (function (theFile) {
    //                 return function (e) {

    //                     var filePayload = e.target.result;
    //                     var val = f.name;
    //                     var ext = val.split('.')[1];
    //                     var docName = val.split('fakepath')[1];
    //                     var filename = (f.name).replace(/C:\\fakepath\\/i, '')

    //                     var timestamp = Number(new Date());
    //                     var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                        
    //                     var uploadTask = storageRef.child(filename).put(theFile);
    //                     console.log(uploadTask);
    //                     uploadTask.on('state_changed', function (snapshot) {

    //                         var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
    //                         console.log('Upload is ' + progress + '% done');

    //                         jQuery("#uploaded_image_menu").text("Image is uploading...");


    //                     }, function (error) {
    //                     }, function () {
    //                         uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {

    //                             jQuery("#uploaded_image_menu").text("Upload is completed");

    //                             photo = downloadURL;

    //                             if (photo) {

    //                                 menuPhotoCount++;
    //                                 photos_html = '<span class="image-item" id="photo_menu' + menuPhotoCount + '"><span class="remove-btn remove-menu-btn" data-id="' + menuPhotoCount + '" data-img="' + photo + '"><i class="fa fa-remove"></i></span><img width="100px" id="" height="auto" src="' + photo + '"></span>';
    //                                 $("#photos_menu_card").append(photos_html);
    //                                 restaurant_menu_photos.push(photo);
    //                             }


    //                         });
    //                     });

    //                 };
    //             })(f);
    //             reader.readAsDataURL(f);
    //         },
    //         error(err) {
    //             console.log(err.message);
    //         },
    //     });
    // }

    $("#dine_in_feature").change(function () {
        if (this.checked) {
            $(".divein_div").show();
        } else {
            $(".divein_div").hide();
        }
    });


    // $(".add_special_offer_restaurant_btn").click(function () {
    //     // if(specialDiscountOfferisEnable){
    //         $(".special_offer_div").show();
    //     // }else{
    //     //     alert("{{trans('lang.special_offer_disabled')}}");
    //     //     return false;
    //     // }
    // })

  

    // $(".add_working_hours_restaurant_btn").click(function () {
    //     $(".working_hours_div").show();
    // })
  
    });
</script>


<!--<script>-->
<!--$(document).ready(function() {-->
<!--    const dayOptions = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];-->
<!--    let dayIndex = 0;-->

<!--    function updateAddButton() {-->
<!--        if (dayIndex < dayOptions.length) {-->
<!--            $('.add-working-hours-btn').prop('disabled', false);-->
<!--            $('.add-working-hours-btn').css('color', 'black');-->
<!--        } else {-->
<!--            $('.add-working-hours-btn').prop('disabled', true);-->
<!--        }-->
<!--    }-->

<!--    $('.add-working-hours-btn').click(function() {-->
        // Dynamically create input fields for working hours
<!--        let workingHoursContainer = $('.working-hours-container');-->
        let day = dayOptions[dayIndex]; // Get the day from the array using the dayIndex

<!--        let workingHoursDiv = `-->
<!--            <div class="form-group row">-->
<!--                <label class="col-1 control-label">${day}</label>-->
<!--                <div class="col-12">-->
<!--                    <button type="button" class="btn btn-primary add-working-hours" data-day="${day}">-->
<!--                        Add-->
<!--                    </button>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="working-hours-options ${day.toLowerCase()}-options">-->
                <!-- Input fields for working hours will be dynamically added here -->
<!--            </div>-->
<!--        `;-->

<!--        workingHoursContainer.append(workingHoursDiv);-->

<!--        dayIndex++;-->
<!--        updateAddButton();-->
<!--    });-->
<!--    updateAddButton();-->

<!--    $(document).on('click', '.add-working-hours', function() {-->
<!--        let day = $(this).data('day');-->
<!--        let workingHoursOptions = $(`.${day.toLowerCase()}-options`);-->

<!--        let workingHoursRow = `-->
<!--            <div class="mb-2 row">-->
<!--                <div class="col-5">-->
<!--                    <input type="time" class="form-control" name="${day.toLowerCase()}_start[]">-->
<!--                </div>-->
<!--                <div class="col-5">-->
<!--                    <input type="time" class="form-control" name="${day.toLowerCase()}_end[]">-->
<!--                </div>-->
<!--                <div class="col-2">-->
<!--                    <button type="button" class="btn btn-danger remove-working-hours">X</button>-->
<!--                </div>-->
<!--            </div>-->
<!--        `;-->

<!--        workingHoursOptions.append(workingHoursRow);-->
<!--    });-->

<!--    $(document).on('click', '.remove-working-hours', function() {-->
<!--        $(this).closest('.mb-2').remove();-->
<!--    });-->
<!--});-->

<!--$(document).ready(function() {-->
<!--    const dayOptionss = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];-->
<!--    let dayIndex = 0;-->

<!--    function updateAdButton() {-->
<!--        if (dayIndex < dayOptionss.length) {-->
<!--            $('.add-special-offer-btn').prop('disabled', false);-->
<!--            $('.add-special-offer-btn').css('color', 'black');-->
<!--        } else {-->
<!--            $('.add-special-offer-btn').prop('disabled', true);-->
<!--        }-->
<!--    }-->

<!--    $('.add-special-offer-btn').click(function() {-->
        
<!--        let specialOfferContainer = $('.special-offer-container');-->
<!--        let day = dayOptionss[dayIndex]; -->

<!--        let offerDiv = `-->
<!--            <div class="form-group row">-->
<!--                <label class="col-1 control-label">${day}</label>-->
<!--                <div class="col-12">-->
<!--                    <button type="button" class="btn btn-primary add-special-offer" data-day="${day}">-->
<!--                        Add-->
<!--                    </button>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="special-offer-options ${day.toLowerCase()}-options">-->
                
<!--            </div>-->
<!--        `;-->

<!--        specialOfferContainer.append(offerDiv);-->

<!--        dayIndex++;-->
<!--        updateAdButton();-->
<!--    });-->
<!--    updateAdButton();-->

<!--    $(document).on('click', '.add-special-offer', function() {-->
<!--        let day = $(this).data('day');-->
<!--        let specialOfferOptions = $(`.${day.toLowerCase()}-options`);-->

<!--        let specialOfferRow = `-->
<!--            <div class="mb-2 row">-->
<!--                <div class="col-3">-->
<!--                    <label>Opening Time	</label>-->
<!--                    <input type="time" class="form-control" name="${day.toLowerCase()}_start[]">-->
<!--                </div>-->
<!--                <div class="col-3">-->
<!--                    <label>Closing Time	</label>-->
<!--                    <input type="time" class="form-control" name="${day.toLowerCase()}_end[]">-->
<!--                </div>-->
<!--                <div class="col-4">-->
<!--                    <div class="row">-->
<!--                        <div class="col-6">-->
<!--                            <label>Discount</label>-->
<!--                            <input type="text" class="form-control" name="${day.toLowerCase()}_discount[]">-->
<!--                        </div>-->
<!--                        <div class="col-6">-->
<!--                            <label>%/₹</label>-->
<!--                            <select id="discount_typeThursday2" name="${day.toLowerCase()}_discount_type[]" class="form-control">-->
<!--                              <option value="percentage">%</option>-->
<!--                              <option value="amount">₹</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-2">-->
<!--                    <label>Type</label>-->
<!--                     <select id="typeThursday2" name="${day.toLowerCase()}_delevery_type[]" class="form-control">-->
<!--                      <option value="delivery">Delivery Discount</option>-->
<!--                      <option value="dinein">Dine-In Discount</option>-->
<!--                    </select>-->
<!--                </div>-->
               
<!--            </div>-->
<!--        `;-->

<!--        specialOfferOptions.append(specialOfferRow);-->
<!--    });-->

<!--    $(document).on('click', '.remove-special-offer', function() {-->
<!--        $(this).closest('.mb-2').remove();-->
<!--    });-->
<!--});-->

<!--</script>-->
   <script>
        $(document).ready(function () {
        const dayOptions = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        let dayIndex = 0;
    
        function addWorkingHoursForDay(day) {
            let workingHoursContainer = $('.working-hours-container');
    
            let workingHoursDiv = `
                <div class="form-group row">
                    <label class="col-1 control-label">${day}</label>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary add-working-hours" data-day="${day}">
                            Add
                        </button>
                    </div>
                </div>
                <div class="working-hours-options ${day.toLowerCase()}-options day-section" style="display: none;">
                    <!-- Input fields for working hours will be dynamically added here -->
                </div>
            `;
    
            workingHoursContainer.append(workingHoursDiv);
        }
    
        function showAllDaySections() {
            // Show all day sections when "Add Working Hours" is clicked
            for (let i = 0; i < dayOptions.length; i++) {
                let day = dayOptions[i];
                addWorkingHoursForDay(day);
                showDaySection(day);
            }
            dayIndex = dayOptions.length;
        }
    
        function showDaySection(day) {
            let daySection = $(`.${day.toLowerCase()}-options.day-section`);
            daySection.show();
        }
    
        $('.add-working-hours-btn').click(function () {
            if (dayIndex < dayOptions.length) {
                showAllDaySections();
            }
        });
    
        $(document).on('click', '.add-working-hours', function () {
            let day = $(this).data('day');
            let workingHoursOptions = $(`.${day.toLowerCase()}-options.day-section`);
    
            let workingHoursRow = `
                <div class="mb-2 row">
                    <div class="col-5">
                        <input type="time" class="form-control" name="${day.toLowerCase()}_start[]">
                    </div>
                    <div class="col-5">
                        <input type="time" class="form-control" name="${day.toLowerCase()}_end[]">
                    </div>
                    <div class="col-2">
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
    <script>
    // Mobile  No
    function numeralsOnly(evt) {
        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 46)) {
             const mon= document.getElementById('mobile_no');
             mon.style.border="1px solid red";
            return false;
        }else{
         const mon= document.getElementById('mobile_no');
             mon.style.border="none";
        return true;
        }
    }
    
    // Aadhar No 
    function numerOnly(evt) {
        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 46)) {
             const aadhar_no= document.getElementById('aadhar_no');
             aadhar_no.style.border="1px solid red";
            return false;
        }else{
         const mon= document.getElementById('mobile_no');
             mon.style.border="none";
        return true;
        }
    }

    const permanent_address = document.getElementById('permanent_address');
    const communication_address = document.getElementById('communication_address');
    const address_same = document.getElementById('address_same');
    
    function updateCommunicationAddress() {
        if (address_same.checked) {
            const permanentValue = permanent_address.value;
            const modifiedValue = permanentValue;
            communication_address.value = modifiedValue;
        }
    }
    
    address_same.addEventListener('change', updateCommunicationAddress);
    
    permanent_address.addEventListener('input', function() {
        if (address_same.checked) {
            updateCommunicationAddress();
        }
    });
    
    updateCommunicationAddress();

</script>
@endsection
