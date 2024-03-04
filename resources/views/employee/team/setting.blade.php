@extends('employee.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('employee/team/update_setting/'. $team->id)}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Edit Setting</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('employee/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('employee.team') !!}">Setting</a></li>
                    <li class="breadcrumb-item active"> Edit Setting </li>
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
                                    <a class="nav-link " href="{!! route('employee.team') !!}"><i class="fa fa-list mr-2"></i>Team List</a>
                                </li>
                                <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>Edit Setting</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">

                            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                            <div class="error_top" style="display:none"></div>
                            <div class="row restaurant_payout_create">

                                <div class="restaurant_payout_create-inner">
                                    <fieldset>
                                        <legend>Edit Setting</legend>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Add Restaurant</label>
                                            <div class="col-7">
                                                <select class="form-select form-control" name="add_restaurant">
                                                    <option value="1" @if($team->add_restaurant == 1) selected @endif>On</option>
                                                    <option value="0" @if($team->add_restaurant == 0) selected @endif>Off</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('add_restaurant')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Add Rider</label>
                                            <div class="col-7">
                                                <select class="form-select form-control" name="add_rider">
                                                    <option value="1" @if($team->add_rider == 1) selected @endif>On</option>
                                                    <option value="0" @if($team->add_rider == 0) selected @endif>Off</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('add_rider')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Add Product</label>
                                            <div class="col-7">
                                                <select class="form-select form-control" name="add_product">
                                                    <option value="1" @if($team->add_product == 1) selected @endif>On</option>
                                                    <option value="0" @if($team->add_product == 0) selected @endif>Off</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('add_product')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Add Order</label>
                                            <div class="col-7">
                                                <select class="form-select form-control" name="add_order">
                                                    <option value="1" @if($team->add_order == 1) selected @endif>On</option>
                                                    <option value="0" @if($team->add_order == 0) selected @endif>Off</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('add_order')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                       
                                       
                                    </fieldset>
                                    
                                </div>

                            </div>
                            <div class="form-group col-12 text-center btm-btn">
                                <button type="submit" class="btn btn-primary save_attribute_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
                                <a href="{!! route('employee.team') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>

    </form>
</div>

</div>

@endsection