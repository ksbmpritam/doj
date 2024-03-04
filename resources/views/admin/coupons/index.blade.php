@extends('admin.layouts.app')

@section('content')

<div class="page-wrapper">

        <div class="row page-titles">

            <div class="col-md-5 align-self-center">

                <h3 class="text-themecolor restaurantTitle">{{trans('lang.coupon_plural')}}</h3>

            </div>

            <div class="col-md-7 align-self-center">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                    <li class="breadcrumb-item active">{{trans('lang.coupon_table')}}</li>

                </ol>

            </div>

            <div>

            </div>

        </div>



        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <?php if($id!=''){ ?>
                    <div class="menu-tab">
                        <ul>
                            <li >
                                <a href="{{route('admin.restaurants.view',$id)}}">{{trans('lang.tab_basic')}}</a>
                            </li>
                            <li>
                                <a href="{{route('admin.restaurants.foods',$id)}}">{{trans('lang.tab_foods')}}</a>
                            </li>
                            <li>
                                <a href="{{route('admin.restaurants.orders',$id)}}">{{trans('lang.tab_orders')}}</a>
                            </li>
                            <li class="active">
                                <a href="{{route('admin.restaurants.coupons',$id)}}">{{trans('lang.tab_promos')}}</a>
                            <li>
                                <a href="{{route('admin.restaurants.payout',$id)}}">{{trans('lang.tab_payouts')}}</a>
                            </li>
                            <li >
                                    <a href="{{route('admin.restaurants.booktable',$id)}}">{{trans('lang.dine_in_future')}}</a>
                                </li>
                        </ul>
                    </div>
                    <?php } ?>

                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.coupon_table')}}</a>
                                </li>
                                <?php if($id!=''){?>
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('admin.coupons.create') !!}/{{$id}}"><i class="fa fa-plus mr-2"></i>{{trans('lang.coupon_create')}}</a>
                                </li>
                                <?php }else{ ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('admin.coupons.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.coupon_create')}}</a>
                                </li>
                                <?php  } ?>                                    
                            </ul>
                        </div>
                        <div class="card-body">

                            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>

                        <div id="users-table_filter" class="pull-right"><label>{{ trans('lang.search_by')}}
                            
                            <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="code">{{trans('lang.coupon_code')}}</option>
                                    <option value="description">{{trans('lang.coupon_description')}}</option>
                            </select>

                            <div class="form-group">
                            <input type="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table"></label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">{{ trans('lang.search')}}</button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">{{ trans('lang.clear')}}</button>
                        </div>
                        </div>

                            <div class="table-responsive m-t-10">

                                <table id="couponTable" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                    <thead>

                                        <tr>
                                            <th>S.No.</th>
                                            <th>{{trans('lang.coupon_code')}}</th>
                                            
                                            <th >{{trans('lang.coupon_discount')}}</th>
                                            
                                            <th >{{trans('lang.coupon_description')}}</th>

                                            <th >{{trans('lang.coupon_restaurant_id')}}</th>

                                            

                                            
                                            
                                            <th >{{trans('lang.coupon_expires_at')}}</th>
                                            
                                            <th >{{trans('lang.coupon_enabled')}}</th>
                                            
                                            <th >{{trans('lang.actions')}}</th>

                                        </tr>

                                    </thead>
                                        @foreach ($coupon as $c)
                                            
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$c->code}}</td>
                                            <td>{{$c->discount}}</td>
                                            <td>{{$c->description}}</td>
                                            <td>{{$c->restaurant_id}}</td>
                                            <td>{{$c->expire_at}}</td>
                                            <td>
                                                @if($c->enabled == 1)
                                                <button class="btn btn-primary">Enable</button>
                                                @else
                                                <button class="btn btn-danger">Not Enable</button>
                                                @endif
                                            </td>
                                            <td><a href="{{ url('admin/coupons/edit/' . $c->id) }}" class="btn btn-primary">Edit</a></td>
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

@endsection

@section('scripts')
  


@endsection
