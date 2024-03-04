@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.category_plural')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.category_plural')}}</li>
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
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.category_table')}}</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link" href="{!! route('admin.categories.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.category_create')}}</a>
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

                                        <th>{{trans('lang.category_image')}}</th>

                                        <th>{{trans('lang.faq_category_name')}}</th>
                                        <th>Restaurant Name</th>
                                        <th>{{trans('lang.food_plural')}}</th>
                                        <th> {{trans('lang.item_publish')}}</th>
                                        <th>{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>
                                @foreach($categories as $cat)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <img src="{{ asset('images/categories/' . $cat->images) }}" width="100" height="100" alt="categories Photo">

                                    </td>
                                    <td>
                                        {{$cat->name}}
                                    </td>
                                    <td>
                                        {{$cat->restaurant ? $cat->restaurant->name: "All"}}
                                    </td>
                                    <td>
                                        {{$cat->foods_count}}
                                    </td>
                                    <td>
                                        @if ($cat->status == 1 )
                                        <span class="badge badge-success" style="padding:5px;">Active</span>
                                        @else
                                        <span class="badge badge-danger" style="padding:5px;">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/categories/edit/' . $cat->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        <!--<a href="{{ url('admin/categories/delete/' . $cat->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')"><i class="fa fa-trash"></i></a>-->
                                        <a href="#" class="btn btn-sm btn-danger"
                                           onclick="showConfirmation('Are you sure you want to delete this category?', function() { window.location.href = '{{ url('admin/categories/delete/' . $cat->id) }}'; })">
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