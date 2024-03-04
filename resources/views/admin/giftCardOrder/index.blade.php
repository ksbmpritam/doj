@extends('admin.layouts.app')

@section('content')

<div class="page-wrapper">


    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">Gift Card Order</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item">Gift Order</li>

                <li class="breadcrumb-item active">Gift Order List</li>

            </ol>

        </div>


    </div>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <!--<ul class="nav nav-tabs align-items-end card-header-tabs w-100">-->
                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Gift Amount</a>-->
                        <!--    </li>-->
                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link" href="{!! route('admin.gift_card_order.create') !!}"><i class="fa fa-plus mr-2"></i>Create Gift Amount</a>-->
                        <!--    </li>-->

                        <!--</ul>-->
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


                            <table id="data-table" class="display nowrap table table-bordered " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Image</th>
                                        <th>Code</th>
                                        <th>Amount</th>
                                        <th>Expiration Date</th>
                                        <th>Redeemed Date</th>
                                        <th>Customer Name</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($orders as $r)

                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <img src="{{$r->image_url}}" width="100" height="100" alt="Photo">
                                        </td>
                                        <td>
                                            {{ $r->card_code}}
                                        </td>
                                        <td>
                                            {{$r->card_value}}
                                        </td>
                                        @php
                                            $cellColor='';
                                            if($r->is_redeemed == 1){
                                                $cellColor = 'success';
                                            } else if(strtotime($r->expiration_date) < strtotime('now') && $r->is_redeemed == 0){
                                                $cellColor = 'danger';
                                            } else {
                                                $cellColor = 'primary';
                                            }
                                        @endphp
                                        
                                        <td class="text-{{$cellColor}}">
                                            @if($r->is_redeemed == 1)
                                                <span class="badge badge-success">{{$r->expiration_date}}</span>
                                            @elseif(strtotime($r->expiration_date) < strtotime('now') && $r->is_redeemed == 0)
                                                <span class="badge badge-danger">{{$r->expiration_date}}</span>
                                                <span class="badge badge-danger">Expired {{ floor((strtotime('now') - strtotime($r->expiration_date)) / (60 * 60 * 24)) }} days ago</span>
                                            @else
                                                <span class="badge badge-primary">{{$r->expiration_date}}</span>
                                                <span class="badge badge-primary">Expired After {{ floor((strtotime('now') - strtotime($r->expiration_date)) / (60 * 60 * 24)) }} days</span>
                                            @endif
                                        </td>





                                        <td>
                                            {{$r->date_redeemed}}
                                        </td>
                                        <td>
                                            {{$r->customer->name ?? 'N/A'}}
                                        </td>
                                        <td>
                                            {{Str::words($r->message, $limit = 10, $end = '...')}}
                                        </td>

                                        <td>
                                            @if($r->is_active == 1)
                                                <label class="badge badge-success" style="color:#fff;background:green;">Active</label>
                                            @else
                                                <label class="badge badge-danger">Deactive</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/gift_card_order/edit/' . $r->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> </a>
                                            <a href="{{ url('admin/gift_card_order/view/' . $r->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> </a>
                                            <!--<a href="{{ url('admin/gift_card_order/delete/' . $r->id) }}" onclick="return confirm('Are you sure wants to delete this item');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>-->
                                            <a href="#" class="btn btn-sm btn-danger"
                                               onclick="showConfirmation('Are you sure wants to delete this item?', function() { window.location.href = '{{ url('admin/gift_card_order/delete/' . $r->id) }}'; })">
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