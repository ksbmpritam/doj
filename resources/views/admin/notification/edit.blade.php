@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <form action="{{ url ('admin/notification/update/'.$notification->id)}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.notification')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('admin/notification') }}">{{trans('lang.notifications')}}</a></li>
                    <li class="breadcrumb-item active">Edit Notification</li>
                </ol>
            </div>


        </div>
        <div class="container-fluid">
            <div class="cat-edite-page max-width-box">
                <div class="card  pb-4">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link " href="{!! route('admin.notification') !!}"><i class="fa fa-list mr-2"></i>Notification List</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>Edit Notification</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
                            {{trans('lang.processing')}}
                        </div>

                        <div class="row restaurant_payout_create">

                            <div class="restaurant_payout_create-inner">

                                <fieldset>
                                    <legend>{{trans('lang.notification')}}</legend>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Role <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <select id="role" name="roles" class="form-control">
                                                <option value="">-- Select role --</option>
                                                <option value="partner" @if($notification->role == 'partner') selected @endif>Partner</option>
                                                <option value="customer" @if($notification->role == 'customer') selected @endif>Customer</option>
                                                <option value="driver" @if($notification->role == 'driver') selected @endif>Driver</option>
                                            </select>
                                            <div class="form-text text-muted">
                                                @error('roles')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">Send To</label>
                                        <div class="col-7">
                                            <select id="data-dropdown" name="send_id" class="form-control">
                                                <option value="">-- Select --</option>
                                            </select>
                                            <div class="form-text text-muted">
                                                @error('send_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">{{trans('lang.subject')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <input type="text" class="form-control" name="title" id="title" value={{$notification->title}}>
                                            <div class="form-text text-muted">
                                                @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">{{trans('lang.message')}} <sup style="color:red;">*</sup></label>
                                        <div class="col-7">
                                            <textarea class="form-control" name="description" id="description">{{$notification->description}}</textarea>
                                            <div class="form-text text-muted">
                                                @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-12 text-center btm-btn">
            <button type="submit" class="btn btn-primary send_message"><i class="fa fa-save"></i> {{
                trans('lang.send')}}
            </button>
            <a href="{{url('admin/dashboard')}}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
        </div>
    </form>
</div>
</div>

@endsection

@section('scripts')

<script>

$(document).ready(function() {
    $('#role').on('change', function() {
        fetchSenderData(this.value);
    });
    
    let role="<?php echo $notification->role; ?>";
    let sender_id="<?php echo $notification->sender_id; ?>";
    
    fetchSenderData(role);
    
    function fetchSenderData(role) {
        $("#data-dropdown").html('');
        $.ajax({
            url: "{{ url('api/get_data') }}",
            type: "POST",
            data: {
                roles: role,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                if (result.restaurant) {
                    $('#data-dropdown').html('<option value="0">All</option>');
                    $.each(result.restaurant, function(key, value) {
                        var selected = (value.id == sender_id) ? 'selected' : ''; 
                        $("#data-dropdown").append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                    });
                }

                if (result.customer) {
                    $('#data-dropdown').html('<option value="0">All</option>');
                    $.each(result.customer, function(key, value) {
                        var selected = (value.id == sender_id) ? 'selected' : ''; 
                        $("#data-dropdown").append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                    });
                }
                
               
                if (result.drivers) {
                    $('#data-dropdown').html('<option value="0"> All</option>');
                    $.each(result.drivers, function(key, value) {
                        var firstName = (value.first_name) ? (value.first_name) : '';
                        var lastName = (value.last_name) ? (value.last_name) : '';
                        var selected = (value.id == sender_id) ? 'selected' : ''; 
                        $("#data-dropdown").append('<option value="' + value.id + '" ' + selected + '>' + firstName + lastName + '</option>');
                    });
                }
            }
        });
    }
});


</script>

@endsection