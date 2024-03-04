<div class="navbar-header">
    <a class="navbar-brand" href="<?php echo URL::to('/employee/dashboard'); ?>">
        <b>
            <img src="{{ asset('images/doj_logo.png')}}" alt="homepage" class="dark-logo" width="100%" id="logo_web">
            <img src="{{ asset('images/doj_logo.png')}}" alt="homepage" class="light-logo">
        </b>
    </a>
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
            @php
                $userId = session('user');
                $user = \App\Models\Employee::find($userId->id);
            @endphp
            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if($user->image)
                    <img src="{{ asset('images/employee/profile/' .$user->image) }}" alt="user" class="profile-pic">
                @else
                    <img src="{{ asset('/images/users/user-new.png') }}" alt="user" class="profile-pic">
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right scale-up">
                <ul class="dropdown-user">
                    <li>
                        
                        <div class="dw-user-box">
                            <a href="{{ route('employee.users.profile') }}">
                                <div class="u-img">
                                    @if($user->image)
                                        <img src="{{ asset('images/employee/profile/' .$user->image) }}" alt="user" style="max-width: 45px;">
                                    @else
                                        <img src="{{ asset('/images/users/user-2.png') }}" alt="user" style="max-width: 45px;">  
                                    @endif
                                </div>
                                <div class="u-text">
                                    <h4 id="username">{{ isset($user->name) ? $user->name : '' }}</h4>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ route('employee.users.password')}}" >
                            Change Password
                        </a>
                    </li>
                    <li role="separator" class="divider"></li>
                   <li>  
                        <a href="{{ route('employee.logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('employee.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                       
                    </li>

                </ul>
            </div>
        </li>
    </ul>
</div>
