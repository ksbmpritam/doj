<nav class="sidebar-nav">
    
    <ul id="sidebarnav">

        <li>
            <a class="waves-effect waves-dark {{ request()->is('employee/dashboard/*') ? 'active' : '' }}" href="{!! url('employee/dashboard') !!}" aria-expanded="false" >

                <i class="mdi mdi-home"></i>

                <span class="hide-menu">{{trans('lang.dashboard')}}</span> 

            </a>
        </li>
        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-plus-box"></i>
                <span class="hide-menu">Manage Request</span>
            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('employee/restaurants/request') !!}">Restaurant </a></li>
                <li><a href="{!! url('employee/rider/request') !!}">Driver/Rider </a></li>
                <li><a href="{!! url('employee/product/request') !!}">Product </a></li>

            </ul>

        </li>
        
        <!--@if(session('user') && $globalTeamAccess->add_zone ==1)-->
        <!--<li>-->
        <!--    <a class="waves-effect waves-dark {{ request()->is('employee/zone/*') ? 'active' : '' }}" href="{!! url('employee/zone') !!}" aria-expanded="false">-->
        <!--        <i class="fa fa-map-marker" aria-hidden="true"></i>-->
        <!--        <span class="hide-menu">Management Zone</span>-->
        <!--    </a>-->
        <!--</li>-->
        <!--@endif-->
        
       @if(session('user') && $globalTeamAccess->add_department==1)
        <li>
            <a class="waves-effect waves-dark {{ request()->is('employee/department/*') ? 'active' : '' }}" href="{!! url('employee/department') !!}" aria-expanded="false">
                <i class="mdi mdi-library-books"></i>
                <span class="hide-menu">Department</span>
            </a>
        </li>
        @endif
        
        <!--<li>-->
        <!--    <a class="waves-effect waves-dark {{ Route::is('role') ? 'active' : '' }}" href="{!! url('employee/role') !!}" aria-expanded="false">-->
        <!--        <i class="mdi mdi-account-multiple"></i>-->
        <!--        <span class="hide-menu">Role</span>-->
        <!--    </a>-->
        <!--</li>-->
        
        @if(session('user') && $globalTeamAccess->add_team==1)
        <li>
            <a class="waves-effect waves-dark {{ request()->is('employee/team/*') ? 'active' : '' }}" href="{!! url('employee/team') !!}" aria-expanded="false">
                <i class="mdi mdi-account-multiple"></i>
                <span class="hide-menu">Team</span>
            </a>
        </li>
        @endif
        
        <!--@if(session('user') && $globalTeamAccess->add_attandance==1)-->
        <!--<li>-->
        <!--    <a class="waves-effect waves-dark {{ request()->is('employee/attandance/*') ? 'active' : '' }}" href="{!! url('employee/attandance') !!}" aria-expanded="false">-->
        <!--        <i class="mdi mdi-account-multiple"></i>-->
        <!--        <span class="hide-menu">Attandance</span>-->
        <!--    </a>-->
        <!--</li>-->
        <!--@endif-->
        
        @if(session('user') && $globalTeamAccess->manage_fsc==1)
        <li>
            <a class="waves-effect waves-dark {{ request()->is('employee/franchies/*') ? 'active' : '' }}" href="{!! url('employee/franchies') !!}" aria-expanded="false">
                <i class="mdi mdi-account-multiple"></i>
                <span class="hide-menu">Franchies</span>
            </a>
        </li>
        @endif
        
        <!--employee.form-->
        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="fa fa-tag"></i>
                <span class="hide-menu">Manage Request </span>
            </a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('employee/form') !!}">Request List</a></li>
            </ul>
        </li>
        
    </ul>
    
    <p class="web_version"></p>
    
</nav>