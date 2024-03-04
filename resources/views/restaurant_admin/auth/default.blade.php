<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="FOODIE">
<meta name="author" content="FOODIE">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="icon" type="image/png" href="{{asset('img/fav.png')}}">
<title>Foodie Restaurant</title>

<link rel="icon" type="image/x-icon" href="{{ asset('images/logo-light-icon.png') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <?php if (str_replace('_', '-', app()->getLocale()) == 'ar' || @$_COOKIE['is_rtl'] == 'true') { ?>
        <link href="{{asset('assets/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet">
    <?php } ?>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <?php if (str_replace('_', '-', app()->getLocale()) == 'ar' || @$_COOKIE['is_rtl'] == 'true') { ?>
        <link href="{{asset('css/style_rtl.css')}}" rel="stylesheet">
    <?php } ?>
    <link href="{{ asset('css/icons/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <link href="{{ asset('css/colors/blue.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <?php if (isset($_COOKIE['store_panel_color'])) { ?>
        <style type="text/css">

            .topbar {
                background: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .sidebar-nav ul li a {
                border-bottom: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .sidebar-nav ul li a:hover i {
                color: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .restaurant_payout_create-inner fieldset legend {
                background: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            a {
                color: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            a:hover, a:focus {
                color: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            a.link:hover, a.link:focus {
                color: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            html body blockquote {
                border-left: 5px solid<?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .text-warning {
                color: <?php echo $_COOKIE['store_panel_color']; ?> !important;
            }

            .text-info {
                color: <?php echo $_COOKIE['store_panel_color']; ?> !important;
            }

            .sidebar-nav ul li a:hover {
                color: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .btn-primary {
                background: <?php echo $_COOKIE['store_panel_color']; ?>;
                border: 1px solid<?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .sidebar-nav > ul > li.active > a {
                color: <?php echo $_COOKIE['store_panel_color']; ?>;
                border-left: 3px solid<?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .sidebar-nav > ul > li.active > a i {
                color: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .bg-info {
                background-color: <?php echo $_COOKIE['store_panel_color']; ?> !important;
            }

            .bellow-text ul li > span {
                color: <?php echo $_COOKIE['store_panel_color']; ?>
            }

            .table tr td.redirecttopage {
                color: <?php echo $_COOKIE['store_panel_color']; ?>
            }

            ul.rating {
                color: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            nav-link.active {
                background-color: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .nav-tabs.card-header-tabs .nav-link:hover {
                background: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
                color: #fff;
                background: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .btn-warning, .btn-warning.disabled {
                background: <?php echo $_COOKIE['store_panel_color']; ?>;
                border: 1px solid<?php echo $_COOKIE['store_panel_color']; ?>;
                box-shadow: none;
            }

            .payment-top-tab .nav-tabs.card-header-tabs .nav-link.active, .payment-top-tab .nav-tabs.card-header-tabs .nav-link:hover {
                border-color: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .nav-tabs.card-header-tabs .nav-link span.badge-success {
                background: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .nav-tabs.card-header-tabs .nav-link.active span.badge-success, .nav-tabs.card-header-tabs .nav-link:hover span.badge-success, .sidebar-nav ul li a.active, .sidebar-nav ul li a.active:hover, .sidebar-nav ul li.active a.has-arrow:hover, .topbar ul.dropdown-user li a:hover {
                color: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .sidebar-nav ul li a.has-arrow:hover::after, .sidebar-nav .active > .has-arrow::after, .sidebar-nav li > .has-arrow.active::after, .sidebar-nav .has-arrow[aria-expanded="true"]::after, .sidebar-nav ul li a:hover {
                border-color: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            [type="checkbox"]:checked + label::before {
                border-right: 2px solid<?php echo $_COOKIE['store_panel_color']; ?>;
                border-bottom: 2px solid<?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .btn-primary:hover, .btn-primary.disabled:hover {
                background: <?php echo $_COOKIE['store_panel_color']; ?>;
                border: 1px solid<?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .btn-primary.active, .btn-primary:active, .btn-primary:focus, .btn-primary.disabled.active, .btn-primary.disabled:active, .btn-primary.disabled:focus, .btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary.focus:active, .btn-primary:active:focus, .btn-primary:active:hover, .open > .dropdown-toggle.btn-primary.focus, .open > .dropdown-toggle.btn-primary:focus, .open > .dropdown-toggle.btn-primary:hover, .btn-primary.focus, .btn-primary:focus, .btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active:focus, .show > .btn-primary.dropdown-toggle:focus, .btn-warning:hover, .btn-warning:hover, .btn-warning.disabled:hover, .btn-warning.active.focus, .btn-warning.active:focus, .btn-warning.active:hover, .btn-warning.focus:active, .btn-warning:active:focus, .btn-warning:active:hover, .open > .dropdown-toggle.btn-warning.focus, .open > .dropdown-toggle.btn-warning:focus, .open > .dropdown-toggle.btn-warning:hover, .btn-warning.focus, .btn-warning:focus {
                background: <?php echo $_COOKIE['store_panel_color']; ?>;
                border-color: <?php echo $_COOKIE['store_panel_color']; ?>;
                box-shadow: 0 0 0 0.2rem<?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .language-options select option, .pagination > li > a.page-link:hover {
                background: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .nav-tabs.card-header-tabs .active.nav-item .nav-link {
                background: <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .print-btn button {
                border: 2px solid<?php echo $_COOKIE['store_panel_color']; ?>;
                color: <?php echo $_COOKIE['store_panel_color'];?>;
            }

        </style>
    <?php } ?>
</head>
<div id="app" class="fix-header fix-sidebar card-no-border">
    

    <main class="py-4">
        @yield('content')
    </main>
    

   

    
   
  
</div>


<body>

</body>
</html>