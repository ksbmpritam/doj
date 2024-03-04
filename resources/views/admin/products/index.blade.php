@extends('admin.layouts.app')

@section('content')

        <div class="page-wrapper">


            <div class="row page-titles">

                <div class="col-md-5 align-self-center">

                    <h3 class="text-themecolor restaurantTitle">Products</h3>

                </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
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
                                    <a class="nav-link" href="{!! route('admin.products.create') !!}"><i class="fa fa-plus mr-2"></i>Create Product</a>
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
                            <form action="{{ url ('admin/products')}}" method="get" enctype="multipart/form-data">
                                <div id="users-table_filter" class="pull-right"><label>Filter By : 
                                    
                                    <div class="form-group">
                                        <select id="category_search_dropdown" name="category" class="form-control">
                                             <option value="">Select Category </option>
                                            @foreach($categories as $ct)
                                                @if($ct->id==$selectedCategory)
                                                <option value="{{$ct->id}}" selected>{{isset($ct->name)?$ct->name:""}} </option>
                                                @else
                                                <option value="{{$ct->id}}">{{$ct->name}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <select  name="restaurants" class="form-control">
                                            <option value="">Select Restaurant </option>
                                            @foreach($restaurants as $rt)
                                                @if($rt->id==$restaur_fil)
                                                    <option value="{{$rt->id}}" selected>{{$rt->name}} </option>
                                                @else
                                                    <option value="{{$rt->id}}">{{$rt->name}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                               
    
    
                                    </div>
                                    <button type="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"> </i></button>
                                    <a href="{{ url ('admin/products')}}" class="btn btn-warning btn-flat"><i class="fa fa-refresh"></i></a>
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
                                                 <th> Franchise Name</th>
                                                 <th>Employee Name </th>
                                                   <th>Team Name </th>
                                                <th>{{trans('lang.food_restaurant_id')}}</th>
                                                <th>{{trans('lang.food_category_id')}}</th>
                                                <th>{{trans('lang.food_publish')}}</th>
                                                <th>{{trans('lang.actions')}}</th>
                                            </tr>

                                        </thead>
                                        @foreach($foods as $f)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><img src="{{ asset('images/foods/' . $f->images) }}"  onerror="this.src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSjUt44i013i_WJ-l3hKPaJ2u3vJd5z1GIvOpN30is&s'"  width="100" height="100" alt="..."/> 
                                            
                                            
                                            </td>
                                            <td>{{$f->name}}</td>
                                            <td> {{$f->item_quantity}} </td>
                                            <td>{{$f->price}}</td>
                                              <!--<td>{{$f->franchies_id}}</td>-->
                                            <!--/================ new code team and ferchinces -------->
                                            @if($f->franchies_id)
                                                <?php
                                                    $franchise = \App\Models\Franchise::find($f->franchies_id);
                                                    $franchiseName = $franchise ? $franchise->franchies_name : 'N/A';
                                                ?>
                                                <td class="franchise-name" data-franchise-id="{{ $f->franchies_id }}" style="cursor:pointer;" data-franchise-name="{{ $franchiseName }}">
                                                    {{ $franchiseName }}
                                                </td>
                                            @else
                                                <td class="franchise-name" data-franchise-id="{{ $f->franchies_id ?? '' }}" style="cursor:pointer;">N/A</td>
                                            @endif

                                            
                                       <td class="employee-name" data-employee-id="{{ $f->employee_id ?? '' }}"
                                        data-employee-name="{{ $f->team && $f->employee_id ? App\Models\Employee::find($f->employee_id)->name : 'N/A' }}" style="cursor:pointer;">
                                           
                                        @if ($f->team && $f->employee_id)
                                            {{ App\Models\Employee::find($f->employee_id)->name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                         <td class="team-name" data-team-id="{{ $f->team->id ?? '' }}" style="cursor:pointer;" data-team-name="{{ $f->team ? $f->team->name : 'N/A' }}">{{ $f->team ? $f->team->name : 'N/A' }}</td>

                                            
                                            <!--end ==========================================-->
                                            <td>{{$f->restaurant ? $f->restaurant->name : " "}}</td>
                                            <td>
                                            {{$f->category ? $f->category->name : " "}}
                                            </td>
                                            <td>
                                            @if($f->publish==1)
                                                <span class="badge badge-success">Active</span>
                                             @else
                                                <span class="badge badge-danger">Deactive</span>
                                            @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/products/edit/' . $f->id) }}" class="btn btn-primary"> <i class="fa fa-edit"></i> </a>
                                                <!--<a href="{{ url('admin/products/delete/' . $f->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')"> <i class="fa fa-trash"></i> </a>-->
                                                <a href="#" class="btn btn-sm btn-danger"
                                                   onclick="showConfirmation('Are you sure you want to delete this item?', function() { window.location.href = '{{ url('admin/products/delete/' . $f->id) }}'; })">
                                                   <i class="fa fa-trash"></i> 
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                        </tbody>

                                    </table>
                                    <nav aria-label="Page navigation example">
                                         <ul class="pagination justify-content-center">
                                            <li class="page-item ">
                                                <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()"  data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>
                                            </li>
                                            <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);" id="users_table_next_btn" onclick="next()"  data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
                                            </li>
                                        </ul>
                                    </nav>
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
<div class="modal fade" id="employeeModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <!-- Data will be loaded here using AJAX -->
        </div>
    </div>
</div>
<div class="modal fade" id="teamModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <!-- Data will be loaded here using AJAX -->
        </div>
    </div>
</div>
<div class="modal fade" id="teamModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <!-- Data will be loaded here using AJAX -->
        </div>
    </div>
</div>
<div class="modal fade" id="franchiseModel" tabindex="-1" role="dialog" aria-hidden="true">
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
            console.log(restaurantId);
            $('#restaurantModal .modal-content').empty();

            $.ajax({
                url: '/team/riders/showRiders/' + restaurantId,
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
           $('.employee-name').on('click', function () {
            var employeeId = $(this).data('employee-id');
                
            var employeeName = $(this).data('employee-name');
                // console.log(employeeId);
            if (employeeName !== 'N/A') {
                $('#employeeModel .modal-content').empty();
        
                $.ajax({
                    url: '/admin/drivers/request/' + employeeId,
                    type: 'GET',
                    success: function (data) {
                        $('#employeeModel .modal-content').html(data);
                        $('#employeeModel').modal('show');
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr);
                    }
                });
            }
        });
                
          
        $('.franchise-name').on('click', function () {
            let franchiesId = $(this).data('franchise-id');
            let franchiesName = $(this).data('franchise-name');
            if (franchiesName !== 'N/A') {
                $('#franchiseModel .modal-content').empty();
        
                $.ajax({
                    url: '/admin/rider/request/franchiesName/' + franchiesId,
                    type: 'GET',
                    success: function (data) {
                        $('#franchiseModel .modal-content').html(data);
                        $('#franchiseModel').modal('show');
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr);
                    }
                });
            }
        });


        $('.team-name').on('click', function () {
    let teamId = $(this).data('team-id');
    let teamName = $(this).data('team-name');

    if (teamName !== 'N/A') {
        $('#teamModel .modal-content').empty();

        $.ajax({
            url: '/admin/drivers/showteamrequest/' + teamId,
            type: 'GET',
            success: function (data) {
                console.log(data);
                $('#teamModel .modal-content').html(data);
                $('#teamModel').modal('show');
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    }
});
    });
</script>
@endsection



