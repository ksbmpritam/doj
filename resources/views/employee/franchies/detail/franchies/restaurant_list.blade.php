@extends('employee.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">Team </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('employee/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Restaurant</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="menu-tab vendorMenuTab">
                    @include('employee.franchies_menu_team')
                </div>
                <div class="card">
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

                            <div class="table-responsive m-t-10">

                                <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                    <thead>

                                        <tr>
                                    
                                            <th>S.No.</th>

                                            <th>{{trans('lang.restaurant_name')}}</th>

                                            <th>{{trans('lang.restaurant_image')}}</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Approved</th>
                                            
                                            <th >Status</th>

                                           <th >Action</th>

                                        </tr>

                                    </thead>

                                    <tbody id="append_restaurants">

                                        @foreach($restaurant as $r)
                                        
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{$r->name}}
                                                </td>
                                                <td>
                                                    <img src="{{ asset('images/restaurants/' . $r->image) }}" width="100" height="100" alt="restaurants Photo">
                                                </td>
                                                <td>
                                                    {{$r->phone}}
                                                </td>
                                                <td>{{$r->address}}</td>
                                                
                                                <td>
                                                    @if($r->team_approvel == 1)
                                                        <label class="badge badge-success" data-toggle="tooltip" data-placement="top" title="{{ $r->cancel_reason }}">Approved</label>
                                                    @elseif($r->team_approvel == 0)
                                                        <label class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="{{ $r->cancel_reason }}">Progress</label>
                                                    @elseif($r->team_approvel == -1)
                                                        <label class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="{{ $r->cancel_reason }}">Reject</label>
                                                    @elseif($r->team_approvel == 2)
                                                        <label class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="{{ $r->cancel_reason }}">Pending</label>
                                                    @endif
                                                </td>


                                                <td>
                                                    @if($r->restaurant_status == 1)
                                                        <label class="badge badge-success" style="color:#fff;background:green;">Active</label>
                                                    @else
                                                        <label class="badge badge-danger">Deactive</label>
                                                    @endif
                                                </td>
                                                
                                                <td>
                                                    <a href="{{ route('employee.franchies.team.restaurant.details' , $r->id) }}" class="btn btn-secondary"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('employee.franchies.team.restaurant.edit' , $r->id) }}" class="btn btn-secondary"><i class="fa fa-edit"></i></a>
                                                   
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