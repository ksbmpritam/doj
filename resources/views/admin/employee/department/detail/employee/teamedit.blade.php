@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('admin/franchies/team/update/'. $team->id)}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Team</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('franchies.department') !!}">Team List</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Team</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="menu-tab vendorMenuTab">
                @include('franchies.head_menu')
            </div>
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link " href="{!! route('franchies.team') !!}"><i class="fa fa-list mr-2"></i>Team List</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>View Team</a>
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
                                        <legend>Team Details</legend>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Name</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="name" value="{{ $team->name }}" readonly>
                                                <div class="form-text text-muted">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Mobile No.</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="mobile_no" onkeypress="return numeralsOnly(event)" maxlength="10" name="mobile_no" value="{{ $team->mobile_no }}" readonly>
                                                <div class="form-text text-muted">
                                                    @error('mobile_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Email</label>
                                            <div class="col-7">
                                                <input type="email" class="form-control" name="email" value="{{ $team->email }}" readonly>
                                                <div class="form-text text-muted">
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Password</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="password" value="{{ $team->pwd }}" readonly>

                                                <div class="form-text text-muted">
                                                    @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group col-12 text-center btm-btn">
                        <!--<button type="submit" class="btn btn-primary save_category_btn"><i class="fa fa-save"></i>-->
                            <!--{{trans('lang.save')}}-->
                        <!--</button>-->
                        <!--<a href="{!! route('admin.employee.team.teamlist', ['id' => $yourIdValueHere]) !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>-->
                        <a href="" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
</div>


@endsection