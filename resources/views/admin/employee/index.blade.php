@extends('admin.layouts.app')

@section('content')
<style>
    #data-table2 tbody tr td,th {
        font-size: 15px;
        padding: 10px;
    } 
</style>

<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Manage Employee</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Manage Employee</li>
            </ol>
        </div>

    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs justify-content-center w-100">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i> Employee List</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link" href="{!! route('admin.employee.create') !!}"><i class="fa fa-plus mr-2"></i>Create Employee</a>
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

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}
                        </div>
                        
                        <div class="table-responsive m-t-10">


                            <table id="data-table2" class="display nowrap table table-bordered " cellspacing="0" width="100%">

                                <thead>

                                    <tr>

                                        <th>ID</th>
                                        <th>Referral Code</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Mobile No.</th>
                                        <th>Status</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>

                                </thead>

                                <tbody >
                                  @foreach($employees as $employe)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        
                                        <td>
                                            {{$employe->referral_code}}
                                        </td>
                                        <td>
                                            {{$employe->name}}
                                        </td>
                                        <td>
                                            {{$employe->email}}
                                        </td>
                                        <td>
                                            {{$employe->pwd}}
                                        </td>
                                        <td>
                                            {{$employe->mobile_no}}
                                        </td>
                                        <td>
                                            @if ($employe->status == 1 )
                                            <span class="badge badge-success" style="padding:5px;">Active</span>
                                            @else
                                            <span class="badge badge-danger" style="padding:5px;">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/employee/view/' . $employe->id) }}" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></a>
                                            <a href="{{ url('admin/employee/edit/' . $employe->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ url('admin/employee/setting/' . $employe->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-cogs" aria-hidden="true"></i></a>
                                            <!--<a href="{{ url('admin/employee/delete/' . $employe->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Employee ?')"><i class="fa fa-trash"></i></a>-->
                                            <a href="#" class="btn btn-sm btn-danger"
                                               onclick="showConfirmation('Are you sure you want to delete this Employee ?', function() { window.location.href = '{{ url('admin/employee/delete/' . $employe->id) }}'; })">
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
</div>



@endsection

