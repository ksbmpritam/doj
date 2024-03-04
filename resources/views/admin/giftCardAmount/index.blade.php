@extends('admin.layouts.app')

@section('content')

    <div class="page-wrapper">


        <div class="row page-titles">

            <div class="col-md-5 align-self-center">

                <h3 class="text-themecolor">Gift Amount</h3>

            </div>

            <div class="col-md-7 align-self-center">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                    <li class="breadcrumb-item">Gift Amount</li>

                    <li class="breadcrumb-item active">Gift Amount List</li>

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
                                <li class="nav-item">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Gift Amount</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="{!! route('admin.gift_card_amount.create') !!}"><i class="fa fa-plus mr-2"></i>Create Gift Amount</a>
                                </li>

                            </ul>
                        </div>
                        
                        <div class="card-body">
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
                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>


                            <div class="table-responsive m-t-10">


                                <table id="data-table2" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                    <thead>

                                        <tr>
                                    

                                            <th>S.No.</th>
                                            <th>Amount</th>
                                            <th >Status</th>

                                           <th >Action</th>

                                        </tr>

                                    </thead>

                                    <tbody id="append_restaurants">

                                        @foreach($gifts as $r)
                                        
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{$r->amount}}
                                                </td>
                                               
                                                <td>
                                                    @if($r->status == 1)
                                                        <label class="badge badge-success" style="color:#fff;background:green;">Active</label>
                                                    @else
                                                        <label class="badge badge-danger">Deactive</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/gift_card_amount/edit/' . $r->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" ></i> </a>
                                                    <!--<a href="{{ url('admin/gift_card_amount/delete/' . $r->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this gift Amount?')"><i class="fa fa-trash"></i></a>-->
                                                    <a href="#" class="btn btn-sm btn-danger"
                                                       onclick="showConfirmation('Are you sure you want to delete this gift Amount?', function() { window.location.href = '{{ url('admin/gift_card_amount/delete/' . $r->id) }}'; })">
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
</div>

@endsection

