@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Users Promo Codes</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Users Promo Codes</li>
            </ol>
        </div>
    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">
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
                                        <th>User Name</th>
                                        <th>Mobile No</th>
                                        <th>Status</th>
                                        <th>{{trans('lang.actions')}}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($FoodPromoCodes as $cat)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            {{$cat->promo_code->promo_code}}
                                        </td>
                                        <td>
                                            {{$cat->users->name ?? 'N/A'}}
                                        </td>
                                        <td>
                                            {{$cat->users->mobile_number ?? 'N/A'}}
                                        </td>
                                    
                                        <td>
                                            
                                            @if ($cat->accept_by == 1 )
                                            <span class="badge badge-success" >Accept</span>
                                            @elseif($cat->accept_by == -1)
                                            <span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="{{ $cat->cancel_reason }}">Reject</span>
                                            @elseif($cat->accept_by == 2)
                                            <span class="badge badge-primary">Pending</span>
                                            @elseif($cat->accept_by == 0)
                                            <span class="badge badge-info">Process</span>
                                            @endif
                                            
                                        </td>
                                        <td>
                                            <!--<a href="{{ url('admin/foodpromoCode/edit/' . $cat->id) }}" class="m-1 p-1 btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Edit">-->
                                            <!--    <i class="fa fa-edit"></i> Edit-->
                                            <!--</a>-->
                                            <!--<a href="{{ url('admin/foodpromoCode/user/delete/' . $cat->id) }}" class=" btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="delete" onclick="return confirm('Are you sure you want to delete this promoCode?')">-->
                                            <!--    <i class="fa fa-trash"></i> -->
                                            <!--</a> -->
                                            <a href="#" class="btn btn-sm btn-danger"
                                               onclick="showConfirmation('Are you sure you want to delete this promoCode?', function() { window.location.href = '{{ url('admin/foodpromoCode/user/delete/' . $cat->id) }}'; })">
                                               <i class="fa fa-trash"></i> 
                                            </a>
                                            
                                            <a href="{{ url('admin/foodpromoCode/view/' . $cat->promo_code->id) }}" class="btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa fa-tag"></i> 
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
</div>




@endsection