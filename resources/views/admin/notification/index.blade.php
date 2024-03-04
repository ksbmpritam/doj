@extends('admin.layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.notifications')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item active"><a href="{{url('admin/notification')}}">{{trans('lang.notifications')}}</a></li>

            </ol>

        </div>
    </div>




    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100 justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.notificaions_table')}}</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link" href="{!! url('admin/notification/create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.create_notificaion')}}</a>
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
                        @if(session('success'))
                            <div class="alert alert-success" id="success-message">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                            <thead>

                                <tr>


                                    <th>S.no</th>
                                    <th>{{trans('lang.subject')}}</th>
                                    <th>Send To</th>

                                    <th>Title</th>

                                    <th>Description</th>

                                    <th>{{trans('lang.actions')}}</th>

                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($notifications as $notification)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucfirst($notification->role) }}</td>
                                        <td>{{ $notification->name }}</td>
                                        <td>{{ $notification->title }}</td>
                                        <td>{{ substr($notification->description, 0, 50) }}{{ strlen($notification->description) > 50 ? '...' : '' }}</td>
                                        <td>
                                            <a href="{{ url('admin/notification/edit/' . $notification->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </a>
                                            <!--<a href="{{ url('admin/notification/delete/' . $notification->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Notification ?')"><i class="fa fa-trash"></i></a>-->
                                            <a href="#" class="btn btn-sm btn-danger"
                                               onclick="showConfirmation('Are you sure you want to delete this Notification?', function() { window.location.href = '{{ url('admin/notification/delete/' . $notification->id) }}'; })">
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

@section('scripts')
<script>
    $(document).ready(function() {
        var successMessage = $('#success-message');

        if (successMessage.length > 0) {
            setTimeout(function() {
                successMessage.fadeOut(500, function() {
                    successMessage.remove(); 
                });
            }, 3000); 
        }
    });
</script>

@endsection