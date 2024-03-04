@extends('employee.layouts.app')

@section('content')
<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Departments</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('franchies/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Department</li>
            </ol>
        </div>
    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">
                <div class="menu-tab vendorMenuTab">
                    @include('employee.franchies_menu')
                </div>
                <div class="card">

                    <!--<div class="card-header">-->
                    <!--    <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">-->
                    <!--        <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">-->
                    <!--            <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Department List</a>-->
                    <!--        </li>-->
                    <!--        <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">-->
                    <!--            <a class="nav-link" href="{!! route('franchies.department.create') !!}"><i class="fa fa-plus mr-2"></i>Create Department</a>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</div>-->

                    <div class="card-body">

                        <div class="table-responsive m-t-10">

                            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                <thead>

                                    <tr>
                                        <th>S.no.</th>
                                        <th> Department Name </th>
                                        <th> Status </th>
                                        <th>{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>
                                @foreach($departments as $d)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    
                                    <td>
                                        {{$d->name}}
                                    </td>
                                   
                                    <td>
                                        @if ($d->status == 1 )
                                        <span class="badge badge-success" style="padding:5px;">Active</span>
                                        @else
                                        <span class="badge badge-danger" style="padding:5px;">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('employee.franchies.department.details' , $d->id) }}" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></a>
                                        <!--<a href="{{ url('franchies/department/delete/' . $d->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Department ?')"><i class="fa fa-trash"></i></a>-->
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