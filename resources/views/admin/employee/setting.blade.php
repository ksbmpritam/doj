@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('admin/employee/update_setting/'. $employee->id)}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Edit Setting</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('admin.employee') !!}">Setting</a></li>
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
                                    <a class="nav-link " href="{!! route('admin.employee') !!}"><i class="fa fa-list mr-2"></i>Setting List</a>
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
                                            <label class="col-3 control-label">Add Zone</label>
                                            <div class="col-7">
                                                <select class="form-select form-control" name="add_zone">
                                                    <option value="1" @if($employee->add_zone == 1) selected @endif>On</option>
                                                    <option value="0" @if($employee->add_zone == 0) selected @endif>Off</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('add_zone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Add Team</label>
                                            <div class="col-7">
                                                <select class="form-select form-control" name="add_team">
                                                    <option value="1" @if($employee->add_team == 1) selected @endif>On</option>
                                                    <option value="0" @if($employee->add_team == 0) selected @endif>Off</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('add_team')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Add Department</label>
                                            <div class="col-7">
                                                <select class="form-select form-control" name="add_department">
                                                    <option value="1" @if($employee->add_department == 1) selected @endif>On</option>
                                                    <option value="0" @if($employee->add_department == 0) selected @endif>Off</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('add_department')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Add Attendance</label>
                                            <div class="col-7">
                                                <select class="form-select form-control" name="add_attandance">
                                                    <option value="1" @if($employee->add_attandance == 1) selected @endif>On</option>
                                                    <option value="0" @if($employee->add_attandance == 0) selected @endif>Off</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('add_attandance')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Manage FSC</label>
                                            <div class="col-7">
                                                <select class="form-select form-control" name="manage_fsc">
                                                    <option value="1" @if($employee->manage_fsc == 1) selected @endif>On</option>
                                                    <option value="0" @if($employee->manage_fsc == 0) selected @endif>Off</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('manage_fsc')
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
                                <a href="{!! route('admin.employee') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
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
