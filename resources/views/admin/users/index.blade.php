@extends('admin.layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.user_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
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
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end justify-content-center card-header-tabs w-100">
                            <li class="nav-item" style="border:1px solid #ff683a">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_table')}}</a>
                            </li>
                            <li class="nav-item" style="border:1px solid #ff683a;">
                                <a class="nav-link" href="{!! route('admin.users.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.user_create')}}</a>
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
                                        <th>S.no.</th>
                                        <th>{{trans('lang.extra_image')}}</th>
                                        <th >{{trans('lang.user_name')}}</th>
                                        <th>Mobile</th>
                                        <th>{{trans('lang.email')}}</th>
                                         <th>Status</th>
                                        <th >Balance</th>
                                        <th class="no-export">{{trans('lang.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">InActive</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{$us->total_wallet}}
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/users/view/' . $us->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> </a>
                                            <a href="{{ url('admin/users/edit/' . $us->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                            <!--<a href="{{ url('admin/users/delete/' . $us->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure');"><i class="fa fa-trash"></i></a>-->
                                            <a href="#" class="btn btn-sm btn-danger"
                                               onclick="showConfirmation('Are you sure you want to delete this user?', function() { window.location.href = '{{ url('admin/users/delete/' . $us->id) }}'; })">
                                               <i class="fa fa-trash"></i> 
                                            </a>
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--<nav aria-label="Page navigation example">-->
                            <!--    <ul class="pagination justify-content-center">-->
                            <!--        <li class="page-item ">-->
                            <!--            <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()"  data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>-->
                            <!--        </li>-->
                            <!--        <li class="page-item">-->
                            <!--            <a class="page-link" href="javascript:void(0);" id="users_table_next_btn" onclick="next()"  data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>-->
                            <!--        </li>-->
                            <!--    </ul>-->
                            <!--</nav>-->
                            
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

