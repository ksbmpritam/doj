@extends('franchies.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="#" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Product</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('franchies/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active">Product View</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">
                    <div class="menu-tab vendorMenuTab">
                        @include('franchies.head_menu')
                    </div>
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link " href="{!! route('franchies.team.product',['id' => $food->team_id]) !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.product')}} List </a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a; border-radius: 2px;">
                                <a class="nav-link active" href="{{ url()->current() }}"><i class="fa fa-plus mr-2"></i>Product View</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                    <div id="data-table_processing" class="dataTables_processing panel panel-default"
                         style="display: none;">{{trans('lang.processing')}}</div>
                    <div class="error_top" style="display:none"></div>
                    <div class="row restaurant_payout_create">
                        <div class="restaurant_payout_create-inner">
    
                            <fieldset>
                              <legend>Products Details</legend>
                
                              <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.food_name')}}</label>
                                <div class="col-7">
                                  <input type="text" class="form-control food_name" readonly name="name" value="{{$food->name}}" >
                                  <div class="form-text text-muted">
                                    @if ($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                
                                  </div>
                                </div>
                              </div>
                
                              <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.food_price')}}</label>
                                <div class="col-7">
                                  <input type="number" class="form-control food_price" readonly name="price" value="{{$food->price}}" >
                                  <div class="form-text text-muted">
                                    @if ($errors->has('price'))
                                        <div class="text-danger">{{ $errors->first('price') }}</div>
                                    @endif
                                  </div>
                                </div>
                              </div>
                
                              <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.food_discount')}}</label>
                                <div class="col-7">
                                  <input type="number" class="form-control food_discount" readonly name="discount" value="{{$food->discount}}">
                                  <div class="form-text text-muted">
                                     @if ($errors->has('discount'))
                                        <div class="text-danger">{{ $errors->first('discount') }}</div>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            <div class="form-group row width-50">
                                <label class="col-3 control-label">Select Restaurant</label>
                                <div class="col-7">
                                    <select id='food_category' class="form-control" disabled name="restaurant_id" required>

                                        @foreach($restaurants as $p)
                                             @if($p->id == $food->restaurant_id)
                                                <option value="{{$p->id}}" selected>{{$p->name}}</option>
                                             @endif
                                                <option value="{{$p->id}}">{{$p->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-text text-muted">
                                        {{ trans("lang.food_category_id_help") }}
                                    </div>
                                </div>
                            </div>

                
                             <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.food_category_id')}}</label>
                                <div class="col-7">
                                    <select id='food_category' class="form-control" disabled name="category_id" required>

                                        @foreach($categories as $c)
                                             @if($c->id == $food->category_id)
                                                <option value="{{$c->id}}" selected>{{$c->name}}</option>
                                             @endif
                                                <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-text text-muted">
                                        {{ trans("lang.food_category_id_help") }}
                                    </div>
                                </div>
                            </div>
                            
                              <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.item_quantity')}}</label>
                                <div class="col-7">
                                  <input type="number" class="form-control item_quantity" readonly name="item_quantity" value="{{$food->item_quantity}}">
                                  <div class="form-text text-muted">
                                     @if ($errors->has('item_quantity'))
                                        <div class="text-danger">{{ $errors->first('item_quantity') }}</div>
                                    @endif
                                  </div>
                                </div>
                              </div>
                
                              <!--<div class="form-group row width-100" id="attributes_div" >-->
                              <!--    <label class="col-3 control-label">{{trans('lang.item_attribute_id')}}</label>-->
                              <!--    <div class="col-7">-->
                              <!--        <select id='item_attribute' class="form-control chosen-select" name="food_attribute" required-->
                              <!--                multiple="multiple"-->
                              <!--                onchange="selectAttribute();"></select>-->
                              <!--    </div>-->
                              <!--</div>-->
                
                              <!--<div class="form-group row width-100">-->
                              <!--    <div class="item_attributes" id="item_attributes"></div>-->
                              <!--    <div class="item_variants" id="item_variants"></div>-->
                              <!--    <input type="hidden" id="attributes" value=""/>-->
                              <!--    <input type="hidden" id="variants" value=""/>-->
                              <!--</div>-->
                
                              <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.food_image')}}</label>
                                <div class="col-7">
                                    <!--<input type="file" id="product_image" name="images">-->
                                    <div class="placeholder_img_thumb product_image"></div>
                                    <div id="uploding_image">
                                        <img src="{{ asset('images/foods/' . $food->images) }}" width="100" height="100" alt="categories Photo">
                                    </div>
                                    <div class="form-text text-muted">
                                        {{ trans("lang.food_image_help") }}
                                    </div>
                                </div>
                            </div>
                
                              <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.food_description')}}</label>
                                <div class="col-7">
                                  <textarea rows="8" class="form-control food_description" id="description" readonly name="description" >{{$food->description}}</textarea>
                                </div>
                              </div>
                              <div class="form-check width-100">
                                <input type="checkbox" class="food_publish" value="1" id="publish" disabled name="publish" @if ($food->publish == 1) checked @endif>
                                <label class="col-3 control-label" for="publish">{{trans('lang.food_publish')}}</label>
                              </div>
                
                              <div class="form-check width-100">
                                <input type="checkbox" class="food_nonveg" id="non_veg" value="1" disabled name="non_veg" @if ($food->non_veg == 1) checked @endif>
                                <label class="col-3 control-label" for="non_veg">{{ trans('lang.non_veg')}}</label>
                              </div>
                
                              <div class="form-check width-100">
                                <input type="checkbox" class="food_take_away_option" value="1" id="takeway_option" disabled name="takeway_option" @if ($food->takeway_option == 1) checked @endif>
                                <label class="col-3 control-label" for="takeway_option">{{trans('lang.food_take_away')}}</label>
                              </div>
                
                            </fieldset>
                
                            <fieldset>
                
                              <legend>{{trans('lang.ingredients')}}</legend>
                
                              <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.calories')}}</label>
                                <div class="col-7">
                                  <input type="number" class="form-control food_calories" name="calories" value="{{$food->calories}}" readonly>
                                </div>
                              </div>
                
                              <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.grams')}}</label>
                                <div class="col-7">
                                  <input type="number" class="form-control food_grams" name="grams" value="{{$food->grams}}" readonly>
                                </div>
                              </div>
                
                              <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.fats')}}</label>
                                <div class="col-7">
                                  <input type="number" class="form-control food_fats" name="fats" value="{{$food->fats}}" readonly>
                                </div>
                              </div>
                
                              <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.proteins')}}</label>
                                <div class="col-7">
                                  <input type="number" class="form-control food_proteins" name="proteins" value="{{$food->proteins}}" readonly>
                                </div>
                              </div>
                
                            </fieldset>

    
                            <fieldset>
                                <legend>ADD ADDONS</legend>
                                <div class="form-group row">
                                    <div class="col-7">
                                        <button type="button" class="btn btn-primary add-addons-btn" disabled>Add Addons</button>
                                    </div>
                                </div>
                                <div class="addons-container">
                                    <!-- Existing foodAddons data -->
                                    @foreach ($food->foodAddons as $addon)
                                        <div class="mb-2 row">
                                            <div class="col-5">
                                                <input type="text" class="form-control" name="addons_title[]" value="{{ $addon->title }}" readonly>
                                            </div>
                                            <div class="col-5">
                                                <input type="text" class="form-control" name="addons_price[]" value="{{ $addon->price }}" readonly>
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-danger remove-addons">X</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </fieldset>
                            
                            <!-- Specifications section -->
                            <fieldset>
                                <legend>{{ trans('lang.product_specification') }}</legend>
                                <div class="form-group row">
                                    <div class="col-7">
                                        <button type="button" class="btn btn-primary specification-btn" disabled>Add Specification</button>
                                    </div>
                                </div>
                                <div class="specification-container">
                                    <!-- Existing foodSpecifications data -->
                                    @foreach ($food->foodSpecifications as $specification)
                                        <div class="mb-2 row">
                                            <div class="col-5">
                                                <label class="col-2 control-label">{{trans('lang.label')}}</label>
                                                <input type="text" class="form-control" name="specifications_label[]" value="{{ $specification->label }}" readonly>
                                            </div>
                                            <div class="col-5">
                                                <label class="col-2 control-label">{{trans('lang.value')}}</label>
                                                <input type="text" class="form-control" name="specifications_value[]" value="{{ $specification->value }}" readonly>
                                            </div>
                                            <div class="col-2">
                                                <label class="col-2 control-label text-white">.</label>
                                                <button type="button" class="btn btn-danger remove-specification">X</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </fieldset>

                        </div>
                    </div>
    
    
                    <div class="form-group col-12 text-center btm-btn">
                        <!--<button type="submit" class="btn btn-primary  save_food_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>-->
                       
                        <a href="{!! route('franchies.team.product',$food->team_id) !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>

                    </div>
                </div>
                </div>
            </div>
        </div>
        <!--<div class="form-group col-12 text-center btm-btn">-->
            <!--<button type="submit" class="btn btn-primary save_driver_btn"><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>-->
        <!--    <a href="{!! route('team.riders') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>-->
        <!--</div>-->

        </div>
    </form>
</div>
</div>


@endsection
@section('scripts')

<script>
    $(document).ready(function () {
        let dayIndex = 0;

        // Add Addons
        $('.add-addons-btn').click(function () {
            // Dynamically create input fields for addons
            let workingHoursContainer = $('.addons-container');
            let workingHoursRow = `
                <div class="mb-2 row">
                    <div class="col-5">
                        <input type="text" class="form-control" name="addons_title[]" placeholder="Title">
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control" name="addons_price[]" placeholder="Price">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-danger remove-addons">X</button>
                    </div>
                </div>
            `;

            workingHoursContainer.append(workingHoursRow);

            dayIndex++;
        });

        // Remove Addons
        $(document).on('click', '.remove-addons', function () {
            $(this).closest('.mb-2').remove();
        });

        // Add Specifications
        $('.specification-btn').click(function () {
            // Dynamically create input fields for specifications
            let specificationContainer = $('.specification-container');
            let specificationRow = `
                <div class="mb-2 row">
                    <div class="col-5">
                        <label class="col-2 control-label">{{ trans('lang.label') }}</label>
                        <input type="text" class="form-control" name="specifications_label[]" placeholder="Label">
                    </div>
                    <div class="col-5">
                        <label class="col-2 control-label">{{ trans('lang.value') }}</label>
                        <input type="text" class="form-control" name="specifications_value[]" placeholder="Value">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-danger remove-specification">X</button>
                    </div>
                </div>
            `;

            specificationContainer.append(specificationRow);

            dayIndex++;
        });

        // Remove Specifications
        $(document).on('click', '.remove-specification', function () {
            $(this).closest('.mb-2').remove();
        });
    });
</script>

@endsection