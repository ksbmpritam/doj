@extends('admin.layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Manage Franchies</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Manage Franchies</li>
            </ol>
        </div>

    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs justify-content-center w-100">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i> Franchies List</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link" href="{!! route('admin.franchies.create') !!}"><i class="fa fa-plus mr-2"></i>Create Franchies</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}
                        </div>
                        
                        <div class="table-responsive m-t-10">


                            <table id="data-table2" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                <thead>

                                    <tr>

                                        <th>ID</th>
                                        <th>Referral Code</th>
                                        <th>Franchies Name</th>
                                        <th>Franchies Tag Line</th>
                                        <th>Franchies address</th>
                                        <th>Manager Name</th>
                                        <th>Manager Mobile No.</th>
                                        <th>Status</th>
                                        <th>{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>

                                <tbody >
                                  @foreach($franchise as $fran)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <!--<td>-->
                                        <!--    <img src="{{ asset('images/categories/' . $fran->images) }}" width="100" height="100" alt="categories Photo">-->
    
                                        <!--</td>-->
                                        <td>
                                            {{$fran->referral_code}}
                                        </td>
                                        <td>
                                            {{$fran->franchies_name}}
                                        </td>
                                        <td>
                                            {{$fran->franchies_tag_line}}
                                        </td>
                                        <td>
                                            {{$fran->franchies_permanent_address}}
                                        </td>
                                        <td>
                                            {{$fran->name}}
                                        </td>
                                        <td>
                                            {{$fran->mobile_no}}
                                        </td>
                                        <td>
                                            @if ($fran->status == 1 )
                                            <span class="badge badge-success" style="padding:5px;">Active</span>
                                            @else
                                            <span class="badge badge-danger" style="padding:5px;">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/franchies/edit/' . $fran->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ url('admin/franchies/setting/' . $fran->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-cogs" aria-hidden="true"></i></a>
                                            <a href="{{ url('admin/franchies/delete/' . $fran->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Franchies ?')"><i class="fa fa-trash"></i></a>
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

