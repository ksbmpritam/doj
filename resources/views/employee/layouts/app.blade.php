<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" <?php if (str_replace('_', '-', app()->getLocale()) == 'ar' || @$_COOKIE['is_rtl'] == 'true') { ?> dir="rtl"  <?php } ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
   
    <link href="{{ asset('css/icons/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <link href="{{ asset('css/colors/blue.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">


    <!--  @yield('style')-->
    <style type="text/css">
        .dt-buttons button{
            border:none;
            cursor:pointer;
        }
    
        .w-5{
            width:15px;
        }
       .flex.justify-between.flex-1.sm\:hidden{
           display:none;
       }
       .btn-primary{
            color: #fff;
            background-color: #007bff !important;
            border-color: #007bff !important;
       }
       .dataTables_length{
           margin-right:50px;
       }
        .topbar {
            background: #ff683a;
        }

        .left-sidebar {
            background: #ff683a;
        }

        .sidebar-nav ul li a {
            border-bottom: #ff683a;
        }

        .sidebar-nav {
            background: #ff683a;
        }

        .sidebar-nav ul li a:hover i {
            color: #ff683a;
        }

        .vendor_payout_create-inner fieldset legend {
            background: #ff683a;
        }

        .restaurant_payout_create-inner fieldset legend {
            background: #ff683a;
        }

        a {
            color: #ff683a;
        }

        a:hover, a:focus {
            color: #ff683a;
        }

        a.link:hover, a.link:focus {
            color: #ff683a;
        }

        html body blockquote {
            border-left: 5px solid#ff683a;
        }

        .text-warning {
            color: #ff683a   !important;
        }

        .text-info {
            color: #ff683a   !important;
        }

        .sidebar-nav ul li a:hover {
            color: #ff683a;
        }

        .btn-primary {
            background: #ff683a;
            border: 1px solid#ff683a;
        }

        .sidebar-nav > ul > li.active > a {
            color: #ff683a;
            border-left: 3px solid#ff683a;
        }

        .sidebar-nav > ul > li.active > a i {
            color: #ff683a;
        }

        .bg-info {
            background-color: #ff683a   !important;
        }

        .bellow-text ul li > span {
            color: #ff683a

        }

        .table tr td.redirecttopage {
            color: #ff683a

        }

        ul.rating {
            color: #ff683a;
        }

        .nav-tabs.card-header-tabs .nav-link.active, .nav-tabs.card-header-tabs .nav-link:hover {
            background: #ff683a;
            border-color: #ff683a #ff683a #fff;
        }

        .btn-warning, .btn-warning.disabled {
            background: #ff683a;
            border: 1px solid#ff683a;
            box-shadow: none;
        }

        .payment-top-tab .nav-tabs.card-header-tabs .nav-link.active, .payment-top-tab .nav-tabs.card-header-tabs .nav-link:hover {
            border-color: #ff683a;
        }

        .nav-tabs.card-header-tabs .nav-link span.badge-success {
            background: #ff683a;
        }

        .nav-tabs.card-header-tabs .nav-link.active span.badge-success, .nav-tabs.card-header-tabs .nav-link:hover span.badge-success, .sidebar-nav ul li a.active, .sidebar-nav ul li a.active:hover, .sidebar-nav ul li.active a.has-arrow:hover, .topbar ul.dropdown-user li a:hover {
            color: #ff683a;
        }

        .sidebar-nav ul li a.has-arrow:hover::after, .sidebar-nav .active > .has-arrow::after, .sidebar-nav li > .has-arrow.active::after, .sidebar-nav .has-arrow[aria-expanded="true"]::after, .sidebar-nav ul li a:hover {
            border-color: #ff683a;
        }

        [type="checkbox"]:checked + label::before {
            border-right: 2px solid#ff683a;
            border-bottom: 2px solid#ff683a;
        }

        .btn-primary:hover, .btn-primary.disabled:hover {
            background: #ff683a;
            border: 1px solid#ff683a;
        }

        .btn-primary.active, .btn-primary:active, .btn-primary:focus, .btn-primary.disabled.active, .btn-primary.disabled:active, .btn-primary.disabled:focus, .btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary.focus:active, .btn-primary:active:focus, .btn-primary:active:hover, .open > .dropdown-toggle.btn-primary.focus, .open > .dropdown-toggle.btn-primary:focus, .open > .dropdown-toggle.btn-primary:hover, .btn-primary.focus, .btn-primary:focus, .btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active:focus, .show > .btn-primary.dropdown-toggle:focus, .btn-warning:hover, .btn-warning:hover, .btn-warning.disabled:hover, .btn-warning.active.focus, .btn-warning.active:focus, .btn-warning.active:hover, .btn-warning.focus:active, .btn-warning:active:focus, .btn-warning:active:hover, .open > .dropdown-toggle.btn-warning.focus, .open > .dropdown-toggle.btn-warning:focus, .open > .dropdown-toggle.btn-warning:hover, .btn-warning.focus, .btn-warning:focus {
            background: #ff683a;
            border-color: #ff683a;
            box-shadow: 0 0 0 0.2rem#ff683a;
        }

        .language-options select option, .pagination > li > a.page-link:hover {
            background: #ff683a;
        }

        .mini-sidebar .sidebar-nav #sidebarnav > li:hover a i, .mini-sidebar .sidebar-nav ul li a, .sidebar-nav ul li a.active i, .sidebar-nav ul li a.active:hover i, .sidebar-nav ul li.active a:hover i {
            color: #ff683a;
        }

        .cat-slider .cat-item a.cat-link:hover, .cat-slider .cat-item.section-selected a.cat-link {
            border-color: #ff683a;
        }

        .cat-slider .cat-item a.cat-link {
            border-bottom-color: #ff683a ;
        }

        .cat-slider .cat-item.section-selected a.cat-link:after {
            border-color: #ff683a;
            background: #ff683a;
        }

        .cat-slider {
            border-color: #ff683a;
        }

        .business-analytics .card-box i {
            background: #ff683a;
        }

        .order-status .data i, .order-status span.count {
            color: #ff683a;
        }

        @media screen and ( max-width: 767px ) {

            .mini-sidebar .sidebar-nav ul li a:hover, .sidebar-nav > ul > li.active > a {
                color: #ff683a   !important;
            }
            .mini-sidebar .sidebar-nav #sidebarnav > li:hover a i, .mini-sidebar .sidebar-nav ul li a, .sidebar-nav ul li a.active i, .sidebar-nav ul li a.active:hover i, .sidebar-nav ul li.active a:hover i{color: #fff;}
            .sidebar-nav > ul > li.active > a,.sidebar-nav > ul > li.active > a i,.sidebar-nav > ul > li > a:hover i{color: #ff683a   !important;}
        }
        .nav-tabs .nav-item {
            margin-left: 5px;
        }
        
    </style>

    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDn46rFOSG_dhB4c4D5wKECcKMXfzFb4-w&libraries=drawing"></script>-->



</head>
<body>

<div id="app" class="fix-sidebar card-no-border">
    <div id="main-wrapper">

        <header class="topbar">

            <nav class="navbar top-navbar navbar-expand-md navbar-light">

                @include('employee.layouts.header')

            </nav>

        </header>

        <aside class="left-sidebar">

            <!-- Sidebar scroll-->

            <div class="scroll-sidebar">

                @include('employee.layouts.menu')

            </div>

            <!-- End Sidebar scroll-->

        </aside>

    </div>


    <main class="py-4">
        @yield('content')
    </main>
    <div class="modal fade" id="notification_add_order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered notification-main" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Order Placed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6><span id="auth_accept_name"></span> order placed.</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"><a href="{{url('orders')}}" id="notification_add_order_a">Go</a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="notification_rejected_order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered notification-main" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Order Rejected</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>There have new order rejected.</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"><a href="{{url('orders')}}">Go</a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="notification_accepted_order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered notification-main" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delivery Agent Assigned.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6><span id="np_accept_name"></span> will deliver Your Order.</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"><a href="{{url('orders')}}"
                                                                     id="notification_accepted_a">Go</a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="notification_completed_order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered notification-main" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Order Completed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Order has been order accepted.</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"><a href="{{url('orders')}}">Go</a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="notification_book_table_add_order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered notification-main" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Book A Table Request Placed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6><span id="auth_accept_name_book_table"></span> Place a Book A Table Request.</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"><a href="{{url('booktable')}}" id="notification_book_table_add_order_a">Go</a>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('js/waves.js') }}"></script>
<script src="{{ asset('js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="{{ asset('js/jquery.resizeImg.js') }}"></script>


<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>


<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-database.js"></script>
<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
<script src="{{ asset('js/chosen.jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#data-table').DataTable({
            searching: true, // Disable search
            pageLength: 10, // Set default pagination length to 10
        });
        
        $('#data-table1').DataTable({
            searching: true,
            pageLength: 10,
            dom: 'lBfrtip', 
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search any fields"
            },
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':not(.no-export)' 
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':not(.no-export)'
                    }
                },
                'pdf',
                {
                    extend: 'print',
                    exportOptions: {
                        title: 'Exported data', 
                        columns: ':not(.no-export)' 
                    }
                }
            ],
            searchBuilder: {
                preDefined: []
            }
        });
        
    });
 setTimeout(function(){
        $('#success-alert').fadeOut('slow');
        $('#error-alert').fadeOut('slow');
    }, 4000);
</script>
         
@yield('scripts')
</body>
</html>
