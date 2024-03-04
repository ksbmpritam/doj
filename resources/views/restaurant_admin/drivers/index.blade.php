@extends('restaurant_admin.layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.driver_plural')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('restaurant/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item active">{{trans('lang.driver_table')}}</li>

            </ol>

        </div>

    </div>



    <div class="container-fluid">

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! route('restaurant.drivers') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.driver_table')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('restaurant.drivers.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.drivers_create')}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive m-t-10">

                            <table id="data-table1" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                <thead>

                                    <tr>
                                        <th>S.No.</th>
                                        <th>{{trans('lang.extra_image')}}</th>

                                        <th>{{trans('lang.user_name')}}</th>
                                        <th>{{trans('lang.phone')}}</th>
                                        <th>{{trans('lang.driver_available')}}</th>

                                        <th>{{trans('lang.order_transactions')}}</th>
                                        <th>{{trans('lang.dashboard_total_orders')}}</th>



                                        <th class="no-export">{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>
                                @foreach($driver as $d)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('images/driver/profile/' . $d->profile_image) }}" width="100" height="100" alt="profile Photo">
                                    </td>
                                    <td>{{$d->firstname}}&nbsp;{{$d->last_name}}</td>
                                    <td>{{$d->phone}}</td>
                                    <td>
                                        @if($d->available == '1')
                                        <span class="badge badge-success">Available</span>
                                        @else
                                        <span class="badge badge-danger">Not Available</span>
                                        @endif
                                    </td>
                                    <td>{{$d->order_transaction}}</td>
                                    <td>{{$d->order_total}}</td>
                                    <td>
                                        <a href="{{ url('restaurant/drivers/edit/' . $d->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="{{ url('restaurant/drivers/view/' . $d->id) }}" class="btn btn-secondary"><i class="fa fa-eye"></i></a>
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