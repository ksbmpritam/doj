@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <form action="{{ url ('coupons/update/'.$coupon->id)}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row page-titles">
    
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.coupon_plural')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <?php if (isset($_GET['eid']) && $_GET['eid'] != '') { ?>
                    <li class="breadcrumb-item"><a href="{{route('restaurants.coupons',$_GET['eid'])}}">{{trans('lang.coupon_plural')}}</a>
                    </li>
                <?php } else { ?>
                    <li class="breadcrumb-item"><a href="{!! route('coupons') !!}">{{trans('lang.coupon_plural')}}</a>
                    </li>
                <?php } ?>
                <li class="breadcrumb-item active">{{trans('lang.coupon_edit')}}</li>
            </ol>
        </div>

    </div>
    
    <div>

        <div class="card-body">

            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
                {{trans('lang.processing')}}
            </div>

            <div class="error_top" style="display:none"></div>

            <div class="row restaurant_payout_create">

                <div class="restaurant_payout_create-inner">

                    <fieldset>
                        <legend>{{trans('lang.coupon_edit')}}</legend>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.coupon_code')}}</label>
                            <div class="col-7">
                                <input type="text" type="text" class="form-control coupon_code" value="{{$coupon->code}}" name="code" required>
                                <div class="form-text text-muted">{{ trans("lang.coupon_code_help") }}</div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.coupon_discount_type')}}</label>
                            <div class="col-7">
                                <select id="coupon_discount_type" class="form-control" name="discount_type" required>
                                    <option value="Percentage" @if($coupon->discount_type == 'Percentage') selected @endif>{{trans('lang.coupon_percent')}}</option>
                                    <option value="Fix_Price" @if($coupon->discount_type == 'Fix_Price') selected @endif>{{trans('lang.coupon_fixed')}}</option>
                                </select>
                                <div class="form-text text-muted">{{ trans("lang.coupon_discount_type_help") }}</div>

                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                            <div class="col-7">
                                <input type="number" type="text" class="form-control coupon_discount" value="{{$coupon->discount}}" name="discount" required>
                                <div class="form-text text-muted">{{ trans("lang.coupon_discount_help") }}</div>

                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.coupon_expires_at')}}</label>
                            <div class="col-7">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control date_picker input-group-addon" value="{{$coupon->expire_at}}" name="expire_at" required/>
                                    <span class=""></span>
                                </div>
                                <div class="form-text text-muted">
                                    {{ trans("lang.coupon_expires_at_help") }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.coupon_restaurant_id')}}</label>
                            <div class="col-7">
                                <select id="vendor_restaurant_select" class="form-control" name="restaurant_id">
                                    <option value="">{{trans('lang.select_restaurant')}}</option>
                                    @foreach($restaurant as $r)
                                        <option value="{{$r->id}}" @if($coupon->restaurant_id == $r->id) selected @endif>{{$r->name}}</option>
                                    @endforeach
                                </select>
                                <div class="form-text text-muted">
                                    {{ trans("lang.coupon_restaurant_id_help") }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.coupon_description')}}</label>
                            <div class="col-7">
                                <textarea rows="12" class="form-control coupon_description"
                                          id="coupon_description" name="description">{{$coupon->description}}</textarea>
                                <div class="form-text text-muted">{{ trans("lang.coupon_description_help") }}</div>
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.category_image')}}</label>
                            <div class="col-7">
                                <input type="file" onChange="handleFileSelect(event)" name="image">
                              
                                <div id="uploding_image">
                                    <img src="{{ asset('images/coupons/' . $coupon->image) }}" width="100" height="100" alt="profile Photo">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <div class="form-check">
                                <input type="hidden" name="status" value="0"/>
                                <input type="checkbox" class="coupon_enabled" id="coupon_enabled" name="status" @if ($coupon->enabled == 1) checked @endif>
                                <label class="col-3 control-label"
                                       for="coupon_enabled">{{trans('lang.coupon_enabled')}}</label>

                            </div>
                        </div>

                    </fieldset>
                </div>

            </div>

        </div>
        <div class="form-group col-12 text-center btm-btn">
            <button type="submit" class="btn btn-primary save_coupon_btn"><i class="fa fa-save"></i> {{
                trans('lang.save')}}
            </button>
            <?php if (isset($_GET['eid']) && $_GET['eid'] != '') { ?>
                <a href="{{route('restaurants.coupons',$_GET['eid'])}}" class="btn btn-default"><i
                            class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            <?php } else { ?>
                <a href="{!! route('coupons') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            <?php } ?>
        </div>
</form>
    </div>

@endsection

@section('scripts')

<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    
@endsection