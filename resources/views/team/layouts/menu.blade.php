<nav class="sidebar-nav">
    
    <ul id="sidebarnav">

        <li>
            <a class="waves-effect waves-dark {{ Route::is('dashboard') ? 'active' : '' }}" href="{!! url('team/dashboard') !!}" aria-expanded="false" >

                <i class="mdi mdi-home"></i>

                <span class="hide-menu">{{trans('lang.dashboard')}}</span> 

            </a>
        </li>
        @if (session('user'))
        <li>
            <a class="waves-effect waves-dark {{ Route::is('restaurants') ? 'active' : '' }}" href="{!! url('team/restaurants') !!}" aria-expanded="false">
                <i class="mdi mdi-library-books"></i>
                <span class="hide-menu">Restaurant</span>
            </a>
        </li>
       @endif
       
       @if (session('user'))
        <li>
            <a class="waves-effect waves-dark {{ Route::is('riders') ? 'active' : '' }}" href="{!! url('team/riders') !!}" aria-expanded="false">
                <i class="mdi mdi-library-books"></i>
                <span class="hide-menu">Rider</span>
            </a>
        </li>
       @endif
       @if (session('user'))
        <li>
            <a class="waves-effect waves-dark {{ Route::is('products') ? 'active' : '' }}" href="{!! url('team/products') !!}" aria-expanded="false">
                <i class="mdi mdi-library-books"></i>
                <span class="hide-menu">Product</span>
            </a>
        </li>
        @endif
        @if (session('user'))
        <li>
            <a class="waves-effect waves-dark {{ Route::is('orders') ? 'active' : '' }}" href="{!! url('team/orders') !!}" aria-expanded="false">
                <i class="mdi mdi-account-multiple"></i>
                <span class="hide-menu">Order</span>
            </a>
        </li>
        @endif

    </ul>
    
    <p class="web_version"></p>
    
</nav>