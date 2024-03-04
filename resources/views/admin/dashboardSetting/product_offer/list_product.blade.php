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

            <h3 class="text-themecolor">Product List</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Product Offer</li>
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
                                <a class="nav-link active" href="{!! route('admin.products.offer') !!}"><i class="fa fa-list mr-2"></i>Product Offer</a>
                            </li>
                            <!--<li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">-->
                            <!--    <a class="nav-link" href="{!! route('admin.products.offer.create') !!}"><i class="fa fa-plus mr-2"></i>Create Product Offer</a>-->
                            <!--</li>-->
                        </ul>
                    </div>

                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
                        
                    <div class="table-responsive m-t-10">


                        <table id="data-table2" class="display nowrap table  table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                            <thead>

                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Discount </th>
                                    <th>Discount % </th>
                                    <th> {{trans('lang.item_publish')}}</th>
                                    <!--<th>{{trans('lang.actions')}}</th>-->

                                </tr>

                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <td>
                                    {{$product->name}}
                                </td>
                                <td>
                                    {{$product->price}}
                                </td>
                                <td>
                                    {{$product->discount}}
                                </td>
                                
                                <td>
                                    {{$product->discounted_price_percentage}}
                                </td>
                              
                                <td>
                                    @if ($product->status == 1 )
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">InActive</span>
                                    @endif
                                </td>
                                <!--<td>-->
                                <!--    <a href="{{ url('admin/products/offer/get_product/' . $product->id) }}" class="btn btn-sm btn-info" title="Product List"><i class="fa fa-list"></i></a>-->
                                <!--    <a href="{{ url('admin/products/offer/edit/' . $product->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>-->
                                <!--    <a href="{{ url('admin/products/offer/delete/' . $product->id) }}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this Offer ?')"><i class="fa fa-trash"></i></a>-->
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




@endsection