@extends('admin.layouts.app')

@section('content')
<style>
    #example24 tbody tr td,th {
        font-size: 15px;
        padding: 10px;
    } 
</style>
<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">Users Offer</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Users Offer</li>
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
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Users Offer</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link" href="{!! route('admin.users.offer.create') !!}"><i class="fa fa-plus mr-2"></i>Create Users Offer</a>
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

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
                        
                    <div class="table-responsive m-t-10">


                        <table id="data-table2" class="display nowrap table  table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                            <thead>

                                <tr>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>Start Date </th>
                                    <th>End Date </th>
                                    <th>Discount Type </th>
                                    <th>Discount </th>
                                    <th> {{trans('lang.item_publish')}} </th>
                                    <th> {{trans('lang.actions')}} </th>

                                </tr>

                            </thead>
                            <tbody>
                            @foreach($offers as $offer)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <td>
                                    {{$offer->title}}
                                </td>
                                <td>
                                    {{$offer->opening_date}} {{$offer->opening_time}}
                                </td>
                                <td style="{{ \Carbon\Carbon::parse($offer->closing_date . ' ' . $offer->closing_time)->isPast() ? 'color: red;' : '' }}">
                                    {{ $offer->closing_date }} {{ $offer->closing_time }}
                                </td>

                                <td>
                                    {{$offer->discount}}
                                </td>
                                <td>
                                    {{ucfirst($offer->discount_type)}}
                                </td>
                           
                              
                                <td>
                                    @if ($offer->status == 1 )
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">InActive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/users/offer/edit/' . $offer->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                    <!--<a href="{{ url('admin/users/offer/delete/' . $offer->id) }}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this Special ?')"><i class="fa fa-trash"></i></a>-->
                                    <a href="#" class="btn btn-sm btn-danger"
                                       onclick="showConfirmation('Are you sure you want to delete this Special?', function() { window.location.href = '{{ url('admin/users/offer/delete/' . $offer->id) }}'; })">
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