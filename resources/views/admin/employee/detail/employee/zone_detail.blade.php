@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('admin/employee/department/update/'. $zone->id)}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Employee</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('employee/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('employee.zone') !!}">Zone List</a>
                    </li>
                    <li class="breadcrumb-item active">View Zone</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="menu-tab vendorMenuTab">
                    @include('admin.head_menu2')
                </div>
                <div class="card  pb-4">

                     <div class="card-body">

                            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                            <div class="error_top" style="display:none"></div>
                            <div class="row restaurant_payout_create">

                                <div class="restaurant_payout_create-inner">
                                    <fieldset>
                                        <legend>Manager Details</legend>
                                        <div class="form-group row width-50">
                                            <input type="hidden" id="polygonId" name="polygonId" value="{{ $zone->id }}" readonly>
                                            <label class="col-3 control-label">Name</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $zone->name }}" readonly>
                                                <div class="form-text text-muted">
                                                   <span class="text-danger " style="display:none" id="name_v" >Name field is required</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">State</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="state" name="state" value="{{ $zone->state }}" readonly>
                                                <div class="form-text text-muted">
                                                    <span class="text-danger " style="display:none" id="state_v" >state field is required</span>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group row width-50">
                                            <label class="col-3 control-label">City</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="city" name="city" value="{{ $zone->city }}" readonly>
                                                <div class="form-text text-muted">
                                                   <span class="text-danger " style="display:none" id="city_v" >city field is required</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check form-group row width-50">
                                              <label class="col-3 control-label text-white">.</label>
                                            <input type="checkbox" class="item_publish" name="status" id="item_publish" disabled value="1" @if($zone->status == 1) checked @endif>
                                            <label class="col-3 control-label" for="item_publish">{{ trans('lang.item_publish') }}</label>
                                            @error('status')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label">Full Address.</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="city_full_address"  name="city_full_address" value="{{ $zone->city_full_address }}" readonly>
                                                <div class="form-text text-muted">
                                                    <span class="text-danger " style="display:none" id="city_full_address_v" >Address field is required</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-check row width-100">
                                           <div id="map" style="height: 400px;"></div>
                                        </div>
                                        
                                    </fieldset>

                                </div>

                            </div>
                            <div class="form-group col-12 text-center btm-btn">
                                <!--<button id="savePolygon" class="btn btn-primary save_attribute_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>-->
                                <a href="{!! route('admin.employee.zone.zonelist', ['id' => $zone->employee_id]) !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                                <!--<button type="button" class="btn btn-primary" id="removePolygon">Remove Polygon</button>-->
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </form>
</div>
</div>

@endsection