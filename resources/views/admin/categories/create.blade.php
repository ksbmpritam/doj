@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('admin/categories/insert')}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.category_plural')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('admin.categories') !!}">{{trans('lang.category_plural')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('lang.category_create')}}</li>
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
                                <a class="nav-link active" href="{!! route('admin.categories.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.category_create')}}</a>
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
                                        <legend>{{trans('lang.category_create')}}</legend>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.category_name')}} <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" name="categories_name" class="form-control cat-name">
                                                <div class="form-text text-muted">{{ trans("lang.category_name_help") }}
                                                    @error('categories_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Restaurant <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <select class="form-select form-control" name="restaurants_id">
                                                    <option value="0">All</option>
                                                    @foreach($restaurant as $c)
                                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="form-text text-muted">{{ trans("lang.category_name_help") }}
                                                    @error('categories_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-3 control-label ">{{trans('lang.category_description')}} <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <textarea rows="7" class="category_description form-control" id="category_description" name="descriptions"></textarea>
                                                <div class="form-text text-muted">{{ trans("lang.category_description_help")}}
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
                                                <div id="uploding_image"></div>
                                                <div class="form-text text-muted w-100">
                                                    @error('category_images')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <small id="imageError" class="text-danger"></small>
                                            </div>
                                        </div>

                                        <div class="form-check row width-100">
                                            <input type="checkbox" class="item_publish" name="status" value="1" id="item_publish">
                                            <label class="col-3 control-label" for="item_publish">{{trans('lang.item_publish')}}</label>
                                        </div>
                                        <div class="form-check row width-100" id="show_in_home">
                                            <input type="checkbox" name="show_in_homepage" value="1" id="show_in_homepage">
                                            <label class="col-3 control-label" for="show_in_homepage">Show in Homepage?</label>
                                            <div class="form-text text-muted w-50">Maximum 5 categories will show in homepage<span id="forsection"></span></div>
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
                        <a href="{!! route('admin.categories') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
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