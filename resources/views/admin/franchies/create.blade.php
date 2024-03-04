@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('admin/franchies/insert')}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Create Franchies</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('admin.franchies') !!}">Franchies</a></li>
                    <li class="breadcrumb-item active"> Create Franchies </li>
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
                                    <a class="nav-link " href="{!! route('admin.franchies') !!}"><i class="fa fa-list mr-2"></i>Franchies List</a>
                                </li>
                                <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>Create Franchies</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">

                            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                            <div class="error_top" style="display:none"></div>
                            <div class="row restaurant_payout_create">

                                <div class="restaurant_payout_create-inner">
                                    <fieldset>
                                        <legend>Create Franchies</legend>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Franchies Name <sup style="color:red;">*</sup> </label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="franchies_name" value="{{ old('franchies_name') }}">
                                                <div class="form-text text-muted">
                                                    @error('franchies_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Franchies Tag Line <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="franchies_tag_line" value="{{ old('franchies_tag_line') }}">
                                                <div class="form-text text-muted">
                                                    @error('franchies_tag_line')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label">Franchies Permanent Address <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="franchies_permanent_address" name="franchies_permanent_address" value="{{ old('franchies_permanent_address') }}">
                                                <div class="form-text text-muted">
                                                    @error('franchies_permanent_address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check row width-100">
                                            <input type="checkbox" class="item_publish" name="franchies_same" id="franchies_same" value="1"  @if(old('franchies_same', 0) == 1) checked @endif>
                                            <label class="col-3 control-label" for="franchies_same">Franchies Communication Address Same as Permanent Address</label>
                                            @error('franchies_same')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label">Franchies Communication Address <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="franchies_communication_address" name="franchies_communication_address" value="{{ old('franchies_communication_address') }}">
                                                <div class="form-text text-muted">
                                                    @error('franchies_communication_address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </fieldset>
                                    <fieldset>
                                        <legend>Manager Details</legend>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Name <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                                <div class="form-text text-muted">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Mobile No. <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="mobile_no" onkeypress="return numeralsOnly(event)" maxlength="10" name="mobile_no" value="{{ old('mobile_no') }}">
                                                <div class="form-text text-muted">
                                                    @error('mobile_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Email <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                                <div class="form-text text-muted">
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Password <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="password" value="{{ old('password') }}">
                                                <div class="form-text text-muted">
                                                    @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <!--<div class="form-group row width-50">-->
                                        <!--    <label class="col-3 control-label">Profile Image</label>-->
                                        <!--    <div class="col-7">-->
                                        <!--      <input type="file" class="form-control" id="profile" name="images">-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Profile Image</label>
                                            <div class="col-7">
                                                <input type="file" class="form-control" id="profile" name="images" onchange="validateImage()">
                                                <small id="imageError" class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Zone. <span style="color:red">*</span></label>
                                            <div class="col-7">
                                                <select class="form-control" id="zone_id" name="zone_id">
                                                    <option value="">Select Zone </option>
                                                    @foreach($zone as $zon)
                                                        <option value="{{ $zon->id }}" {{ old('zone_id') == $zon->id ? 'selected' : '' }}>
                                                            {{ $zon->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('zone_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label">Permanent Address <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="permanent_address" name="permanent_address" value="{{ old('permanent_address') }}">
                                                <div class="form-text text-muted">
                                                    @error('permanent_address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check row width-100">
                                            <input type="checkbox" class="item_publish" name="address_same" id="address_same" value="1"
                                                @if(old('address_same', 0) == 1) checked @endif>
                                            <label class="col-3 control-label" for="address_same">Communication Address Same as Permanent Address</label>
                                            @error('address_same')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label"> Communication Address <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="communication_address" name="communication_address" value="{{ old('communication_address') }}">
                                                <div class="form-text text-muted">
                                                    @error('communication_address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label"> PAN No. <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="pan_card_no" name="pan_card_no" value="{{ old('pan_card_no') }}">
                                                <div class="form-text text-muted">
                                                    @error('pan_card_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label"> Aadhar No. <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" id="aadhar_no" maxlength="12" onkeypress="return numerOnly(event)" name="aadhar_no" value="{{ old('aadhar_no') }}">
                                                <div class="form-text text-muted">
                                                    @error('aadhar_no')
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

                        </div>
                        <div class="form-group col-12 text-center btm-btn">
                            <button type="submit" class="btn btn-primary save_attribute_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
                            <a href="{!! route('admin.franchies') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
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
<script>
    function validateImage() {
        var fileInput = document.getElementById('profile');
        var file = fileInput.files[0];
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (file && allowedExtensions.test(file.name)) {
            document.getElementById('imageError').textContent = '';
        } else {
            document.getElementById('imageError').textContent = 'Please select a valid image file (jpg, jpeg, png, gif).';
            fileInput.value = '';
        }
    }
</script>
@endsection