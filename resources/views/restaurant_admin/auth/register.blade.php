@include('restaurant_admin.auth.default')

{{--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

--}}
<div class="container">
        <div class="row page-titles ">

            <div class="col-md-12 align-self-center text-center">
                <h3 class="text-themecolor  ">{{trans('lang.sign_up_with_us')}}</h3>
            </div>
          {{--  <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{!! route('restaurants') !!}">{{trans('lang.restaurant_plural')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.create_restaurant')}}</li>
                </ol>
            </div>
            <div>--}}

                <div class="card-body">
                    <div id="data-table_processing" class="dataTables_processing panel panel-default"
                         style="display: none;">{{trans('lang.processing')}}
                    </div>
                    <div class="error_top"></div>
                    <div class="alert alert-success" style="display:none;"></div>
                    <div class="row restaurant_payout_create">
                        <div class="restaurant_payout_create-inner">
                            <form method="POST" action="{{ url('register/create') }}">
                                @csrf
                                <fieldset>
                                <legend>{{trans('lang.admin_area')}}</legend>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.first_name')}}</label>
                                    <div class="col-7">
                                        <input type="text" name="first_name" class="form-control user_first_name" required>
                                        <div class="form-text text-muted">
                                            {{ trans("lang.user_first_name_help") }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.last_name')}}</label>
                                    <div class="col-7">
                                        <input type="text" name="last_name" class="form-control user_last_name">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.user_last_name_help") }}
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.email')}}</label>
                                    <div class="col-7">
                                        <input type="email" name="email" class="form-control user_email" required>
                                        <div class="form-text text-muted">
                                            {{ trans("lang.user_email_help") }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.password')}}</label>
                                    <div class="col-7">
                                        <input type="password" name="password" class="form-control user_password" required>
                                        <div class="form-text text-muted">
                                            {{ trans("lang.user_password_help") }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.user_phone')}}</label>
                                    <div class="col-7">
                                        <input type="text" name="phone" class="form-control user_phone">
                                        <div class="form-text text-muted w-50">
                                            {{ trans("lang.user_phone_help") }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_image')}}</label>
                                    <input type="file" onChange="handleFileSelectowner(event)" class="col-7">
                                    <div id="uploding_image_owner"></div>
                                    <div class="uploaded_image_owner" style="display:none;"><img
                                                id="uploaded_image_owner"
                                                src="" width="150px"
                                                height="150px;"></div>
                                </div>

                                <div class="form-group row width-100">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </fieldset>

                            <!--<fieldset>-->
                            <!--    <legend>{{trans('lang.restaurant_details')}}</legend>-->

                            <!--    <div class="form-group row width-50">-->
                            <!--        <label class="col-3 control-label">{{trans('lang.restaurant_name')}}</label>-->
                            <!--        <div class="col-7">-->
                            <!--            <input type="text" class="form-control restaurant_name" required>-->
                            <!--            <div class="form-text text-muted">-->
                            <!--                {{ trans("lang.restaurant_name_help") }}-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->

                            <!--    <div class="form-group row width-50">-->
                            <!--        <label class="col-3 control-label">{{trans('lang.category')}}</label>-->
                            <!--        <div class="col-7">-->
                            <!--            <select id='restaurant_cuisines' class="form-control" required>-->
                            <!--                <option value="">{{ trans("lang.select_cuisines") }}</option>-->
                            <!--            </select>-->
                            <!--            <div class="form-text text-muted">-->
                            <!--                {{ trans("lang.restaurant_cuisines_help") }}-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->

                            <!--    <div class="form-group row width-50">-->
                            <!--        <label class="col-3 control-label">{{trans('lang.restaurant_phone')}}</label>-->
                            <!--        <div class="col-7">-->
                            <!--            <input type="text" class="form-control restaurant_phone" required>-->
                            <!--            <div class="form-text text-muted">-->
                            <!--                {{ trans("lang.restaurant_phone_help") }}-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->

                            <!--    <div class="form-group row width-50">-->
                            <!--        <label class="col-3 control-label">{{trans('lang.restaurant_address')}}</label>-->
                            <!--        <div class="col-7">-->
                            <!--            <input type="text" class="form-control restaurant_address" required>-->
                            <!--            <div class="form-text text-muted">-->
                            <!--                {{ trans("lang.restaurant_address_help") }}-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->

                            <!--    <div class="form-group row width-100">-->
                            <!--        <div class="col-12">-->
                            <!--            <h6>* Don't Know your cordinates ? use <a target="_blank"-->
                            <!--                                                      href="https://www.latlong.net/">Latitude-->
                            <!--                    and Longitude Finder</a></h6>-->
                            <!--        </div>-->
                            <!--    </div>-->

                            <!--    <div class="form-group row width-50">-->
                            <!--        <label class="col-3 control-label">{{trans('lang.restaurant_latitude')}}</label>-->
                            <!--        <div class="col-7">-->
                            <!--            <input class="form-control restaurant_latitude" type="number" min="-90"-->
                            <!--                   max="90">-->
                            <!--            <div class="form-text text-muted">-->
                            <!--                {{ trans("lang.restaurant_latitude_help") }}-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->

                            <!--    <div class="form-group row width-50">-->
                            <!--        <label class="col-3 control-label">{{trans('lang.restaurant_longitude')}}</label>-->
                            <!--        <div class="col-7">-->
                            <!--            <input class="form-control restaurant_longitude" type="number" min="-180"-->
                            <!--                   max="180">-->
                            <!--            <div class="form-text text-muted">-->
                            <!--                {{ trans("lang.restaurant_longitude_help") }}-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->

                            <!--    <div class="form-group row width-50">-->
                            <!--        <label class="col-3 control-label">{{trans('lang.restaurant_image')}}</label>-->
                            <!--        <div class="col-7">-->
                            <!--            <input type="file" onChange="handleFileSelect(event,'photo')">-->
                            <!--            <div id="uploding_image_restaurant"></div>-->
                            <!--            <div class="uploaded_image" style="display:none;"><img id="uploaded_image"-->
                            <!--                                                                   src=""-->
                            <!--                                                                   width="150px"-->
                            <!--                                                                   height="150px;"></div>-->
                            <!--            <div class="form-text text-muted">-->
                            <!--                {{ trans("lang.restaurant_image_help") }}-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->

                            <!--    <div class="form-group row width-100">-->
                            <!--        <label class="col-3 control-label ">{{trans('lang.restaurant_description')}}</label>-->
                            <!--        <div class="col-7">-->
                            <!--        <textarea rows="7" class="restaurant_description form-control"-->
                            <!--                  id="restaurant_description"></textarea>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</fieldset>-->

                            <!--<fieldset>-->
                            <!--    <legend>{{trans('lang.gallery')}}</legend>-->

                            <!--    <div class="form-group row width-50 restaurant_image">-->
                            <!--        <div class="">-->
                            <!--            <div id="photos"></div>-->
                            <!--        </div>-->
                            <!--    </div>-->

                            <!--    <div class="form-group row">-->
                            <!--        <div>-->
                            <!--            <input type="file" onChange="handleFileSelect(event,'photos')">-->
                            <!--            <div id="uploding_image_photos"></div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</fieldset>-->

                            <!--<fieldset>-->
                            <!--    <legend>{{trans('lang.services')}}</legend>-->

                            <!--    <div class="form-group row">-->

                            <!--        <div class="form-check width-100">-->
                            <!--            <input type="checkbox" id="Free_Wi_Fi">-->
                            <!--            <label class="col-3 control-label"-->
                            <!--                   for="Free_Wi_Fi">{{trans('lang.free_wi_fi')}}</label>-->
                            <!--        </div>-->
                            <!--        <div class="form-check width-100">-->
                            <!--            <input type="checkbox" id="Good_for_Breakfast">-->
                            <!--            <label class="col-3 control-label"-->
                            <!--                   for="Good_for_Breakfast">{{trans('lang.good_for_breakfast')}}</label>-->
                            <!--        </div>-->
                            <!--        <div class="form-check width-100">-->
                            <!--            <input type="checkbox" id="Good_for_Dinner">-->
                            <!--            <label class="col-3 control-label"-->
                            <!--                   for="Good_for_Dinner">{{trans('lang.good_for_dinner')}}</label>-->
                            <!--        </div>-->
                            <!--        <div class="form-check width-100">-->
                            <!--            <input type="checkbox" id="Good_for_Lunch">-->
                            <!--            <label class="col-3 control-label"-->
                            <!--                   for="Good_for_Lunch">{{trans('lang.good_for_lunch')}}</label>-->
                            <!--        </div>-->

                            <!--        <div class="form-check width-100">-->
                            <!--            <input type="checkbox" id="Live_Music">-->
                            <!--            <label class="col-3 control-label"-->
                            <!--                   for="Live_Music">{{trans('lang.live_music')}}</label>-->
                            <!--        </div>-->

                            <!--        <div class="form-check width-100">-->
                            <!--            <input type="checkbox" id="Outdoor_Seating">-->
                            <!--            <label class="col-3 control-label"-->
                            <!--                   for="Outdoor_Seating">{{trans('lang.outdoor_seating')}}</label>-->
                            <!--        </div>-->

                            <!--        <div class="form-check width-100">-->
                            <!--            <input type="checkbox" id="Takes_Reservations">-->
                            <!--            <label class="col-3 control-label"-->
                            <!--                   for="Takes_Reservations">{{trans('lang.takes_reservations')}}</label>-->
                            <!--        </div>-->

                            <!--        <div class="form-check width-100">-->
                            <!--            <input type="checkbox" id="Vegetarian_Friendly">-->
                            <!--            <label class="col-3 control-label"-->
                            <!--                   for="Vegetarian_Friendly">{{trans('lang.vegetarian_friendly')}}</label>-->
                            <!--        </div>-->

                            <!--    </div>-->
                            <!--</fieldset>-->

                            <!--<fieldset>-->
                            <!--    <legend>{{trans('lang.working_hours')}}</legend>-->

                            <!--    <div class="form-group row">-->

                            <!--        <div class="form-group row width-100">-->
                            <!--            <div class="col-7">-->
                            <!--                <button type="button"-->
                            <!--                        class="btn btn-primary  add_working_hours_restaurant_btn">-->
                            <!--                    <i></i>{{trans('lang.add_working_hours')}}-->
                            <!--                </button>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--        <div class="working_hours_div" style="display:none">-->


                            <!--            <div class="form-group row">-->
                            <!--                <label class="col-1 control-label">{{trans('lang.sunday')}}</label>-->
                            <!--                <div class="col-12">-->
                            <!--                    <button type="button" class="btn btn-primary add_more_sunday"-->
                            <!--                            onclick="addMorehour('Sunday','sunday', '1')">-->
                            <!--                        {{trans('lang.add_more')}}-->
                            <!--                    </button>-->
                            <!--                </div>-->
                            <!--            </div>-->


                            <!--            <div class="restaurant_discount_options_Sunday_div restaurant_discount"-->
                            <!--                 style="display:none">-->


                            <!--                <table class="booking-table" id="working_hour_table_Sunday">-->
                            <!--                    <tr>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.from')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.to')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>-->
                            <!--                        </th>-->
                            <!--                    </tr>-->

                            <!--                </table>-->

                            <!--            </div>-->

                            <!--            <div class="form-group row">-->
                            <!--                <label class="col-1 control-label">{{trans('lang.monday')}}</label>-->
                            <!--                <div class="col-12">-->
                            <!--                    <button type="button" class="btn btn-primary add_more_sunday"-->
                            <!--                            onclick="addMorehour('Monday','monday', '1')">-->
                            <!--                        {{trans('lang.add_more')}}-->
                            <!--                    </button>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="restaurant_discount_options_Monday_div restaurant_discount"-->
                            <!--                 style="display:none">-->

                            <!--                <table class="booking-table" id="working_hour_table_Monday">-->
                            <!--                    <tr>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.from')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.to')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>-->
                            <!--                        </th>-->
                            <!--                    </tr>-->
                            <!--                </table>-->
                            <!--            </div>-->
                            <!--            <div class="form-group row">-->
                            <!--                <label class="col-1 control-label">{{trans('lang.tuesday')}}</label>-->
                            <!--                <div class="col-12">-->
                            <!--                    <button type="button" class="btn btn-primary"-->
                            <!--                            onclick="addMorehour('Tuesday','tuesday', '1')">-->
                            <!--                        {{trans('lang.add_more')}}-->
                            <!--                    </button>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="restaurant_discount_options_Tuesday_div restaurant_discount"-->
                            <!--                 style="display:none">-->

                            <!--                <table class="booking-table" id="working_hour_table_Tuesday">-->
                            <!--                    <tr>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.from')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.to')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>-->
                            <!--                        </th>-->
                            <!--                    </tr>-->

                            <!--                </table>-->
                            <!--            </div>-->
                            <!--            <div class="form-group row">-->
                            <!--                <label class="col-1 control-label">{{trans('lang.wednesday')}}</label>-->
                            <!--                <div class="col-12">-->
                            <!--                    <button type="button" class="btn btn-primary"-->
                            <!--                            onclick="addMorehour('Wednesday','wednesday', '1')">-->
                            <!--                        {{trans('lang.add_more')}}-->
                            <!--                    </button>-->
                            <!--                </div>-->
                            <!--            </div>-->


                            <!--            <div class="restaurant_discount_options_Wednesday_div restaurant_discount"-->
                            <!--                 style="display:none">-->
                            <!--                <table class="booking-table" id="working_hour_table_Wednesday">-->
                            <!--                    <tr>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.from')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.to')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>-->
                            <!--                        </th>-->
                            <!--                    </tr>-->

                            <!--                </table>-->
                            <!--            </div>-->

                            <!--            <div class="form-group row">-->
                            <!--                <label class="col-1 control-label">{{trans('lang.thursday')}}</label>-->
                            <!--                <div class="col-12">-->
                            <!--                    <button type="button" class="btn btn-primary"-->
                            <!--                            onclick="addMorehour('Thursday','thursday', '1')">-->
                            <!--                        {{trans('lang.add_more')}}-->
                            <!--                    </button>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="restaurant_discount_options_Thursday_div restaurant_discount"-->
                            <!--                 style="display:none">-->
                            <!--                <table class="booking-table" id="working_hour_table_Thursday">-->
                            <!--                    <tr>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.from')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.to')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>-->
                            <!--                        </th>-->
                            <!--                    </tr>-->

                            <!--                </table>-->
                            <!--            </div>-->

                            <!--            <div class="form-group row">-->
                            <!--                <label class="col-1 control-label">{{trans('lang.friday')}}</label>-->
                            <!--                <div class="col-12">-->
                            <!--                    <button type="button" class="btn btn-primary"-->
                            <!--                            onclick="addMorehour('Friday','friday', '1')">-->
                            <!--                        {{trans('lang.add_more')}}-->
                            <!--                    </button>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="restaurant_discount_options_Friday_div restaurant_discount"-->
                            <!--                 style="display:none">-->
                            <!--                <table class="booking-table" id="working_hour_table_Friday">-->
                            <!--                    <tr>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.from')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.to')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>-->
                            <!--                        </th>-->
                            <!--                    </tr>-->

                            <!--                </table>-->
                            <!--            </div>-->


                            <!--            <div class="form-group row">-->
                            <!--                <label class="col-1 control-label">{{trans('lang.satuarday')}}</label>-->
                            <!--                <div class="col-12">-->
                            <!--                    <button type="button" class="btn btn-primary"-->
                            <!--                            onclick="addMorehour('Satuarday','satuarday','1')">-->
                            <!--                        {{trans('lang.add_more')}}-->
                            <!--                    </button>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--            <div class="restaurant_discount_options_Satuarday_div restaurant_discount"-->
                            <!--                 style="display:none">-->
                            <!--                <table class="booking-table" id="working_hour_table_Satuarday">-->
                            <!--                    <tr>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.from')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.to')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>-->
                            <!--                        </th>-->
                            <!--                    </tr>-->
                            <!--                </table>-->
                            <!--            </div>-->
                            <!--        </div>-->

                            <!--    </div>-->
                            <!--</fieldset>-->

                          <!--{{--  <fieldset>-->
                          <!--      <legend>{{trans('lang.restaurant_status')}}</legend>-->

                          <!--      <div class="form-group row">-->

                          <!--          <div class="form-group row width-50">-->
                          <!--              <div class="form-check width-100">-->
                          <!--                  <input type="checkbox" id="is_open">-->
                          <!--                  <label class="col-3 control-label"-->
                          <!--                         for="is_open">{{trans('lang.Is_Open')}}</label>-->
                          <!--              </div>-->
                          <!--          </div>-->

                          <!--      </div>-->
                          <!--  </fieldset>--}}-->

                           <!--{{-- <fieldset>-->
                           <!--     <legend>{{trans('restaurant')}} {{trans('lang.active_deactive')}}</legend>-->
                           <!--     <div class="form-group row">-->

                           <!--         <div class="form-group row width-50">-->
                           <!--             <div class="form-check width-100">-->
                           <!--                 <input type="checkbox" id="is_active">-->
                           <!--                 <label class="col-3 control-label"-->
                           <!--                        for="is_active">{{trans('lang.active')}}</label>-->
                           <!--             </div>-->
                           <!--         </div>-->

                           <!--     </div>-->
                           <!-- </fieldset> --}}-->

                            <!--<fieldset>-->
                            <!--    <legend>{{trans('lang.dine_in_future_setting')}}</legend>-->

                            <!--    <div class="form-group row">-->

                            <!--        <div class="form-group row width-100">-->
                            <!--            <div class="form-check width-100">-->
                            <!--                <input type="checkbox" id="dine_in_feature" class="">-->
                            <!--                <label class="col-3 control-label"-->
                            <!--                       for="dine_in_feature">{{trans('lang.enable_dine_in_feature')}}</label>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--        <div class="divein_div" style="display:none">-->


                            <!--            <div class="form-group row width-50">-->
                            <!--                <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>-->
                            <!--                <div class="col-7">-->
                            <!--                    <input type="time" class="form-control" id="openDineTime" required>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="form-group row width-50">-->
                            <!--                <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>-->
                            <!--                <div class="col-7">-->
                            <!--                    <input type="time" class="form-control" id="closeDineTime" required>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="form-group row width-50">-->
                            <!--                <label class="col-3 control-label">Cost</label>-->
                            <!--                <div class="col-7">-->
                            <!--                    <input type="number" class="form-control restaurant_cost" required>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--            <div class="form-group row width-100 restaurant_image">-->
                            <!--                <label class="col-3 control-label">Menu Card Images</label>-->
                            <!--                <div class="">-->
                            <!--                    <div id="photos_menu_card"></div>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--            <div class="form-group row">-->
                            <!--                <div>-->
                            <!--                    <input type="file" onChange="handleFileSelectMenuCard(event)">-->
                            <!--                    <div id="uploaded_image_menu"></div>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </div>-->

                            <!--    </div>-->
                            <!--</fieldset>-->

                            <!--<fieldset>-->
                            <!--    <legend>{{trans('lang.deliveryCharge')}}</legend>-->

                            <!--    <div class="form-group row">-->

                            <!--        <div class="form-group row width-100">-->
                            <!--            <label class="col-4 control-label">{{trans('lang.delivery_charges_per_km')}}</label>-->
                            <!--            <div class="col-7">-->
                            <!--                <input type="number" class="form-control" id="delivery_charges_per_km">-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--        <div class="form-group row width-100">-->
                            <!--            <label class="col-4 control-label">{{trans('lang.minimum_delivery_charges')}}</label>-->
                            <!--            <div class="col-7">-->
                            <!--                <input type="number" class="form-control" id="minimum_delivery_charges">-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--        <div class="form-group row width-100">-->
                            <!--            <label class="col-4 control-label">{{trans('lang.minimum_delivery_charges_within_km')}}</label>-->
                            <!--            <div class="col-7">-->
                            <!--                <input type="number" class="form-control"-->
                            <!--                       id="minimum_delivery_charges_within_km">-->
                            <!--            </div>-->
                            <!--        </div>-->

                            <!--    </div>-->
                            <!--</fieldset>-->
                            <!--<fieldset>-->
                            <!--    <legend>{{trans('lang.special_offer')}}</legend>-->

                            <!--    <div class="form-group row">-->

                            <!--        <div class="form-group row width-100">-->
                            <!--            <div class="col-7">-->
                            <!--                <button type="button"-->
                            <!--                        class="btn btn-primary  add_special_offer_restaurant_btn">-->
                            <!--                    <i></i>{{trans('lang.add_special_offer')}}-->
                            <!--                </button>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--        <div class="special_offer_div" style="display:none">-->


                            <!--            <div class="form-group row">-->
                            <!--                <label class="col-1 control-label">{{trans('lang.sunday')}}</label>-->
                            <!--                <div class="col-12">-->
                            <!--                    <button type="button" class="btn btn-primary add_more_sunday"-->
                            <!--                            onclick="addMoreButton('Sunday','sunday', '1')">-->
                            <!--                        {{trans('lang.add_more')}}-->
                            <!--                    </button>-->
                            <!--                </div>-->
                            <!--            </div>-->


                            <!--            <div class="restaurant_discount_options_Sunday_div restaurant_discount"-->
                            <!--                 style="display:none">-->


                            <!--                <table class="booking-table" id="special_offer_table_Sunday">-->
                            <!--                    <tr>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}-->
                            <!--                                {{trans('lang.type')}}</label></th>-->

                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>-->
                            <!--                        </th>-->
                            <!--                    </tr>-->

                            <!--                </table>-->

                            <!--            </div>-->

                            <!--            <div class="form-group row">-->
                            <!--                <label class="col-1 control-label">{{trans('lang.monday')}}</label>-->
                            <!--                <div class="col-12">-->
                            <!--                    <button type="button" class="btn btn-primary add_more_sunday"-->
                            <!--                            onclick="addMoreButton('Monday','monday', '1')">-->
                            <!--                        {{trans('lang.add_more')}}-->
                            <!--                    </button>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="restaurant_discount_options_Monday_div restaurant_discount"-->
                            <!--                 style="display:none">-->

                            <!--                <table class="booking-table" id="special_offer_table_Monday">-->
                            <!--                    <tr>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}-->
                            <!--                                {{trans('lang.type')}}</label></th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>-->
                            <!--                        </th>-->
                            <!--                    </tr>-->
                            <!--                </table>-->
                            <!--            </div>-->
                            <!--            <div class="form-group row">-->
                            <!--                <label class="col-1 control-label">{{trans('lang.tuesday')}}</label>-->
                            <!--                <div class="col-12">-->
                            <!--                    <button type="button" class="btn btn-primary"-->
                            <!--                            onclick="addMoreButton('Tuesday','tuesday', '1')">-->
                            <!--                        {{trans('lang.add_more')}}-->
                            <!--                    </button>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="restaurant_discount_options_Tuesday_div restaurant_discount"-->
                            <!--                 style="display:none">-->

                            <!--                <table class="booking-table" id="special_offer_table_Tuesday">-->
                            <!--                    <tr>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}-->
                            <!--                                {{trans('lang.type')}}</label></th>-->

                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>-->
                            <!--                        </th>-->
                            <!--                    </tr>-->

                            <!--                </table>-->
                            <!--            </div>-->
                            <!--            <div class="form-group row">-->
                            <!--                <label class="col-1 control-label">{{trans('lang.wednesday')}}</label>-->
                            <!--                <div class="col-12">-->
                            <!--                    <button type="button" class="btn btn-primary"-->
                            <!--                            onclick="addMoreButton('Wednesday','wednesday', '1')">-->
                            <!--                        {{trans('lang.add_more')}}-->
                            <!--                    </button>-->
                            <!--                </div>-->
                            <!--            </div>-->


                            <!--            <div class="restaurant_discount_options_Wednesday_div restaurant_discount"-->
                            <!--                 style="display:none">-->
                            <!--                <table class="booking-table" id="special_offer_table_Wednesday">-->
                            <!--                    <tr>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}-->
                            <!--                                {{trans('lang.type')}}</label></th>-->

                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>-->
                            <!--                        </th>-->
                            <!--                    </tr>-->

                            <!--                </table>-->
                            <!--            </div>-->

                            <!--            <div class="form-group row">-->
                            <!--                <label class="col-1 control-label">{{trans('lang.thursday')}}</label>-->
                            <!--                <div class="col-12">-->
                            <!--                    <button type="button" class="btn btn-primary"-->
                            <!--                            onclick="addMoreButton('Thursday','thursday', '1')">-->
                            <!--                        {{trans('lang.add_more')}}-->
                            <!--                    </button>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="restaurant_discount_options_Thursday_div restaurant_discount"-->
                            <!--                 style="display:none">-->
                            <!--                <table class="booking-table" id="special_offer_table_Thursday">-->
                            <!--                    <tr>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}-->
                            <!--                                {{trans('lang.type')}}</label></th>-->

                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>-->
                            <!--                        </th>-->
                            <!--                    </tr>-->

                            <!--                </table>-->
                            <!--            </div>-->

                            <!--            <div class="form-group row">-->
                            <!--                <label class="col-1 control-label">{{trans('lang.friday')}}</label>-->
                            <!--                <div class="col-12">-->
                            <!--                    <button type="button" class="btn btn-primary"-->
                            <!--                            onclick="addMoreButton('Friday','friday', '1')">-->
                            <!--                        {{trans('lang.add_more')}}-->
                            <!--                    </button>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="restaurant_discount_options_Friday_div restaurant_discount"-->
                            <!--                 style="display:none">-->
                            <!--                <table class="booking-table" id="special_offer_table_Friday">-->
                            <!--                    <tr>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}-->
                            <!--                                {{trans('lang.type')}}</label></th>-->

                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>-->
                            <!--                        </th>-->
                            <!--                    </tr>-->

                            <!--                </table>-->
                            <!--            </div>-->


                            <!--            <div class="form-group row">-->
                            <!--                <label class="col-1 control-label">{{trans('lang.satuarday')}}</label>-->
                            <!--                <div class="col-12">-->
                            <!--                    <button type="button" class="btn btn-primary"-->
                            <!--                            onclick="addMoreButton('Satuarday','satuarday','1')">-->
                            <!--                        {{trans('lang.add_more')}}-->
                            <!--                    </button>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--            <div class="restaurant_discount_options_Satuarday_div restaurant_discount"-->
                            <!--                 style="display:none">-->
                            <!--                <table class="booking-table" id="special_offer_table_Satuarday">-->
                            <!--                    <tr>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>-->
                            <!--                        </th>-->
                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}-->
                            <!--                                {{trans('lang.type')}}</label></th>-->

                            <!--                        <th>-->
                            <!--                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>-->
                            <!--                        </th>-->
                            <!--                    </tr>-->
                            <!--                </table>-->
                            <!--            </div>-->
                            <!--        </div>-->

                            <!--    </div>-->

                            <!--</fieldset>-->
                            </form>
                        </div>
                    </div>
                </div>


                <div class="form-group col-12 text-center">
                    <!--<button type="button" class="btn btn-primary  create_restaurant_btn"><i class="fa fa-save"></i>-->
                    <!--    {{trans('lang.save')}}-->
                    <!--</button>-->
                      
                    <div class="or-line mb-4 ">
                        <span>OR</span>
                    </div>

                    <div class="new-acc d-flex align-items-center justify-content-center">

                        <a href="{{route('restaurant.register.phone')}}" class="btn btn-primary" id="btn-signup-phone">

                              <i class="fa fa-phone"> </i> {{trans('lang.signup_with_phone')}}

                        </a>

                    </div>
                    <a href="{{route('login')}}">

                    <p class="text-center m-0">  {{trans('lang.already_an_account')}}  {{trans('lang.sign_in')}}</p>

                </a>
                </div>


            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/compressorjs/1.1.1/compressor.min.js"
        integrity="sha512-VaRptAfSxXFAv+vx33XixtIVT9A/9unb1Q8fp63y1ljF+Sbka+eMJWoDAArdm7jOYuLQHVx5v60TQ+t3EA8weA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-database.js"></script>
<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
<script type="text/javascript">@include('vendor.notifications.init_firebase')</script>

