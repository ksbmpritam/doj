@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">

  <div class="row page-titles">

    <div class="col-md-5 align-self-center">
      <h3 class="text-themecolor"> kilometer Promo Codes </h3>
    </div>

    <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item active">Promo Codes</li>
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
                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Promo Code kilometer  List</a>
              </li>
              <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                <a class="nav-link" href="{!! route('admin.kilometer.create') !!}"><i class="fa fa-plus mr-2"></i>Create  kilometer Promo Code</a>
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
                  <th>S.no</th>
                  <th>Promo Code</th>
                   <th>Promo Code name </th>
                  <th>Image</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>KiloMetter</th>

                  <th>Status</th>
                  <th>{{trans('lang.actions')}}</th>

                </tr>

              </thead>
              @foreach($promoCodes as $cat)
              <tr>
                <td>{{$loop->iteration}}</td>
                 <td>
                  {{$cat->promo_code}}
                </td>
                <td>
                  {{$cat->promo_code_name}}
                </td>
                <td>
                  <img src="{{ asset('images/kmpromo/' . $cat->image) }}" width="100" height="100" alt="promo Photo">

                </td>
               
                <td>
                  {{$cat->start_date}}
                </td>
                <td>
                  {{$cat->end_date}}
                </td>
                <td>
                  {{$cat->kilometter}}
                </td>
               

                <td>
                  @if ($cat->status == 1 )
                  <span class="badge badge-success">Active</span>
                  @else
                  <span class="badge badge-danger">InActive</span>
                  @endif
                </td>
                <td>
                    <a href="{{ url('admin/kilometer/edit/' . $cat->id) }}"  class="m-1 p-1" data-toggle="tooltip" data-placement="top"  title="Edit">
                      <i class="fa fa-edit"></i> Edit 
                    </a>
                    <a href="{{ url('admin/kilometer/get_restaurant/' . $cat->id) }}"  class="m-1 p-1" data-toggle="tooltip" data-placement="top"  title="Select restaurant">
                        <i class="fa fa-list"></i> Restaurant 
                    </a><br>
                    <a href="{{ url('admin/kilometer/kmget_user/' . $cat->id) }}" class="m-1 p-1" data-toggle="tooltip" data-placement="top"  title="Select Users">
                        <i class="fa fa-list"></i> Users 
                    </a>
                    <!--<a href="{{ url('admin/kilometer/delete/' . $cat->id) }}" class="m-1 p-1" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure you want to delete this promoCode?')"><i class="fa fa-trash"></i> Delete </a>-->
                    <a href="#" class="btn btn-sm btn-danger"
                       onclick="showConfirmation('Are you sure you want to delete this promoCode?', function() { window.location.href = '{{ url('admin/kilometer/delete/' . $cat->id) }}'; })">
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