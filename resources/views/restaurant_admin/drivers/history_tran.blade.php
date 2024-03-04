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
            <li>
                <a href="{{url('restaurant/drivers/balanceHistory/'.$id)}}">{{trans('lang.balance_list')}}</a>
            </li>
            <li class="active">
                <a href="{{url('restaurant/drivers/transaction/history/'.$id)}}">Transaction History</a>
            </li>
        </ul>

      </div>
      
        <div class="table-responsive m-t-10">
            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Driver Name</th>
                        <th>Amount</th>
                        <th>Image</th>
                        <th >Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="append_restaurants">
                    @foreach($driver as $r)
                        <tr>
                            <td>{{$loop->iteration}}</td> 
                            <td>
                                {{$r->driver->first_name ?? ''}}
                            </td>
                            <td>
                                {{$r->amount}}
                            </td>
                            <td>
                                @if(isset($r->image))
                                    <img src="{{ asset('images/driver/transaction/' . $r->image) }}" width="100" height="100" alt="Photo">
                                @else
                                    N/A
                                @endif
                            </td>
                            
                            <td>
                                @if($r->status == 3)
                                    <label class="badge badge-success" style="color:#fff;background:green;">Approved</label>
                                @elseif($r->status == 2)
                                    <label class="badge badge-danger">Cancel</label>
                                @elseif($r->status == 1)
                                    <label class="badge badge-warning">Pending</label>
                                @endif
                            </td>
                            <td>{{$r->date}}</td>
                            
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