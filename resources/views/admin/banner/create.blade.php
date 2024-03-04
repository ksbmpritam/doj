@extends('admin.layouts.app')



@section('content')

  <div class="page-wrapper">
      
      <form action="{{ url('admin/banner/insert')}}" method="post" enctype="multipart/form-data">
         @csrf
    <div class="row page-titles">



        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">Banner</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item active">Create Banner</li>

            </ol>

        </div>

    </div>

    <div class="card-body">

        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Banner</div>

        <div class="error_top"></div>

        <div class="row restaurant_payout_create">

            <div class="restaurant_payout_create-inner">

                <fieldset>

                    <legend>Banner</legend>

                    <div class="form-group row width-50">
                        <label class="col-3 control-label">{{trans('lang.title')}} <sup style="color:red;">*</sup></label>
                        <div class="col-7">
                            <input type="text" class="form-control title" name="title" required>
                        </div>
                    </div>
                    

                    <div class="form-group row width-100">

                        <div class="form-check width-100">
                            <input type="checkbox" id="is_publish" value="1" name="status">
                            <label class="col-3 control-label" for="is_publish">{{trans('lang.is_publish')}}</label>
    
                        </div>

                    </div>

                    <div class="form-group row width-50">

                        <label class="col-3 control-label">{{trans('lang.photo')}} <sup style="color:red;">*</sup></label>

                        <input type="file" id="banner_img" name="banner_photo" class="col-7" required>

                        <div id="uploding_image"></div>
                        <div class="placeholder_img_thumb user_image"></div>
                    </div>
                   
                </fieldset>

            </div>
        </div>

    </div>

    <div class="form-group col-12 text-center">

        <button type="submit" class="btn btn-primary  create_banner_btn" ><i class="fa fa-save"></i> {{trans('lang.save')}}</button>

        <a href="{{ url('admin/banner') }}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>

    </div>
</form>
  </div>


@endsection
