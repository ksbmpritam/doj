@extends('admin.layouts.app')



@section('content')

  <div class="page-wrapper">
      
      <form action="{{ url('admin/voucher/insert')}}" method="post" enctype="multipart/form-data">
         @csrf
    <div class="row page-titles">



        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">Voucher</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item active">Create Voucher</li>

            </ol>

        </div>

    </div>

    <div class="card-body">

        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Voucher</div>

        <div class="error_top"></div>

        <div class="row restaurant_payout_create">

            <div class="restaurant_payout_create-inner">

                <fieldset>

                    <legend>Voucher</legend>

                    <div class="form-group row width-50">
                        <label class="col-3 control-label">{{trans('Amount')}} <sup style="color:red;">*</sup></label>
                        <div class="col-7">
                            <input type="amount" class="form-control title" name="amount" required>
                        </div>
                    </div>
                    <div class="form-group row width-50">
                        <label class="col-3 control-label">{{trans('Discount')}} <sup style="color:red;">*</sup></label>
                        <div class="col-7">
                            <input type="discount" class="form-control title" name="discount" required>
                        </div>
                    </div>
                    
                    <div class="form-group row width-100">
                        <div class="form-check width-100">
                            <input type="checkbox" id="is_publish" value="1" name="status">
                            <label class="col-3 control-label" for="is_publish">{{trans('lang.is_publish')}}</label>
                        </div>
                    </div>
                   
                </fieldset>

            </div>
        </div>

    </div>

    <div class="form-group col-12 text-center">

        <button type="submit" class="btn btn-primary  create_banner_btn" ><i class="fa fa-save"></i> {{trans('lang.save')}}</button>

        <a href="{{ url('admin/voucher') }}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>

    </div>
</form>
  </div>


@endsection
