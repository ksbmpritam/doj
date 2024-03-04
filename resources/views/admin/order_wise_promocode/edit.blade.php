@extends('admin.layouts.app')

@section('content')
    <div class="page-wrapper">
        <form action="{{ url('admin/orderPromoCode/update/'. $promo_code->id)}}" method="post" enctype="multipart/form-data">
         @csrf
        <div class="row page-titles">
        
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Order Promo Code</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('admin.orderPromoCode') !!}">Order Promo Code</a></li>
                    <li class="breadcrumb-item active">Edit Order Promo Code</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <div class="card-header">
                        
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                              <a class="nav-link " href="{!! route('admin.orderPromoCode') !!}"><i class="fa fa-list mr-2" ></i>Order Promo Code </a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                              <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2" ></i>Edit Order Promo Code</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}</div>
                        <div class="error_top" style="display:none"></div>
                        <div class="row restaurant_payout_create" role="tabpanel">

                            <div class="restaurant_payout_create-inner tab-content">
                                <div role="tabpanel" class="tab-pane active" id="promo_information">
                                    <fieldset>
                                        <legend>Order Promo Code</legend>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Promo Code Name <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" name="promo_code_name" class="form-control" value="{{$promo_code->promo_code_name}}">
                                                <div class="form-text text-muted">
                                                    @error('promo_code_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Image <sup style="color:red;">*</sup></label>
                                            <div class="row">
                                                <div class="col-lg-7">
                                                    <input type="file" id="promo_images" class="form-control" name="promo_images">
                                                    <div class="placeholder_img_thumb cat_image"></div>
                                                    <div id="uploding_image"></div>
                                                    <div class="form-text text-muted w-100">
                                                        @error('promo_images')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-5" id="uploding_image">
                                                    <img src="{{ asset('images/promo/' . $promo_code->image) }}" width="100" height="100" alt="promo Photo">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Discount Type <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <select id="discount_type" class="form-control" name="discount_type">
                                                    <option value="">select type</option>
                                                    <option value="percentage" {{$promo_code->discount_type == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                                    <option value="up_topercentage" {{$promo_code->discount_type == 'up_topercentage' ? 'selected' : '' }}>Up To Percentage (%)</option>
                                                    <option value="amount" {{ $promo_code->discount_type == 'amount' ? 'selected' : '' }}>Amount (₹)</option>
                                                    <option value="up_to_amount" {{ $promo_code->discount_type == 'up_to_amount' ? 'selected' : '' }}>Up To Amount (₹)</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @if ($errors->has('discount_type'))
                                                    <div class="text-danger">{{ $errors->first('discount_type') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Discount Value <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="number" name="discount" class="form-control" min="0" value="{{$promo_code->discount}}">
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
                                                <input type="date" name="start_date" class="form-control" value="{{$promo_code->start_date}}">
                                                <div class="form-text text-muted">
                                                    @error('start_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="form-group row width-50" >
                                            <label class="col-3 control-label">To Date <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="date" name="end_date" class="form-control" value="{{$promo_code->end_date}}">
                                                <div class="form-text text-muted">
                                                    @error('end_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-check form-group row width-50">
                                            <label>Coupon Usage</label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="radio" class="item_publish" name="coupon_usage" value="unlimited" id="unlimited" {{$promo_code->coupon_usage == 'unlimited' ? 'checked' : '' }}>
                                                    <label class=" control-label" for="unlimited">Unlimited</label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="radio" class="item_publish" name="coupon_usage" value="limited" id="limited" {{$promo_code->coupon_usage == 'limited' ? 'checked' : '' }}>
                                                    <label class=" control-label" for="limited">Limited</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row width-50" >
                                            <div id="limitedCouponContainer" style="display: {{$promo_code->coupon_usage === 'limited' ? 'block' : 'none' }};">
                                                <label class="col-3 control-label">Coupon Usage Limited <sup style="color:red;">*</sup></label>
                                                <div class="col-7">
                                                    <input type="number" min="0" name="limited_usage" class="form-control" value="{{$promo_code->limited_usage}}">
                                                    <div class="form-text text-muted">
                                                        @error('limited_usage')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group row width-50" >
                                            <label class="col-3 control-label">Maximum Price <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="number" min="0" name="max_price" class="form-control" value="{{$promo_code->max_price}}">
                                                <div class="form-text text-muted">
                                                    @error('max_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row width-50" >
                                            <label class="col-3 control-label">Minimum Price <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="number" min="0" name="min_price" class="form-control" value="{{$promo_code->min_price}}">
                                                <div class="form-text text-muted">
                                                    @error('min_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check form-group row width-50">
                                            <label>Coupon Type <sup style="color:red;">*</sup></label>
                                            <div class="row">
                                                <div class="col-4">
                                                    <input type="radio" class="item_publish" name="coupon_type" value="all" id="all" {{$promo_code->coupon_type == 'all' ? 'checked' : '' }}>
                                                    <label class=" control-label" for="all">All</label>
                                                </div>
                                                <div class="col-4">
                                                    <input type="radio" class="item_publish" name="coupon_type" value="cod" id="cod" {{ $promo_code->coupon_type == 'cod' ? 'checked' : '' }}>
                                                    <label class=" control-label" for="cod">COD</label>
                                                </div>
                                                <div class="col-4">
                                                    <input type="radio" class="item_publish" name="coupon_type" value="online" id="online" {{ $promo_code->coupon_type == 'online' ? 'checked' : '' }}>
                                                    <label class=" control-label" for="online">Online</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50" >
                                            <label class="col-3 control-label">Order Count <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <select id="count_order" class="form-control" name="count_order">
                                                    <option value="">select type</option>
                                                    <option value="0" {{ $promo_code->count_order == '0' ? 'selected' : '' }}>First Order</option>
                                                    <option value="1" {{ $promo_code->count_order == '1' ? 'selected' : '' }}>Second Order</option>
                                                    <option value="2" {{ $promo_code->count_order == '2' ? 'selected' : '' }}>Third Order</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('count_order')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50" >
                                            <label class="col-3 control-label">Restaurant % <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="number" name="res_percentage" placeholder=" Restaurant" class=" form-control" value="{{$promo_code->res_percentage}}">
                                                <div class="form-text text-muted">
                                                    @error('res_percentage')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50" >
                                            <label class="col-3 control-label">Doj  % <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="number" name="doj_percentage" placeholder=" Doj" class=" form-control"  value="{{$promo_code->doj_percentage}}">
                                                <div class="form-text text-muted">
                                                    @error('doj_percentage')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label ">Message <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <textarea rows="3" class="form-control" id="message" name="message"> {{$promo_code->message}} </textarea>
                                                <div class="form-text text-muted">
                                                    @error('message')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                       

                                        <div class="form-check row width-100">
                                            <input type="checkbox" class="item_publish" name="status" value="1" id="item_publish" {{$promo_code->status == '1' ? 'checked' : '' }}>
                                            <label class="col-3 control-label" for="item_publish">{{trans('lang.item_publish')}}</label>
                                        </div>

                                    </fieldset>
                                    
                                </div>

                                <div role="tabpanel" class="tab-pane" id="review_attributes">

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="form-group col-12 text-center btm-btn">
                        <button type="submit" class="btn btn-primary "><i
                                    class="fa fa-save"></i> {{trans('lang.save')}}</button>
                        <a href="{!! route('admin.orderPromoCode') !!}" class="btn btn-default"><i
                                    class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                    </div>

                </div>
            </div>
        </div>
        </form>
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
   
    $('input[name="coupon_usage"]').change(function() {
        var selectedValue = $(this).val();

        // Hide all additional input fields initially
        $('#limitedCouponContainer').hide();

        // Show the appropriate input field based on the selected value
        if (selectedValue === 'limited') {
            $('#limitedCouponContainer').show();
        }
    });
    
    
    $('input[name="active_dates"]').change(function() {
        var selectedValue = $(this).val();
        // Hide all additional input fields initially
        $('#to_date').hide();

        // Show the appropriate input field based on the selected value
        if (selectedValue === 'expires_at') {
            $('#to_date').show();
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
@endsection
