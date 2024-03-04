@extends('restaurant_admin.layouts.app')
@section('content')
<div class="page-wrapper">
    <form action="{{ url ('restaurant/promoCode/update/'.$promo_code->id)}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">Promo Code </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('restaurant/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Promo Code</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="body-card">
                        <div class="col-12">
                           
                            <div class="resttab-sec">
                                <div id="data-table_processing" class="dataTables_processing panel panel-default"
                                     style="display: none;">{{trans('lang.processing')}}</div>
                                <div class="error_top"></div>
                                <div class="row restaurant_payout_create">
                                    <div class="restaurant_payout_create-inner">
        
                                        <fieldset>
                                            <legend>Promo Code Status</legend>
        
                                            <div class="form-group row width-100">
                                                <label class="col-3 control-label">Status</label>
                                                <div class="col-7">
                                                    <select class="form-control form-select" name="accept_by" id="accept_by">
                                                        <option value="1" @if(old('accept_by', $promo_code->accept_by) == 1) selected @endif>Accept</option>
                                                        <option value="2" @if(old('accept_by', $promo_code->accept_by) == 2) selected @endif>Pending</option>
                                                        <option value="-1" @if(old('accept_by', $promo_code->accept_by) == -1) selected @endif>Reject</option>
                                                        <option value="0" @if(old('accept_by', $promo_code->accept_by) == 0) selected @endif>Process</option>
                                                    </select>
                                                    <div class="form-text text-muted">
                                                        @error('accept_by')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
        
                                             <div class="form-group row width-100" id="reasonField" style="display: none;">
                                                <label class="col-3 control-label">Reason</label>
                                                <div class="col-7">
                                                    <textarea class="form-control" rows="4" name="cancel_reason" id="cancel_reason">{{ $promo_code->cancel_reason }}</textarea>
                                                    <div class="form-text text-muted">
                                                        @error('cancel_reason')
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
                            <button type="submit" class="btn btn-primary "><i class="fa fa-save"></i>
                                {{trans('lang.save')}}
                            </button>
                            <a href="{!! route('restaurant.promoCode') !!}" class="btn btn-default">
                                <i class="fa fa-undo"></i>{{trans('lang.cancel')}}
                            </a>
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
<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#accept_by').change(function() {
        if ($(this).val() === "-1") {
            $('#reasonField').show();
        } else {
            $('#reasonField').hide();
        }
    });
    
    const adminStatusSelect = document.getElementById('accept_by');
    if(adminStatusSelect.value == -1){
        $('#reasonField').show();
    }
});
</script>
@endsection