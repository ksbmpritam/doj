@extends('team.layouts.app')
@section('content')

<main class="py-4">
    <div class="page-wrapper">
        <form action="{{ route('team.newpassword')}}" method="Post" enctype="multipart/form-data">
            @csrf
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Change Password</h3>
                </div>

                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="https://dojapp.com/team/dashboard">Dashboard</a></li>

                        <li class="breadcrumb-item active">Create New Password </li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
                <div class="cat-edite-page max-width-box">
                    <div class="card  pb-4">

                        <div class="card-body">
                           @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="error_top"></div>

                            <div class="row restaurant_payout_create">
                                <div class="restaurant_payout_create-inner">
                                    <fieldset>
                                        <legend>Change Password</legend>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">New Password</label>
                                            <div class="col-7">
                                                <input type="password" class="form-control" id="pwd" name="pwd" value="">
                                                <div id="pwd">
                                                    <div class="form-text text-muted">
                                                        @error('pwd')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                          
                                        </div>


                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">confirm Password</label>
                                            <div class="col-7">
                                                <input type="password" class="form-control " id="cpwd" name="cpwd" value="">
                                                <div id="showErrorcPwd"></div>
                                                <div class="form-text text-muted">
                                                    @error('cpwd')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12 text-center btm-btn">
                                            <button type="submit" id="submit" class="btn btn-primary save_driver_btn"><i class="fa fa-save"></i> Save</button>
                                            <a href="https://dojapp.com/team/riders" class="btn btn-default"><i class="fa fa-undo"></i>Back</a>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#cpwd').keyup(function() {
            var pwd = $('#pwd').val();
            var cpwd = $('#cpwd').val();
            if (cpwd != pwd) {
                $('#showErrorcPwd').html('*Passwords do not match');
                $('#showErrorcPwd').css('color', 'red');
                return false;
            } else {
                $('#showErrorcPwd').html('');
                return true;
            }
        });
    });
</script>
@endsection