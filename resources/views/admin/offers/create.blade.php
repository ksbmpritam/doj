@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('admin/offer/insert')}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Offers</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('admin.offer') !!}">Offer</a>
                    </li>
                    <li class="breadcrumb-item active">Create Offer</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link " href="{!! route('admin.offer') !!}"><i class="fa fa-list mr-2"></i>Offers List</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! route('admin.offer.create') !!}"><i class="fa fa-plus mr-2"></i>Create Offer</a>
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
                                        <legend>Create Offer</legend>
                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label">Type <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <select id="type_id" name="type_id" class="form-control">
                                                    @foreach($offer_category as $oc)
                                                        <option value="{{$oc->id}}" id="order_placed">{{$oc->title}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('type_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>




                                            <div class="form-group row width-100">
                                                <label class="col-3 control-label">Image <sup style="color:red;">*</sup></label>
                                                <div class="col-7">
                                                    <input type="file" id="offer_image" name="offer_images">
                                                    <div class="placeholder_img_thumb cat_image"></div>
                                                    <div id="uploding_image"></div>
                                                    <div class="form-text text-muted w-100">
                                                        @error('category_images')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-check row width-100">
                                                <input type="checkbox" class="item_publish" name="status" value="1" id="item_publish">
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
                        <button type="submit" class="btn btn-primary save_category_btn"><i class="fa fa-save"></i>
                            {{trans('lang.save')}}
                        </button>
                        <a href="{!! route('admin.offer') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
</div>

@endsection