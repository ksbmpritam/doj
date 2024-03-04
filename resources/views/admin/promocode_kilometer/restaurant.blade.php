@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
   
    <form action="{{ url('admin/kilometer/kilometerstore_restaurant/'. $promo_code->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Promo Code kilometer</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('admin.kilometer') !!}">Promo Code kilometer</a></li>
                    <li class="breadcrumb-item active">Select Restaurant</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <div class="card-header">

                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link " href="{!! route('admin.kilometer') !!}"><i class="fa fa-list mr-2"></i>Promo Code kilometer </a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>Select Restaurant </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                        <div class="row restaurant_payout_create" role="tabpanel">

                            <div class="restaurant_payout_create-inner tab-content">
                                <div role="tabpanel" class="tab-pane active" id="promo_information">
                                    <fieldset>
                                        <legend>Promo Code </legend>
                                        @error('restaurant_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                       
                                        
                                         <div  class="form-group row width-100">
                                             <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="coupon_enabled" id="checkAll" >
                                                        <label class="control-label" for="checkAll">Check All</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" id="restaurantSearch" class="form-control" placeholder="Search Restaurant ...">
                                                </div>
                                            </div>
                                            
                                            <div id="loader" style="display: none;">
                                                Loading...
                                            </div>
                                            
                                            <div class="form-check" id="restaurantList">
                                               
                                            </div>
                                        </div>
                                        
                                    </fieldset>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="form-group col-12 text-center btm-btn">
                    <button type="submit" class="btn btn-primary "><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
                    <a href="{!! route('admin.kilometer') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                </div>

            </div>
        </div>
    </form>
</div>
</div>


@endsection
@section('scripts')


<script>
$(document).ready(function () {

    function displayAllRestaurant(data) {
        $('#restaurantList').empty();
        data.forEach(function (restaurant) {
            var isChecked = restaurant.selected ? 'checked' : '';
            $('#restaurantList').append(`
                <input type="checkbox" class="coupon_enabled" id="restaurant_${restaurant.restaurant.id}" name="restaurant_id[]" value="${restaurant.restaurant.id}"  ${isChecked}>
                <label class="m-2 control-label user-label" for="restaurant_${restaurant.restaurant.id}">${restaurant.restaurant.name}</label>
            `);
        
        });
    }
    
    function showLoader() {
        $('#loader').show();
    }
    
    function hideLoader() {
        $('#loader').hide();
    }
    
    showLoader();

    $.ajax({
        url: '/admin/kilometer/kmget_restaurant',
        type: 'GET',
        data: {
            id: "<?php echo $id ?>"
        },
        success: function (data) {

            $('#restaurantList').empty(); 
            if (data) {
                displayAllRestaurant(data);
            }
              hideLoader();
        },
        error: function (xhr) {
            hideLoader();
            console.log('Error:', xhr);
        }
    });


    $('#restaurantSearch').on('keyup', function () {
        const searchValue = $(this).val();
        showLoader();
          $('#restaurantList').empty();
        $.ajax({
            url: '/admin/kilometer/search_restaurant',
            type: 'GET',
            data: {
                search: searchValue,
                id: "<?php echo $id ?>"
            },
            success: function (data) {
                $('#restaurantList').empty();
                if (data) {
                    displayAllRestaurant(data);
                }
                hideLoader(); 
            },
            error: function (xhr) {
                console.log('Error:', xhr);
                hideLoader();
            }
        });
    });


    $('.fav_clr').on("select2:select", function (e) { 
       var data = e.params.data.text;
       if(data=='all'){
        $(".fav_clr > option").prop("selected","selected");
        $(".fav_clr").trigger("change");
       }
    });
    
    $(document).ready(function () {
        $('#checkAll').change(function () {
            var isChecked = $(this).is(":checked");
            $('.coupon_enabled').prop('checked', isChecked);
        });
    });
  
});    
</script>
@endsection