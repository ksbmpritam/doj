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

                    <div class="card-body">
                        <div class="table-responsive m-t-10">
                            <table id="data-table" class="nowrap table table-hover table-bordered " width="100%">

                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Promo Code</th>
                                         <th>Promocode Name</th>
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
                                     @php
                               $promo_code_id = $cat->promo_code_kilometers_id;
                           $promo_code = \App\Models\PrmoCodekilometer::where('id', $promo_code_id)->value('promo_code');
                               @endphp
                                   @if ($promo_code)
                          <span title="{{ $promo_code }}">{{ $promo_code }}</span>
                                 @else
                               NA (ID: {{ $promo_code_id }})
                                @endif
                                  </td>
                                    <td>
                                     @php
                               $promo_code_id = $cat->promo_code_kilometers_id;
                           $promo_code_name = \App\Models\PrmoCodekilometer::where('id', $promo_code_id)->value('promo_code_name');
                               @endphp
                                   @if ($promo_code_name)
                          <span title="{{ $promo_code_name}}">{{ $promo_code_name }}</span>
                                 @else
                               NA (ID: {{ $promo_code_name }})
                                @endif
                             </td>
                                        <td>
                                            {{$cat->users->name}}
                                        </td>
                                        <td>
                                            {{$cat->users->mobile_number}}
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
                                            <a href="{{ url('admin/kilometer/usersdelete/' . $cat->promo_code_kilometers_id) }}" class=" btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="delete" onclick="return confirm('Are you sure you want to delete this promoCode?')">
                                                <i class="fa fa-trash"></i> 
                                            </a> 
                                            <a href="{{ url('admin/kilometer/view/' . $cat->promo_code_kilometers_id) }}" class="btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="View">
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