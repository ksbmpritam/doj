@extends('admin.layouts.app')



@section('content')

<div class="page-wrapper">

    <form action="{{ url('admin/voucher/update/'. $voucher->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">



            <div class="col-md-5 align-self-center">

                <h3 class="text-themecolor">Voucher</h3>

            </div>

            <div class="col-md-7 align-self-center">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                    <li class="breadcrumb-item active">Edit Voucher</li>

                </ol>

            </div>

        </div>

        <div class="card-body">

            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

            <div class="error_top"></div>

            <div class="row restaurant_payout_create">

                <div class="restaurant_payout_create-inner">

                    <fieldset>
                        <legend>{{trans('lang.menu_items')}}</legend>
                        
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('Voucher')}} <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <input type="number" class="form-control title" name="amount" value="{{ $voucher->amount}}" required>
                            </div>
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('Discount')}} <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <input type="number" class="form-control title" name="discount" value="{{ $voucher->discount}}" required>
                            </div>
                        </div>
                        <div class="form-group row width-100">

                            <div class="form-check width-100">

                                <input type="checkbox" id="is_publish" value="1" name="status" @if ($voucher->status == 1) checked @endif>

                                <label class="col-3 control-label" for="is_publish">{{trans('lang.is_publish')}}</label>

                            </div>

                        </div>
                    </fieldset>

                </div>
            </div>
        </div>

        <div class="form-group col-12 text-center">

            <button type="submit" class="btn btn-primary  create_banner_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>

            <a href="{{ url('admin/voucher') }}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>

        </div>
    </form>
</div>
</div>


@endsection