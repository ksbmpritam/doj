@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ route('admin.orderPromoCode.store_users', $promo_code->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Promo Code</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">{{ trans('lang.dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.orderPromoCode') }}">Promo Code</a></li>
                    <li class="breadcrumb-item active">Select Users</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card pb-4">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a; border-radius: 2px">
                                <a class="nav-link" href="{{ route('admin.orderPromoCode') }}"><i class="fa fa-list mr-2"></i>Promo Code</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a; border-radius: 2px">
                                <a class="nav-link active" href="{{ url()->current() }}"><i class="fa fa-plus mr-2"></i>Select Users</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
                            {{ trans('lang.processing') }}
                        </div>
                        <div class="row restaurant_payout_create" role="tabpanel">
                            <div class="restaurant_payout_create-inner tab-content">
                                <div role="tabpanel" class="tab-pane active" id="promo_information">
                                    <fieldset>
                                        @if ($errors->user_association_errors->has('user_id'))
                                            <div class="alert alert-danger">
                                                {{ $errors->user_association_errors->first('user_id') }}
                                            </div>
                                        @endif
                                        <legend>Promo Code</legend>
                                        
                                        <div class="form-group row width-100">
                                            <div class="row">
                                                
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" id="userSearchInput" class="form-control" placeholder="Search users...">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div  class="form-group row width-100">
                                            <div class="col-sm-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="coupon_enabled" id="checkAll" >
                                                    <label class="control-label" for="checkAll">Check All</label>
                                                </div>
                                            </div>
                                            <div id="loader" style="display: none;">
                                                Loading...
                                            </div>
                                            <div class="form-check" id="userList">
                                               
                                            </div>
                                            
                                        </div>

                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-12 text-center btm-btn">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('lang.save') }}</button>
                    <a href="{{ route('admin.orderPromoCode') }}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel') }}</a>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('scripts')

<script>
$(document).ready(function () {
    function displayAllUsers(data) {
      
        data.forEach(function (user) {
            var isChecked = user.selected ? 'checked' : '';
                // console.log(user);
            if (user.hasOrder===user.promo_order) {
                $('#userList').append(`
                    <input type="checkbox" class="coupon_enabled" id="user_${user.user.id}" name="user_id[]" value="${user.user.id}" ${isChecked}>
                    <label class="m-2 control-label user-label" for="user_${user.user.id}">${user.user.name} <span><label class="badge badge-success " style="background:green;">${user.promo_order}</label></span> </label>
                `);
            } 
        });
    }

    function showLoader() {
        $('#loader').show();
    }
    
    function hideLoader() {
        $('#loader').hide();
    }
    
    var selectedValue = 'all_user';
    showLoader();
 
    $.ajax({
        url: '/admin/orderPromoCode/get_users',
        type: 'GET',
        data: {
            category: selectedValue,
            id: "<?php echo $id ?>"
        },
        success: function (data) {
            $('#userList').empty(); 
            // console.log(data);
            if (data) {
                displayAllUsers(data);
            }
            hideLoader(); 
        },
        error: function (xhr) {
            hideLoader();
            console.log('Error:', xhr);
        }
    });
    
   
    
    $('#userSearchInput').on('keyup', function () {
  
         const searchValue = $(this).val();
        
        $.ajax({
            url: '/admin/orderPromoCode/search_users',
            type: 'GET',
            data: {
                search: searchValue,
                id: "<?php echo $id ?>"
            },
            success: function (data) {
                $('#userList').empty(); 
                // console.log(data);
                if (data) {
                    displayAllUsers(data);
                }
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });
    
    
    
    $('#checkAll').change(function () {
        if ($(this).is(":checked")) {
            $('.coupon_enabled').prop('checked', true);
        } else {
            $('.coupon_enabled').prop('checked', false);
        }
    });

    $('.coupon_enabled').change(function () {
        var totalCheckboxes = $('.coupon_enabled').length;
        var checkedCheckboxes = $('.coupon_enabled:checked').length;

        $('#checkAll').prop('checked', totalCheckboxes === checkedCheckboxes);
    });


});
</script>

@endsection
