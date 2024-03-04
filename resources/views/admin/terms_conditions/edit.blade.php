@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('admin/termsAndConditions/update/'.$termsCondition->id)}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.terms_and_conditions')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('admin/termsAndConditions') }}">{{trans('lang.terms_and_conditions')}}</a></li>
                    <li class="breadcrumb-item active">Edit {{trans('lang.terms_and_conditions')}}</li>
                </ol>
            </div>


        </div>
        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <!--<div class="card-header">-->
                    <!--    <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">-->
                    <!--        <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">-->
                    <!--            <a class="nav-link " href="{!! route('admin.termsAndConditions') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.terms_and_conditions')}} List</a>-->
                    <!--        </li>-->
                    <!--        <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">-->
                    <!--            <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>Edit {{trans('lang.terms_and_conditions')}}</a>-->
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
                                    <legend>{{trans('lang.terms_and_conditions')}}</legend>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Role <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <select id="role" name="app" class="form-control">
                                                <option value="">-- Select App --</option>
                                                <option value="3" @if($termsCondition->app == 3) selected @endif>Partner</option>
                                                <option value="2" @if($termsCondition->app ==2) selected @endif>Customer</option>
                                                <option value="1" @if($termsCondition->app == 1) selected @endif>Driver</option>
                                            </select>
                                            <div class="form-text text-muted">
                                                @error('app')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    
                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">{{trans('lang.subject')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control" name="title" id="title" value={{$termsCondition->title}}>
                                            <div class="form-text text-muted">
                                                @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">{{trans('lang.message')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <textarea class="form-control" name="content" id="body">{{$termsCondition->content}}</textarea>
                                            <div class="form-text text-muted">
                                                @error('content')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                        </div>

                    </div>
                    <div class="form-group col-12 text-center btm-btn">
                        <button type="submit" class="btn btn-primary send_message"><i class="fa fa-save"></i> {{
                            trans('lang.send')}}
                        </button>
                        <a href="{{url('admin/termsAndConditions')}}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
                    </div>
                </div>
            </div>
        </div>
        
    </form>
</div>
</div>

@endsection
