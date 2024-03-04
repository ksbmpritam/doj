@extends('franchies.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('franchies/department/update/'. $department->id)}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Department</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('franchies/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('franchies.department') !!}">Department List</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Department</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link " href="{!! route('franchies.department') !!}"><i class="fa fa-list mr-2"></i>Department List</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>Edit Department</a>
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
                                        <legend>Department</legend>
                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label">Name<sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" name="name" class="form-control" value="{{$department->name}}"> 
                                                <div class="form-text text-muted">{{ trans("lang.category_name_help") }}
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                       

                                        <div class="form-check row width-100">
                                            <input type="checkbox" class="item_publish" name="status" value="1" id="status" @if($department->status==1) checked @endif>
                                            <label class="col-3 control-label" for="status">Active</label>
                                        </div>
                                        

                                    </fieldset>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group col-12 text-center btm-btn">
                        <button type="submit" class="btn btn-primary save_category_btn"><i class="fa fa-save"></i>
                            {{trans('lang.save')}}
                        </button>
                        <a href="{!! route('franchies.department') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
</div>

@endsection