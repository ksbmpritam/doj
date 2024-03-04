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

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>


                        <div class="table-responsive m-t-10">


                            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                <thead>

                                    <tr>
                                    
                                        <th>S.No.</th>
                                        <th>{{trans('lang.food_image')}}</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>{{trans('lang.food_price')}}</th>
                                        <th>{{trans('lang.food_restaurant_id')}}</th>
                                        <th>{{trans('lang.food_category_id')}}</th>
                                        <th>Approved</th>
                                        <th>{{trans('lang.food_publish')}}</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>

                                </thead>
                                @foreach($foods as $f)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><img src="{{ asset('images/foods/' . $f->images) }}" width="100" height="100" alt="categories Photo"></td>
                                    <td>{{$f->name}}</td>
                                    <td> {{$f->item_quantity}} </td>
                                    <td>{{$f->price}}</td>
                                    <td>{{$f->restaurant ? $f->restaurant->name : " "}}</td>
                                    <td>
                                        {{$f->category ? $f->category->name : " "}}
                                    </td>
                                     <td>
                                        @if($f->team_approvel == 1)
                                            <label class="badge badge-success" data-toggle="tooltip" data-placement="top" title="{{ $f->cancel_reason }}">Approved</label>
                                        @elseif($f->team_approvel == 0)
                                            <label class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="{{ $f->cancel_reason }}">Progress</label>
                                        @elseif($f->team_approvel == -1)
                                            <label class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="{{ $f->cancel_reason }}">Reject</label>
                                        @elseif($f->team_approvel == 2)
                                            <label class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="{{ $f->cancel_reason }}">Pending</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if($f->publish==1)
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-danger">Deactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('employee.franchies.team.product.detail' , $f->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('employee.franchies.team.product.edit' , $f->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </a>
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