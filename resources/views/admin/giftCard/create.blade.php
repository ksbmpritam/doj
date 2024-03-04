@extends('admin.layouts.app')

@section('content')

    <div class="page-wrapper">
        <form action="{{ url('admin/gift_card/insert') }}" method="post" enctype="multipart/form-data"> 
        @csrf
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Gift Cart</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{!! url('admin/gift_card') !!}">Gift Cart</a></li>
                    <li class="breadcrumb-item active">Create Gift Cart</li>
                </ol>
            </div>
            <div>

                <div class="card-body">
                    <div id="data-table_processing" class="dataTables_processing panel panel-default"
                         style="display: none;">{{trans('lang.processing')}}
                    </div>
                    <div class="error_top"></div>
                    <div class="row restaurant_payout_create">
                        <div class="restaurant_payout_create-inner">
                            <fieldset>
                                <legend>CONFIGURATIONS</legend>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">Title <sup style="color:red;">*</sup></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control " name="title" value="{{ old('title') }}">
                                        <div class="form-text text-muted">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">Description <sup style="color:red;">*</sup></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control col-7" name="description" value="{{ old('description') }}">
                                        <div class="form-text text-muted">
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_image')}}</label>
                                    <input type="file" name="image_path[]" class="col-7" multiple>
                                    <div id="uploding_image_owner"></div>
                                </div>

                            </fieldset>

                            <fieldset>
                                <legend>{{trans('lang.active_deactive')}}</legend>
                                <div class="form-group row">

                                    <div class="form-group row width-50">
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="is_active" value="1" name="status">
                                            <label class="col-3 control-label" for="is_active">{{trans('lang.active')}}</label>
                                        </div>
                                    </div>

                                </div>
                            </fieldset>

                            
                        </div>
                    </div>
                </div>

                <div class="form-group col-12 text-center">
                    <button type="submit" class="btn btn-primary  create_restaurant_btn"><i class="fa fa-save"></i>
                        {{trans('lang.save')}}
                    </button>
                    <a href="{!! route('admin.gift_card') !!}" class="btn btn-default">
                        <i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                </div>

            </div>
        </div>
        </form>
    </div>

@endsection