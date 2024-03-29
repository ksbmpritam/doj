@extends('admin.layouts.app')

@section('content')
    <div class="page-wrapper">
          <form action="{{ url ('admin/ticket_type/insert')}}" method="Post" enctype="multipart/form-data">
            @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Ticket Type</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('admin.ticket_type') !!}">Ticket Type</a></li>
                    <li class="breadcrumb-item active">Create Ticket Type</li>
                </ol>
            </div>
        </div>

        <div class="card-body">
            
            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
            <div class="error_top" style="display:none"></div>
            <div class="row restaurant_payout_create">

                <div class="restaurant_payout_create-inner">
                    <fieldset>
                        <legend>Create Ticket Type</legend>
                        <div class="form-group row width-100">
                            <label class="col-3 control-label">Title <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <input type="text" class="form-control cat-name" name="title">
                                <div class="form-text text-muted">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-check row width-100">
                            <input type="checkbox" class="item_publish" name="status" id="item_publish" value="1">
                            <label class="col-3 control-label" for="item_publish">{{ trans('lang.item_publish') }}</label>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </fieldset>

                </div>

            </div>
            <div class="form-group col-12 text-center btm-btn">
                <button type="submit" class="btn btn-primary save_attribute_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
                <a href="{!! route('admin.ticket_type') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            </div>
        </div>
        

    </div>

    </div>
</form>

    </div>

@endsection
