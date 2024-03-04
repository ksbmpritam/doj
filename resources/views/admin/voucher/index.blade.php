@extends('admin.layouts.app')


@section('content')

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Voucher</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item">Voucher</li>
                <li class="breadcrumb-item active">Voucher List</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs justify-content-center w-100">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Voucher List</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link" href="{{ url('admin/voucher/create') }}"><i class="fa fa-plus mr-2"></i>Create Voucher</a>
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
                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                        <div class="table-responsive m-t-10">
                            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>{{trans('Amount Min')}}</th>
                                        <th>{{trans('Discount')}}</th>
                                        <th>{{trans('lang.publish')}}</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vouchers as $voucher)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>
                                            <p>{{ $voucher->amount}}</p>
                                        </td>
                                        <td>
                                            <p>{{ $voucher->discount}}</p>
                                        </td>
                                        <td>
                                            @if ($voucher->status == 1)

                                            <span class="badge badge-success" style="padding:5px;">active</span>
                                            @else
                                            <span class="badge badge-danger" style="padding:5px;">inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/voucher/edit/' . $voucher->id) }}" class="btn btn-primary"> <i class="fa fa-edit"></i> </a>
                                            <a href="#" class="btn btn-sm btn-danger"
                                               onclick="showConfirmation('Are you sure you want to delete this voucher?', function() { window.location.href = '{{ url('admin/voucher/delete/' . $voucher->id) }}'; })">
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