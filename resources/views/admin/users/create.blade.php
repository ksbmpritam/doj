@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url('admin/users/insert')}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.user_plural')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('admin.users') !!}">{{trans('lang.user_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.user_create')}}</li>
            </ol>
        </div>

        <div class="card-body">

            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
            <div class="error_top"></div>

            <div class="row restaurant_payout_create">
                <div class="restaurant_payout_create-inner">
                    <fieldset>
                        <legend>{{trans('lang.user_details')}}</legend>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">User Name <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <input type="text" class="form-control user_first_name" name="name">
                                <div class="form-text text-muted">
                                    {{ trans("lang.user_name_help") }}
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.email')}} <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <input type="email" class="form-control user_email" name="email">
                                <div class="form-text text-muted">
                                    {{ trans("lang.user_email_help") }}
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.user_phone')}} <sup style="color:red;">*</sup></label>
                            <div class="col-7"> 
                                <input type="text" class="form-control user_phone" name="mobile_number"  maxlength="12" onkeypress="return numeralsOnly(event)">
                                <div class="form-text text-muted w-100">
                                    {{ trans("lang.user_phone_help") }}
                                    @if ($errors->has('mobile_number'))
                                        <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">Gender <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <select class="col-7 form-control" name="gender">
                                    <option value="" >Select gender</option>
                                    <option value="Male" >Male</option>
                                    <option value="Female" >Female</option>
                                </select>
                                <div class="form-text text-muted w-100">
                                    Enter Gender
                                    @if ($errors->has('gender'))
                                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">Dob <sup style="color:red;">*</sup></label>
                            <div class="col-7"> 
                                <input type="date" class="form-control" name="dob">
                                <div class="form-text text-muted w-100">
                                    Enter dob
                                    @if ($errors->has('dob'))
                                        <span class="text-danger">{{ $errors->first('dob') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.restaurant_image')}}</label>
                            <input type="file"class="col-7" name="profile_image">
                            <div class="placeholder_img_thumb user_image"></div>
                            <div id="uploding_image"></div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>{{trans('user')}} {{trans('lang.active_deactive')}}</legend>
                        <div class="form-group row">

                            <div class="form-group row width-50">
                                <div class="form-check width-100">
                                    <input type="checkbox" class="user_active" value="1" id="user_status" name="status">
                                    <label class="col-3 control-label" for="user_status">{{trans('lang.active')}}</label>
                                </div>
                            </div>

                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>{{trans('lang.address')}}</legend>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">Address <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <input type="text" class="form-control" name="address">
                                <div class="form-text text-muted w-100">
                                    Enter Address
                                    @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="form-group row width-100">
                            <div class="col-12">
                                <h6>{{ trans("lang.know_your_cordinates") }} <a target="_blank" href="https://www.latlong.net/"> {{ trans("lang.latitude_and_longitude_finder") }} </a> </h6>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.user_latitude')}} <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <input type="text" class="form-control user_latitude" name="latitude">
                                <div class="form-text text-muted w-100">
                                    {{ trans("lang.user_latitude_help") }}
                                    @if ($errors->has('latitude'))
                                        <span class="text-danger">{{ $errors->first('latitude') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.user_longitude')}} <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <input type="text" class="form-control user_longitude" name="longitude">
                                <div class="form-text text-muted w-100">
                                    {{ trans("lang.user_longitude_help") }}
                                    @if ($errors->has('longitude'))
                                        <span class="text-danger">{{ $errors->first('longitude') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </fieldset>
                </div>
            </div>
            
            <div class="form-group col-12 text-center btm-btn">
                <button type="submit" class="btn btn-primary save_category_btn"><i class="fa fa-save"></i>{{trans('lang.save')}}</button>
                <a href="{!! route('admin.users') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
            </div>
        </div>

    </div>
    </form>
</div>

</div>

@endsection
@section('scripts')
<script>
  function numeralsOnly(evt) {
        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 46)) {
            return false;
        }
        return true;
    }

</script>
@endsection