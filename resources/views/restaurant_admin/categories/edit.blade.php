@extends('restaurant_admin.layouts.app')

@section('content')
    <div class="page-wrapper">
        <form action="{{ url('restaurant/category/update/'. $category->id)}}" method="post" enctype="multipart/form-data">
         @csrf
        <div class="row page-titles">
        
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.category_plural')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('restaurant/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{!! route('restaurant.category') !!}">{{trans('lang.category_plural')}}</a></li>
                    <li class="breadcrumb-item active">category edit</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}</div>
                        <div class="error_top" style="display:none"></div>
                        <div class="row restaurant_payout_create" role="tabpanel">

                            <div class="restaurant_payout_create-inner tab-content">
                                <div role="tabpanel" class="tab-pane active" id="category_information">
                                    <fieldset>
                                        <legend>category edit</legend>
                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label">{{trans('lang.category_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control cat-name" name="categories_name" value="{{$category->name}}">
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
                                            <textarea rows="7" class="category_description form-control" id="category_description" name="descriptions">{{$category->description}}</textarea>
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
                                                <input type="file" id="category_image" name="images">
                                                <div class="placeholder_img_thumb cat_image"></div>
                                                <div id="uploding_image">
                                                    <img src="{{ asset('images/categories/' . $category->images) }}" width="100" height="100" alt="categories Photo">
                                                </div>
                                                <div class="form-text text-muted w-50">{{ trans("lang.category_image_help") }}</div>
                                            </div>
                                        </div>

                                       <div class="form-check row width-100">
                                        <!--<input type="checkbox" class="item_publish" id="item_publish">-->
                                         <input type="checkbox" id="item_publish" value="1" name="status" @if ($category->status == '1') checked @endif>
                                        
                                        <label class="col-3 control-label"
                                               for="item_publish">{{trans('lang.item_publish')}}</label>
                                       </div>

                            
                       
                                    </fieldset>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="review_attributes">

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="form-group col-12 text-center btm-btn">
                        <button type="submit" class="btn btn-primary save_category_btn"><i
                                    class="fa fa-save"></i> {{trans('lang.save')}}</button>
                        <a href="{!! route('restaurant.category') !!}" class="btn btn-default"><i
                                    class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                    </div>

                </div>
            </div>
        </div>
        </form>
    </div>


@endsection

