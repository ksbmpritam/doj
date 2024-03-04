@extends('franchies.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">Team </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Product</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="body-card">
                        <div class="col-12">
                            <div class="menu-tab vendorMenuTab">
                                @include('franchies.head_menu')
                            </div>
                            <div class="resttab-sec">
                                <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                                <div class="error_top"></div>
                                <div class="row restaurant_payout_create">
                                    <div class="restaurant_payout_create-inner">
                                        <form action="{!! route('franchies.team.approvalProduct.update', ['id' => $product->id]) !!}" method="POST">
                                            @csrf
                                            @method('PUT') <!-- Assuming you are using PUT to update the record -->
                                        
                                            <fieldset>
                                                <legend>Product Approval</legend>
                                                <div class="form-group row">
                                                    <label for="team_approvel">Approval Status:</label>
                                                    <select name="team_approvel" id="team_approvel" class="form-control"> <!-- Added 'form-control' class for styling -->
                                                        <option value="1" @if($product->team_approvel == 1) selected @endif>Approved</option>
                                                        <option value="0" @if($product->team_approvel == 0) selected @endif>Progress</option>
                                                        <option value="-1" @if($product->team_approvel == -1) selected @endif>Unapproved</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                            <div class="form-group col-12 text-center btm-btn">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button> <!-- Added space before "Submit" for readability -->
                                                <a href="{!! route('franchies.team.product', ['id' => $product->team_id]) !!}" class="btn btn-default"><i class="fa fa-undo"></i> Cancel</a> <!-- Updated the text for "Cancel" button -->
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection