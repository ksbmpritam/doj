@extends('restaurant_admin.layouts.app')

@section('content')
        <div class="page-wrapper">

            <div class="row page-titles">

                <div class="col-md-5 align-self-center">

                    <h3 class="text-themecolor">{{trans('lang.category_plural')}}</h3>

                </div>

                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('restaurant/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('lang.category_plural')}}</li>
                    </ol>
                </div>

                <div>

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
                                      <a class="nav-link active" href="{{ url('restaurant/category')}}"><i class="fa fa-list mr-2"></i>{{trans('lang.category_table')}}</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" href="{{ url('restaurant/category/create')}}"><i class="fa fa-plus mr-2"></i>{{trans('lang.category_create')}}</a>
                                    </li>
                              </ul>
                            </div>

                            <div class="card-body">

                                <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>

                          
                                <div class="table-responsive m-t-10">


                                    <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>
                                            <th>S.no.</th>

                                                <th>{{trans('lang.category_image')}}</th>

                                                <th>{{trans('lang.faq_category_name')}}</th>
                                                <th> Description</th>
                                                <th>{{trans('lang.food_plural')}}</th>
                                                <th>{{trans('lang.actions')}}</th>

                                            </tr>

                                        </thead>
                                        @foreach($category as $cat)  
                                            <tr>
                                                 <td>{{$loop->iteration}}</td>
                                                <td>
                                                    <img src="{{ asset('images/categories/' . $cat->images) }}" width="100" height="100" alt="categories Photo">
                                            
                                                </td>
                                                <td>
                                                    {{$cat->name}}
                                                </td>
                                                <td>
                                                    {{$cat->description}}
                                                </td>
                                                <td>
                                                      @if ($cat->status == '1' )
                                                        
                                                        <span class="badge badge-success" style="background:green">Active</span>
                                                        @else
                                                        <span class="badge badge-danger" >InActive</span>
                                                        @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('restaurant/category/edit/' . $cat->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="{{ url('restaurant/category/delete/' . $cat->id) }}" class="btn btn-danger" onclick="return confirm('Are You sure wants to delete ');"><i class="fa fa-trash"></i></a>
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

@push('scripts')

<script>
    document.getElementById('clear-search').addEventListener('click', function() {
        document.getElementById('search').value = '';
    });
</script>

@endpush

