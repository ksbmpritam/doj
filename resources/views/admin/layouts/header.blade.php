<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Poppins&display=swap" rel="stylesheet">

<div class="navbar-header">
    @if (auth()->check() && auth()->user()->role == "admin")

    <a class="navbar-brand" href="<?php echo URL::to('/admin/dashboard'); ?>">
        <b>
            <img src="{{ asset('/images/doj_logo.png') }}" alt="homepage" class="dark-logo" width="100%" id="logo_web">
            <img src="{{ asset('images/doj_logo.png') }}" alt="homepage" class="light-logo">
        </b>
        <span>
        
        </span>
    </a>
    @else
     <a class="navbar-brand" href="<?php echo URL::to('/member/dashboard'); ?>">
        <b>
            <img src="{{ asset('/images/doj_logo.png') }}" alt="homepage" class="dark-logo" width="100%" id="logo_web">
            <img src="{{ asset('images/doj_logo.png') }}" alt="homepage" class="light-logo">
        </b>
        <span>
        
        </span>
    </a>
    @endif
</div>
<div class="navbar-collapse">
    <ul class="navbar-nav mr-auto mt-md-0">
        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
    </ul>
    <div style="visibility: hidden;" class="language-list icon d-flex align-items-center text-light ml-2" id="language_dropdown_box">
        <div class="language-select">
            <i class="fa fa-globe"></i>
        </div>
        <div class="language-options">
            <select class="form-control changeLang text-dark" id="language_dropdown">
                
            </select>
        </div>
    </div>
    <ul class="navbar-nav my-lg-0">
    
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('/images/users/user-new.png') }}" alt="user" class="profile-pic"></a>
            <div class="dropdown-menu dropdown-menu-right scale-up">
                <ul class="dropdown-user">
                    <li>
                        <div class="dw-user-box">
                            <a href="{{ route('admin.users.profile') }}">
                                <div class="u-img"><img src="{{ asset('/images/users/user-2.png') }}" alt="user" style="max-width: 45px;"></div>
                                <div class="u-text">
                                    <h4>Super User</h4>
                                    <p class="text-muted">Super Administrator</p>
                                </div>
                            </a>
                            
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                     @if (auth()->check() && auth()->user()->role == "admin")
                    <li><a href="{{ route('admin.users.password') }}"><i class="ti-user"></i> Password</a></li>
                    <li role="separator" class="divider"></li>
                  
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{ __('Logout') }}</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif
                    
                    @if(auth()->check() && auth()->user()->role== 'franchies')
                        <li><a href="{{ route('member.profile') }}"><i class="ti-user"></i>  {!! trans('lang.user_profile') !!}</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('member.logout') }}" onclick="event.preventDefault(); document.getElementById('memberlogout-form').submit();"><i class="fa fa-power-off"></i> {{ __('Logout') }}</a></li>
                        <form id="memberlogout-form" action="{{ route('member.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif


                </ul>
            </div>
        </li>
    </ul>
</div>