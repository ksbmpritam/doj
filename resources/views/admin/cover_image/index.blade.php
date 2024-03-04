@extends('admin.layouts.app')


@section('content')

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Cover Image</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item">Cover Image</li>
                <li class="breadcrumb-item active">Cover Image List</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs justify-content-center w-100">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Cover Image List</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link" href="{{ url('admin/cover_image/create') }}"><i class="fa fa-plus mr-2"></i>Create Cover Image</a>
                            </li>
                        </ul>
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                    @endif
                
                    @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                        <div class="table-responsive m-t-10">
                            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <!--          <th class="delete-all"><input type="checkbox" id="is_active"><label-->
                                        <!--        class="col-3 control-label" for="is_active">-->
                                        <!--<a id="deleteAll" class="do_not_delete" href="javascript:void(0)">-->
                                        <!--    <i class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>-->
                                        <th>S.No.</th>
                                        <th>{{trans('lang.photo')}}</th>
                                        <th>{{trans('lang.title')}}</th>
                                        <th>{{trans('lang.publish')}}</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $banner)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>
                                            @if ($banner->banner_photo)
                                            <img src="{{ asset('images/cover_image/' . $banner->banner_photo) }}" width="100" height="100" alt="Banner Photo">
                                            @else
                                            <p>No banner photo available</p>
                                            @endif
                                        </td>
                                        <td>
                                            <p>{{ $banner->title}}</p>
                                        </td>
                                        <td>
                                            @if ($banner->status == 1)

                                            <span class="badge badge-success" style="padding:5px;">active</span>
                                            @else
                                            <span class="badge badge-danger" style="padding:5px;">inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/cover_image/edit/' . $banner->id) }}" class="btn btn-primary"> <i class="fa fa-edit"></i> </a>
                                            <!--<a href="{{ url('admin/cover_image/delete/' . $banner->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Banner ?')"><i class="fa fa-trash"></i></a>-->
                                            <a href="#" class="btn btn-sm btn-danger"
                                               onclick="showConfirmation('Are you sure you want to delete this Banner?', function() { window.location.href = '{{ url('admin/cover_image/delete/' . $banner->id) }}'; })">
                                               <i class="fa fa-trash"></i> 
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>

                            <!--<div class="data-table_paginate">-->

                            <!--    <nav aria-label="Page navigation example">-->

                            <!--        <ul class="pagination justify-content-center">-->

                            <!--            <li class="page-item ">-->

                            <!--                <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()" data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>-->

                            <!--            </li>-->

                            <!--            <li class="page-item">-->

                            <!--                <a class="page-link" href="javascript:void(0);" id="users_table_next_btn" onclick="next()" data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>-->

                            <!--            </li>-->

                            <!--        </ul>-->

                            <!--    </nav>-->

                            <!--</div>-->

                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection