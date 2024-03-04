@extends('restaurant_admin.layouts.app')

@section('content')
    <div class="page-wrapper">
        <form action="{{ url ('restaurant/category/insert')}}" method="Post" enctype="multipart/form-data">
            @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.category_plural')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('restaurant/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('restaurant.category') !!}">{{trans('lang.category_plural')}}</a>
                    </li>
                    
                    <!--categories-->
                    <li class="breadcrumb-item active">{{trans('lang.category_create')}}</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                   

                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">
                            {{trans('lang.processing')}}
                        </div>
                        <div class="error_top" style="display:none"></div>
                        <div class="row restaurant_payout_create" role="tabpanel">

                            <div class="restaurant_payout_create-inner tab-content">
                                <div role="tabpanel" class="tab-pane active" id="category_information">
                                    <fieldset>
                                        <legend>{{trans('lang.category_create')}}</legend>
                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label">{{trans('lang.category_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="categories_name" class="form-control cat-name" value="{{ old('categories_name') }}">
                                                 <div class="form-text text-muted">{{ trans("lang.category_name_help") }}
                                                     @error('categories_name')
                                                        <span class="text-danger">{{$message}}</span>
                                                     @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label ">{{trans('lang.category_description')}}</label>
                                            <div class="col-7">
                                            <textarea rows="7" class="category_description form-control" id="category_description" name="descriptions">{{ old('descriptions') }}</textarea>
                                                <div class="form-text text-muted">{{ trans("lang.category_description_help")}}
                                                    @error('descriptions')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label">{{trans('lang.category_image')}}</label>
                                            <div class="col-7">
                                                <input type="file" id="category_image" name="category_images">
                                                <div class="placeholder_img_thumb cat_image"></div>
                                                <div id="uploding_image"></div>
                                                <div class="form-text text-muted w-100">{{ trans("lang.category_image_help")}}
                                                @error('category_images')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                                </div>
                                            </div>
                                        </div>

                                       <div class="form-check row width-100">
                                        <input type="checkbox" class="item_publish" value="1" name="status" id="item_publish">
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
                        <a href="{!! route('restaurant.category') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

@endsection

