@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">

  <div class="row page-titles">

    <div class="col-md-5 align-self-center">
      <h3 class="text-themecolor">Food Promo Codes</h3>
    </div>

    <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item active">Food Promo Codes</li>
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
                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Food Promo Code</a>
              </li>
              <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                <a class="nav-link" href="{!! route('admin.foodpromoCode.create') !!}"><i class="fa fa-plus mr-2"></i>Create Food Promo Code</a>
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
            <table id="data-table" class="nowrap table table-hover table-bordered " width="100%">

              <thead>

                <tr>
                  <th>S.no.</th>
                  <th>Promo Code</th>
                  <th>Promo Code Name</th>
                  <th>Image</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <!--<th>Discount</th>-->
                  <!--<th>Discount Type</th>-->
                  <th>Status</th>
                  <th>{{trans('lang.actions')}}</th>

                </tr>

              </thead>
              @foreach($FoodPromoCodes as $cat)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                  {{$cat->promo_code}}
                </td>
                <td>
                  {{$cat->promo_code_name}}
                </td>
                <td>
                  <img src="{{ asset('images/promo/' . $cat->image) }}" width="100" height="100" alt="promo Photo">

                </td>
               
                <td>
                  {{$cat->start_date}}
                </td>
                <td>
                  {{$cat->end_date}}
                </td>
                <!--<td>-->
                <!--  {{$cat->discount}}-->
                <!--</td>-->
                <!--<td>-->
                <!--    @if($cat->discount_type=='percentage')-->
                <!--        <p>Percentage %</p>-->
                <!--    @elseif($cat->discount_type=='up_topercentage')-->
                <!--        <p>Up To Percentage (%)</p>-->
                <!--    @elseif($cat->discount_type=='amount')-->
                <!--        <p>Amount (₹)</p>-->
                <!--    @elseif($cat->discount_type=='up_to_amount')-->
                <!--        <p>Up To Amount (₹)</p>-->
                <!--    @endif-->
                <!--</td>-->

                <td>
                  @if ($cat->status == 1 )
                  <span class="badge badge-success">Active</span>
                  @else
                  <span class="badge badge-danger">InActive</span>
                  @endif
                </td>
                <td>
                    <a href="{{ url('admin/foodpromoCode/edit/' . $cat->id) }}"  class="m-1 p-1" data-toggle="tooltip" data-placement="top"  title="Edit">
                      <i class="fa fa-edit"></i> Edit 
                    </a>
                    <a href="{{ url('admin/foodpromoCode/restaurant/' . $cat->id) }}"  class="m-1 p-1" data-toggle="tooltip" data-placement="top"  title="Select restaurant">
                        <i class="fa fa-list"></i> Restaurant 
                    </a><br>
                    <a href="{{ url('admin/foodpromoCode/users/' . $cat->id) }}" class="m-1 p-1" data-toggle="tooltip" data-placement="top"  title="Select Users">
                        <i class="fa fa-list"></i> Users 
                    </a>
                    <a href="{{ url('admin/foodpromoCode/product/' . $cat->id) }}" class="m-1 p-1" data-toggle="tooltip" data-placement="top"  title="Select Product">
                        <i class="fa fa-list"></i> Product 
                    </a>
                    <!--<a href="{{ url('admin/foodpromoCode/delete/' . $cat->id) }}" class="m-1 p-1" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure you want to delete this promoCode?')"><i class="fa fa-trash"></i> Delete </a>-->
                    <a href="#" class="btn btn-sm btn-danger"
                       onclick="showConfirmation('Are you sure you want to delete this promoCode?', function() { window.location.href = '{{ url('admin/foodpromoCode/delete/' . $cat->id) }}'; })">
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