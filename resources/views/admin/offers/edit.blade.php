@extends('admin.layouts.app')

@section('content')
    <div class="page-wrapper">
        <form action="{{ url('admin/offer/update/'. $offers->id)}}" method="post" enctype="multipart/form-data">
         @csrf
        <div class="row page-titles">
        
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Offers</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{!! route('admin.offer') !!}">Offer</a></li>
                    <li class="breadcrumb-item active">Edit Offer</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <div class="card-header">
                        
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                              <a class="nav-link " href="{!! route('admin.offer') !!}"><i class="fa fa-list mr-2" ></i>Offer List</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                              <a class="nav-link active" href="{!! route('admin.offer.create') !!}"><i class="fa fa-plus mr-2" ></i>Create Offer</a>
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
                                        <legend>Offer edit</legend>
                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label">Type <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <select id="type_id" name="type_id" class="form-control">
                                                    @foreach($offer_category as $oc)
                                                        @if($oc->id == $offers->type_id)
                                                            <option value="{{$oc->id}}" selected>{{$oc->title}}</option>
                                                        @else
                                                            <option value="{{$oc->id}}" >{{$oc->title}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <div class="form-text text-muted">
                                                    @error('type_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label">Image <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="file" id="offer_images" name="offer_images">
                                                <div class="placeholder_img_thumb cat_image"></div>
                                                <div id="uploding_image">
                                                    <img src="{{ asset('images/offer/' . $offers->image) }}" width="100" height="100" alt="type Photo">
                                                </div>
                                                <div class="form-text text-muted w-50">{{ trans("lang.category_image_help") }}</div>
                                            </div>
                                        </div>

                                       <div class="form-check row width-100">
                                            <input type="checkbox" id="item_publish" value="1" name="status" @if ($offers->status == 1) checked @endif>
                                            <label class="col-3 control-label" for="item_publish">{{trans('lang.item_publish')}}</label>
                                       </div>

                                        <!--<div class="form-check row width-100" id="show_in_home">-->
                                        <!--    <input type="checkbox" name="show_in_homepage" value="1" id="show_in_homepage" @if ($offers->homepage == 1) checked @endif>-->
                                        <!--    <label class="col-3 control-label" for="show_in_homepage">{{trans('lang.show_in_home')}}</label>-->
                                        <!--    <div class="form-text text-muted w-50">{{trans('lang.show_in_home_desc')}}<span id="forsection"></span></div>-->
                                        <!--</div>            -->
                       
                                    </fieldset>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="review_attributes">

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="form-group col-12 text-center btm-btn">
                        <button type="submit" class="btn btn-primary save_category_btn">
                            <i class="fa fa-save"></i> {{trans('lang.save')}}</button>
                        <a href="{!! route('admin.offer') !!}" class="btn btn-default">
                            <i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                    </div>

                </div>
            </div>
        </div>
        </form>
    </div>


@endsection

