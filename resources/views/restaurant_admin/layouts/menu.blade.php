<nav class="sidebar-nav">

    <ul id="sidebarnav">

        <li><a class="waves-effect waves-dark" href="{!! url('restaurant/dashboard') !!}" aria-expanded="false">

                <i class="mdi mdi-home"></i>

                <span class="hide-menu">{{trans('lang.dashboard')}}</span>

            </a>
        </li>

        <li>
        	<a class="waves-effect waves-dark" href="{!! url('restaurant/restaurants') !!}" aria-expanded="false">

                <i class="mdi mdi-shopping"></i> 

                <span class="hide-menu">{{trans('lang.restaurant')}}</span>

            </a>

        </li>
        <li>
        	<a class="waves-effect waves-dark" href="{!! url('restaurant/category') !!}" aria-expanded="false">

                <i class="mdi mdi-silverware"></i>

                <span class="hide-menu">{{trans('lang.category')}}</span>

            </a>

        </li>
        <li>
        	<a class="waves-effect waves-dark" href="{!! url('restaurant/products') !!}" aria-expanded="false">

                <i class="mdi mdi-food"></i>

                <span class="hide-menu">{{trans('lang.products')}}</span>

            </a>

        </li>

        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">

                <i class="mdi mdi-motorbike"></i>

                <span class="hide-menu">{{trans('lang.driver_plural')}}</span>

            </a>

            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('restaurant/drivers') !!}">Driver List</a></li>

                <!--<li><a href="{!! url('restaurant/drivers/orders') !!}">{{trans('lang.order_plural')}}</a></li>-->

                
            </ul>

        </li>
        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">

                <i class="mdi mdi-reorder-horizontal"></i>

                <span class="hide-menu">{{trans('lang.order_plural')}}</span>

            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('restaurant/orders') !!}">{{trans('lang.order_plural')}}</a></li>
            </ul>
            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('restaurant/dine_orders') !!}">Dine in order</a></li>

               

            </ul>

        </li>
        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">

                <i class="mdi mdi-reorder-horizontal"></i>

                <span class="hide-menu">Promo Code</span>

            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('restaurant/promoCode') !!}">Promo Code List</a></li>
            </ul>
            

        </li>
        <li class="hide"><a class="waves-effect waves-dark hide" href="{!! url('coupons') !!}" aria-expanded="false">

                <i class="mdi mdi-sale"></i>

                <span class="hide-menu">{{trans('lang.coupon_plural')}}</span>

            </a>
        </li>
        
      
        <li class="hide">
            <a class="waves-effect waves-dark hide" href="{!! url('coupons') !!}" aria-expanded="false">
                <i class="mdi mdi-sale"></i>
                <span class="hide-menu">{{ __('lang.offer_plural') }}</span>
            </a>
        </li>
        
        <li class="hide">
            <a class="waves-effect waves-dark hide" href="{!! url('coupons') !!}" aria-expanded="false">
                <i class="mdi mdi-sale"></i>
                <span class="hide-menu">{{ __('lang.event_plural') }}</span>
            </a>
        </li>


        <li class="dineInHistory hide"><a class="has-arrow waves-effect waves-dark" href="{!! url('booktable') !!}"
                                          aria-expanded="false">

                <i class="fa fa-table "></i>

                <span class="hide-menu">DINE IN History</span>

            </a>
        </li>

        <li class="specialOfferDiv hide"><a class="has-arrow waves-effect waves-dark"
                                            href="{!! url('special-offer') !!}" aria-expanded="false">

                <i class="fa fa-table "></i>

                <span class="hide-menu">{{trans('lang.special_offer')}}</span>

            </a>
        </li>
        
        <li><a class="waves-effect waves-dark" href="{!! route('restaurant.payment') !!}" aria-expanded="false">

                <i class="mdi mdi-wallet"></i>

                <span class="hide-menu">Order Transaction</span>

            </a>
        </li>
        
        <li>
        	<a class="waves-effect waves-dark" href="{!! route('restaurant.transaction.history') !!}" aria-expanded="false">

                <i class="mdi mdi-wallet"></i>

                <span class="hide-menu">Transaction History</span>

            </a>

        </li>
        
        <li>
        	<a class="waves-effect waves-dark" href="{!! url('restaurant/rating') !!}" aria-expanded="false">

                <i class="mdi mdi-silverware"></i>

                <span class="hide-menu">Rating</span>

            </a>

        </li>
    </ul>
    
    <p class="web_version"></p>

</nav>


