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
                   
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                        <div class="menu-tab">
                            <ul>
                                <li >
                                    <a href="{{route('admin.users.view',$userId)}}">{{trans('lang.tab_basic')}}</a>
                                </li>
                                <li >
                                    <a href="{{route('admin.users.orders',$userId)}}">{{trans('lang.tab_orders')}}</a>
                                </li>
                                <li class="active">
                                    <a href="{{route('admin.users.payout',$userId)}}">Wallet Transaction</a>
                                </li>
                            </ul>
                        </div>
                       
                        <div class="table-responsive m-t-10">
                            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                    
                                        <th>S.no.</th>
                                        <th>Transaction Id</th>
                                        <th>Amount</th>
                                        <!--<th>Type</th>-->
                                        <th >Date</th>
                                        <!--<th class="no-export">{{trans('lang.actions')}}</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wallet as $or)

                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$or->transaction_id}}</td>
                                            @if($or->type=='credit')
                                                <td class="text-success"> <i class="fa fa-plus"> </i> {{$or->amount}}</td>
                                            @else
                                                <td class="text-danger"><i class="fa fa-minus"></i> {{$or->amount}}</td>
                                            @endif
                                            <td>{{$or->transaction_date}}</td>
                                            <!--<td>-->
                                            <!--    <a href="{{ url('admin/users/view/' . $or->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> </a>-->
                                            <!--    <a href="{{ url('admin/users/order_details/' . $or->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>-->
                                            <!--    <a href="{{ url('admin/users/delete/' . $or->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>-->
                                            <!--</td>-->
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
</div>

@endsection

