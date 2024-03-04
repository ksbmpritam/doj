@extends('layouts.app')


@section('content')

        <div class="page-wrapper">


            <div class="row page-titles">



                <div class="col-md-5 align-self-center">



                    <h3 class="text-themecolor">App Splash Screen</h3>



                </div>



                <div class="col-md-7 align-self-center">



                    <ol class="breadcrumb">



                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>



                        <li class="breadcrumb-item">App Splash Screen</li>



                        <li class="breadcrumb-item active">Splash Screen list</li>



                    </ol>



                </div>



                <div>



                </div>



            </div>







            <div class="container-fluid">



                <div class="row">



                    <div class="col-12">



                        <div class="card">

                              <div class="card-header">

                              <ul class="nav nav-tabs align-items-end card-header-tabs w-100">

                                  <li class="nav-item">

                                    <a class="nav-link" href="{{ url('splash/create') }}"><i class="fa fa-plus mr-2"></i>create Video and Image</a>

                                  </li>



                              </ul>

                            </div>

                            <div class="card-body">

                            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                            <div id="users-table_filter" class="pull-right">
                            <div class="row">

                                <div class="col-sm-9">
                                    <label>{{ trans('lang.search_by')}}
                                        <select name="selected_search" id="selected_search" class="form-control input-sm">
                                            <option value="title">{{ trans('lang.title')}}</option>
                                        </select>
                                        <div class="form-group">
                                            <input type="search" id="search" class="search form-control"
                                                placeholder="Search" aria-controls="users-table">
                                    </label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">Search
                                    </button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">Clear
                                    </button>
                                </div>
                            </div>
                            </div>
                            </div>

                                <div class="table-responsive m-t-10">

                                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">



                                        <thead>



                                            <tr>
                                    <!--          <th class="delete-all"><input type="checkbox" id="is_active"><label-->
                                    <!--        class="col-3 control-label" for="is_active">-->
                                    <!--<a id="deleteAll" class="do_not_delete" href="javascript:void(0)">-->
                                    <!--    <i class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>-->
                                                <th>S.No.</th>

                                                <th>Images/Videos</th>
                                                <th>{{trans('lang.publish')}}</th>
                                                <th>{{trans('lang.actions')}}</th>



                                            </tr>



                                        </thead>
                                        @foreach ($splash as $banner)
                                            <tr>
                                                <td>
                                                   {{$loop->iteration}}
                                                </td>
                                                <td>
                                                     @if ($banner->images)
                                                        <img src="{{ asset('images/banner/' . $banner->banner_photo) }}" width="100" height="100" alt="Banner Photo">
                                                    @else @if($banner->video)
                                                        <p>hadfas</p>
                                                        @endif
                                                        <p>No images/video available</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($banner->status == 'on' )
                                                    
                                                    <button class="btn btn-success" style="padding:5px;">active</button>
                                                    @else
                                                    <button class="btn btn-danger" style="padding:5px;">inactive</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('splash/edit/' . $banner->id) }}" class="btn btn-primary">Edit</a>
                                                    <a href="{{ url('splash/delete/' . $banner->id) }}" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        

                                        </tbody>



                                    </table>

                                    <div class="data-table_paginate">

                                    <nav aria-label="Page navigation example">

                                         <ul class="pagination justify-content-center">

                                            <li class="page-item ">

                                                <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()"  data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>

                                            </li>

                                            <li class="page-item">

                                            <a class="page-link" href="javascript:void(0);" id="users_table_next_btn" onclick="next()"  data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>

                                            </li>

                                        </ul>

                                    </nav>

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
