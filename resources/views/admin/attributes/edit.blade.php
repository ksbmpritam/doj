@extends('admin.layouts.app')

@section('content')
    <div class="page-wrapper">
        <form action="{{ url ('admin/attributes/update/'.$attribute->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row page-titles">
    
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Attributes</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('admin.attributes') !!}">Attributes</a></li>
                        <li class="breadcrumb-item active">Edit Attributes</li>
                    </ol>
                </div>
            </div>
    
            <div class="card-body">
    
                <div id="data-table_processing" class="dataTables_processing panel panel-default"
                     style="display: none;">{{trans('lang.processing')}}</div>
                <div class="error_top" style="display:none"></div>
                <div class="row restaurant_payout_create">
    
                    <div class="restaurant_payout_create-inner">
                        <fieldset>
                            <legend>{{ trans('lang.attribute_edit') }}</legend>
                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{ trans('lang.attribute_name') }}</label>
                                <div class="col-7">
                                    <input type="text" class="form-control attribute-name" name="name" value="{{ $attribute->name }}">
                                    <div class="form-text text-muted">{{ trans('lang.attribute_name_help') }}
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-check row width-100">
                                <input type="checkbox" class="item_publish" name="status" id="item_publish" value="1" @if($attribute->status == 1) checked @endif>
                                <label class="col-3 control-label" for="item_publish">{{ trans('lang.item_publish') }}</label>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </fieldset>

                    </div>
    
                </div>
    
            </div>
            <div class="form-group col-12 text-center btm-btn">
                <button type="submit" class="btn btn-primary save_attribute_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
                <a href="{!! route('admin.attributes') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            </div>
        </form>
    </div>


@endsection
