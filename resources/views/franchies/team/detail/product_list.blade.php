@extends('franchies.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">Team </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Rider</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="menu-tab vendorMenuTab">
                    @include('franchies.head_menu')
                </div>

                <div class="card">
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>


                        <div class="table-responsive m-t-10">


                            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                <thead>

                                    <tr>
                                        <!--    <th class="delete-all"><input type="checkbox" id="is_active"><label-->
                                        <!--    class="col-3 control-label" for="is_active">-->
                                        <!--<a id="deleteAll" class="do_not_delete" href="javascript:void(0)"><i-->
                                        <!--            class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>-->
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
                                        <label class="badge badge-success" style="color: #fff; background-color: green;">Approved</label>
                                        @elseif($f->team_approvel == 0)
                                        <label class="badge badge-primary" style="color: #fff; background-color: orange;">Progress</label>
                                        @else
                                        <label class="badge badge-warning" style="color: #fff; background-color: red;">Unapproved</label>
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
                                        <a href="{{ route('franchies.team.approvalProduct.edit' , $f->id) }}" class="btn btn-primary"> <i class="fa fa-edit"></i> </a>
                                        <a href="{{ route('franchies.team.view.productDetail' , $f->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
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