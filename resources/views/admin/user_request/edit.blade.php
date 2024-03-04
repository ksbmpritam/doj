@extends('admin.layouts.app')

@section('content')
    <div class="page-wrapper">
        <form action="{{ url ('admin/user/withdrawal/update/'.$user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">{{trans('lang.user_plural')}}</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{trans('lang.user_plural')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('lang.user_edit')}}</li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="resttab-sec">
                            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                            <div class="error_top"></div>
                            <div class="row restaurant_payout_create">
                                <div class="restaurant_payout_create-inner">
                                    <fieldset>
                                        <legend>Withdrawal Status</legend>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.name')}}</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control user_first_name" value="{{$user->customer->name ?? ''}}" name="name" readonly>
                                                @if ($errors->has('name'))
                                                    <span class="text-danger text-muted">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.amount')}}</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control user_first_name" value="{{$user->amount ?? ''}}" name="amount" readonly>
                                                @if ($errors->has('amount'))
                                                    <span class="text-danger text-muted">
                                                        <strong>{{ $errors->first('amount') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Image</label>
                                            <div class="col-7">
                                                <input type="file" class="form-control user_first_name" value="{{$user->image ?? ''}}" name="image" >
                                                
                                                @if ($errors->has('image'))
                                                    <span class="text-danger text-muted">
                                                        <strong>{{ $errors->first('image') }}</strong>
                                                    </span>
                                                @endif
                                                @if(isset($user->image))
                                                    <img src="{{ asset('images/user/transaction/' . $user->image) }}" alt="User Image" style="width: 100px;height: 100px;">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.status')}}</label>
                                            <div class="col-7">
                                                <select class="form-control" name="status">
                                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Pending</option>
                                                    <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>Cancel</option>
                                                    <option value="3" {{ $user->status == 3 ? 'selected' : '' }}>Approved</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <span class="text-danger text-muted">
                                                        <strong>{{ $errors->first('status') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </fieldset>
                                    @if($user->status == 2 || $user->status == 3)
                                        <a href="{{ route('admin.user.withdrawal.request') }}" class="btn btn-primary" type="submit">Back</a>
                                    @else
                                        <button class="btn btn-primary" type="submit">Update Status</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- Include the jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
