@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('admin/promoCode/insert')}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Promo Code</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('admin.promoCode') !!}">Promo Code</a>
                    </li>
                    <li class="breadcrumb-item active">Create Promo Code</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link " href="{!! route('admin.promoCode') !!}"><i class="fa fa-list mr-2"></i>Promo Code List</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! route('admin.promoCode.create') !!}"><i class="fa fa-plus mr-2"></i>Create Promo Code</a>
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
                                        <legend>Promo Code</legend>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Promo Code Name  <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" name="promo_code_name" class="form-control" value="{{ old('promo_code') }}">
                                                <div class="form-text text-muted">
                                                    @error('promo_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Image <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="file" id="promo_images" name="promo_images" >
                                                <div class="form-text text-muted w-100">
                                                    @error('promo_images')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                           
                                          <div class="form-group row width-50">
                                            <label class="col-3 control-label">Enter minimum Amount  <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                              <input type="number" name="minimum" pattern="[0-9]*" inputmode="numeric" oninput="validateInput(this);" placeholder="Enter minimum Amount " class="col-sm-5 form-control" />
                                                <div class="form-text text-muted">
                                                    @error('minimum Amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group row width-50">
                                            <label class="col-3 control-label">Enter Maximum  Amount  <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                              <input type="number" name="maximum" pattern="[0-9]*" inputmode="numeric" oninput="validateInput(this);" placeholder="Enter Maximum  Amount  " class="col-sm-5 form-control" />
                                                <div class="form-text text-muted">
                                                    @error('Maximum')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                           <div class="form-check form-group row width-100">
                                            <label>Coupon Type</label>
                                            <div class="row">
                                                <div class="col-2">
                                                    <input type="radio" class="item_publish" name="coupon_type" value="all" id="all" {{ old('coupon_type') == 'all' ? 'checked' : '' }}>
                                                    <label class=" control-label" for="all">All</label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" class="item_publish" name="coupon_type" value="cod" id="cod" {{ old('coupon_type') == 'cod' ? 'checked' : '' }}>
                                                    <label class=" control-label" for="cod">COD</label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" class="item_publish" name="coupon_type" value="online" id="online" {{ old('coupon_type') == 'online' ? 'checked' : '' }}>
                                                    <label class=" control-label" for="online">Online</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Discount Type <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <select id="discount_type" class="form-control" name="discount_type">
                                                    <option value="">select type</option>
                                                    <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                                    <option value="up_topercentage" {{ old('discount_type') == 'up_topercentage' ? 'selected' : '' }}>Up To Percentage (%)</option>
                                                    <option value="amount" {{ old('discount_type') == 'amount' ? 'selected' : '' }}>Amount (₹)</option>
                                                    <option value="up_to_amount" {{ old('discount_type') == 'up_to_amount' ? 'selected' : '' }}>Up To Amount (₹)</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @if ($errors->has('discount_type'))
                                                    <div class="text-danger">{{ $errors->first('discount_type') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                          <div class="form-group row width-50"  id="inputField_show_hide" style="display: none;">
                                            <label class="col-3 control-label">Up to Price <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="number" name="up_topercentage_price" pattern="[0-9]*" inputmode="numeric" oninput="validateInput(this);" class="form-control" min="0" value="{{ old('up_topercentage_price') }}">
                                                <div class="form-text text-muted">
                                                    @error('up_topercentage_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                           </div>
                                        
                                        
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Discount Value <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="number" name="discount" pattern="[0-9]*" inputmode="numeric" oninput="validateInput(this);" class="form-control" min="0" value="{{ old('discount') }}">
                                                <div class="form-text text-muted">
                                                    @error('discount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">From Date <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
                                                <div class="form-text text-muted">
                                                    @error('start_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check form-group row width-50">
                                            <label>Active Dates</label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="radio" class="item_publish" name="active_dates" value="always_active" id="always_active" {{ old('active_dates') == 'always_active' ? 'checked' : '' }}>
                                                    <label class=" control-label" for="always_active">Always Active</label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="radio" class="item_publish" name="active_dates" value="expires_at" id="expires_at" {{ old('active_dates') == 'expires_at' ? 'checked' : '' }}>
                                                    <label class=" control-label" for="expires_at">Expires At</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50" >
                                            <div id="to_date" style="display: {{ old('expires_at') === 'expires_at' ? 'inline-block' : 'none' }};">
                                                <label class="col-3 control-label">To Date <sup style="color:red;">*</sup></label>
                                                <div class="col-7">
                                                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                                                    <div class="form-text text-muted">
                                                        @error('end_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-check form-group row width-50">
                                            <label>Coupon Usage</label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="radio" class="item_publish" name="coupon_usage" value="unlimited" id="unlimited" {{ old('coupon_usage') == 'unlimited' ? 'checked' : '' }}>
                                                    <label class=" control-label" for="unlimited">Unlimited</label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="radio" class="item_publish" name="coupon_usage" value="limited" id="limited" {{ old('coupon_usage') == 'limited' ? 'checked' : '' }}>
                                                    <label class=" control-label" for="limited">Limited</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row width-50" >
                                            <div id="limitedCouponContainer" style="display: {{ old('coupon_usage') === 'limited' ? 'inline-block' : 'none' }};">
                                                <label class="col-3 control-label">Coupon Usage Limited <sup style="color:red;">*</sup></label>
                                                <div class="col-7">
                                                    <input type="number" min="0" name="limited_usage" class="form-control" value="{{ old('limited_usage') }}">
                                                    <div class="form-text text-muted">
                                                        @error('limited_usage')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50" >
                                            <label class="col-3 control-label">Doj / Restaurant % <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input type="number" name="res_percentage" placeholder=" Restaurant" class=" form-control" value="{{ old('res_percentage') }}">
                                                            <div class="form-text text-muted">
                                                    @error('res_percentage')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="number" name="doj_percentage" placeholder=" Doj" class=" form-control" value="{{ old('doj_percentage') }}">
                                                    </div>
                                                </div>
                                                <div class="form-text text-muted">
                                                    @error('end_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label ">Message <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <textarea rows="3" class="form-control" id="message" name="message"> {{ old('message') }} </textarea>
                                                <div class="form-text text-muted">
                                                    @error('message')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-check row width-100">
                                            <input type="checkbox" class="item_publish" name="status" value="1" id="item_publish" {{ old('status') == '1' ? 'checked' : '' }}>
                                            <label class="col-3 control-label" for="item_publish">{{trans('lang.item_publish')}}</label>
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
                        <a href="{!! route('admin.promoCode') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    
    var i = 0;
        
    $("#add-btn").click(function(){
    
        ++i;
        $("#dynamicAddRemove").append(`<tr>
            <td class="row d-flex" style="flex-wrap: nowrap">
                <input type="text" name="distance_km[]" placeholder="Enter km" class="col-sm-5 form-control" />
                <select class="form-control col-sm-3" name="discount_type_km[]">
                    <option value="">select type</option>
                    <option value="percentage" {{ old('discount_type_km') == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                    <option value="up_topercentage" {{ old('discount_type_km') == 'up_topercentage' ? 'selected' : '' }}>Up To Percentage (%)</option>
                    <option value="amount" {{ old('discount_type_km') == 'amount' ? 'selected' : '' }}>Amount (₹)</option>
                    <option value="up_to_amount" {{ old('discount_type_km') == 'up_to_amount' ? 'selected' : '' }}>Up To Amount (₹)</option>
                </select>
                <input type="number" name="value[]" placeholder="Enter Value" class="col-sm-3 form-control" />
                <button type="button" class="btn btn-danger remove-tr col-sm-1"> - </button>
            </td>
        </tr>`);
    });
    
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
    
</script>

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
   
    $('input[name="active_dates"]').change(function() {
        var selectedValue = $(this).val();
        // Hide all additional input fields initially
        $('#to_date').hide();

        // Show the appropriate input field based on the selected value
        if (selectedValue === 'expires_at') {
            $('#to_date').show();
        }
    });
    
    $('input[name="coupon_usage"]').change(function() {
        var selectedValue = $(this).val();

        // Hide all additional input fields initially
        $('#limitedCouponContainer').hide();

        // Show the appropriate input field based on the selected value
        if (selectedValue === 'limited') {
            $('#limitedCouponContainer').show();
        }
    });
    
    
</script>


<script>
    
    document.getElementById('discount_type').addEventListener('change', function() {
        
        
  var inputField = document.getElementById('discount_type').value;
  
 

  var inputField_show_hide = document.getElementById('inputField_show_hide').style.display;
  var inputField_change = document.getElementById('inputField_show_hide');
   
  
    if (inputField === 'up_topercentage') {
          if (inputField_show_hide === 'none') {
            inputField_change.style.display = 'block';
          } else if (inputField_show_hide === 'hide') {
            inputField_change.style.display = 'none';
          }
        }else{
             inputField_change.style.display = 'none';
        }
   });

    
</script>

 <script>
        ClassicEditor
            .create( document.querySelector( '#message' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
<script>
    function validateInput(element) {
        element.value = element.value.replace(/[^0-9]/g, '');
    }
</script>


@endsection