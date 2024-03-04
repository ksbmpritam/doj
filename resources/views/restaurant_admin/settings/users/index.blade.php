@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.user_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('restaurant/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.user_table')}}</li>
            </ol>
        </div>
        <div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!--<div class="card-header">-->
                    <!--    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">-->
                    <!--        <li class="nav-item">-->
                    <!--            <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_table')}}</a>-->
                    <!--        </li>-->
                    <!--        <li class="nav-item">-->
                    <!--            <a class="nav-link" href="{!! route('admin.users.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.user_create')}}</a>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</div>-->
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                        
                        <!--<div id="users-table_filter" class="pull-right"><label>{{ trans('lang.search_by')}}-->
                        <!--    <select name="selected_search" id="selected_search" class="form-control input-sm">-->
                        <!--        <option value="first_name">{{ trans('lang.first_name')}}</option>-->
                        <!--        <option value="last_name">{{ trans('lang.last_name')}}</option>-->
                        <!--        <option value="email">{{ trans('lang.email')}}</option>-->
                        <!--    </select>-->
                        <!--    <div class="form-group">-->
                        <!--        <input type="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table"></label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">Search</button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">Clear</button>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="table-responsive m-t-10">
                            <table id="userTable" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                    <!--<th class="delete-all"><input type="checkbox" id="is_active"><label-->
                                    <!--        class="col-3 control-label" for="is_active"-->
                                    <!--><a id="deleteAll" class="do_not_delete"-->
                                    <!--    href="javascript:void(0)"><i-->
                                    <!--                class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>-->
                                        <th>S.no.</th>
                                        <th>{{trans('lang.extra_image')}}</th>
                                        <th >{{trans('lang.user_name')}}</th>
                                        <th>Mobile</th>
                                        <th>{{trans('lang.email')}}</th>
                                         <th>{{trans('lang.active')}}</th>
                                        <th >{{trans('lang.wallet_transaction')}}</th>
                                        <!-- <th >{{trans('lang.role')}}</th> -->
                                        
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>
                                </thead>
                                    @foreach($user as $us)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            @if($us->profile_image == '')
                                                <img src="{{ asset('images/upload/profile.png') }}" width="100" height="100" alt="restaurants Photo">
                                            @else
                                                <img src="{{ asset('images/upload/' . $us->profile_image) }}" width="100" height="100" alt="restaurants Photo">
                                            @endif
                                            
                                        </td>
                                        <td>
                                            {{$us->name}}
                                        </td>
                                        <td>{{$us->mobile_number}}</td>
                                        <td>{{$us->email}}</td>
                                        <td>
                                            @if($us->status == 1)
                                                <p>active</p>
                                            @else
                                                <p>inactive</p>
                                            @endif
                                        </td>
                                        <td>
                                            {{$us->total_wallet}}
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/users/view/' . $us->id) }}" class="btn btn-primary">View</a>
                                            <!--<a href="{{ url('users/delete/' . $us->id) }}" class="btn btn-danger">Delete</a>-->
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

@endsection

