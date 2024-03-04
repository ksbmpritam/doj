@extends('restaurant_admin.layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor restaurantTitle">{{trans('lang.driver_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href= "{!! route('restaurant.drivers') !!}" >{{trans('lang.driver_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.restaurant_details')}}</li>
            </ol>
        </div>
    
  </div>
 
   <div class="container-fluid">
   	<div class="row">
   		<div class="col-12">

    <div class="resttab-sec">
      	<div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
      <div class="menu-tab">
     
          <ul>
            <li class="active">
                <a href="{{route('restaurant.drivers.view',$id)}}">{{trans('lang.tab_basic')}}</a>
            </li>
            <li>
                <a href="{{url('restaurant/drivers/orders_list/'.$id)}}">{{trans('lang.tab_orders')}}</a>
            </li>
            <li>
                <a href="{{url('restaurant/drivers/balanceHistory/'.$id)}}">{{trans('lang.balance_list')}}</a>
            </li>
           
        </ul>

      </div>
      			
      <div class="row restaurant_payout_create driver_details">
        <div class="restaurant_payout_create-inner">
          <fieldset>
             <legend>{{trans('lang.driver_details')}}</legend>

                <div class="form-group row width-50">
                  <label class="col-3 control-label">{{trans('lang.first_name')}}</label>
                  <div class="col-7" class="driver_name">
                      <span class="driver_name" id="driver_name">{{$driver->first_name}}</span>
                    </div>
                </div>
    
                <div class="form-group row width-50">
                  <label class="col-3 control-label">{{trans('lang.email')}}</label>
                  <div class="col-7">
                  <span class="email">{{$driver->email}}</span>
                  </div>
                </div>
    
                <div class="form-group row width-50">
                  <label class="col-3 control-label">{{trans('lang.user_phone')}}</label>
                  <div class="col-7">
                  <span class="phone">{{$driver->phone}}</span>
                  </div>
                </div>
                <div class="form-group row width-50">
                  <label class="col-3 control-label">{{trans('lang.profile_image')}}</label>
                  <div class="col-7 profile_image">
                      <img src="{{ asset('images/driver/profile/' . $driver->profile_image) }}" width="100" height="100" alt="profile Photo">
                  </div>
                  </div>
              
                </div>

            </fieldset>
          </div>
        </div>

        <div class="row restaurant_payout_create restaurant_details">
        <div class="restaurant_payout_create-inner">
          <fieldset>
             <legend>{{trans('lang.car_details')}}</legend>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.car_number')}}</label>
               	<div class="col-7">
                	<span class="car_number">{{$driver->car_number}}</span>
              	</div>
            	</div>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.car_name')}}</label>
                <div class="col-7">
                  <span class="car_name">{{$driver->car_name}}</span>
                </div>
              </div>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.car_image')}}</label>
                <div class="col-7 car_image">
                 <img src="{{ asset('images/driver/' . $driver->car_image) }}" width="100" height="100" alt="image Photo">
                </div>
              </div>

            </fieldset>

          </div>
      </div>

      <div class="row restaurant_payout_create restaurant_details">
        <div class="restaurant_payout_create-inner">
           <fieldset>
                  <legend>{{trans('lang.bankdetails')}}</legend>
                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.bank_name')}}</label>
                          <div class="col-7">
                          <span class="bank_name">{{$driver->bank_name}}</span>
                          </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.branch_name')}}</label>
                          <div class="col-7">
                          <span class="branch_name">{{$driver->branch_name}}</span>
                          </div>
                        </div>


                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.holer_name')}}</label>
                          <div class="col-7">
                          <span class="holer_name">{{$driver->holder_name}}</span>
                          </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.account_number')}}</label>
                          <div class="col-7">
                          <span class="account_number">{{$driver->account_number}}</span>
                          </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.other_information')}}</label>
                          <div class="col-7">
                          <span class="other_information">{{$driver->other_information}}</span>
                          </div>
                        </div>


                    </fieldset>
          </div>
      </div>
      
      <div class="row restaurant_payout_create restaurant_details">
        <div class="restaurant_payout_create-inner">
           <fieldset>
                  <legend>{{trans('lang.address_details')}}</legend>
                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.contact_us_address')}}</label>
                          <div class="col-7">
                          <span>{{$driver->address}}</span>
                          </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.state')}}</label>
                          <div class="col-7">
                          <span >{{$driver->state}}</span>
                          </div>
                        </div>


                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.city')}}</label>
                          <div class="col-7">
                          <span >{{$driver->city}}</span>
                          </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.pin_code')}}</label>
                          <div class="col-7">
                          <span >{{$driver->pincode}}</span>
                          </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.latitude')}}</label>
                          <div class="col-7">
                          <span>{{$driver->latitude}}</span>
                          </div>
                        </div>
                        
                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.longitude')}}</label>
                          <div class="col-7">
                          <span>{{$driver->longitude}}</span>
                          </div>
                        </div>


                    </fieldset>
          </div>
      </div>

   </div>

</div>
      <div class="form-group col-12 text-center btm-btn">
         <a href="{!! route('restaurant.drivers') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
      </div>

    </div>
  </div>
</div>


 @endsection

