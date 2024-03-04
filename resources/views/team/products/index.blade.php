@extends('team.layouts.app')

@section('content')

        <div class="page-wrapper">


            <div class="row page-titles">

                <div class="col-md-5 align-self-center">

                    <h3 class="text-themecolor restaurantTitle">Products</h3>

                </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('team/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>

                </div>

                <div>

                </div>

            </div>

      

            <div class="container-fluid">

                <div class="row">

                    <div class="col-12">

                       
                          <!--<div class="menu-tab">-->
                          <!--      <ul>-->
                          <!--          <li >-->
                          <!--              <a href="">{{trans('lang.tab_basic')}}</a>-->
                          <!--          </li>-->
                          <!--          <li class="active">-->
                          <!--                  <a href="">{{trans('lang.tab_foods')}}</a>-->
                          <!--          </li>-->
                          <!--          <li>-->
                          <!--                  <a href="">{{trans('lang.tab_orders')}}</a>-->
                          <!--          </li>-->
                          <!--          <li>-->
                          <!--                  <a href="">{{trans('lang.tab_promos')}}</a>-->
                          <!--          <li>-->
                          <!--                  <a href="">{{trans('lang.tab_payouts')}}</a>-->
                          <!--          </li>-->
                                  
                                   
                          <!--      </ul>-->
                          <!--</div>-->

                        <div class="card">
                             <div class="card-header">
                              <ul class="nav nav-tabs align-items-end card-header-tabs w-100 justify-content-center">
                                  <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Product List</a>
                                  </li>

                                  <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                    <a class="nav-link" href="{!! route('team.products.create') !!}"><i class="fa fa-plus mr-2"></i>Create Product</a>
                                  </li>
                              </ul>
                            </div>
                            <div class="card-body">

                            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
                            <form action="{{ url ('team/products')}}" method="get" enctype="multipart/form-data">
                                <div id="users-table_filter" class="pull-right"><label> : 
                                    
                                    <!--<div class="form-group">-->
                                    <!--    <select id="category_search_dropdown" name="category" class="form-control">-->
                                    <!--         <option value="">Select Category </option>-->
                                    <!--        @foreach($categories as $ct)-->
                                    <!--            @if($ct->id==$selectedCategory)-->
                                    <!--            <option value="{{$ct->id}}" selected>{{isset($ct->name)?$ct->name:""}} </option>-->
                                    <!--            @else-->
                                    <!--            <option value="{{$ct->id}}">{{$ct->name}} </option>-->
                                    <!--            @endif-->
                                    <!--        @endforeach-->
                                    <!--    </select>-->
                                    <!--    <select  name="restaurants" class="form-control">-->
                                    <!--        <option value="">Select Restaurant </option>-->
                                    <!--        @foreach($restaurants as $rt)-->
                                    <!--            @if($rt->id==$restaur_fil)-->
                                    <!--                <option value="{{$rt->id}}" selected>{{$rt->name}} </option>-->
                                    <!--            @else-->
                                    <!--                <option value="{{$rt->id}}">{{$rt->name}} </option>-->
                                    <!--            @endif-->
                                    <!--        @endforeach-->
                                    <!--    </select>-->
                                               
    
    
                                    <!--</div>-->
                                    <!--<button type="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"> </i></button>-->
                                    <!--<a href="{{ url ('team/products')}}" class="btn btn-warning btn-flat"><i class="fa fa-refresh"></i></a>-->
                                </div>
                            </form>
 
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
                                            <!--<i class="fa fa-check text-success" aria-hidden="true"></i>-->
                                            <label class="badge badge-success open-modal"
                                                style="color:#fff;background:green;cursor:pointer;"
                                                data-toggle="tooltip" data-placement="top" data-restaurant-id="{{ $f->id }}" title="{{ $f->approved_by_name }}">Approved</label>
                                        @elseif($f->team_approvel == 0)
                                            <!--<i class="fa fa-tasks text-primary" aria-hidden="true"></i>-->
                                            <label class="badge badge-primary"
                                                data-toggle="tooltip" data-placement="top"
                                                title="{{ $f->cancel_reason }}">Progress</label>
                                        @elseif($f->team_approvel == -1)
                                            <!--<i class="fa fa-ban text-danger" aria-hidden="true"></i>-->
                                            <label class="badge badge-danger open-modal" data-restaurant-id="{{ $f->id }}"
                                                data-toggle="tooltip" data-placement="top"
                                                title="{{ $f->cancel_reason }}" style="cursor:pointer"> Reject</label>
                                        @elseif($f->team_approvel == 2)
                                            <label class="badge badge-warning" data-toggle="tooltip" data-placement="top"
                                                title="{{ $f->cancel_reason }}">Pending</label>
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
                                                   <a href="{{ url('team/products/view/' . $f->id) }}" class="btn  btn-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                                              
                                                <a href="{{ url('team/products/edit/' . $f->id) }}" class="btn btn-primary"> <i class="fa fa-edit"></i> </a>
                                                    <a href="{{ url('team/products/delete/' . $f->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')"> <i class="fa fa-trash"></i> </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                        </tbody>

                                    </table>
                                    <!--<nav aria-label="Page navigation example">-->
                                    <!--     <ul class="pagination justify-content-center">-->
                                    <!--        <li class="page-item ">-->
                                    <!--            <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()"  data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>-->
                                    <!--        </li>-->
                                    <!--        <li class="page-item">-->
                                    <!--        <a class="page-link" href="javascript:void(0);" id="users_table_next_btn" onclick="next()"  data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>-->
                                    <!--        </li>-->
                                    <!--    </ul>-->
                                    <!--</nav>-->
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
    
    <div class="modal fade" id="restaurantModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <!-- Data will be loaded here using AJAX -->
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('scripts')

<script>
    $(document).ready(function () {
        $('.open-modal').on('click', function () {
            var restaurantId = $(this).data('restaurant-id');
            // console.log(restaurantId);
            $('#restaurantModal .modal-content').empty();

            $.ajax({
                url: '/team/products/approved/' + restaurantId,
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    $('#restaurantModal .modal-content').html(data);
                    $('#restaurantModal').modal('show');
                },
                error: function (xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    });
</script>
@endsection

