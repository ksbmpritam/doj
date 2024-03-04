
<nav class="sidebar-nav">

    <ul id="sidebarnav">

        <li>
            <a class="waves-effect waves-dark" href="{!! url('admin/dashboard') !!}" aria-expanded="false" style="background:#e8ffc6;">

                <i class="mdi mdi-home"></i>

                <span class="hide-menu">{{trans('lang.dashboard')}}</span> 

            </a>
        </li>
        <li>
            <a class="waves-effect waves-dark" href="{!! url('admin/zone') !!}" aria-expanded="false" > 

                <i class="fa fa-map"></i>

                <span class="hide-menu">Manage Zone </span> 

            </a>
        </li>
        <li>
            <a class="waves-effect waves-dark" href="{!! url('admin/franchies') !!}" aria-expanded="false" > 

                <i class="fa fa-user"></i>

                <span class="hide-menu">Manage Franchies </span> 

            </a>
        </li>
       
        <!--<li>-->
        <!--    <a class="waves-effect waves-dark" href="{!! url('admin/role') !!}" aria-expanded="false" >-->

        <!--        <i class="fa fa-user"></i>-->

        <!--        <span class="hide-menu">Roles Management</span> -->

        <!--    </a>-->
        <!--</li>-->
        
        <!--<li>-->
        <!--    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">-->
        <!--        <i class="fa fa-tag"></i>-->
        <!--        <span class="hide-menu">Request Form </span>-->
        <!--    </a>-->

        <!--    <ul aria-expanded="false" class="collapse">-->

        <!--        <li><a href="#">Merchant Portal</a></li>-->

        <!--        <li><a href="#">User App & Portal</a></li>-->
        <!--        <li><a href="#">Rider App & Portal.</a></li>-->

        <!--    </ul>-->

        <!--</li>-->
        
        <li>
            <a class="waves-effect waves-dark" href="{!! url('admin/employee') !!}" aria-expanded="false" >

                <i class="fa fa-user"></i>

                <span class="hide-menu">Employee</span> 

            </a>
        </li>
         <li>
            <a class="waves-effect waves-dark" href="{!! url('admin/orders') !!}" aria-expanded="false">

                <i class="mdi mdi-account-multiple"></i>

                <span class="hide-menu">Orders</span>

            </a>
        </li>
        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-plus-box"></i>
                <span class="hide-menu">Manage Request</span>
            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('admin/restaurants/request') !!}">Restaurant </a></li>
                <li><a href="{!! url('admin/rider/request') !!}">Driver/Rider </a></li>
                <li><a href="{!! url('admin/product/request') !!}">Product </a></li>

            </ul>

        </li>
        
        <li><a class="waves-effect waves-dark" href="{!! url('admin/categories') !!}" aria-expanded="false">

                <i class="mdi mdi-clipboard-text"></i>

                <span class="hide-menu">Categories</span>

            </a>
        </li>
        <li><a class="waves-effect waves-dark" href="{!! url('admin/commission') !!}" aria-expanded="false">

                <i class="mdi mdi-clipboard-text"></i>

                <span class="hide-menu">Commission</span>

            </a>
        </li>
        <li><a class="waves-effect waves-dark" href="{!! url('admin/tags') !!}" aria-expanded="false">

                <i class="fa fa-tag"></i>

                <span class="hide-menu">Tags</span>

            </a>
        </li>
        <li><a class="waves-effect waves-dark" href="{!! url('admin/attributes') !!}" aria-expanded="false">

                <i class="fa fa-tag"></i>

                <span class="hide-menu">Attributes</span> 

            </a>
        </li>
        
        
        
        <li>
            <a class="waves-effect waves-dark" href="{!! url('admin/restaurants') !!}" aria-expanded="false">
                <i class="fa fa-users"></i>
                <span class="hide-menu">Partners</span>
            </a>
        </li>
        
        <li>
            <a class="waves-effect waves-dark" href="{!! url('admin/products') !!}" aria-expanded="false">
                <i class="mdi mdi-food"></i>
                <span class="hide-menu">Products</span>
            </a>
        </li>
        
        <!--<li>-->
        <!--    <a class="waves-effect waves-dark" href="{!! url('admin/media') !!}" aria-expanded="false">-->
        <!--        <i class="mdi mdi-food"></i>-->
        <!--        <span class="hide-menu">Media</span>-->
        <!--    </a>-->

        <!--</li>-->
        
        <li>
            <a class="waves-effect waves-dark" href="{!! url('admin/banner') !!}" aria-expanded="false">
                <i class="mdi mdi-food"></i>
                <span class="hide-menu">Banner</span>
            </a>
        </li>
        <li>
            <a class="waves-effect waves-dark" href="{!! url('admin/cover_image') !!}" aria-expanded="false">
                <i class="mdi mdi-food"></i>
                <span class="hide-menu">Cover Image</span>
            </a>
        </li>
        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-plus-box"></i>
                <span class="hide-menu">Slider</span>
            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('admin/slider_category') !!}">Slider Category</a></li>
                <li><a href="{!! url('admin/slider') !!}">Slider List</a></li>

            </ul>

        </li>
       
         <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-plus-box"></i>
                <span class="hide-menu">Offers</span>
            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('admin/offer_category') !!}">Offer Category</a></li>
                <li><a href="{!! url('admin/offer') !!}">Offer List</a></li>

            </ul>

        </li>
        
        <li><a class="waves-effect waves-dark" href="{!! url('admin/voucher') !!}" aria-expanded="false">

                <i class="fa fa-tag"></i>

                <span class="hide-menu">Voucher Coupon</span>

            </a>
        </li>
        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-plus-box"></i>
                <span class="hide-menu">Support Tickets</span>
            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('admin/ticket_type') !!}">Manage Ticket Type</a></li>
                <li><a href="{!! url('admin/ticket') !!}">Manage Ticket</a></li>

            </ul>

        </li>
         <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-plus-box"></i>
                <span class="hide-menu">Promo Code</span>
            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('admin/promoCode') !!}">PromoCode List</a></li>
                <li><a href="{!! url('admin/promoCode/restaurant_list') !!}">Accept PromoCode </a></li>
               
            </ul>

        </li>
                 <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-plus-box"></i>
                <span class="hide-menu">Promocode KM</span>
            </a>

            <ul aria-expanded="false" class="collapse">

              
                  <li><a href="{!! url('admin/kilometer') !!}">PromoCode List </a></li>
                <li><a href="{!! url('admin/kilometer/restaurant_list') !!}">Restaurant Promo kilometer  </a></li>
                <li><a href="{!! url('admin/kilometer/users_list') !!}"> User PromoCode kilometer </a></li>
            </ul>

        </li>
        
        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-plus-box"></i>
                <span class="hide-menu">Food Promo Code</span>
            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('admin/foodpromoCode') !!}">PromoCode List</a></li>
                <li><a href="{!! url('admin/foodpromoCode/restaurant_list') !!}">Restaurant Promo </a></li>
                <li><a href="{!! url('admin/foodpromoCode/users_list') !!}">Users PromoCode </a></li>
            </ul>

        </li>
        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-plus-box"></i>
                <span class="hide-menu">Order Promo Code</span>
            </a>

            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('admin/orderPromoCode') !!}">PromoCode List</a></li>
                <li><a href="{!! url('admin/orderPromoCode/users_list') !!}">Users PromoCode </a></li>
            </ul>

        </li>
         
        <!--<li>-->
        <!--    <a class="waves-effect waves-dark @if(request()->is('admin/promoCode/*')) active @endif" href="{!! url('admin/promoCode') !!}" aria-expanded="false">-->
        <!--        <i class="mdi mdi-library-books"></i>-->
        <!--        <span class="hide-menu">Promo Code</span>-->
        <!--    </a>-->
        <!--</li>-->
        
        <li>
            <a class="waves-effect waves-dark" href="{!! url('admin/gift_card_order') !!}" aria-expanded="false">
                <i class="mdi mdi-library-books"></i>
                <span class="hide-menu">Gift Card Order</span>
            </a>
        </li>
        
        <!--<li><a class="waves-effect waves-dark" href="{!! url('admin/restaurants') !!}" aria-expanded="false">-->
        <!--        <i class="mdi mdi-plus-box"></i>-->
        <!--        <span class="hide-menu">Restaurants</span>-->
        <!--    </a>-->

            <!--<ul aria-expanded="false" class="collapse">-->

            <!--    <li><a href="{!! url('restaurants') !!}">manage restaurants</a></li>-->
            <!--    <li><a  href="{!! url('vendors') !!}" >-->
            <!--    Restaurants Vendor-->
            <!--</a>-->

            <!--</ul>-->

        <!--</li>-->
         <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">

                <i class="mdi mdi-settings"></i>

                <span class="hide-menu">Featured Sections</span>

            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('admin/gift_card_amount') !!}">Gift Card Amount</a></li>
                <li><a href="{!! url('admin/gift_card') !!}">Gift Card</a></li>

                <li><a href="{!! url('admin/filter') !!}">Filters</a></li>
                <li><a href="{!! url('admin/termsAndConditions') !!}">{{trans('lang.terms_and_conditions')}}</a></li>
                <li><a href="{!! url('admin/privacyPolicy') !!}">{{trans('lang.privacy_policy')}}</a></li>
                <li><a href="{!! url('admin/faq') !!}">Manage FAQ</a></li>

            </ul>

        </li>
       
        
        <li>
            <a class="waves-effect waves-dark" href="{!! url('admin/users') !!}" aria-expanded="false">

                <i class="mdi mdi-home"></i>

                <span class="hide-menu">Users / Customer</span>

            </a>
        </li>
         <li><a class="waves-effect waves-dark" href="{!! url('admin/drivers') !!}" aria-expanded="false">

                <i class="mdi mdi-car"></i>

                <span class="hide-menu">{{trans('lang.driver_plural')}}</span>

            </a>
        </li>
         <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-library-books"></i>
                <span class="hide-menu">Payment Request</span>
            </a>
            <ul aria-expanded="false" class="collapse">

                <!--<li><a href="{!! url('admin/payments') !!}">Payments</a></li>-->
                <li><a href="{!! url('admin/resturant/withdrawal/request') !!}">Resturant Withdrawal Request</a></li>
                <li><a href="{!! url('admin/user/withdrawal/request') !!}">User Withdrawal Request</a></li>
                <li><a href="{!! url('admin/driver/withdrawal/request') !!}">Driver Withdrawal Request</a></li>

            </ul>
        </li>
        
        
        
        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-plus-box"></i>
                <span class="hide-menu">{{trans('lang.notification')}}</span>
            </a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('admin/notification') !!}">Notification List</a></li>
                <li><a href="{!! url('admin/notification/create') !!}">Send Notification</a></li>
            </ul>

        </li>
        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="fa fa-tag"></i>
                <span class="hide-menu">Dashboard Setting </span>
            </a>

            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('admin/products/offer') !!}">Products Offer</a></li>
            </ul>
            
            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('admin/today/special') !!}">Today Special</a></li>
            </ul>
            
            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('admin/users/offer') !!}">Users Offer</a></li>
            </ul>

        </li>
        
        <li>
            <a class="waves-effect waves-dark" href="{!! url('admin/rating') !!}" aria-expanded="false">
                <i class="mdi mdi-food"></i>
                <span class="hide-menu">Rating</span>
            </a>

        </li>
        
        <li>
            <a class="waves-effect waves-dark" href="{!! url('admin/safety') !!}" aria-expanded="false">
                <i class="mdi mdi-food"></i>
                <span class="hide-menu">Sefty & Emergency</span>
            </a>

        </li>
        <!--<li>-->
        <!--    <a class="waves-effect waves-dark" href="{!! url('vendors') !!}" aria-expanded="false">-->

        <!--        <i class="mdi mdi-account-multiple"></i>-->

        <!--        <span class="hide-menu">{{trans('lang.owner_vendor')}}</span>-->

        <!--    </a>-->
        <!--</li>-->
        
       
        <!--<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">-->

        <!--        <i class="mdi mdi-calendar-check"></i>-->

        <!--        <span class="hide-menu">Reports</span>-->

        <!--    </a>-->

        <!--    <ul aria-expanded="false" class="collapse" style="height: 0px;">-->

        <!--        <li><a href="#">Sales Report</a></li>-->

        <!--    </ul>-->

        <!--</li>-->
        
        
        
       
        
        <!--<li><a class="waves-effect waves-dark" href="{!! url('admin/coupons') !!}" aria-expanded="false">-->
        <!--        <i class="mdi mdi-library-books"></i>-->
        <!--        <span class="hide-menu">Coupons</span>-->
        <!--    </a>-->
        <!--</li>-->
       
       
       
        
        <!--<li><a class="waves-effect waves-dark" href="{!! url('notification') !!}" aria-expanded="false">-->

        <!--        <i class="fa fa-table "></i>-->

        <!--        <span class="hide-menu">{{trans('lang.notification')}}</span>-->

        <!--    </a>-->
        <!--</li>-->
 
    

    </ul>
   
    

    <p class="web_version"></p>
    
</nav>
