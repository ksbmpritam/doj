<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title id="app_name"><?php echo @$_COOKIE['meta_title']; ?></title>
    <link rel="icon" id="favicon" type="image/x-icon"
          href="<?php echo str_replace('images/', 'images%2F', @$_COOKIE['favicon']); ?>">


    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/plugins/toast-master/css/jquery.toast.css')}}" rel="stylesheet">

    <link href="{{ asset('css/colors/blue.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet">

<!--  @yield('style')-->

    <?php if(isset($_COOKIE['store_panel_color'])){ ?>
    <style type="text/css">
        a, a:hover, a:focus {
            color: <?php echo $_COOKIE['store_panel_color']; ?>;
        }

        .form-group.default-admin {
            padding: 10px;
            font-size: 14px;
            color: #000;
            font-weight: 600;
            border-radius: 10px;
            box-shadow: 0 0px 6px 0px rgba(0, 0, 0, 0.5);
            margin: 20px 10px 10px 10px;
        }

        .form-group.default-admin .crediantials-field {
            position: relative;
            padding-right: 15px;
            text-align: left;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .form-group.default-admin .crediantials-field > a {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            margin: auto;
            height: 20px;
        }

        .btn-primary, .btn-primary.disabled, .btn-primary:hover, .btn-primary.disabled:hover {
            background: <?php echo $_COOKIE['store_panel_color']; ?>;
            border: 1px solid<?php echo $_COOKIE['store_panel_color']; ?>;
        }

        [type="checkbox"]:checked + label::before {
            border-right: 2px solid<?php echo $_COOKIE['store_panel_color']; ?>;
            border-bottom: 2px solid<?php echo $_COOKIE['store_panel_color']; ?>;
        }

        .form-material .form-control, .form-material .form-control.focus, .form-material .form-control:focus {
            background-image: linear-gradient(<?php echo $_COOKIE['store_panel_color']; ?>, <?php echo $_COOKIE['store_panel_color']; ?>), linear-gradient(rgba(120, 130, 140, 0.13), rgba(120, 130, 140, 0.13));
        }

        .btn-primary.active, .btn-primary:active, .btn-primary:focus, .btn-primary.disabled.active, .btn-primary.disabled:active, .btn-primary.disabled:focus, .btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary.focus:active, .btn-primary:active:focus, .btn-primary:active:hover, .open > .dropdown-toggle.btn-primary.focus, .open > .dropdown-toggle.btn-primary:focus, .open > .dropdown-toggle.btn-primary:hover, .btn-primary.focus, .btn-primary:focus, .btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active:focus, .show > .btn-primary.dropdown-toggle:focus {
            background: <?php echo $_COOKIE['store_panel_color']; ?>;
            border-color: <?php echo $_COOKIE['store_panel_color']; ?>;
            box-shadow: 0 0 0 0.2rem<?php echo $_COOKIE['store_panel_color']; ?>;
        }

        <?php } ?>
    </style>


</head>

<body>


<section id="wrapper">

    <?php if(isset($_COOKIE['store_panel_color'])){ ?>

    <div class="login-register" style="background-color:<?php echo $_COOKIE['store_panel_color']; ?>;">
        <?php } else{?>

        <div class="login-register" style="background-color:#FF683A;">
            <?php }?>


            <div class="login-logo text-center py-3" style="margin-top:0%;">

                <a href="#" style="display: inline-block;background: #fff ; padding: 10px;border-radius: 5px;"><img
                            src="{{ asset('images/doj_logo.png')}}"> </a>

            </div>

            <div class="login-box card" style="margin-bottom:0%;">


                <!-- <div class="row justify-content-center">



                    <div class="col-md-8">

                        <div class="card"> -->


                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form class="form-horizontal form-material" name="login" id="login-box" method="POST" action="{{ url('franchies/login') }}">
                        @csrf
                        <div class="box-title m-b-20">Login</div>
                        <div class="error_top"></div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" placeholder="{{ trans('lang.email_address') }}" id="email"
                                       type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="password" placeholder="{{ trans('lang.password') }}" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password"></div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button type="submit"  id="login_btn"
                                        class="btn btn-dark btn-lg btn-block text-uppercase waves-effect waves-light btn btn-primary">
                                    login
                                </button>
                                <!--<a href="{{route('register')}}" id="signup_btn"-->
                                <!--   class="btn btn-dark btn-lg btn-block text-uppercase waves-effect waves-light btn btn-primary">-->
                                <!--    {{ trans('lang.sign_up') }}-->
                                <!--</a>-->
                                <!--<button type="button" onclick="loginWithPhoneClick()" id="loginphon_btn"-->
                                <!--        class="btn btn-dark btn-lg btn-block text-uppercase waves-effect waves-light btn btn-primary">-->
                                <!--    {{ trans('lang.log_in') }} {{ trans('lang.with_phone') }}</button>-->

                                <div class="error" id="password_required"></div>
                            </div>
                        </div>
                    </form>


                </div>

                <!-- </div>

            </div>

        </div> -->

            </div>

        </div>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>

<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/plugins/select2/dist/js/select2.min.js') }}"></script>

<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>

<script src="{{ asset('js/waves.js') }}"></script>

<script src="{{ asset('js/sidebarmenu.js') }}"></script>

<script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>

<script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

<script src="{{ asset('js/custom.min.js') }}"></script>

<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-database.js"></script>

</body>

</html>
