@extends('admin.layouts.app')



@section('content')

<div class="page-wrapper">

    <form action="{{ url('admin/safety/update/'. $safety->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">



            <div class="col-md-5 align-self-center">

                <h3 class="text-themecolor">safety</h3>

            </div>

            <div class="col-md-7 align-self-center">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                    <li class="breadcrumb-item active">Edit safety</li>

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
                            <label class="col-3 control-label">{{trans('Name')}} <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <input type="text" class="form-control title" name="name" value="{{ $safety->name}}" required>
                            </div>
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('Email')}} <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <input type="email" class="form-control title" name="email" value="{{ $safety->email}}" required>
                            </div>
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('Phone')}} <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <input type="number" class="form-control title" name="phone" value="{{ $safety->phone}}" required>
                            </div>
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('Question')}} <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <input type="text" class="form-control title" name="question" value="{{ $safety->question}}" required>
                            </div>
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('Message')}} <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <input type="text" class="form-control title" name="message" value="{{ $safety->message}}" required>
                            </div>
                        </div>
                        <div class="form-group row width-100">

                            <div class="form-check width-100">

                                <input type="checkbox" id="is_publish" value="1" name="status" @if ($safety->status == 1) checked @endif>

                                <label class="col-3 control-label" for="is_publish">{{trans('lang.is_publish')}}</label>

                            </div>

                        </div>
                    </fieldset>

                </div>
            </div>
        </div>

        <div class="form-group col-12 text-center">

            <button type="submit" class="btn btn-primary  create_banner_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>

            <a href="{{ url('admin/safety') }}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>

        </div>
    </form>
</div>
</div>


@endsection