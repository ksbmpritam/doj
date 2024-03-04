@extends('admin.layouts.app')


@section('content')
        <div class="page-wrapper">


            <div class="row page-titles">

                <div class="col-md-5 align-self-center">

                    <h3 class="text-themecolor">{{trans('lang.payment_plural')}}</h3>

                </div>

                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('lang.payment_plural')}}</li>
                    </ol>
                </div>

                <div>

                </div>

            </div>



            <div class="container-fluid">

                <div class="row">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-body">

                                <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                            <div id="users-table_filter" class="pull-right"><label>{{trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                      <option value="restaurant">{{ trans('lang.restaurant')}}</option>
                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table"></label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">{{trans('lang.search')}}</button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">{{trans('lang.clear')}}</button>
                                </div>
                            </div>



                                <div class="table-responsive m-t-10">


                                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>
                                                <th>{{ trans('lang.restaurant')}}</th>
                                                <th>{{ trans('lang.total_amount')}}</th>
                                                <th>{{trans('lang.paid_amount')}}</th>
                                                <th>{{trans('lang.remaining_amount')}}</th>
                                            </tr>

                                        </thead>

                                        <tbody id="append_list1">
                                            <tr>
                                                <th>{{ trans('lang.restaurant')}}</th>
                                                <th>{{ trans('lang.total_amount')}}</th>
                                                <th>{{trans('lang.paid_amount')}}</th>
                                                <th>{{trans('lang.remaining_amount')}}</th>
                                            </tr>

                                        </tbody>

                                    </table>
                                           
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

