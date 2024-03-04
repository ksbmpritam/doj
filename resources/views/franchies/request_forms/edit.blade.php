@extends('franchies.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('franchies/form/update/'. $forms->id)}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Request</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('franchies/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('franchies.form') !!}">Request List</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Request</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link " href="{!! route('franchies.form') !!}"><i class="fa fa-list mr-2"></i>Request List</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>Edit Request</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
                            {{trans('lang.processing')}}
                        </div>
                        <div class="error_top" style="display:none"></div>
                        <div class="row restaurant_payout_create" role="tabpanel">

                            <div class="restaurant_payout_create-inner tab-content">
                                <div role="tabpanel" class="tab-pane active" id="category_information">
                                    <fieldset>
                                        <legend>Request Details</legend>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Title<sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="title" value="{{ $forms->title }}">
                                                <div class="form-text text-muted">
                                                    @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Description<sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="description" value="{{ $forms->description }}" oninput="validateDescription(this)">
                                                <div class="form-text text-muted">
                                                    @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        </div>
                                       
                                        <!--<div class="form-check row width-100">-->
                                        <!--    <input type="checkbox" class="item_publish" name="status" id="status" value="1" @if($forms->status == 1) checked @endif>-->
                                        <!--    <label class="col-3 control-label" for="status">{{ trans('lang.item_publish') }}</label>-->
                                        <!--    @error('status')-->
                                        <!--    <div class="text-danger">{{ $message }}</div>-->
                                        <!--    @enderror-->
                                        <!--</div>-->
                                    </fieldset>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group col-12 text-center btm-btn">
                        <button type="submit" class="btn btn-primary save_category_btn"><i class="fa fa-save"></i>
                            {{trans('lang.save')}}
                        </button>
                        <a href="{!! route('franchies.form') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
</div>
<script>
function validateDescription(input) {
    if (input.value.length > 30) {
        input.value = input.value.slice(0, 30); // Truncate input to 30 characters
    }
}
</script>

@endsection