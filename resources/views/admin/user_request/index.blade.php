@extends('admin.layouts.app')

@section('content')

    <div class="page-wrapper">


        <div class="row page-titles">

            <div class="col-md-5 align-self-center">

                <h3 class="text-themecolor">{{trans('lang.user_plural')}}</h3>

            </div>

            <div class="col-md-7 align-self-center">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="#">{{trans('lang.dashboard')}}</a></li>

                    <li class="breadcrumb-item">{{trans('lang.user_plural')}}</li>

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
                            <div class="card-header">
                            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            </ul>
                        </div>
                        <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                            <div class="table-responsive m-t-10">
                                <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>{{trans('lang.customer_name')}}</th>
                                            <th>Amount</th>
                                            <th>Image</th>
                                            <th >Status</th>
                                            <th>Date</th>
                                           <th class="no-export">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="append_restaurants">
                                        @foreach($user as $r)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{$r->customer->name ?? ''}}
                                                </td>
                                                <td>
                                                    {{$r->amount}}
                                                </td>
                                                <td>
                                                    @if(isset($r->image))
                                                        <img src="{{ asset('images/user/transaction/' . $r->image) }}" width="100" height="100" alt="user Photo">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                
                                                <td>
                                                    @if($r->status == 3)
                                                        <label class="badge badge-success" style="color:#fff;background:green;">Approved</label>
                                                    @elseif($r->status == 2)
                                                        <label class="badge badge-danger">Cancel</label>
                                                    @elseif($r->status == 1)
                                                        <label class="badge badge-warning">Pending</label>
                                                    @endif
                                                </td>
                                                <td>{{$r->date}}</td>
                                                <td>
                                                    <a href="{{ route('admin.user.withdrawal.edit',['id'=> $r->id])}}" class="btn btn-primary edit-btn"> <i class="fa fa-edit"></i> </a>
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
</div>
@endsection

