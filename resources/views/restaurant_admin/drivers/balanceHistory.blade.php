@extends('restaurant_admin.layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor restaurantTitle">{{trans('lang.driver_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('restaurant/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href= "{!! route('restaurant.drivers.view',$id) !!}" >{{trans('lang.driver_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.restaurant_details')}}</li>
            </ol>
        </div>
    
  </div>
 
   <div class="container-fluid">
   	<div class="row">
   		<div class="col-12">

    <div class="resttab-sec">
      	<div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
      <div class="menu-tab">
     
          <ul>
            <li >
                <a href="{{route('restaurant.drivers.view',$id)}}">{{trans('lang.tab_basic')}}</a>
            </li>
            <li>
                <a href="{{url('restaurant/drivers/orders_list/'.$id)}}">{{trans('lang.tab_orders')}}</a>
            </li>
            <li class="active">
                <a href="{{url('restaurant/drivers/balanceHistory/'.$id)}}">{{trans('lang.balance_list')}}</a>
            </li>
            <li>
                <a href="{{url('restaurant/drivers/transaction/history/'.$id)}}">Transaction History</a>
            </li>
        </ul>

      </div>
      
      <div class="table-responsive m-t-10">


            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                <thead>

                    <tr>
                    <th>S.no.</th>

                        <th>{{trans('lang.order_id')}}</th>
                        <th>Customer Name</th>
                        <th>Amount</th>
                        <th>Payment Type</th>
                        <th> {{trans('lang.driver_status')}}</th>
                    </tr>
    
                </thead>
                     @foreach($order as $cat)  
                     <tr>
                         <td>{{$loop->iteration}}</td>
                        <td>
                           {{$cat->order_id ?? ''}}
                        </td>
                        <td>  
                           {{$cat->users->name ?? ''}}
                        </td>
                        <td>
                           {{$cat->amount ?? ''}}
                        </td>
                        <td>
                           {{$cat->type ?? ''}}
                        </td>
                        <td>
                            @if($cat->order_status == '0')
                                <span class="badge badge-primary">Send Order</span>
                            @elseif ($cat->order_status == '1')
                                <span class="badge badge-success">Accept</span>
                            @elseif($cat->order_status == '-1')
                                <span class="badge badge-danger">Cancel</span>
                            @elseif($cat->order_status == '2')
                                <span class="badge badge-warning">Dispatch Order</span>
                            @elseif($cat->order_status == '3')
                                <span class="badge badge-secondary">Payment Process</span>
                            @elseif($cat->order_status == '4')
                                <span class="badge badge-success">Order Completed</span>
                            @endif
                        </td>
                        
                    </tr>
                    @endforeach

                </tbody>

            </table>
      	</div>
      

   </div>

</div>
      <div class="form-group col-12 text-center btm-btn">
         <a href="{!! route('restaurant.drivers') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
      </div>

    </div>
  </div>
</div>


 @endsection