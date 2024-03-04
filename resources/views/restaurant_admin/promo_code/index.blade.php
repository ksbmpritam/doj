@extends('restaurant_admin.layouts.app')

@section('content')
<div class="page-wrapper">

    <!-- ... (Other HTML and Blade code) ... -->

    <div class="table-responsive m-t-10">
        <table id="data-table" class="nowrap table table-hover table-bordered" width="100%">

            <thead>
                <tr>
                    <th>S.no.</th>
                    <th>Promo Code</th>
                    <th>Promo Code Name </th>
                    <th>Image </th>
                    <th>Minimum Amount</th>
                    <th>Maximum Amount </th>
                    <th>Coupon Type</th>
                     <th>Discount Type</th>
                    <th>Discount</th>
                    <th>Start Date </th>
                    <th>End Date </th>
                   
                    <th> Prmo Code Status </th>
                    <th>Status</th>
                    <th>{{ trans('lang.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promoCodes as $cat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($cat->promo_code)
                            {{ $cat->promo_code->promo_code ?? 'N/A'}}
                        @else
                            <span class="text-danger">No Promo Code</span>
                        @endif
                    </td>
                          <td>
                        
                            {{ $cat->promo_code->promo_code_name ?? 'N/A'}}
                     
                    </td>
                     <td>
                        @if(isset($cat->promo_code->image))
                          <img src="{{ asset('images/promo/' . $cat->promo_code->image) }}" width="100" height="100" alt="promo Photo">
                        @else
                            'N/A'
                        @endif
                    </td>
                     <td>
                        
                            {{ $cat->promo_code->minimum ?? 'N/A'}}
                     
                    </td>
                     <td>
                        
                            {{ $cat->promo_code->maximum ?? 'N/A'}}
                     
                    </td>
                     <td>
                        
                            {{ $cat->promo_code->coupon_type ?? 'N/A'}}
                     
                    </td>
                     <td>
                        
                            {{ $cat->promo_code->discount_type ?? 'N/A'}}
                     
                    </td>
                     <td>
                        
                            {{ $cat->promo_code->discount ?? 'N/A'}}
                     
                    </td>
                     <td>
                        
                            {{ $cat->promo_code->start_date ?? 'N/A'}}
                     
                    </td>
                     <td>
                        
                            {{ $cat->promo_code->end_date ?? 'N/A'}}
                     
                    </td>
                     <td>
                        
                             @if ($cat->status == 1 )
                  <span class="badge badge-success">Active</span>
                  @else
                  <span class="badge badge-danger">InActive</span>
                  @endif
  
                    </td>
                    <td>
                        @if ($cat->accept_by == 1)
                            <span class="badge badge-success">Accept</span>
                        @elseif ($cat->accept_by == -1)
                            <span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="{{ $cat->cancel_reason }}">Reject</span>
                        @elseif ($cat->accept_by == 2)
                            <span class="badge badge-primary">Pending</span>
                        @elseif ($cat->accept_by == 0)
                            <span class="badge badge-info">Process</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('restaurant/promoCode/edit/' . $cat->id) }}" class="m-1 p-1 btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="{{ url('restaurant/promoCode/view/' . $cat->promo_code_id) }}" class="m-1 p-1 btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="View">
                            <i class="fa fa-eye"></i> View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- ... (Other HTML and Blade code) ... -->

</div>
</div>
@endsection
