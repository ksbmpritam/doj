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
		<div>

			<div class="card-body">

				<div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

        <div class="row daes-top-sec mb-3">

        <div class="col-lg-6 col-md-6">

          <!--<a href="{{route('restaurant.drivers')}}?driverId={{$id}}">-->

           <div class="card">

            <div class="flex-row">

              <div class="p-10 bg-info col-md-12 text-center">

                <h3 class="text-white box m-b-0"><i class="mdi mdi-cart"></i></h3></div>

                <div class="align-self-center pt-3 col-md-12 text-center">

                  <h3 class="m-b-0 text-info" id="total_orders">{{$driver->order_total}}</h3>

                  <h5 class="text-muted m-b-0">{{trans('lang.dashboard_total_orders')}}</h5>

                </div>

              </div>

            </div>
          <!--</a>-->
        </div>

        <div class="col-lg-6 col-md-6">
            
            <div class="card">

            <div class="flex-row">

              <div class="p-10 bg-info col-md-12 text-center">

                <h3 class="text-white box m-b-0"><i class="mdi 	mdi-currency-inr"></i></h3></div>

                <div class="align-self-center pt-3 col-md-12 text-center">

                  <h3 class="m-b-0 text-info" id="total_orders">{{$driver->wallet}}</h3>

                  <h5 class="text-muted m-b-0">{{trans('lang.total_amount')}}</h5>

                </div>

              </div>

            </div>
          
          </div>

        </div>

				<div class="error_top"></div>
				<div class="row restaurant_payout_create">
              <div class="restaurant_payout_create-inner">
                <fieldset>
                  <legend>{{trans('lang.driver_details')}}</legend>
							<div class="form-group row width-50">
	              <label class="col-3 control-label">{{trans('lang.first_name')}}</label>
                <div class="col-7">
  	              <input type="text" class="form-control user_first_name" value="{{$driver->first_name}}" name="first_name" required>
                  <div class="form-text text-muted">{{trans('lang.first_name_help')}}</div>
                </div>
	            </div>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.last_name')}}</label>
                <div class="col-7">
                  <input type="text" class="form-control user_last_name" value="{{$driver->last_name}}" name="last_name" required>
                  <div class="form-text text-muted">{{trans('lang.last_name_help')}}</div>
                </div>
              </div>

	            <div class="form-group row width-50">
	              <label class="col-3 control-label">{{trans('lang.email')}}</label>
                <div class="col-7">
                  <input type="text" class="form-control user_email" value="{{$driver->email}}" name="email" required>
                  <div class="form-text text-muted">{{trans('lang.user_email_help')}}</div>
                </div>
	            </div>

	            <div class="form-group row width-50">
	              <label class="col-3 control-label">{{trans('lang.user_phone')}}</label>
                <div class="col-7">
                  <input type="text" class="form-control user_phone" value="{{$driver->phone}}" name="phone" required>
                  <div class="form-text text-muted">{{trans('lang.user_phone_help')}}</div>
                </div>
	            </div>

              <div class="form-group row width-50">
	              <label class="col-3 control-label">Address</label>
                <div class="col-7">
                  <input type="text" class="form-control user_phone" value="{{$driver->address}}" name="address" required>
                  <div class="form-text text-muted">{{trans('lang.user_phone_help')}}</div>
                </div>
	            </div>

                <div class="form-group row width-50">
	              <label class="col-3 control-label">State</label>
                <div class="col-7">
                  <input type="text" class="form-control user_phone" value="{{$driver->state}}" name="state" required>
                  <div class="form-text text-muted">{{trans('lang.user_phone_help')}}</div>
                </div>
	            </div>
	            
	            <div class="form-group row width-50">
	              <label class="col-3 control-label">City</label>
                <div class="col-7">
                  <input type="text" class="form-control user_phone" value="{{$driver->city}}" name="city" required>
                  <div class="form-text text-muted">{{trans('lang.user_phone_help')}}</div>
                </div>
	            </div>
	            
	            <div class="form-group row width-50">
	              <label class="col-3 control-label">Pin Code</label>
                <div class="col-7">
                  <input type="text" class="form-control user_phone" value="{{$driver->pincode}}" name="pincode" required>
                  <div class="form-text text-muted">{{trans('lang.user_phone_help')}}</div>
                </div>
	            </div>
	            
               <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.profile_image')}}</label>
                <div class="col-7">
                  <input type="file" onChange="handleFileSelect(event)" class="" name="profile_image">
                  <div class="form-text text-muted">{{trans('lang.profile_image_help')}}</div>
                </div>

                <div id="uploding_image">
                    <img src="{{ asset('images/driver/profile/' . $driver->profile_image) }}" width="100" height="100" alt="profile Photo">
                </div>
              </div>

	             </fieldset>

                <fieldset>
                    <legend>{{trans('driver')}} {{trans('lang.active_deactive')}}</legend>
                  <div class="form-group row">

                      <div class="form-group row width-50">
                          <div class="form-check width-100">
                              <input type="hidden" name="status" value="0"/>
                            <input type="checkbox" id="is_active" name="status" value="1" @if ($driver->status == 1 ) checked @endif >
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
			                  <input type="text" class="form-control car_number" value="{{$driver->car_number}}" name="car_number" required>
			                  <div class="form-text text-muted">{{trans('lang.car_number_help')}}</div>
			                </div>
			              </div>

			              <div class="form-group row width-50">
			                <label class="col-3 control-label">{{trans('lang.car_name')}}</label>
			                <div class="col-7">
			                  <input type="text" class="form-control car_name" value="{{$driver->car_number}}" name="car_name" required>
			                  <div class="form-text text-muted">{{trans('lang.car_name_help')}}</div>
			                </div>
			              </div>
	            		   <div class="form-group row width-50">
			                <label class="col-3 control-label">{{trans('lang.car_image')}}</label>
			                <div class="col-7">
			                  <input type="file" onChange="handleFileSelectcar(event)" class="" name="car_image">
			                  <div class="form-text text-muted">{{trans('lang.car_image_help')}}</div>
			                </div>
			               
			                <div id="uploding_image_car">
			                    <img src="{{ asset('images/driver/' . $driver->car_image) }}" width="100" height="100" alt="profile Photo">
			                </div>
			              </div>
				           </fieldset>
                   <fieldset>
      <legend>{{trans('lang.bankdetails')}}</legend>

      <div class="form-group row">

        <div class="form-group row width-100">
          <label class="col-4 control-label">{{
          trans('lang.bank_name')}}</label>
          <div class="col-7">
            <input type="text"  class="form-control" id="bankName" name="bank_name" value={{$driver->bank_name}}>
          </div>
        </div>

        <div class="form-group row width-100">
          <label class="col-4 control-label">{{
          trans('lang.branch_name')}}</label>
          <div class="col-7">
            <input type="text"  class="form-control" id="branchName" name="branch_name" value="{{$driver->branch_name}}">
          </div>
        </div>


        <div class="form-group row width-100">
          <label class="col-4 control-label">{{
          trans('lang.holer_name')}}</label>
          <div class="col-7">
            <input type="text" class="form-control" id="holderName" name="holder_name" value="{{$driver->holder_name}}">
          </div>
        </div>

        <div class="form-group row width-100">
          <label class="col-4 control-label">{{
          trans('lang.account_number')}}</label>
          <div class="col-7">
            <input type="text" " class="form-control" id="accountNumber" name="account_number" value="{{$driver->account_number}}">
          </div>
        </div>

        <div class="form-group row width-100">
          <label class="col-4 control-label">{{
          trans('lang.other_information')}}</label>
          <div class="col-7">
            <input type="text" class="form-control" id="otherDetails" name="other_information" value="{{$driver->other_information}}">
          </div>
        </div>

      </div>
    </fieldset>
                   </div>
              </div>
          </div>
		<div class="form-group col-12 text-center btm-btn">
			<button type="submit" class="btn btn-primary save_driver_btn" ><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>
			<a href="{!! route('restaurant.drivers') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
		</div>

	</div>

</div>
</form>
</div>

@endsection

