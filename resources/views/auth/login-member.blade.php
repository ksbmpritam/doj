<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title id="app_name"><?php echo @$_COOKIE['meta_title']; ?></title>

    <link rel="icon" id="favicon" type="image/x-icon" href="<?php echo str_replace('images/', 'images%2F', @$_COOKIE['favicon']); ?>">



    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/plugins/toast-master/css/jquery.toast.css')}}" rel="stylesheet">

    <link href="{{ asset('css/colors/blue.css') }}" rel="stylesheet">

    @yield('style')


</head>

<body>

    <style type="text/css">
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

        .form-group.default-admin .crediantials-field>a {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            margin: auto;
            height: 20px;
        }

        .login-register {
            background-color: #e9ecef;
        }

        <?php if (isset($_COOKIE['admin_panel_color'])) { ?>a,
        a:hover,
        a:focus {
            color: <?php echo $_COOKIE['admin_panel_color']; ?>;
        }

        .btn-primary,
        .btn-primary.disabled,
        .btn-primary:hover,
        .btn-primary.disabled:hover {
            background: <?php echo $_COOKIE['admin_panel_color']; ?>;
            border: 1px solid<?php echo $_COOKIE['admin_panel_color']; ?>;
        }

        [type="checkbox"]:checked+label::before {
            border-right: 2px solid<?php echo $_COOKIE['admin_panel_color']; ?>;
            border-bottom: 2px solid<?php echo $_COOKIE['admin_panel_color']; ?>;
        }

        .form-material .form-control,
        .form-material .form-control.focus,
        .form-material .form-control:focus {
            background-image: linear-gradient(<?php echo $_COOKIE['admin_panel_color']; ?>, <?php echo $_COOKIE['admin_panel_color']; ?>), linear-gradient(rgba(120, 130, 140, 0.13), rgba(120, 130, 140, 0.13));
        }

        .btn-primary.active,
        .btn-primary:active,
        .btn-primary:focus,
        .btn-primary.disabled.active,
        .btn-primary.disabled:active,
        .btn-primary.disabled:focus,
        .btn-primary.active.focus,
        .btn-primary.active:focus,
        .btn-primary.active:hover,
        .btn-primary.focus:active,
        .btn-primary:active:focus,
        .btn-primary:active:hover,
        .open>.dropdown-toggle.btn-primary.focus,
        .open>.dropdown-toggle.btn-primary:focus,
        .open>.dropdown-toggle.btn-primary:hover,
        .btn-primary.focus,
        .btn-primary:focus,
        .btn-primary:not(:disabled):not(.disabled).active:focus,
        .btn-primary:not(:disabled):not(.disabled):active:focus,
        .show>.btn-primary.dropdown-toggle:focus {
            background: <?php echo $_COOKIE['admin_panel_color']; ?>;
            border-color: <?php echo $_COOKIE['admin_panel_color']; ?>;
            box-shadow: 0 0 0 0.2rem<?php echo $_COOKIE['admin_panel_color']; ?>;
        }

        .login-register {
            background-color: <?php echo $_COOKIE['admin_panel_color']; ?>;
        }

        <?php } ?>
    </style>


    <section id="wrapper">


        <div class="login-register">




            <div class="login-box card" style="margin-bottom:0%;">

              

                <div class="card-body">
        
                     @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form class="form-horizontal form-material" method="POST" action="{{ route('member.login') }}">

                        @csrf
                       
                        <div class="box-title m-b-20 text-center">Sign in to the start your session</div>


                        <div class="form-group ">


                            <div class="col-xs-12">


                                <input class="form-control" placeholder="{{ __('Email Address') }}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>


                            @error('email')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                            @enderror


                        </div>


                        <div class="form-group">


                            <div class="col-xs-12">


                                <input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            </div>


                            @error('password')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                            @enderror


                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <select class="form-control form-select" name="role">
                                    <option value="">Select Role</option>
                                    <option value="franchise">Franchies</option>
                                    <option value="employee">Employee</option>
                                </select>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group m-t-20">


                            <div class="col-xs-12">


                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember')
                            ? 'checked' : '' }}>


                                <label class="form-check-label" for="remember">

                                    {{ __('Remember Me') }}

                                </label>


                            </div>


                        </div>


                        <div class="form-group text-center m-t-20 mb-0">


                            <div class="col-xs-12">


                                <button type="submit" class="btn btn-dark btn-lg btn-block text-uppercase waves-effect waves-light btn btn-primary">

                                    {{ __('Login') }}

                                </button>

                            </div>


                        </div>



                    </form>

                </div>


            </div>

        </div>

    </section>

    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>

    <script src="{{ asset('js/waves.js') }}"></script>

    <script src="{{ asset('js/sidebarmenu.js') }}"></script>

    <script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

    <script src="{{ asset('js/custom.min.js') }}"></script>



</body>

</html>