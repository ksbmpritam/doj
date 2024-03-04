@extends('restaurant_admin.layouts.app')

@section('content')

<div class="page-wrapper">


    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor restaurantTitle">Products</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ol>

        </div>

    </div>



    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! route('restaurant.products') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.food_table')}}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('restaurant.products.create') !!}"><i class="fa fa-plus mr-2"></i>Create Products</a>
                            </li>



                        </ul>
                    </div>
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>


                        <div class="table-responsive m-t-10">

                            <table id="data-table1" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                <thead>

                                    <tr>
                                        <th>S.No.</th>
                                        <th>{{trans('lang.food_image')}}</th>
                                        <th>{{trans('lang.food_name')}}</th>
                                        <th>{{trans('lang.food_price')}}</th>
                                        <th>{{trans('lang.food_restaurant_id')}}</th>
                                        <th>{{trans('lang.food_category_id')}}</th>
                                        <th>{{trans('lang.food_publish')}}</th>
                                        <th class="no-export">{{trans('lang.actions')}}</th>
                                    </tr>

                                </thead>
                                @foreach($products as $f)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><img src="{{ asset('images/foods/' . $f->images) }}" width="100" height="100" alt="categories Photo"></td>
                                    <td>{{$f->name}}</td>
                                    <td>{{$f->price}}</td>
                                    <td>{{$f->restaurant->name}}</td>
                                    <td>
                                        {{$f->category->name}}
                                    </td>
                                    <td>
                                        @if($f->publish==1)
                                        <span class="badge badge-success px-3">Active</span>
                                        @else
                                        <span class="badge badge-danger px-3">Deactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('restaurant/products/edit/' . $f->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="{{ url('restaurant/products/delete/' . $f->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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