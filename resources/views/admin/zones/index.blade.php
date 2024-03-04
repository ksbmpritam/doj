@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">

    <div class="row page-titles"> 

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">Zone</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Zone</li>
            </ol>
        </div>
    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Zone List</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link" href="{!! route('admin.zone.create') !!}"><i class="fa fa-plus mr-2"></i>Create Zone</a>
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

                        <div class="table-responsive m-t-10">

                            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                <thead>

                                    <tr>
                                        <th>S.no.</th>
                                        <th>Name </th>
                                        <th>State </th>
                                        <th>City</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>
                                @foreach($zone as $d)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    
                                    <td>
                                        {{$d->name}}
                                    </td>
                                    <td>
                                        {{$d->state}}
                                    </td>
                                    <td>
                                        {{$d->city}}
                                    </td>
                                    <td>
                                        {{$d->city_full_address}}
                                    </td>
                                   
                                    <td>
                                        @if ($d->status == 1 )
                                        <span class="badge badge-success" style="padding:5px;">Active</span>
                                        @else
                                        <span class="badge badge-danger" style="padding:5px;">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/zone/edit/' . $d->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        <!--<a href="{{ url('admin/zone/delete/' . $d->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this zone ?')"><i class="fa fa-trash"></i></a>-->
                                        <a href="#" class="btn btn-sm btn-danger"
                                           onclick="showConfirmation('Are you sure you want to delete this zone ?', function() { window.location.href = '{{ url('admin/zone/delete/' . $d->id) }}'; })">
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




@endsection