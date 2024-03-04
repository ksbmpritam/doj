@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
  <form action="{{ url ('team/rider/update/'.$driver->id)}}" method="post" enctype="multipart/form-data">
    <!--<form action="{{ url ('admin/employee/team/view/riderEdit/'.$driver->id)}}" method="post" enctype="multipart/form-data">-->
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Rider</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('franchies/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="#">{{trans('lang.driver_plural')}}</a></li>
                    <li class="breadcrumb-item active">Rider</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="menu-tab vendorMenuTab">
                        @include('admin.head_menu_team2')
                    </div>

                    <div class="card  pb-4">

                        <div class="card-header">
                            <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                                <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                    <a class="nav-link " href="{!! route('admin.employee.team.rider',['id' => $driver->team_id]) !!}"><i class="fa fa-list mr-2"></i>Rider List </a>
                                </li>
                                <li class="nav-item" style="border: 1px solid #ff683a; border-radius: 2px;">
                                    <a class="nav-link active" href="{{ url()->current() }}"><i class="fa fa-plus mr-2"></i>View Rider</a>
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
                                                <input type="text" class="form-control  @error('first_name') is-invalid @enderror" name="first_name" value="{{$driver->first_name}}" >
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
                                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{$driver->last_name}}" >
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
                                                <input type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" value="{{$driver->father_name}}" >
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
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $driver->email }}" >
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
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$driver->phone}}" readonly>
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
                                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{$driver->address}}" >
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
                                                <input type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{$driver->state}}" >
                                            </div>
                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">City</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{$driver->city}}" >
                                            </div>
                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Pin Code</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control @error('pincode') is-invalid @enderror" name="pincode" value="{{$driver->pincode}}" readonly>
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
                                                <input type="number" class="form-control" name="latitude" step="any" value="{{$driver->latitude}}" >
                                                <small class="form-text text-muted">{{ trans('lang.user_latitude_help') }}</small>
                                            </div>
                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{ trans('lang.user_longitude') }}</label>
                                            <div class="col-7">
                                                <input type="number" class="form-control" name="longitude" step="any" value="{{$driver->longitude}}" >
                                                <small class="form-text text-muted">{{ trans('lang.user_longitude_help') }}</small>
                                            </div>
                                        </div>


                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.profile_image')}}</label>
                                            <div class="col-7">
                                                <input type="file" class="" name="profile_image" >
                                                <div class="form-text text-muted">{{trans('lang.profile_image_help')}}</div>
                                            </div>

                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Work Area</label>
                                            <div class="col-7">
                                                <div id="uploding_image">
                                                    <img src="{{ asset('images/driver/profile/' . $driver->profile_image) }}" width="100" height="100" alt="profile Photo">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Work Area</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="work_area" value="{{$driver->work_area}}" >
                                                <small class="form-text text-muted">work area</small>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Vehicle</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="vehicle" value="{{$driver->vehicle}}" >
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
                                                    <input type="number" class="form-control @error('aadhar_no') is-invalid @enderror" name="aadhar_no" value="{{$driver->aadhar_no}}" >
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
                                                    <!--<input type="file"  name="aadhar_image">-->
                                                    <div class="form-text text-muted">Aadhar Image</div>
                                                    <div id="uploding_image">
                                                        <img src="{{ asset('images/driver/document/' . $driver->aadhar_image) }}" width="100" height="100" alt="aadhar Photo">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group row width-50">
                                                <label class="col-3 control-label">PAN Number</label>
                                                <div class="col-7">
                                                    <input type="text" class="form-control @error('pan_card_no') is-invalid @enderror" name="pan_card_no" value="{{$driver->pan_card_no}}" >
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
                                                    <!--<input type="file" class="" name="pancart_image">-->
                                                    <div class="form-text text-muted">PAN Card Image</div>
                                                </div>
                                                <div id="uploding_image">
                                                    <img src="{{ asset('images/driver/document/' . $driver->pancart_image) }}" width="100" height="100" alt="pancart Photo">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>{{ trans('Bank Details') }}</legend>

                                        {{-- Bank Name, Branch Name, Account Number, and Holder Name on the same line --}}
                                        <div class="form-group row width-50">
                                            <label for="bank_name" class="col-3 control-label">{{ trans('Bank Name') }}</label>
                                            <div class="col-12">
                                                <input type="text" id="bank_name" name="bank_name" class="form-control" value="{{ old('bank_name', $driver->bank_name) }}"  required>
                                                <small class="form-text text-muted">
                                                    @error('bank_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </small>
                                            </div>

                                            <label for="branch_name" class="col-3 control-label">{{ trans('Branch Name') }}</label>
                                            <div class="col-12">
                                                <input type="text" id="branch_name" name="branch_name" class="form-control" value="{{ old('branch_name', $driver->branch_name) }}"  required>
                                                <small class="form-text text-muted">
                                                    @error('branch_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>

                                        {{-- Account Number and Holder Name on the same line --}}
                                        <div class="form-group row width-50">
                                            <label for="account_number" class="col-3 control-label">Account Number</label>
                                            <div class="col-12">
                                                <input type="text" id="account_number" name="account_number" class="form-control"  value="{{ old('account_number', $driver->account_number) }}" required>
                                                <small class="form-text text-muted">
                                                    @error('account_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </small>
                                            </div>

                                            <label for="holder_name" class="col-3 control-label">Holder Name</label>
                                            <div class="col-12">
                                                <input type="text" id="holder_name" name="holder_name" class="form-control"  value="{{ old('holder_name', $driver->holder_name) }}" required>
                                                <small class="form-text text-muted">
                                                    @error('holder_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>

                                        {{-- IFSC Code --}}
                                        <div class="form-group row width-50">
                                            <label for="ifsc_code" class="col-3 control-label">IFSC Code</label>
                                            <div class="col-12">
                                                <input type="text" id="ifsc_code" name="ifsc_code" class="form-control"  value="{{ old('ifsc_code', $driver->ifsc_code) }}" required>
                                                <small class="form-text text-muted">
                                                    @error('ifsc_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>

                                        {{-- Other Information --}}
                                        <div class="form-group row width-50">
                                            <label for="other_information" class="col-3 control-label">Other Information</label>
                                            <div class="col-12">
                                                <textarea id="other_information" name="other_information"  class="form-control" rows="4">{{ old('other_information', $driver->other_information) }}</textarea>
                                                <small class="form-text text-muted">
                                                    @error('other_information')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>{{trans('driver')}} Available</legend>
                                        <div class="form-group row">
                                            <div class="form-check width-100">
                                                <input type="checkbox" class="col-7 form-check-inline" value="1" id="user_active" name="available" @if ($driver->available == 1 ) checked @endif disabled>
                                                <label class="col-3 control-label" for="user_active">{{trans('lang.available')}}</label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>{{trans('driver')}} {{trans('lang.active_deactive')}}</legend>
                                        <div class="form-group row">

                                            <div class="form-group row width-50">
                                                <div class="form-check width-100">
                                                    <input type="checkbox" id="is_active" value="1" name="status" @if ($driver->status == 1 ) checked @endif disabled>
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
                                                <input type="text" class="form-control car_number" name="car_number" value="{{$driver->car_number}}" >
                                                <div class="form-text text-muted">{{trans('lang.car_number_help')}}</div>
                                            </div>
                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.car_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control car_name" name="car_name" value="{{$driver->car_name}}" >
                                                <div class="form-text text-muted">{{trans('lang.car_name_help')}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.car_image')}}</label>
                                            <div class="col-7">
                                                <!--<input type="file" class="" name="car_image">-->
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
                <a href="{!! route('admin.employee.team.rider', ['id' => $driver->team_id]) !!}" class="btn btn-default"><i class="fa fa-undo"></i> Cancel</a> <!-- Updated the text for "Cancel" button -->
            </div>

        </div>
    </form>
</div>
</div>


@endsection