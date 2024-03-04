@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('admin/privacyPolicy/insert')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.privacy_policy')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('admin/privacyPolicy') }}">{{trans('lang.privacy_policy')}}</a></li>
                    <li class="breadcrumb-item active">Create {{trans('lang.privacy_policy')}}</li>
                </ol>
            </div>


        </div>
        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <!--<div class="card-header">-->
                    <!--    <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">-->
                    <!--        <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">-->
                    <!--            <a class="nav-link " href="{!! route('admin.privacyPolicy') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.privacy_policy')}}</a>-->
                    <!--        </li>-->
                    <!--        <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">-->
                    <!--            <a class="nav-link active" href="{!! route('admin.privacyPolicy.create') !!}"><i class="fa fa-plus mr-2"></i>Create {{trans('lang.privacy_policy')}}</a>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</div>-->
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
                            {{trans('lang.processing')}}
                        </div>

                        <div class="row restaurant_payout_create">

                            <div class="restaurant_payout_create-inner">

                                <fieldset>
                                    <legend>{{trans('lang.privacy_policy')}}</legend>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Role <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <select id='role' name="app" class="form-control">
                                                <option value="">-- Select role --</option>
                                                <option value="3">Partner</option>
                                                <option value="2">{{trans('lang.customer')}}</option>
                                                <option value="1">{{trans('lang.driver')}}</option>
                                            </select>
                                            <div class="form-text text-muted">
                                                @error('roles')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    

                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">{{trans('lang.title')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control" name="title" id="title">
                                            <div class="form-text text-muted">
                                                @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">Content <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <textarea class="form-control" name="content" id="body"></textarea>
                                            <div class="form-text text-muted">
                                                @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
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
            <button type="submit" class="btn btn-primary send_message"><i class="fa fa-save"></i> {{
                trans('lang.send')}}
            </button>
            <a href="{{url('admin/privacyPolicy')}}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
        </div>
    </form>
</div>
</div>

@endsection
