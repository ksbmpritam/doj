@extends('employee.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('employee/franchies/update_setting/'. $franchise->id)}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Edit Setting</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('employee/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('employee.franchies') !!}">Setting</a></li>
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
                                    <a class="nav-link " href="{!! route('employee.franchies') !!}"><i class="fa fa-list mr-2"></i>Setting List</a>
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
                                                    <option value="1" @if($franchise->add_zone == 1) selected @endif>On</option>
                                                    <option value="0" @if($franchise->add_zone == 0) selected @endif>Off</option>
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
                                                    <option value="1" @if($franchise->add_team == 1) selected @endif>On</option>
                                                    <option value="0" @if($franchise->add_team == 0) selected @endif>Off</option>
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
                                                    <option value="1" @if($franchise->add_department == 1) selected @endif>On</option>
                                                    <option value="0" @if($franchise->add_department == 0) selected @endif>Off</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('add_department')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Add Attandance</label>
                                            <div class="col-7">
                                                <select class="form-select form-control" name="add_attandance">
                                                    <option value="1" @if($franchise->add_attandance == 1) selected @endif>On</option>
                                                    <option value="0" @if($franchise->add_attandance == 0) selected @endif>Off</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('add_attandance')
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
                                <a href="{!! route('employee.franchies') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
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
@section('scripts')


<script>
    function numeralsOnly(evt) {
        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 46)) {
             const mon= document.getElementById('mobile_no');
             mon.style.border="1px solid red";
            return false;
        }else{
         const mon= document.getElementById('mobile_no');
             mon.style.border="none";
        return true;
        }
    }
    function numerOnly(evt) {
        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 46)) {
             const aadhar_no= document.getElementById('aadhar_no');
             aadhar_no.style.border="1px solid red";
            return false;
        }else{
         const mon= document.getElementById('mobile_no');
             mon.style.border="none";
        return true;
        }
    }
// Get references to the elements
    const franchies_permanent_address = document.getElementById('franchies_permanent_address');
    const franchies_communication_address = document.getElementById('franchies_communication_address');
    const franchies_same_check = document.getElementById('franchies_same');

    franchies_same_check.addEventListener('change', function() {
        if (franchies_same_check.checked) {
            franchies_communication_address.setAttribute('readonly', 'readonly');
            franchies_communication_address.value = franchies_permanent_address.value;

        } else {
            franchies_communication_address.removeAttribute('readonly');
            franchies_communication_address.value = '';
        }
    });
    
    

    const permanent_address = document.getElementById('permanent_address');
    const communication_address = document.getElementById('communication_address');
    const address_same = document.getElementById('address_same');

    address_same.addEventListener('change', function() {
        if (address_same.checked) {
            communication_address.setAttribute('readonly', 'readonly');
            communication_address.value = permanent_address.value;
        } else {
            communication_address.removeAttribute('readonly');
            communication_address.value = '';
        }
    });
    
</script>
@endsection