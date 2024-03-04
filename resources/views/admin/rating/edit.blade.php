@extends('admin.layouts.app')



@section('content')

<div class="page-wrapper">

    <form action="{{ url('admin/rating/update/'. $rating->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">



            <div class="col-md-5 align-self-center">

                <h3 class="text-themecolor">Banner</h3>

            </div>

            <div class="col-md-7 align-self-center">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                    <li class="breadcrumb-item active">Edit Banner</li>

                </ol>

            </div>

        </div>

        <div class="card-body">

            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

            <div class="error_top"></div>

            <div class="row restaurant_payout_create">

                <div class="restaurant_payout_create-inner">

                    <fieldset>

                        <legend>{{trans('lang.menu_items')}}</legend>
                        
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">Select Restaurant <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <select class="form-control title" name="restaurant_id" required>
                                    <option value="">Select Restaurant</option>
                                    @foreach($restaurants as $id => $name)
                                        <option value="{{ $id }}" @if($id == $rating->restaurant_id) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('restaurant_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                        </div>
                        
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">Select Customer <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <select class="form-control title" name="customer_id" required>
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $id => $name)
                                        <option value="{{ $id }}" @if($id == $rating->customer_id) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                        </div>
                        
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">Rating <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                <input type="number" class="form-control title" min="0" max="5" name="value" value="{{ $rating->value }}" required>
                                @error('value')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                        </div>
                        
                        <div class="form-group row width-100">
                            <div class="form-check width-100">
                                <input type="checkbox" id="is_publish" value="1" name="status" @if ($rating->status == 1) checked @endif>
                                <label class="col-3 control-label" for="is_publish">{{ trans('lang.is_publish') }}</label>
                            </div>
                        </div>


                    </fieldset>

                </div>
            </div>
        </div>

        <div class="form-group col-12 text-center">

            <button type="submit" class="btn btn-primary  create_banner_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>

            <a href="{{ url('admin/rating') }}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>

        </div>
    </form>
</div>
</div>


@endsection