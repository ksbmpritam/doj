@extends('restaurant_admin.layouts.app')

@section('content')
    <div class="page-wrapper">
        <form action="{{ url ('restaurant/products/update/'.$food->id)}}" method="post" enctype="multipart/form-data">
              @csrf
            <div class="row page-titles">
    
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Product</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('restaurant/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('admin.products') !!}">Product</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div>
            </div>
    
            <div>
    
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
                                  <input type="text" class="form-control food_name" name="name" value="{{$food->name}}" >
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
                                  <input type="number" class="form-control food_price" name="price" value="{{$food->price}}" oninput="validateInput(this)">
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
                                  <input type="number" class="form-control food_discount" name="discount" value="{{$food->discount}}" oninput="validateInput(this)">
                                  <div class="form-text text-muted">
                                     @if ($errors->has('discount'))
                                        <div class="text-danger">{{ $errors->first('discount') }}</div>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            

                
                             <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.food_category_id')}}</label>
                                <div class="col-7">
                                    <select id='food_category' class="form-control" name="category_id" required>

                                      
                                    @foreach($categories as $c)
                                        <option value="{{ $c->id }}"{{ $c->id == $food->category_id ? ' selected' : '' }}>
                                            {{ $c->name }}
                                        </option>
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
                                  <input type="number" class="form-control item_quantity" name="item_quantity" value="{{$food->item_quantity}}" oninput="validateInput(this)">
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
                                    <input type="file" id="product_image" name="images">
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
                                  <textarea rows="8" class="form-control food_description" id="description" name="description" >{{$food->description}}</textarea>
                                </div>
                              </div>
                              <div class="form-check width-100">
                                <input type="checkbox" class="food_publish" value="1" id="publish" name="publish" @if ($food->publish == 1) checked @endif>
                                <label class="col-3 control-label" for="publish">{{trans('lang.food_publish')}}</label>
                              </div>
                
                              <div class="form-check width-100">
                                <input type="checkbox" class="food_nonveg" id="non_veg" value="1" name="non_veg" @if ($food->non_veg == 1) checked @endif>
                                <label class="col-3 control-label" for="non_veg">{{ trans('lang.non_veg')}}</label>
                              </div>
                
                              <div class="form-check width-100">
                                <input type="checkbox" class="food_take_away_option" value="1" id="takeway_option" name="takeway_option" @if ($food->takeway_option == 1) checked @endif>
                                <label class="col-3 control-label" for="takeway_option">{{trans('lang.food_take_away')}}</label>
                              </div>
                
                            </fieldset>
                
                            <fieldset>
                
                              <legend>{{trans('lang.ingredients')}}</legend>
                
                              <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.calories')}}</label>
                                <div class="col-7">
                                  <input type="number" class="form-control food_calories" name="calories" value="{{$food->calories}}" oninput="validateInput2(this)">
                                </div>
                              </div>
                
                              <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.grams')}}</label>
                                <div class="col-7">
                                  <input type="number" class="form-control food_grams" name="grams" value="{{$food->grams}}" oninput="validateInput2(this)">
                                </div>
                              </div>
                
                              <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.fats')}}</label>
                                <div class="col-7">
                                  <input type="number" class="form-control food_fats" name="fats" value="{{$food->fats}}" oninput="validateInput2(this)">
                                </div>
                              </div>
                
                              <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.proteins')}}</label>
                                <div class="col-7">
                                  <input type="number" class="form-control food_proteins" name="proteins" value="{{$food->proteins}}" oninput="validateInput2(this)">
                                </div>
                              </div>
                            
                            </fieldset>

    
                            <fieldset>
                                <legend>ADD ADDONS</legend>
                                <div class="form-group row">
                                    <div class="col-7">
                                        <button type="button" class="btn btn-primary add-addons-btn">Add Addons</button>
                                    </div>
                                </div>
                                <div class="addons-container">
                                    <!-- Existing foodAddons data -->
                                    @foreach ($food->foodAddons as $addon)
                                        <div class="mb-2 row">
                                            <div class="col-5">
                                                <input type="text" class="form-control" name="addons_title[]" value="{{ $addon->title }}">
                                            </div>
                                            <div class="col-5">
                                                <input type="text" class="form-control" name="addons_price[]" value="{{ $addon->price }}">
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
                                        <button type="button" class="btn btn-primary specification-btn">Add Specification</button>
                                    </div>
                                </div>
                                <div class="specification-container">
                                    <!-- Existing foodSpecifications data -->
                                    @foreach ($food->foodSpecifications as $specification)
                                        <div class="mb-2 row">
                                            <div class="col-5">
                                                <label class="col-2 control-label">{{trans('lang.label')}}</label>
                                                <input type="text" class="form-control" name="specifications_label[]" value="{{ $specification->label }}">
                                            </div>
                                            <div class="col-5">
                                                <label class="col-2 control-label">{{trans('lang.value')}}</label>
                                                <input type="text" class="form-control" name="specifications_value[]" value="{{ $specification->value }}">
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
                        <button type="submit" class="btn btn-primary  save_food_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
                       
                        <a href="{!! route('restaurant.products') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>

                    </div>
                </div>
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
<script>
    function validateInput(input) {
        // Remove any non-numeric characters
        input.value = input.value.replace(/[^\d]/g, '');
    }
</script>


<script>
	function validateInput2(input) {
		// Remove any non-numeric characters except for the first dot
		input.value = input.value.replace(/[^\d.]+/g, '');

		// Remove any dots after the first one
		var dotIndex = input.value.indexOf('.');
		if (dotIndex !== -1) {
			var beforeDot = input.value.substring(0, dotIndex + 1);
			var afterDot = input.value.substring(dotIndex + 1).replace(/\./g, '');
			input.value = beforeDot + afterDot;
		}
	}
</script>
@endsection