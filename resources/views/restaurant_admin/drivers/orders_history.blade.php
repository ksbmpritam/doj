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
            <li class="active">
                <a href="{{route('restaurant.drivers.view',$id)}}">{{trans('lang.tab_basic')}}</a>
            </li>
            <li>
                <a href="{{url('restaurant/drivers/orders_list/'.$id)}}">{{trans('lang.tab_orders')}}</a>
            </li>
           
        </ul>

      </div>
      
      <div class="table-responsive m-t-10">


            <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                <thead>

                    <tr>
                    <th>S.no.</th>

                        <th>{{trans('lang.order_id')}}</th>

                        <th>{{trans('lang.order_order_status_id')}}</th>
                        <th> {{trans('lang.driver_status')}}</th>

                    </tr>

                </thead>
                     @foreach($order as $od)  
                     <tr>
                         <td>{{$loop->iteration}}</td>
                        <td>
                           
                    
                        </td>
                        <td>
                            {{$od->name}}
                        </td>
                        <td>
                            {{$od->description}}
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

