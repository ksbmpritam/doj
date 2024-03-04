@extends('admin.layouts.app')

@section('content')
    <div class="page-wrapper">
        <form action="{{ url ('admin/filter/update/'.$filter->id)}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Filter</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{!! route('admin.filter') !!}">Filter</a></li>
                    <li class="breadcrumb-item active">Edit Filters</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="resttab-sec">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}</div>
                        <div class="error_top"></div>
                        <div class="row restaurant_payout_create">
                            <div class="restaurant_payout_create-inner">

                                <fieldset>
                                    <legend>Filter </legend>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Title <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control" value="{{$filter->title}}" name="title" required>
                                            <div class="form-text text-muted">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                                 
                               <fieldset>
                                    <legend> Filter Options </legend>
                                    <div class="form-group row">
                                        <div class="col-7">
                                            <table class="table table-bordered" id="titleAddRemove">  
                                                <tr>
                                                    <th>Options</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tr>  
                                                    <td><button type="button" name="add" class="btn btn-success" id="add-btn">+</button></td>  
                                                </tr>  
                                                @foreach($filter->filter_option as $index => $filterOption)
                                                        <tr>  
                                                            <td>
                                                                <input type="text" name="option_title[]" value="{{ $filterOption->title }}" class="form-control" />
                                                            </td>  
                                                            <td><button type="button" name="remove" class="btn btn-danger remove-tr">x</button></td>  
                                                        </tr>  
                                                @endforeach
                                               
                                            </table>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.active_deactive')}}</legend>
                                    <div class="form-group row">

                                        <div class="form-group row width-50">
                                            <div class="form-check width-100">
                                                <input type="checkbox" id="is_active" value="1" name="status" @if($filter->status == 1) checked @endif>
                                                <label class="col-3 control-label" for="is_active">{{trans('lang.active')}}</label>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-group col-12 text-center btm-btn">
                    <button type="submit" class="btn btn-primary "><i
                                class="fa fa-save"></i> {{trans('lang.save')}}</button>
                    <a href="{!! route('admin.filter') !!}" class="btn btn-default"><i
                                class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                </div>

            </div>
        </div>
        </form>
    </div>


@endsection
@section('scripts')
<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    
    var i = 0;
        
    $("#add-btn").click(function(){
    
        ++i;
    
        $("#titleAddRemove").append('<tr><td><input type="text" name="option_title[]" placeholder="Enter title" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">x</button></td></tr>');
    });
    
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
    
</script>
@endsection
