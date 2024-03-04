<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--favicon icon-->
    <link rel="icon" href="{{ asset('frontend/assets/img/logo.png')}}" type="image/png" sizes="16x16">

    <!--title-->
    <title>Doj</title>

    <!--build:css-->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css')}}">
    <!-- endbuild -->

</head>

<body>

    <!--preloader start-->
    <div id="preloader">
        <div class="preloader-wrap">
            <img src="{{ asset('frontend/assets/img/logo.png')}}" alt="logo" class="img-fluid" />
            <div class="thecube">
                <div class="cube c1"></div>
                <div class="cube c2"></div>
                <div class="cube c4"></div>
                <div class="cube c3"></div>
            </div>
        </div>
    </div>
    <!--preloader end-->
    <!--header section start-->
    <header class="header">
        <!--start navbar-->
        <nav class="navbar navbar-expand-lg fixed-top bg-transparent">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="{{ asset('frontend/assets/img/logo.png')}}" alt="logo" class="img-fluid" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="ti-menu"></span>
                </button>

                <div class="collapse navbar-collapse h-auto" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto menu">
                        <li><a href="#">Home</a></li>
                        <li><a href="#about" class="page-scroll">About</a></li>
                        <li><a href="#features" class="page-scroll">Features</a></li>
                        <li><a href="#screenshots" class="page-scroll">Screenshots</a></li>

                        <li><a href="#contact" class="page-scroll">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!--header section end-->

    <div class="main">

        <!--hero section start-->
        <section class="ptb-100 bg-image overflow-hidden" image-overlay="10">
            <div class="hero-bottom-shape-two" style="background: url('{{ asset('frontend/assets/img/hero-bottom-shape-2.svg') }}') no-repeat bottom center"></div>
            <!--<div class="background-image-wraper" style="background: url('{{ asset('frontend/assets/img/cta-bg.jpg') }}') no-repeat center center / cover fixed; opacity: 1;"></div>-->

            <div class="container">
                <div class="row align-items-center justify-content-lg-between justify-content-md-center justify-content-sm-center">
                    <div class="col-md-12 col-lg-6">
                        <div class="hero-slider-content text-white py-5">
                            <h1 class="text-white">Healthy inside, fresh <span>outside</h1>
                            <p class="lead">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>

                            <div class="action-btns mt-3">
                                <a href="#" class="btn btn-brand-03 btn-rounded mr-3">Download Now <i class="fas fa-cloud-download-alt pl-2"></i></a>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-5">
                        <div class="img-wrap">
                            <img src="{{ asset('frontend/assets/img/app-mobile-image.png')}}" alt="app image" class="img-fluid"> 
                        </div>
                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </section>



        <!--hero section end-->

        <!--promo section start-->
        <section class="promo-section ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 single-promo-card p-2 mt-4 shadow">
                            <div class="card-body">
                                <div class="pb-2">
                                    <span class="fas fa-concierge-bell icon-size-md color-secondary"></span>
                                </div>
                                <div class="pt-2 pb-3">
                                    <h5>Choose Your Favorite</h5>
                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 single-promo-card p-2 mt-4 shadow">
                            <div class="card-body">
                                <div class="pb-2">
                                    <span class="fas fa-window-restore icon-size-md color-secondary"></span>
                                </div>
                                <div class="pt-2 pb-3">
                                    <h5>We Deliver Your Meals</h5>
                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 single-promo-card p-2 mt-4 shadow">
                            <div class="card-body">
                                <div class="pb-2">
                                    <span class="fas fa-sync-alt icon-size-md color-secondary"></span>
                                </div>
                                <div class="pt-2 pb-3">
                                    <h5>Eat And Enjoy</h5>
                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!--promo section end-->

        <!--about us section start-->
        <div class="overflow-hidden">
            <!--about us section start-->
            <section id="about" class="about-us ptb-100 background-shape-img position-relative">
                <div class="animated-shape-wrap">
                    <div class="animated-shape-item"></div>
                    <div class="animated-shape-item"></div>
                    <div class="animated-shape-item"></div>
                    <div class="animated-shape-item"></div>
                    <div class="animated-shape-item"></div>
                </div>
                <div class="container">
                    <div class="row align-items-center justify-content-lg-between justify-content-md-center justify-content-sm-center">
                        <div class="col-md-12 col-lg-6 mb-5 mb-md-5 mb-sm-5 mb-lg-0">
                            <div class="about-content-left">
                                <h2>About Doj</h2>
                                <p>comming soon 2023, Our technology platform connects customers, restaurant partners and delivery partners, serving their multiple needs. Customers use our platform to search and discover restaurants, read and write customer generated reviews and view and upload photos, order food delivery, book a table and make payments while dining-out at restaurants. On the other hand, we provide restaurant partners with industry-specific marketing tools which enable them to engage and acquire customers to grow their business while also providing a reliable and efficient last mile delivery service. We also operate a one-stop procurement solution, Hyperpure, which supplies high quality ingredients and kitchen products to restaurant partners. We also provide our delivery partners with transparent and flexible earning opportunities.</p>

                            </div>
                        </div>
                        <div class="col-sm-5 col-md-5 col-lg-4">
                            <div class="about-content-right">
                                <img src="{{ asset('frontend/assets/img/app-mobile-image-2.png')}}" alt="about us" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--about us section end-->
        </div>



        <!--about us section end-->

        <!--download section step start-->
        <section class="bg-image ptb-100" image-overlay="8">
            <div class="background-image-wraper" style="background: url('{{ asset('frontend/assets/img/cta-bg.jpg') }}') no-repeat center center / cover fixed; opacity:1"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8">
                        <div class="section-heading text-center mb-1 text-white">
                            <h2 class="text-white">Download Our Apps</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                            <div class="action-btns">
                                <ul class="list-inline">

                                    <li class="list-inline-item my-2">
                                        <a href="#" class="d-flex align-items-center app-download-btn btn btn-brand-02 btn-rounded">
                                            <span class="fab fa-apple icon-size-sm mr-3"></span>
                                            <div class="download-text text-left">
                                                <small>Download form</small>
                                                <h5 class="mb-0">App Store</h5>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="list-inline-item my-2">
                                        <a href="#" class="d-flex align-items-center app-download-btn btn btn-brand-02 btn-rounded">
                                            <span class="fab fa-google-play icon-size-sm mr-3"></span>
                                            <div class="download-text text-left">
                                                <small>Download form</small>
                                                <h5 class="mb-0">Google Play</h5>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
        </section>


        <!--download section step end-->

        <!--features section start-->
        <div id="features" class="feature-section ptb-100 ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-9">
                        <div class="section-heading text-center mb-5">
                            <h2>Apdash Features</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>

                        </div>
                    </div>
                </div>

                <!--feature new style start-->
                <div class="row align-items-center justify-content-md-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-start mb-sm-0 mb-md-3 mb-lg-3">
                                    <span class="ti-face-smile icon-size-md color-secondary mr-4"></span>
                                    <div class="icon-text">
                                        <h5 class="mb-2">Responsive web design</h5>
                                        <p>Modular and monetize an componente between layouts monetize array. Core competencies for testing.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-start mb-sm-0 mb-md-3 mb-lg-3">
                                    <span class="ti-vector icon-size-md color-secondary mr-4"></span>
                                    <div class="icon-text">
                                        <h5 class="mb-2">Loaded with features</h5>
                                        <p>Holisticly aggregate client centered the manufactured products transparent. Organic sources content.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-start mb-sm-0 mb-md-3 mb-lg-3">
                                    <span class="ti-headphone-alt icon-size-md color-secondary mr-4"></span>
                                    <div class="icon-text">
                                        <h5 class="mb-2">Friendly online support</h5>
                                        <p>Monotonectally recaptiualize client the centric customize clicks niche markets for this meta-services via. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 d-none d-sm-none d-md-block d-lg-block">
                        <div class="position-relative pb-md-5 py-lg-0">
                            <img alt="Image placeholder" src="{{ asset('frontend/assets/img/app-mobile-image.png')}}" class="img-center img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-start mb-sm-0 mb-md-3 mb-lg-3">
                                    <span class="ti-layout-media-right icon-size-md color-secondary mr-4"></span>
                                    <div class="icon-text">
                                        <h5 class="mb-2">Free updates forever</h5>
                                        <p>Compellingly formulate installed base imperatives high standards in benefits for highly efficient client.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-start mb-sm-0 mb-md-3 mb-lg-3">
                                    <span class="ti-layout-cta-right icon-size-md color-secondary mr-4"></span>
                                    <div class="icon-text">
                                        <h5 class="mb-2">Built with Sass</h5>
                                        <p>Energistically initiate client-centric the maximize market positioning synergy rather client-based data. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-start mb-sm-0 mb-md-3 mb-lg-3">
                                    <span class="ti-palette icon-size-md color-secondary mr-4"></span>
                                    <div class="icon-text">
                                        <h5 class="mb-2">Infinite colors</h5>
                                        <p>Energistically initiate client-centric e-tailers rather than-based data. Morph business technology before.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--feature new style end-->
            </div>
        </div>

        <!--features section end-->

        <!--screenshots section start-->
        <section id="screenshots" class="screenshots-section pb-100 pt-100 gray-light-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8">
                        <div class="section-heading text-center mb-5">
                            <h2>Apps Screenshots</h2>
                            <p>Proactively impact value-added channels via backend leadership skills. Efficiently revolutionize worldwide networks whereas strategic catalysts for change. </p>
                        </div>
                    </div>
                </div>
                <!--start app screen carousel-->
                <div class="screenshot-wrap">
                    <div class="screenshot-frame"></div>
                    <div class="screen-carousel owl-carousel owl-theme dot-indicator">
                        <img src="{{ asset('frontend/assets/img/01.jpg')}}" class="img-fluid" alt="screenshots" />
                        <img src="{{ asset('frontend/assets/img/02.jpg')}}" class="img-fluid" alt="screenshots" />
                        <img src="{{ asset('frontend/assets/img/03.jpg')}}" class="img-fluid" alt="screenshots" />
                        <img src="{{ asset('frontend/assets/img/04.jpg')}}" class="img-fluid" alt="screenshots" />
                        <img src="{{ asset('frontend/assets/img/05.jpg')}}" class="img-fluid" alt="screenshots" />
                        <img src="{{ asset('frontend/assets/img/06.jpg')}}" class="img-fluid" alt="screenshots" />
                    </div>
                </div>
                <!--end app screen carousel-->
            </div>
        </section>





        <!--our contact section start-->
        <section id="contact" class="contact-us-section ptb-100">
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-12 pb-3 message-box d-none">
                        <div class="alert alert-danger"></div>
                    </div>
                    <div class="col-md-12 col-lg-5 mb-5 mb-md-5 mb-sm-5 mb-lg-0">
                        <div class="contact-us-form gray-light-bg rounded p-5">
                            <h4>Ready to get started?</h4>
                            <form action="#" method="POST" id="contactForm" class="contact-us-form">
                                <div class="form-row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Enter name" required="required">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" placeholder="Enter email" required="required">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea name="message" id="message" class="form-control" rows="7" cols="25" placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-3">
                                        <button type="submit" class="btn btn-brand-02" id="btnContactUs">
                                            Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="contact-us-content">
                            <h2>Get In Touch!</h2>
                            <p class="lead">Give us a call or drop by anytime, we endeavour to answer all enquiries within 24 hours on business days.</p>

                            <a href="#" class="btn btn-outline-brand-01 align-items-center">Get Directions <span class="ti-arrow-right pl-2"></span></a>

                            <hr class="my-5">

                            <ul class="contact-info-list">
                                <li class="d-flex pb-3">
                                    <div class="contact-icon mr-3">
                                        <span class="fas fa-location-arrow color-primary rounded-circle p-3"></span>
                                    </div>
                                    <div class="contact-text">
                                        <h5 class="mb-1">Company Location</h5>
                                        <p>
                                            2256/4, AIRFORCE ROAD,<br>
                                            JAWAHAR COLONY, Faridabad, Haryana, BHARAT 121005
                                        </p>
                                    </div>
                                </li>
                                <li class="d-flex pb-3">
                                    <div class="contact-icon mr-3">
                                        <span class="fas fa-envelope color-primary rounded-circle p-3"></span>
                                    </div>
                                    <div class="contact-text">
                                        <h5 class="mb-1">Email Address</h5>
                                        <p>
                                            Demo#fmail.com
                                        </p>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--our contact section end-->
    </div>

    <!--footer section start-->
    <!--when you want to remove subscribe newsletter container then you should remove .footer-with-newsletter class-->
    <footer class="footer-1 gradient-bg ptb-60 footer-with-newsletter">


        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-4 mb-4 mb-md-4 mb-sm-4 mb-lg-0">
                    <a href="#" class="navbar-brand mb-2">
                        <img src="{{ asset('frontend/assets/img/logo.png')}}" alt="logo" class="img-fluid">
                    </a>
                    <br>
                    <h3 class="text-light"> About Dojapp.com</h3>
                    <p>Our technology platform connects customers, restaurant partners and delivery partners, serving their multiple needs. Customers use our platform to search and discover restaurants, read and write customer generated reviews and view and upload photos, order food delivery, book a table and make payments while dining-out at restaurants.</p>

                </div>


                <div class="col-md-12 col-lg-4 mb-4 mb-md-4 mb-sm-4 mb-lg-0">
                    <h6 class="text-uppercase">Important Link</h6>
                    <ul>
                        <li>
                            <a href="#about">About-US</a>
                        </li>
                        <li>
                            <a href="privacypolicy.php">Privacy Policy </a>
                        </li>
                        <li>
                            <a href="cancel.php">Cancellation </a>
                        </li>

                        <li>
                            <a href="refund.php">Refund Policies</a>
                        </li>
                        <li>
                            <a href="termsandconditions.php">Terms and conditions </a>
                        </li>
                    </ul>

                </div>

                <div class="col-md-12 col-lg-4 mb-4 mb-md-4 mb-sm-4 mb-lg-0">
                    <h6 class="text-uppercase">Doj App Pvt. ltd.</h6>
                    <div class="list-inline social-list-default background-color social-hover-2 mt-2">
                        <li class="list-inline-item"><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a class="youtube" href="#"><i class="fab fa-youtube"></i></a></li>
                        <li class="list-inline-item"><a class="linkedin" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        <li class="list-inline-item"><a class="dribbble" href="#"><i class="fab fa-dribbble"></i></a></li>
                    </div>

                </div>



            </div>
        </div>
        <!--end of container-->
    </footer>
    <!--footer bottom copyright start-->
    <div class="footer-bottom py-3 gray-light-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7">
                    <div class="copyright-wrap small-text">
                        <p class="mb-0">&copy; All rights reserved</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--footer bottom copyright end-->
    <!--footer section end-->
    <!--scroll bottom to top button start-->
    <div class="scroll-top scroll-to-target primary-bg text-white" data-target="html">
        <span class="fas fa-hand-point-up"></span>
    </div>
    <!--scroll bottom to top button end-->
    <!--build:js-->
    <script src="{{ asset('frontend/assets/js/vendors/jquery-3.5.1.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/vendors/popper.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/vendors/bootstrap.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/vendors/jquery.easing.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/vendors/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/vendors/countdown.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/vendors/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/vendors/jquery.rcounterup.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/vendors/magnific-popup.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/vendors/validator.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/app.js')}}"></script>
    <!--endbuild-->
</body>

</html>