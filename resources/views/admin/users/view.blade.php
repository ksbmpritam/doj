@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
  <form action="{{ url('admin/users/update/'. $user->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">{{trans('lang.user_plural')}}</h3>
      </div>
      <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
          <li class="breadcrumb-item"><a href="{!! route('admin.users') !!}">{{trans('lang.user_plural')}}</a></li>
          <li class="breadcrumb-item active">{{trans('lang.user_edit')}}</li>
        </ol>
      </div>

    </div>
    <div class="card-body">

      <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
        <div class="menu-tab">
            <ul>
                <li class="active">
                    <a href="{{route('admin.users.view',$id)}}">{{trans('lang.tab_basic')}}</a>
                </li>
                <li>
                    <a href="{{route('admin.users.orders',$id)}}">{{trans('lang.tab_orders')}}</a>
                </li>
                <li>
                    <a href="{{route('admin.users.payout',$id)}}">Wallet Transaction</a>
                </li>
            </ul>
        </div>
      <div class="row daes-top-sec mb-3">

        <div class="col-lg-6 col-md-6">
          <!--<a href="">-->

          <div class="card">

            <div class="flex-row">

              <div class="p-10 bg-info col-md-12 text-center">

                <h3 class="text-white box m-b-0"><i class="mdi mdi-cart"></i></h3>
              </div>

              <div class="align-self-center pt-3 col-md-12 text-center">

                <h3 class="m-b-0 text-info" id="total_orders">{{$orderCount ?? ' '}}</h3>

                <h5 class="text-muted m-b-0">{{trans('lang.dashboard_total_orders')}}</h5>

              </div>

            </div>

          </div>
          <!--</a>-->
        </div>

        <div class="col-lg-6 col-md-6">
          <!--<a href="">-->
          <div class="card">

            <div class="flex-row">

              <div class="p-10 bg-info col-md-12 text-center">

                <h3 class="text-white box m-b-0"><i class="mdi mdi-bank"></i></h3>
              </div>

              <div class="align-self-center pt-3 col-md-12 text-center">

                <h3 class="m-b-0 text-info" id="wallet_amount">{{$user->total_wallet}}</h3>

                <h5 class="text-muted m-b-0">{{trans('lang.wallet_Balance')}}</h5>

              </div>

            </div>

          </div>
          <!--</a>-->
        </div>

      </div>

      <div class="error_top"></div>
      <div class="row restaurant_payout_create">
        <div class="restaurant_payout_create-inner">

          <fieldset>
            <legend>User</legend>
            <div class="form-group row width-50">
              <label class="col-3 control-label">User Name</label>
              <div class="col-7">
                <input type="text" class="form-control user_first_name" value="{{$user->name}}">

              </div>
            </div>


            <div class="form-group row width-50">
              <label class="col-3 control-label">{{trans('lang.email')}}</label>
              <div class="col-7">
                <input type="text" class="form-control user_email" value="{{$user->email}}">

              </div>
            </div>

            <div class="form-group row width-50">
              <label class="col-3 control-label">{{trans('lang.user_phone')}}</label>
              <div class="col-7">
                <input type="text" class="form-control user_phone" value="{{$user->mobile_number}}">

              </div>

            </div>

            <div class="form-group row width-50">
              <label class="col-3 control-label">Gender</label>
              <div class="col-7">
                <input type="text" class="form-control user_phone" value="{{$user->gender}}">

              </div>

            </div>

            <div class="form-group row width-50">
              <label class="col-3 control-label">Date of Birth</label>
              <div class="col-7">
                <input type="date" class="form-control user_phone" value="{{$user->dob}}">

              </div>

            </div>

            <div class="form-group row width-100">
              <label class="col-3 control-label">{{trans('lang.restaurant_image')}}</label>
              <!--<input type="file" onChange="handleFileSelect(event)" class="col-7">-->
              <div class="placeholder_img_thumb user_image">
                @if($user->profile_image == '')
                <img src="{{ asset('images/upload/profile.png') }}" width="100" height="100" alt="profile Photo">
                @else
                <img src="{{ asset('images/upload/' . $user->profile_image) }}" width="100" height="100" alt="profile Photo">
                @endif
              </div>

            </div>
          </fieldset>

          <fieldset>
            <legend>{{trans('user')}} {{trans('lang.active_deactive')}}</legend>
            <div class="form-group row">

              <div class="form-group row width-50">
                <div class="form-check width-100">
                  <input type="checkbox" class="user_active" id="user_active" @if ($user->status == 1) checked @endif>
                  <label class="col-3 control-label" for="user_active">{{trans('lang.active')}}</label>
                </div>
              </div>

            </div>
          </fieldset>

          <fieldset>
            <legend>{{trans('lang.address')}}</legend>
            <div class="form-group row width-100">
              <label class="col-3 control-label">Address</label>
              <div class="col-7">
                <input type="text" class="form-control address_line1" value="{{$user->address}}">
                <div class="form-text text-muted w-50">
                  {{ trans("lang.address_line1_help") }}
                </div>
              </div>

            </div>
            <div class="form-group row width-100">
              <div class="col-12">
                <h6>{{ trans("lang.know_your_cordinates") }}<a target="_blank" href="https://www.latlong.net/">{{ trans("lang.latitude_and_longitude_finder") }}</a></h6>
              </div>
            </div>
            <div class="form-group row width-50">
              <label class="col-3 control-label">{{trans('lang.user_latitude')}}</label>
              <div class="col-7">
                <input type="text" class="form-control user_latitude" value="{{$user->latitude}}">
                <div class="form-text text-muted w-50">
                  {{ trans("lang.user_latitude_help") }}
                </div>
              </div>

            </div>
            <div class="form-group row width-50">
              <label class="col-3 control-label">{{trans('lang.user_longitude')}}</label>
              <div class="col-7">
                <input type="text" class="form-control user_longitude" value="{{$user->longitude}}">
                <div class="form-text text-muted w-50">
                  {{ trans("lang.user_longitude_help") }}
                </div>
              </div>

            </div>

          </fieldset>

        </div>
      </div>
    </div>
    <div class="form-group col-12 text-center btm-btn">
      <button type="button" class="btn btn-primary  save_user_btn"><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>
      <a href="{!! route('admin.users') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
    </div>
  </form>
</div>
</div>

@endsection
