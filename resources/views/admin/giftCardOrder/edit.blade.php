@extends('admin.layouts.app')



@section('content')

<div class="page-wrapper">

    <form action="{{ url('admin/gift_card_order/update/'. $order->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row page-titles">



            <div class="col-md-5 align-self-center">

                <h3 class="text-themecolor">Gift Amount</h3>

            </div>

            <div class="col-md-7 align-self-center">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('admin/gift_card_order')}}">Gift Order List</a></li>

                    <li class="breadcrumb-item active">Edit Gift Amount</li>

                </ol>

            </div>

        </div>

        <div class="card-body">

            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

            <div class="error_top"></div>

            <div class="row restaurant_payout_create">

                <div class="restaurant_payout_create-inner">

                    <fieldset>

                        <legend>Gift Amount</legend>



                        <div class="form-group row width-50">

                            <label class="col-3 control-label">Code <sup style="color:red;">*</sup></label>

                            <div class="col-7">

                                <input type="text" class="form-control title" name="card_code " value="{{ $order->card_code }}"  readonly>
                                <div class="form-text text-muted">
                                    @error('card_code ')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="form-group row width-50">

                            <label class="col-3 control-label">Amount <sup style="color:red;">*</sup></label>

                            <div class="col-7">

                                <input type="text" class="form-control title" name="amount" value="{{ $order->card_value}}"  readonly>
                                <div class="form-text text-muted">
                                    @error('card_value')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="form-group row width-100">

                            <label class="col-3 control-label">Description <sup style="color:red;">*</sup></label>

                            <div class="col-7">
                                <textarea class="form-control" name="message" readonly>{{ $order->message}}</textarea>
                                <div class="form-text text-muted">
                                    @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">Expiration Date <sup style="color:red;">*</sup></label>
                            <div class="col-7">
                                @php
                                    $currentDateTime = \Carbon\Carbon::now('Asia/Kolkata');
                                    $expirationDateTime = \Carbon\Carbon::parse($order->expiration_date, 'Asia/Kolkata');
                                    $readOnly = $expirationDateTime > $currentDateTime ? 'readonly' : '';
                                    
                                    if($order->is_redeemed==1){
                                        $readOnly="readonly";
                                    }elseif($expirationDateTime > $currentDateTime){
                                        $readOnly="readonly";
                                    }else{
                                        $readOnly="";
                                    }
                                @endphp
                                <input type="date" class="form-control title" name="expiration_date" value="{{ $order->expiration_date }}" {{ $readOnly }}>
                                <div class="form-text text-muted">
                                    @error('expiration_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        
                        <div class="form-group row width-50">

                            <label class="col-3 control-label" >Redeemed Date <sup style="color:red;">*</sup></label>

                            <div class="col-7">

                                <input type="date" class="form-control title" name="date_redeemed" value="{{ $order->date_redeemed}}" readonly>
                                <div class="form-text text-muted">
                                    @error('date_redeemed')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        @if(empty($readOnly) && ($order->is_redeemed !=1) )
                        <div class="form-group row width-50">

                            <label class="col-3 control-label">Select type <sup style="color:red;">*</sup></label>

                            <div class="col-7">

                                <select class="form-control" name="cutoff_type">
                                    <option value="">-- Select Options --</option>
                                    <option value="percentage" @if($order->cutoff_type == 'percentage') selected @endif>Percentage</option>
                                    <option value="rupee" @if($order->cutoff_type == 'rupee') selected @endif>Rupee</option>
                                </select>

                                <div class="form-text text-muted">
                                    @error('cutoff_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        
                        <div class="form-group row width-50">

                            <label class="col-3 control-label">Value <sup style="color:red;">*</sup></label>

                            <div class="col-7">
                                <input type="text" class="form-control title" name="cutoff_value" value="{{ $order->cutoff_value}}">
                                <div class="form-text text-muted">
                                    @error('cutoff_value')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        @endif
                        <div class="form-group row width-50">

                            <label class="col-3 control-label">Customer Name <sup style="color:red;">*</sup></label>

                            <div class="col-7">

                                <input type="text" class="form-control title" name="customer_id" value="{{ $order->customer->name}}" readonly>
                                <div class="form-text text-muted">
                                    @error('customer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="form-group row width-50">

                            <label class="col-3 control-label">Image</label>

                            <div class="col-7">
                                <img src="{{$order->image_url}}" width="100"  height="100" alt="Photo">
                            </div>

                        </div>
                    </fieldset>

                </div>
            </div>
        </div>

        <div class="form-group col-12 text-center">
            @if($order->is_redeemed ==0 && ($expirationDateTime < $currentDateTime))
            <button type="submit" class="btn btn-primary  "><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
            @endif
            <a href="{{ url('admin/gift_card_order') }}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>

        </div>
    </form>
</div>
</div>


@endsection