@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ route('admin.users.offer.update', ['id' => $offer->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">User Offer</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('admin.users.offer') !!}">User Offer</a></li>
                    <li class="breadcrumb-item active">Edit User Offer</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card pb-4">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link " href="{!! route('admin.users.offer') !!}"><i
                                        class="fa fa-list mr-2"></i>User Offer</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! route('admin.users.offer.edit', ['id' => $offer->id]) !!}"><i class="fa fa-edit mr-2"></i>Edit User Offer</a>
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
                                        <legend>Edit User Offer</legend>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Title <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="title" value="{{ $offer->title }}">
                                                <div class="form-text text-muted">
                                                    @if ($errors->has('title'))
                                                        <div class="text-danger">{{ $errors->first('title') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Status <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <select name="status" class="form-control">
                                                    <option value="1" {{ $offer->status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ $offer->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @if ($errors->has('status'))
                                                        <div class="text-danger">{{ $errors->first('status') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.photo')}} <sup style="color:red;">*</sup></label>
                                            <input type="file" id="image" name="image" class="col-7 form-control">
                                            <div id="uploding_image"></div>
                                            <div class="placeholder_img_thumb user_image"></div>
                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Opening Date<sup style="color:red;">*</sup></label>
                                            <input type="date" id="opening_date" name="opening_date" class="col-7 form-control" value="{{ $offer->opening_date }}">
                                            <div class="form-text text-muted">
                                                @if ($errors->has('opening_date'))
                                                    <div class="text-danger">{{ $errors->first('opening_date') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Closing Date<sup style="color:red;">*</sup></label>
                                            <input type="date" id="closing_date" name="closing_date" class="col-7 form-control" value="{{ $offer->closing_date }}" >
                                            <div class="form-text text-muted">
                                                @if ($errors->has('closing_date'))
                                                <div class="text-danger">{{ $errors->first('closing_date') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Opening Time<sup style="color:red;">*</sup></label>
                                            <input type="time" id="opening_time" name="opening_time" class="col-7 form-control" value="{{ $offer->opening_time }}">
                                            <div class="form-text text-muted">
                                                @if ($errors->has('opening_time'))
                                                <div class="text-danger">{{ $errors->first('opening_time') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Closing Time<sup style="color:red;">*</sup></label>
                                            <input type="time" id="closing_time" name="closing_time" class="col-7 form-control" value="{{ $offer->closing_time }}">
                                            <div class="form-text text-muted">
                                                @if ($errors->has('closing_time'))
                                                <div class="text-danger">{{ $errors->first('closing_time') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Discount Type <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <select id="discount_type" class="form-control" name="discount_type">
                                                    <option value="">select type</option>
                                                    <option value="percentage" {{ $offer->discount_type == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                                    <option value="amount" {{ $offer->discount_type == 'amount' ? 'selected' : '' }}>Amount (₹)</option>
                                                </select>
                                                <div class="form-text text-muted">
                                                    @if ($errors->has('discount_type'))
                                                    <div class="text-danger">{{ $errors->first('discount_type') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Discount Value <sup style="color:red;">*</sup></label>
                                            <div class="col-7">
                                                <input type="number" name="discount" class="form-control" min="0" value="{{ $offer->discount }}">
                                                <div class="form-text text-muted">
                                                    @error('discount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                       <div class="row width-100">
                                            <label class="col-3 control-label">Users <sup style="color:red;">*</sup></label>
                                            <div class="form-text text-muted">
                                                @error('user_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        
                                            @if($users)
                                                @foreach($users as $user)
                                                    <div class="form-check">
                                                        <input type="radio" class="item_publish" name="user_id" value="{{ $user->id }}" id="{{ $user->id }}" {{ ($user->id == $offer->user_id) ? 'checked' : '' }}>
                                                        <label class="col-3 control-label" for="{{ $user->id }}">{{ $user->name }}</label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        
                                       <div class="row width-100">
                                            <label class="col-3 control-label">Users <sup style="color:red;">*</sup></label>
                                            <div class="form-text text-muted">
                                                @error('food_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        
                                            @if($foods)
                                                @foreach($foods as $food)
                                                    <div class="form-check">
                                                        <input type="checkbox" class="item_publish" name="food_id[]" value="{{ $food->id }}" id="f_{{ $food->id }}"  {{ in_array($food->id, explode(',', $offer->food_id)) ? 'checked' : '' }}>
                                                        <label class="col-3 control-label" for="f_{{ $food->id }}">{{ $food->name }}</label>
                                                    </div>
                                                @endforeach
                                            @endif
                                          
                                        </div>

                                        

                                        <!-- Add other fields similar to the ones above -->

                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 text-center btm-btn">
                            <button type="submit" class="btn btn-primary save_category_btn"><i class="fa fa-save"></i>
                                {{trans('lang.update')}}
                            </button>
                            <a href="{!! route('admin.users.offer') !!}" class="btn btn-default"><i
                                    class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

@endsection
