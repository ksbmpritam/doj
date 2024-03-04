@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url('admin/categories/update/'. $category->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.category_plural')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('admin.categories') !!}">{{trans('lang.category_plural')}}</a></li>
                    <li class="breadcrumb-item active">category edit</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <div class="card-header">

                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link " href="{!! route('admin.categories') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.category_table')}}</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.category_edit')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                        <div class="error_top" style="display:none"></div>
                        <div class="row restaurant_payout_create" role="tabpanel">

                            <div class="restaurant_payout_create-inner tab-content">
                                <div role="tabpanel" class="tab-pane active" id="category_information">
                                    <fieldset>
                                        <legend>category edit</legend>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.category_name')}} <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control cat-name" name="categories_name" value="{{$category->name}}">
                                                <div class="form-text text-muted">{{ trans("lang.category_name_help") }} </div>
                                                @error('categories_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Restaurant <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <select class="form-select form-control" name="restaurants_id">
                                                    <option value="0">All</option>
                                                    @foreach($restaurant as $c)
                                                        @if($c->id == $category->restaurants_id)
                                                            <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                                        @else
                                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <div class="form-text text-muted">{{ trans("lang.category_name_help") }}</div>
                                                @error('categories_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label ">{{trans('lang.category_description')}} <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <textarea rows="7" class="category_description form-control" id="category_description" name="descriptions">{{$category->description}}</textarea>
                                                <div class="form-text text-muted">
                                                    @error('descriptions')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label">{{trans('lang.category_image')}} <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="file" id="category_image" name="category_images" onchange="validateImage()">
                                                <div class="placeholder_img_thumb cat_image"></div>
                                                <div id="uploding_image">
                                                    <img src="{{ asset('images/categories/' . $category->images) }}" width="100" height="100" alt="categories Photo">
                                                </div>
                                                <small id="imageError" class="text-danger"></small>
                                                <div class="form-text text-muted w-50">{{ trans("lang.category_image_help") }}</div>
                                            </div>
                                        </div>

                                        <div class="form-check row width-100">
                                            <input type="checkbox" id="item_publish" value="1" name="status" @if ($category->status == 1) checked @endif>
                                            <label class="col-3 control-label" for="item_publish">{{trans('lang.item_publish')}}</label>
                                        </div>

                                        <div class="form-check row width-100" id="show_in_home">
                                            <input type="checkbox" name="show_in_homepage" value="1" id="show_in_homepage" @if ($category->homepage == 1) checked @endif>
                                            <label class="col-3 control-label" for="show_in_homepage">{{trans('lang.show_in_home')}}</label>
                                            <div class="form-text text-muted w-50">{{trans('lang.show_in_home_desc')}}<span id="forsection"></span></div>
                                        </div>

                                    </fieldset>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="review_attributes">

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="form-group col-12 text-center btm-btn">
                        <button type="submit" class="btn btn-primary save_category_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
                        <a href="{!! route('admin.categories') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function validateImage() {
        var fileInput = document.getElementById('category_image');
        var file = fileInput.files[0];
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (file && allowedExtensions.test(file.name)) {
            document.getElementById('imageError').textContent = '';
        } else {
            document.getElementById('imageError').textContent = 'Please select a valid image file (jpg, jpeg, png, gif).';
            fileInput.value = '';
        }
    }
</script>

@endsection