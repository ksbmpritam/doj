@extends('employee.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">Team </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('employee/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Team</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="menu-tab vendorMenuTab">
                    @include('employee.franchies_menu_team')
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
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Profile Image</label>
                                        <div class="col-7">
                                          <input type="file" class="form-control" id="profile" name="images" readonly>
                                           <div id="uploding_image">
                                                <img src="{{ asset('images/team/profile/' . $team->image) }}" width="100" height="100" alt="Photo">
                                            </div>
                                        </div>
                                    </div>
                                    
                                  
                                    
                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">Permanent Address</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control" id="permanent_address" name="permanent_address" value="{{ $team->permanent_address }}" readonly>
                                            <div class="form-text text-muted">
                                                @error('permanent_address')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check row width-100">
                                        <input type="checkbox" class="item_publish" name="address_same" id="address_same" value="1"
                                            @if($team->address_same == 1) checked @endif disabled>
                                        <label class="col-3 control-label" for="address_same">Communication Address Same as Permanent Address</label>
                                        @error('address_same')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label"> Communication Address</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control" id="communication_address" name="communication_address" @if($team->communication_address == 1) readonly @endif value="{{ $team->communication_address }}" readonly>
                                            <div class="form-text text-muted">
                                                @error('communication_address')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label"> PAN No.</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control" id="pan_card_no" name="pan_card_no" value="{{ $team->pan_card_no }}" readonly>
                                            <div class="form-text text-muted">
                                                @error('pan_card_no')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label"> Aadhar No.</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control" id="aadhar_no" maxlength="12" onkeypress="return numerOnly(event)" name="aadhar_no" value="{{ $team->aadhar_no }}" readonly>
                                            <div class="form-text text-muted">
                                                @error('aadhar_no')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check row width-100">
                                        <input type="checkbox" class="item_publish" name="status" id="status" value="1" @if($team->status == 1) checked @endif disabled>
                                        <label class="col-3 control-label" for="status">{{ trans('lang.item_publish') }}</label>
                                        @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </fieldset>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group col-12 text-center btm-btn">
                    <a href="{{ route('employee.franchies.team.list',['id' => $team->franchies_id]) }}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('scripts')


<script>
    // Mobile No
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
    
    // Aadhar no
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

    // PanCahd No
    const pan_card = document.getElementById('pan_card_no');
    pan_card.addEventListener('input',function(){
        let panUpper=this.value.replace(/[^A-Za-z0-9]/g, '').toUpperCase();
        
        if(panUpper.length > 10){
            panUpper=panUpper.slice(0,10);
        }
        
        this.value = panUpper;
    })
    

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