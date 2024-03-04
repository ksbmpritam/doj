@extends('admin.layouts.app')

@section('content')
<style>
    #example24 tbody tr td,th {
        font-size: 15px;
        padding: 10px;
    } 
</style>
<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">Today Special</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Today Special</li>
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
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Today Special</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link" href="{!! route('admin.today.special.create') !!}"><i class="fa fa-plus mr-2"></i>Create Today Special</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
                        
                    <div class="table-responsive m-t-10">


                        <table id="data-table2" class="display nowrap table  table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                            <thead>

                                <tr>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>Date </th>
                                    <th> {{trans('lang.item_publish')}}</th>
                                    <th>{{trans('lang.actions')}}</th>

                                </tr>

                            </thead>
                            <tbody>
                            @foreach($specials as $special)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <td>
                                    {{$special->title}}
                                </td>
                                <td>
                                    {{$special->created_date}}
                                </td>
                           
                              
                                <td>
                                    @if ($special->status == 1 )
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">InActive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/today/special/edit/' . $special->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                    <!--<a href="{{ url('admin/today/special/delete/' . $special->id) }}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this Special ?')"><i class="fa fa-trash"></i></a>-->
                                    <a href="#" class="btn btn-sm btn-danger"
                                       onclick="showConfirmation('Are you sure you want to delete this Special?', function() { window.location.href = '{{ url('admin/today/special/delete/' . $special->id) }}'; })">
                                       <i class="fa fa-trash"></i> 
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>

                        </table>
                     
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>




@endsection