<nav class="sidebar-nav">
    
    <ul id="sidebarnav">

        <li>
            <a class="waves-effect waves-dark {{ Route::is('dashboard') ? 'active' : '' }}" href="{!! url('member/dashboard') !!}" aria-expanded="false" >

                <i class="mdi mdi-home"></i>

                <span class="hide-menu">{{trans('lang.dashboard')}}</span> 

            </a>
        </li>
     
        @if (auth()->check() && auth()->user()->add_department==1)
        <li>
            <a class="waves-effect waves-dark {{ Route::is('department') ? 'active' : '' }}" href="{!! url('member/department') !!}" aria-expanded="false">
                <i class="mdi mdi-library-books"></i>
                <span class="hide-menu">Department</span>
            </a>
        </li>
        @endif
        
        @if (auth()->check() && auth()->user()->add_team==1)
        <li>
            <a class="waves-effect waves-dark {{ Route::is('team') ? 'active' : '' }}" href="{!! url('member/team') !!}" aria-expanded="false">
                <i class="mdi mdi-account-multiple"></i>
                <span class="hide-menu">Team</span>
            </a>
        </li>
        @endif
        
        @if (auth()->check() && auth()->user()->add_team==1)
        <li>
            <a class="waves-effect waves-dark {{ Route::is('role') ? 'active' : '' }}" href="{!! url('member/role') !!}" aria-expanded="false">
                <i class="mdi mdi-account-multiple"></i>
                <span class="hide-menu">Team</span>
            </a>
        </li>
        @endif
      
    </ul>
    
    <p class="web_version"></p>
    
</nav>