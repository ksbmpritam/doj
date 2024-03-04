@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{ trans('lang.vat_setting')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{ trans('lang.vat_setting')}}</li>
                </ol>
            </div>
        </div>

        <div class="card-body">
            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
                Processing...
            </div>
            <div class="row restaurant_payout_create">
                <div class="restaurant_payout_create-inner">
                    <fieldset>
                        <legend>{{trans('lang.vat_setting')}}</legend>

                        <div class="form-check width-100">
                            <input type="checkbox" class="form-check-inline" id="vat_enabled">
                            <label class="col-5 control-label" for="vat_enabled">{{ trans('lang.is_enabled')}}</label>
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-4 control-label">{{ trans('lang.label')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control vat_label">
                            </div>
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-4 control-label">{{ trans('lang.tax')}}</label>
                            <div class="col-7">
                                <input type="number" class="form-control vat_tax">
                            </div>
                        </div>
                        <div class="form-group row width-50">

                            <label class="col-4 control-label">{{ trans('lang.type')}}</label>
                            <div class="col-7">
                                <select class="form-control commission_type" id="vat_type">
                                    <option value="percent">{{trans('lang.coupon_percent')}}</option>
                                    <option value="fix">{{trans('lang.coupon_fixed')}}</option>
                                </select>
                            </div>
                        </div>
                </div>
                </fieldset>
            </div>
        </div>

        <div class="form-group col-12 text-center">
            <button type="button" class="btn btn-primary save_vat_table_btn"><i
                        class="fa fa-save"></i> {{trans('lang.save')}}</button>
            <a href="{{url('/dashboard')}}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}
            </a>
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        var database = firebase.firestore();
        var ref = database.collection('settings').doc("taxSetting");

        $(document).ready(function () {
            jQuery("#data-table_processing").show();
            ref.get().then(async function (snapshots) {
                var vatSetting = snapshots.data();

                if (vatSetting == undefined) {
                    database.collection('settings').doc('taxSetting').set({});
                }

                try {
                    if (vatSetting.active) {
                        $("#vat_enabled").prop('checked', true);
                    }
                    $(".vat_label").val(vatSetting.label);
                    $(".vat_tax").val(vatSetting.tax);
                    $("#vat_type").val(vatSetting.type);
                } catch (error) {

                }
                jQuery("#data-table_processing").hide();

            })

            $(".save_vat_table_btn").click(function () {

                var checkboxValue = $("#vat_enabled").is(":checked");
                var label = $(".vat_label").val();
                var tax = $(".vat_tax").val();
                var type = $("#vat_type").val();
                database.collection('settings').doc("taxSetting").update({
                    'active': checkboxValue,
                    'label': label,
                    'tax': tax,
                    'type': type
                }).then(function (result) {
                    window.location.href = '{{ url("settings/app/vatSetting")}}';

                });


            })
        })


    </script>

@endsection