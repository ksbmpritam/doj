@extends('employee.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">Franchies </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('employee/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Franchies</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="menu-tab vendorMenuTab">
                    @include('employee.franchies_menu')
                </div>

                <div class="card-body">

                        <div class="table-responsive m-t-10">

                            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                <thead>

                                    <tr>
                                        <th>S.no.</th>
                                        <th>Name </th>
                                        <th>Email </th>
                                        <th>Password</th>
                                        <th>Mobile No</th>
                                        <th>Status</th>
                                        <th>{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>
                                @foreach($teams as $d)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    
                                    <td>
                                        {{$d->name}}
                                    </td>
                                    <td>
                                        {{$d->email}}
                                    </td>
                                    <td>
                                        {{$d->pwd}}
                                    </td>
                                    <td>
                                        {{$d->mobile_no}}
                                    </td>
                                   
                                    <td>
                                        @if ($d->status == 1 )
                                        <span class="badge badge-success" style="padding:5px;">Active</span>
                                        @else
                                        <span class="badge badge-danger" style="padding:5px;">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('employee/franchies/team/details/' . $d->id) }}" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></a>
                                        <!--<a href="{{ url('employee/franchies/team/teamDetail/' . $d->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-cogs" aria-hidden="true"></i></a>-->
                                        <!--<a href="{{ url('employee/franchies/team/delete/' . $d->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Team ?')"><i class="fa fa-trash"></i></a>-->
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