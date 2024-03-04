<nav class="sidebar-nav">
    
    <ul id="sidebarnav">

        <li>
            <a class="waves-effect waves-dark {{ Route::is('dashboard') ? 'active' : '' }}" href="{!! url('franchies/dashboard') !!}" aria-expanded="false" >

                <i class="mdi mdi-home"></i>

                <span class="hide-menu">{{trans('lang.dashboard')}}</span> 

            </a>
        </li>
        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-plus-box"></i>
                <span class="hide-menu">Manage Request</span>
            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('franchies/restaurants/request') !!}">Restaurant </a></li>
                <li><a href="{!! url('franchies/rider/request') !!}">Driver/Rider </a></li>
                <li><a href="{!! url('franchies/product/request') !!}">Product </a></li>

            </ul>

        </li>
        
        <!--@if (session('user') && $globalTeamAccess->add_zone == 1)-->
        <!--    <li>-->
        <!--        <a class="waves-effect waves-dark " href="{!! url('franchies/zone') !!}" aria-expanded="false">-->
        <!--            <i class="fa fa-map-marker" aria-hidden="true"></i>-->
        <!--            <span class="hide-menu">Manage Zone</span>-->
        <!--        </a>-->
        <!--    </li>-->
        <!--@endif-->
        
        @if (session('user') && $globalTeamAccess->add_department==1)
        <li>
            <a class="waves-effect waves-dark {{ Route::is('department') ? 'active' : '' }}" href="{!! url('franchies/department') !!}" aria-expanded="false">
                <i class="mdi mdi-library-books"></i>
                <span class="hide-menu">Department</span>
            </a>
        </li>
       @endif
       @if (session('user') && $globalTeamAccess->add_team==1)
        <li>
            <a class="waves-effect waves-dark {{ Route::is('team') ? 'active' : '' }}" href="{!! url('franchies/team') !!}" aria-expanded="false">
                <i class="mdi mdi-account-multiple"></i>
                <span class="hide-menu">Team</span>
            </a>
        </li>
         @endif
        <!--@if(session('user') && $globalTeamAccess->add_attandance==1)-->
        <!--<li>-->
        <!--    <a class="waves-effect waves-dark {{ Route::is('attandance') ? 'active' : '' }}" href="{!! url('franchies/attandance') !!}" aria-expanded="false">-->
        <!--        <i class="mdi mdi-account-multiple"></i>-->
        <!--        <span class="hide-menu">Attandance</span>-->
        <!--    </a>-->
        <!--</li>-->
        <!--@endif-->

        <!--<li>-->
        <!--    <a class="waves-effect waves-dark {{ Route::is('role') ? 'active' : '' }}" href="{!! url('franchies/role') !!}" aria-expanded="false">-->
        <!--        <i class="mdi mdi-account-multiple"></i>-->
        <!--        <span class="hide-menu">Role</span>-->
        <!--    </a>-->
        <!--</li>-->
        
        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="fa fa-tag"></i>
                <span class="hide-menu"> Request Form </span>
            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('franchies/form') !!}">Request List</a></li>

                <!--<li><a href="#">User App & Portal</a></li>-->
                <!--<li><a href="#">Rider App & Portal.</a></li>-->

            </ul>

        </li>
   
    </ul>
    
    <p class="web_version"></p>
    
</nav>