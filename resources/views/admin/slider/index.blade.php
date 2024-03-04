@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">Slider</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Slider</li>
            </ol>
        </div>
    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Slider List</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link" href="{!! route('admin.slider.create') !!}"><i class="fa fa-plus mr-2"></i>Create Slider</a>
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
                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
                        
                    <div class="table-responsive m-t-10">
                        <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>S.no.</th>
                                    <th>Type</th>
                                    <th>Image</th>
                                    <th> {{trans('lang.item_publish')}}</th>
                                    <th>{{trans('lang.actions')}}</th>
                                </tr>
                            </thead>
                            @foreach($slider as $cat)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <td>
                                    {{$cat->type_id}}
                                </td>
                              
                                <td>
                                    <img src="{{ asset('images/slider/' . $cat->image) }}" width="100" height="100" alt="slider Photo">
                                </td>
                                <td>
                                    @if ($cat->status == 1 )
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">InActive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/slider/edit/' . $cat->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    <!--<a href="{{ url('admin/slider/delete/' . $cat->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Slider ?')"><i class="fa fa-trash"></i></a>-->
                                    <a href="#" class="btn btn-sm btn-danger"
                                       onclick="showConfirmation('Are you sure you want to delete this Slider?', function() { window.location.href = '{{ url('admin/slider/delete/' . $cat->id) }}'; })">
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
                        <!--            <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()" data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>-->
                        <!--        </li>-->
                        <!--        <li class="page-item">-->
                        <!--            <a class="page-link" href="javascript:void(0);" id="users_table_next_btn" onclick="next()" data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>-->
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




@endsection