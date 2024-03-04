@extends('admin.layouts.app')

@section('content')
    <div class="page-wrapper">
        <form action="{{ url('admin/products/offer/update/'. $setting->id)}}" method="post" enctype="multipart/form-data">
         @csrf
        <div class="row page-titles">
        
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Product Offers</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{!! route('admin.products.offer') !!}">Product Offer</a></li>
                    <li class="breadcrumb-item active">Edit Product Offer</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <div class="card-header">
                        
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                              <a class="nav-link " href="{!! route('admin.products.offer') !!}"><i class="fa fa-list mr-2" ></i>Product Offer</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                              <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2" ></i>Edit Product Offer</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}</div>
                        <div class="error_top" style="display:none"></div>
                        <div class="row restaurant_payout_create" role="tabpanel">

                            <div class="restaurant_payout_create-inner tab-content">
                                <div role="tabpanel" class="tab-pane active" id="category_information">
                                    <fieldset>
                                        <legend>Create Prodct Offers</legend>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Title <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                              <input type="text" class="form-control " name="title" value={{$setting->title}}>
                                              <div class="form-text text-muted">
                                                @if ($errors->has('title'))
                                                    <div class="text-danger">{{ $errors->first('title') }}</div>
                                                @endif
                            
                                              </div>
                                            </div>
                                        </div>
                            
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Discount % <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                              <input type="number" class="form-control " name="discount" value={{$setting->discount}}>
                                              <div class="form-text text-muted">
                                                 @if ($errors->has('discount'))
                                                    <div class="text-danger">{{ $errors->first('discount') }}</div>
                                                @endif
                                              </div>
                                            </div>
                                        </div>

                                        <div class="form-check row width-100">
                                            <input type="checkbox" class="item_publish" name="status" value="1" id="item_publish" {{ $setting->status == 1 ? 'checked' : '' }}>
                                            <label class="col-3 control-label" for="item_publish">{{trans('lang.item_publish')}}</label>
                                        </div>

                                    </fieldset>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="form-group col-12 text-center btm-btn">
                        <button type="submit" class="btn btn-primary save_category_btn">
                            <i class="fa fa-save"></i> {{trans('lang.save')}}</button>
                        <a href="{!! route('admin.products.offer') !!}" class="btn btn-default">
                            <i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                    </div>

                </div>
            </div>
        </div>
        </form>
    </div>


@endsection

