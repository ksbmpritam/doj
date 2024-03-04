@extends('restaurant_admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('restaurant/drivers/update/'.$driver->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.driver_plural')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
    				<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
    				<li class="breadcrumb-item"><a href= "{!! route('restaurant.drivers') !!}" >{{trans('lang.driver_plural')}}</a></li>
    				<li class="breadcrumb-item active">{{trans('lang.driver_edit')}}</li>
    			</ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link " href="{!! route('admin.drivers') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.driver_plural')}} List </a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a; border-radius: 2px;">
                                <a class="nav-link active" href="{{ url()->current() }}"><i class="fa fa-plus mr-2"></i>{{ trans('lang.driver_edit') }}</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                       
                        <div class="error_top"></div>

                        <div class="row restaurant_payout_create">
                            <div class="restaurant_payout_create-inner">
                                <fieldset>
                                    <legend>{{trans('lang.driver_details')}}</legend>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{ trans('lang.first_name') }}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control  @error('first_name') is-invalid @enderror" name="first_name" value="{{$driver->first_name}}">
                                            <small class="form-text text-muted">{{ trans('lang.first_name_help') }}</small>
                                        </div>
                                        <div class="col-2">
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.last_name')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{$driver->last_name}}">
                                            <div class="form-text text-muted">
                                                @error('last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Father's Name</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" value="{{$driver->father_name}}">
                                            <div class="form-text text-muted">
                                                @error('father_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.email')}}</label>
                                        <div class="col-7">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $driver->email }}">
                                            <div class="form-text text-muted">
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.user_phone')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$driver->phone}}">
                                            <div class="form-text text-muted">
                                                @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Address</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"  value="{{$driver->address}}">
                                            <div class="form-text text-muted">
                                                @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">State</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{$driver->state}}">
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">City</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{$driver->city}}">
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Pin Code</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control @error('pincode') is-invalid @enderror" name="pincode" value="{{$driver->pincode}}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Language</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control @error('language') is-invalid @enderror" name="language" value="{{ $driver->language}}">
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <div class="col-12">
                                            <h6>{{ trans("lang.know_your_cordinates") }}<a target="_blank" href="https://www.latlong.net/">{{ trans("lang.latitude_and_longitude_finder") }}</a></h6>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{ trans('lang.user_latitude') }}</label>
                                        <div class="col-7">
                                            <input type="number" class="form-control" name="latitude" step="any" value="{{$driver->latitude}}">
                                            <small class="form-text text-muted">{{ trans('lang.user_latitude_help') }}</small>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{ trans('lang.user_longitude') }}</label>
                                        <div class="col-7">
                                            <input type="number" class="form-control" name="longitude" step="any" value="{{$driver->longitude}}">
                                            <small class="form-text text-muted">{{ trans('lang.user_longitude_help') }}</small>
                                        </div>
                                    </div>


                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.profile_image')}}</label>
                                        <div class="col-7">
                                            <input type="file" class="" name="profile_image">
                                            <div class="form-text text-muted">{{trans('lang.profile_image_help')}}</div>
                                        </div>
                                       
                                    </div>
                                    
                                    <div class="form-group row width-50">
                                        <div class="col-7">
                                            <div id="uploding_image">
                                                <img src="{{ asset('images/driver/profile/' . $driver->profile_image) }}" width="100" height="100" alt="profile Photo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Work Area</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control" name="work_area" value="{{$driver->work_area}}">
                                            <small class="form-text text-muted">work area</small>
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Vehicle</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control" name="vehicle" value="{{$driver->vehicle}}">
                                            <small class="form-text text-muted">vehicle</small>
                                        </div>
                                    </div>

                                </fieldset>
                                <fieldset>
                                    <legend>{{trans('driver')}} Documents</legend>
                                    <div class="form-group row">
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Aadhar Number</label>
                                            <div class="col-7">
                                                <input type="number" class="form-control @error('aadhar_no') is-invalid @enderror" name="aadhar_no" value="{{$driver->aadhar_no}}">
                                                <small class="form-text text-muted">
                                                    @error('aadhar_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </small>

                                            </div>
                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Aadhar Image</label>
                                            <div class="col-7">
                                                <input type="file"  name="aadhar_image">
                                                <div class="form-text text-muted">Aadhar Image</div>
                                                <div id="uploding_image">
                                                    <img src="{{ asset('images/driver/document/' . $driver->aadhar_image) }}" width="100" height="100" alt="aadhar Photo">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">PAN Number</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control @error('pan_card_no') is-invalid @enderror" name="pan_card_no" value="{{$driver->pan_card_no}}">
                                                <small class="form-text text-muted">
                                                    @error('pan_card_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">PAN Card Image</label>
                                            <div class="col-7">
                                                <input type="file" class="" name="pancart_image">
                                                <div class="form-text text-muted">PAN Card Image</div>
                                            </div>
                                            <div id="uploding_image">
                                                <img src="{{ asset('images/driver/document/' . $driver->pancart_image) }}" width="100" height="100" alt="pancart Photo">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>{{trans('driver')}} Available</legend>
                                    <div class="form-group row">
                                        <div class="form-check width-100">
                                            <input type="checkbox" class="col-7 form-check-inline" value="1" id="user_active" name="available"  @if ($driver->available == 1 ) checked @endif > 
                                            <label class="col-3 control-label" for="user_active">{{trans('lang.available')}}</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>{{trans('driver')}} {{trans('lang.active_deactive')}}</legend>
                                    <div class="form-group row">

                                        <div class="form-group row width-50">
                                            <div class="form-check width-100">
                                                <input type="checkbox" id="is_active" value="1" name="status" @if ($driver->status == 1 ) checked @endif >
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
                                            <input type="text" class="form-control car_number" name="car_number" value="{{$driver->car_number}}">
                                            <div class="form-text text-muted">{{trans('lang.car_number_help')}}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.car_name')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control car_name" name="car_name" value="{{$driver->car_name}}">
                                            <div class="form-text text-muted">{{trans('lang.car_name_help')}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.car_image')}}</label>
                                        <div class="col-7">
                                            <input type="file" class="" name="car_image">
                                            <div class="form-text text-muted">{{trans('lang.car_image_help')}}</div>
                                        </div>
                                        <div id="uploding_image_car">
                                            <img src="{{ asset('images/driver/car_image/' . $driver->car_image) }}" width="100" height="100" alt="Car Images">
                                        </div>
                                    </div>

                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-12 text-center btm-btn">
            <button type="submit" class="btn btn-primary save_driver_btn"><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>
            <a href="{!! route('restaurant.drivers') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
        </div>

        </div>
    </form>
</div>
</div>


@endsection