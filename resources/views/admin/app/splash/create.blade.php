@extends('layouts.app')



@section('content')

  <div class="page-wrapper">
      
      <form action="{{ url('splash/insert')}}" method="post" enctype="multipart/form-data">
         @csrf
    <div class="row page-titles">



        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">App Splash Screen</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item active">{{trans('lang.menu_items_create')}}</li>

            </ol>

        </div>

    </div>

    <div class="card-body">

        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

        <div class="error_top"></div>

        <div class="row restaurant_payout_create">

            <div class="restaurant_payout_create-inner">

                <fieldset>

                    <legend>Splash</legend>

                    <div class="form-group row width-100">
                        <label class="col-3 control-label">Images/Video Option</label>
                        <div class="col-7">
                            <select id='food_category' class="form-control" name="images" required>
                                <option value="show_images"> Images</option>
                                <option value="show_video">Video</option>
                           
                            </select>
                        </div>
                    </div>

                   
                    <div class="form-group row width-100" id="imageGroup" >

                    <label class="col-3 control-label">Images</label>
                    <input type="file" id="img" name="images" class="col-7">
                    </div>
                    
                    <div class="form-group row width-100" id="videoGroup" style="display:none">

                    <label class="col-3 control-label">Video</label>
                    <input type="file" id="video" name="video" class="col-7">
                    </div>
                    
                    
                    <div class="form-group row width-100">

                    <div class="form-check width-100">
                    <input type="hidden" name="status" value="off">
                    <input type="checkbox" id="is_publish" name="status">

                    <label class="col-3 control-label" for="is_publish">{{trans('lang.is_publish')}}</label>

                    </div>

                    </div>

                    
                   
                </fieldset>

            </div>
        </div>

    </div>

    <div class="form-group col-12 text-center">

        <button type="submit" class="btn btn-primary  create_banner_btn" ><i class="fa fa-save"></i> {{trans('lang.save')}}</button>

        <a href="{{ url('banner') }}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>

    </div>
</form>
  </div>


@endsection

@section('scripts')
<script>
    const foodCategorySelect = document.getElementById('food_category');
    const imageGroup = document.getElementById('imageGroup');
    const videoGroup = document.getElementById('videoGroup');

    foodCategorySelect.addEventListener('change', () => {
        const selectedValue = foodCategorySelect.value;
        if (selectedValue === 'show_images') {
            showElement(imageGroup);
            hideElement(videoGroup);
        } else if (selectedValue === 'show_video') {
            showElement(videoGroup);
            hideElement(imageGroup);
        }
    });

    function showElement(element) {
        element.style.display = 'block';
    }

    function hideElement(element) {
        element.style.display = 'none';
    }
</script>

@endsection