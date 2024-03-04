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
                <li class="breadcrumb-item active">Rider</li>
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
                        <div class="table-responsive m-t-10">

                            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                <thead>

                                    <tr>

                                        <th>S.No.</th>
                                        <th>{{trans('lang.extra_image')}}</th>

                                        <th>{{trans('lang.user_name')}}</th>
                                        <th>{{trans('lang.phone')}}</th>

                                        <th>{{trans('lang.driver_available')}}</th>

                                        <th>{{trans('lang.dashboard_total_orders')}}</th>
                                        <th>Approved</th>

                                        <th>{{trans('lang.status')}}</th>
                                        <th class="no-export">{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>
                                @foreach($driver as $d)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td>
                                        @if($d->profile_image)
                                           <img src="{{ asset('images/driver/profile/' . $d->profile_image) }}" width="100" height="100" alt="profile Photo">
                                        @else
                                            Profile Image not Uploaded
                                        @endif
                                        
                                    </td>
                                    <td>{{$d->first_name}}&nbsp;{{$d->last_name}}</td>
                                    <td>{{$d->phone}}</td>
                                    <td>
                                        @if($d->available==1)
                                            <span class="badge badge-success" >Available</span>
                                        @else
                                            <span class="badge badge-danger" >Not Available</span>
                                        @endif
                                    </td>
                                    
                                    <td>{{count($d->order)}}</td>
                                    <td>
                                        @if($d->team_approvel == 1)
                                            <label class="badge badge-success" data-toggle="tooltip" data-placement="top" title="{{ $d->cancel_reason }}">Approved</label>
                                        @elseif($d->team_approvel == 0)
                                            <label class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="{{ $d->cancel_reason }}">Progress</label>
                                        @elseif($d->team_approvel == -1)
                                            <label class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="{{ $d->cancel_reason }}">Reject</label>
                                        @elseif($d->team_approvel == 2)
                                            <label class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="{{ $d->cancel_reason }}">Pending</label>
                                        @endif
                                    </td>

                                    <td>
                                        @if($d->status==1)
                                            <span class="badge badge-success" >Active</span>
                                        @else
                                            <span class="badge badge-danger" >InActive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('employee/franchies/team/rider/details/' . $d->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="{{ url('employee/franchies/team/rider/edit/' . $d->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </a>
                                        <!--<a href="{{ url('employee/team/riders/delete/' . $d->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure wants to delete');"><i class="fa fa-trash"></i></a>-->
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