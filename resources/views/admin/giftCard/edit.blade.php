@extends('admin.layouts.app')

@section('content')
    <div class="page-wrapper">
        <form action="{{ url ('admin/gift_card/update/'.$gift->id)}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Gift Card</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{!! route('admin.gift_card') !!}">Gift Card List</a></li>
                    <li class="breadcrumb-item active">Edit Gift Card</li>
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
                                    <legend>CONFIGURATIONS</legend>
    
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Title <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control " name="title" value="{{ $gift->title }}">
                                            <div class="form-text text-muted">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">Description <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control col-7" name="description" value="{{ $gift->description }}">
                                            <div class="form-text text-muted">
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
    
                                    
                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_image')}}</label>
                                        <input type="file" name="image_path[]" class="col-7" multiple>
                                        <div id="uploding_image_owner"></div>
                                    </div>
    
                                </fieldset>

                                
                                <!-- <fieldset>-->
                                <!--    <legend>{{ trans('lang.gallery') }}</legend>-->
                            
                                <!--    <div class="form-group row width-100 restaurant_image">-->
                                <!--        <div class="uploaded_image">-->
                                <!--            @foreach($galleryImages as $imagePath)-->
                                <!--                <img src="{{ asset('images/giftImage/'.$imagePath->image_path) }}" alt="Gallery Image" width="150px" height="150px;" style="border-radius:5px; margin:5px">-->
                                <!--            @endforeach-->
                                <!--        </div>-->
                                <!--    </div>-->
                            
                                <!--</fieldset>-->

                                <fieldset>
                                    <legend> {{trans('lang.active_deactive')}}</legend>
                                    <div class="form-group row">

                                        <div class="form-group row width-50">
                                            <div class="form-check width-100">
                                                <input type="checkbox" id="is_active" value="1" name="status" @if($gift->status == 1) checked @endif>
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
                    <button type="submit" class="btn btn-primary  save_restaurant_btn"><i
                                class="fa fa-save"></i> {{trans('lang.save')}}</button>
                    <a href="{!! route('admin.gift_card') !!}" class="btn btn-default"><i
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

<script>
    // Your JavaScript code here
    var countAddButton = 1;
    var currentCurrency = '₹';
  
    $(document).ready(function () {
     


    $("#dine_in_feature").change(function () {
        if (this.checked) {
            $(".divein_div").show();
        } else {
            $(".divein_div").hide();
        }
    });


    });
</script>

 <script>
        $(document).ready(function () {
            const dayOptions = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            let dayIndex = 0;

            function updateAddButton() {
                if (dayIndex < dayOptions.length) {
                    $('.add-working-hours-btn').prop('disabled', false);
                    $('.add-working-hours-btn').css('color', 'black');
                } else {
                    $('.add-working-hours-btn').prop('disabled', true);
                }
            }

            $('.add-working-hours-btn').click(function () {
                // Dynamically create input fields for working hours
                let workingHoursContainer = $('.working-hours-container');
                let day = dayOptions[dayIndex]; // Get the day from the array using the dayIndex

                let workingHoursDiv = `
                    <div class="form-group row">
                        <label class="col-1 control-label">${day}</label>
                        <div class="col-12">
                            <button type="button" class="btn btn-primary add-working-hours" data-days="${day}">
                                Add
                            </button>
                        </div>
                    </div>
                    <div class="working-hours-options ${day.toLowerCase()}-optionss">
                        <!-- Input fields for working hours will be dynamically added here -->
                    </div>
                `;

                workingHoursContainer.append(workingHoursDiv);

                dayIndex++;
                updateAddButton();
            });
            updateAddButton();

            $(document).on('click', '.add-working-hours', function () {
                let day = $(this).data('days');
                let workingHoursOptions = $(`.${day.toLowerCase()}-optionss`);

                let workingHoursRow = `
                    <div class="mb-2 row">
                        <div class="col-5">
                            <label>Start Time</label>
                            <input type="time" class="form-control" name="${day.toLowerCase()}_start[]">
                        </div>
                        <div class="col-5">
                            <label>End Time</label>
                            <input type="time" class="form-control" name="${day.toLowerCase()}_end[]">
                        </div>
                        <div class="col-2">
                            <label style="display:block;width:100%;color:#fff">.</label>
                            <button type="button" class="btn btn-danger remove-working-hours">X</button>
                        </div>
                    </div>
                `;

                workingHoursOptions.append(workingHoursRow);
            });

            $(document).on('click', '.remove-working-hours', function () {
                $(this).closest('.mb-2').remove();
            });
        });

        $(document).ready(function () {
            const dayOptionss = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            let dayIndex = 0;

            function updateAdButton() {
                if (dayIndex < dayOptionss.length) {
                    $('.add-special-offer-btn').prop('disabled', false);
                    $('.add-special-offer-btn').css('color', 'black');
                } else {
                    $('.add-special-offer-btn').prop('disabled', true);
                }
            }

            $('.add-special-offer-btn').click(function () {
                let specialOfferContainer = $('.special-offer-container');
                let day = dayOptionss[dayIndex];

                let offerDiv = `
                    <div class="form-group row">
                        <label class="col-1 control-label">${day}</label>
                        <div class="col-12">
                            <button type="button" class="btn btn-primary add-special-offer" data-day="${day}">
                                Add
                            </button>
                        </div>
                    </div>
                    <div class="special-offer-options ${day.toLowerCase()}-options">

                    </div>
                `;

                specialOfferContainer.append(offerDiv);

                dayIndex++;
                updateAdButton();
            });
            updateAdButton();

            $(document).on('click', '.add-special-offer', function () {
                let day = $(this).data('day');
                let specialOfferOptions = $(`.${day.toLowerCase()}-options`);

                let specialOfferRow = `
                    <div class="mb-2 row">
                        <div class="col-3">
                            <label>Opening Time</label>
                            <input type="time" class="form-control" name="${day.toLowerCase()}_start_offer[]">
                        </div>
                        <div class="col-3">
                            <label>Closing Time</label>
                            <input type="time" class="form-control" name="${day.toLowerCase()}_end_offer[]">
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-6">
                                    <label>Discount</label>
                                    <input type="text" class="form-control" name="${day.toLowerCase()}_discount[]">
                                </div>
                                <div class="col-6">
                                    <label>%/₹</label>
                                    <select id="discount_typeThursday2" name="${day.toLowerCase()}_discount_type[]" class="form-control">
                                        <option value="percentage">%</option>
                                        <option value="amount">₹</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <label>Type</label>
                            <select id="typeThursday2" name="${day.toLowerCase()}_delivery_type[]" class="form-control">
                                <option value="delivery">Delivery Discount</option>
                                <option value="dinein">Dine-In Discount</option>
                            </select>
                        </div>
                    </div>
                `;

                specialOfferOptions.append(specialOfferRow);
            });

            $(document).on('click', '.remove-special-offer', function () {
                $(this).closest('.mb-2').remove();
            });
        });
    </script>
@endsection
