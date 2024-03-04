@extends('admin.layouts.app')

@section('content')
    <div class="page-wrapper">
        <form action="{{ url ('admin/role/update/'.$role->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row page-titles">
    
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Manage Title</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('admin.role') !!}">Role</a></li>
                        <li class="breadcrumb-item active">Edit Role</li>
                    </ol>
                </div>
            </div>
    
           <div class="container-fluid">
    
                <div class="row">
    
                    <div class="col-12">
    
                        <div class="card">
    
                            <div class="card-header">
                                <ul class="nav nav-tabs align-items-end card-header-tabs justify-content-center w-100">
                                    <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                        <a class="nav-link " href="{!! route('admin.role') !!}"><i class="fa fa-list mr-2"></i>Role List</a>
                                    </li>
                                    <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                        <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>Edit Role</a>
                                    </li>
                                </ul>
                            </div>
    
                            <div class="card-body">
                    
                                <div id="data-table_processing" class="dataTables_processing panel panel-default"
                                     style="display: none;">{{trans('lang.processing')}}</div>
                                <div class="error_top" style="display:none"></div>
                                <div class="row restaurant_payout_create">
                    
                                    <div class="restaurant_payout_create-inner">
                                        <fieldset>
                                            <legend>Edit Role</legend>
                                            <div class="form-group row width-100">
                                                <label class="col-3 control-label">Title</label>
                                                <div class="col-7">
                                                    <input type="text" class="form-control" name="title" value="{{ $role->title }}">
                                                     <div class="form-text text-muted">
                                                        @error('title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-check row width-100">
                                                <input type="checkbox" class="item_publish" name="status" id="item_publish" value="1" @if($role->status == 1) checked @endif>
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
                                <a href="{!! route('admin.role') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection

