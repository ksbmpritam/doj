@extends('restaurant_admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('restaurant/drivers/insert')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.driver_plural')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('restaurant/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('restaurant.drivers') !!}">{{trans('lang.driver_plural')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.driver_edit')}}</li>
                </ol>
            </div>
        </div>

        <div class="card-body">

            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
            <div class="error_top"></div>

            <div class="row restaurant_payout_create">
                <div class="restaurant_payout_create-inner">
                    <fieldset>
                        <legend>{{trans('lang.driver_details')}}</legend>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.first_name')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control user_first_name" name="first_name">
                                <div class="form-text text-muted">{{trans('lang.first_name_help')}}
                                @error('first_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.last_name')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control user_last_name" name="last_name">
                                <div class="form-text text-muted">{{trans('lang.last_name_help')}}
                                    @error('last_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.email')}}</label>
                            <div class="col-7">
                                <input type="email" class="form-control user_email" name="email">
                                <div class="form-text text-muted">{{trans('lang.user_email_help')}}
                                @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.password')}}</label>
                            <div class="col-7">
                                <input type="password" class="form-control user_password" name="password">
                                <div class="form-text text-muted">{{trans('lang.user_password_help')}}
                                @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.user_phone')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control user_phone" name="phone">
                                <div class="form-text text-muted">
                                    {{trans('lang.user_phone_help')}}
                                    @error('phone')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">Address</label>
                            <div class="col-7">
                                <input type="text" class="form-control user_phone" name="address">
                                 <div class="form-text text-muted">
                                    @error('address')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">State</label>
                            <div class="col-7">
                                <input type="text" class="form-control user_phone" name="state">
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">City</label>
                            <div class="col-7">
                                <input type="text" class="form-control user_phone" name="city">
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">Pin Code</label>
                            <div class="col-7">
                                <input type="text" class="form-control user_phone" name="pincode">
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.profile_image')}}</label>
                            <div class="col-7">
                                <input type="file" class="" name="profile_image">
                                <div class="form-text text-muted">{{trans('lang.profile_image_help')}}</div>
                            </div>
                            <div class="placeholder_img_thumb user_image"></div>
                            <div id="uploding_image"></div>
                        </div>

                        <div class="form-check width-100">
                            <input type="hidden" name="available" value="0">
                            <input type="checkbox" class="col-7 form-check-inline user_active" id="user_active" name="available" value="1">
                            <label class="col-3 control-label" for="user_active">{{trans('lang.available')}}</label>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>{{trans('driver')}} {{trans('lang.active_deactive')}}</legend>
                        <div class="form-group row">

                            <div class="form-group row width-50">
                                <div class="form-check width-100">
                                    <input type="hidden" name="status" value="0">
                                    <input type="checkbox" id="is_active" name="status" value="1">
                                    <label class="col-3 control-label" for="is_active">{{trans('lang.active')}}</label>
                                </div>
                            </div>

                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>{{trans('lang.car_details')}}</legend>
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.car_number')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control car_number" name="car_number">
                                <div class="form-text text-muted">{{trans('lang.car_number_help')}}
                                @error('car_number')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.car_name')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control car_name" name="car_name">
                                <div class="form-text text-muted">{{trans('lang.car_name_help')}}</div>
                            </div>
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.car_image')}}</label>
                            <div class="col-7">
                                <input type="file" onChange="handleFileSelectcar(event)" class="" name="car_image">
                                <div class="form-text text-muted">{{trans('lang.car_image_help')}}</div>
                            </div>
                            <div class="placeholder_img_thumb car_image">
                            </div>
                            <div id="uploding_image_car"></div>
                        </div>

                    </fieldset>
                </div>
            </div>
        </div>

        <div class="form-group col-12 text-center btm-btn">
            <button type="submit" class="btn btn-primary save_driver_btn"><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>
            <a href="{!! route('restaurant.drivers') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
        </div>

    </form>
</div>
</div>


@endsection