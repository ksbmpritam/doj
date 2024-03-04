@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Restaurant Promo Codes</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Restaurant Promo Codes</li>
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
                                        <th>Restaurant Name</th>
                                        <th>Mobile No</th>
                                        <th>Status</th>
                                        <th>{{trans('lang.actions')}}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($promoCodes as $cat)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            {{$cat->promo_code->promo_code ?? 'N/A'}}
                                        </td>
                                        <td>
                                           {{ optional($cat->restaurant)->name }}
                                        </td>
                                        <td>
                                            {{ optional($cat->restaurant)->mobile_no }}

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
                                            <!--<a href="{{ url('admin/promoCode/edit/' . $cat->id) }}" class="m-1 p-1 btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Edit">-->
                                            <!--    <i class="fa fa-edit"></i> Edit-->
                                            <!--</a>-->
                                            <a href="{{ url('admin/promoCode/restaurant/view/' . $cat->promo_code_id) }}" class="m-1 p-1 btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa fa-eye"></i> View
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