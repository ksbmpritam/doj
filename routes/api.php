<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/payment',[App\Http\Controllers\API\PaymentController::class,'phonePe']);
// Route::any('/payment-response',[App\Http\Controllers\API\PaymentController::class,'response'])->name('payment.response');

Route::post('/payment',[App\Http\Controllers\API\Restaurant\Orders::class,'phonePe']);
Route::any('/payment-response',[App\Http\Controllers\API\Restaurant\Orders::class,'response'])->name('payment.response');


Route::get('/',[App\Http\Controllers\API\Restaurant\Orders::class, 'test']);

//login 
Route::post('/login',  [App\Http\Controllers\API\LoginController::class, 'login']);

Route::any('/login1',  [App\Http\Controllers\API\LoginController::class, 'login1']);
Route::post('/otp',  [App\Http\Controllers\API\LoginController::class, 'otp']);
Route::post('/verify_otp', [App\Http\Controllers\API\LoginController::class, 'verify_otp']);
Route::post('/update_name', [App\Http\Controllers\API\LoginController::class, 'update_name']);
Route::post('customer/login_google',[App\Http\Controllers\API\LoginController::class,'login_google']);   

//banner
Route::get('/get_banner',[App\Http\Controllers\API\BannerController::class, 'get_banner']);
Route::get('/get_restaurant_banner',[App\Http\Controllers\API\BannerController::class, 'get_restaurant_banner']);

// App
Route::get('/get_video',[App\Http\Controllers\API\BannerController::class, 'get_app_video']);
Route::get('/get_driver_about_us',[App\Http\Controllers\API\AppSetting::class, 'get_driver_about_us']);
Route::get('/get_customer_about_us',[App\Http\Controllers\API\AppSetting::class, 'get_customer_about_us']);
Route::get('/get_restaurant_about_us',[App\Http\Controllers\API\AppSetting::class, 'get_restaurant_about_us']);

Route::get('/get_driver_terms_condition',[App\Http\Controllers\API\AppSetting::class, 'get_driver_terms_condition']);
Route::get('/get_customer_terms_condition',[App\Http\Controllers\API\AppSetting::class, 'get_customer_terms_condition']);
Route::get('/get_restaurant_terms_condition',[App\Http\Controllers\API\AppSetting::class, 'get_restaurant_terms_condition']);

Route::get('/get_driver_privacy_policy',[App\Http\Controllers\API\AppSetting::class, 'get_driver_privacy_policy']);
Route::get('/get_customer_privacy_policy',[App\Http\Controllers\API\AppSetting::class, 'get_customer_privacy_policy']);
Route::get('/get_restaurant_privacy_policy',[App\Http\Controllers\API\AppSetting::class, 'get_restaurant_privacy_policy']);


Route::get('/get_driver_faq',[App\Http\Controllers\API\AppSetting::class, 'get_driver_faq']);
Route::get('/get_customer_faq',[App\Http\Controllers\API\AppSetting::class, 'get_customer_faq']);
Route::get('/get_restaurant_faq',[App\Http\Controllers\API\AppSetting::class, 'get_restaurant_faq']);


Route::post('/customer/helpWithUs',[App\Http\Controllers\API\AppSetting::class, 'helpWithUs']);
Route::post('/customer/sendFeedback',[App\Http\Controllers\API\AppSetting::class, 'sendFeedback']);

Route::post('/get_data',[App\Http\Controllers\API\AppSetting::class, 'get_data']);

// Gift Cart
Route::get('/get_gift',[App\Http\Controllers\API\GiftCard::class,'get_gift']);


// Category
Route::get('/get_category',[App\Http\Controllers\API\CategoryController::class,'get_category']);
Route::get('/get/subcategory',[App\Http\Controllers\API\CategoryController::class,'get_subcategory']);
Route::get('restaurant/food/attribute',  [App\Http\Controllers\API\Restaurant\Product::class, 'get_attribute']);


// Payment  Route::post('/phonepe/callback', 'PaymentController@handlePhonePeCallback');

// Route::post('/phonePe',[App\Http\Controllers\API\PaymentController::class,'phonePe']);
// Route::get('/phonepe-response',[App\Http\Controllers\API\PaymentController::class,'response'])->name('response');


// Route::post('/makePayment',[App\Http\Controllers\API\PaymentController::class,'makePayment']);
// Route::post('/phonepe/callback',[App\Http\Controllers\API\PaymentController::class,'handlePhonePeCallback'])->name('phonepe.callback');



//*************** Restaurant App *************************************
Route::post('restaurant/otp',  [App\Http\Controllers\API\Restaurant\LoginController::class, 'otp']);
Route::post('restaurant/update_profile',  [App\Http\Controllers\API\Restaurant\LoginController::class, 'update_profile']);
Route::post('restaurant/update_restaurant',  [App\Http\Controllers\API\Restaurant\LoginController::class, 'update_restaurant']);
Route::post('restaurant/update_restaurantInfo',  [App\Http\Controllers\API\Restaurant\LoginController::class, 'update_restaurantInfo']);
Route::post('restaurant/login',  [App\Http\Controllers\API\Restaurant\LoginController::class, 'login']);
Route::post('restaurant/verify_otp',  [App\Http\Controllers\API\Restaurant\LoginController::class, 'verify_otp']);

Route::post('restaurant/update_restaurant_status',  [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'update_restaurant_status']);

Route::post('restaurant/profile',  [App\Http\Controllers\API\Restaurant\ProfileController::class, 'get_profile']);
Route::post('restaurant/update_name',  [App\Http\Controllers\API\Restaurant\ProfileController::class, 'update_name']);
Route::post('restaurant/register',  [App\Http\Controllers\API\Restaurant\LoginController::class, 'restaurant_register']);
Route::post('restaurant/update_self_pickup',  [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'update_self_pickup']);
Route::post('restaurant/update_dine',  [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'update_dine']);

Route::post('restaurant/food/add',  [App\Http\Controllers\API\Restaurant\Product::class, 'add_food']);
Route::post('restaurant/get/food',  [App\Http\Controllers\API\Restaurant\Product::class, 'get_product']);
Route::post('restaurant/food/delete',  [App\Http\Controllers\API\Restaurant\Product::class, 'delete_food_id']);
Route::post('restaurant/food/update',  [App\Http\Controllers\API\Restaurant\Product::class, 'update_food']); 
Route::post('restaurant/food/change_status',  [App\Http\Controllers\API\Restaurant\Product::class, 'changeFoodStatus']); 

Route::post('restaurant/ratings', [App\Http\Controllers\API\Restaurant\ProfileController::class, 'get_ratings']);


// Orders
Route::post('restaurant/order/list',  [App\Http\Controllers\API\Restaurant\Orders::class, 'getOrderList']);
Route::post('restaurant/order/change_status',  [App\Http\Controllers\API\Restaurant\Product::class, 'changeOrderStatus']);
Route::post('restaurant/order/book_dinner_list',  [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'book_dinner_list']);
Route::post('restaurant/order/accept_reject',  [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'accept_reject']);
Route::post('restaurant/dinner_cancle_list',[App\Http\Controllers\API\Restaurant\RestaurantController::class,'book_dinner_cancle_list']);
Route::post('restaurant/filter_sort',[App\Http\Controllers\API\Restaurant\RestaurantController::class,'filterAndSort']);
Route::post('restaurant/getorder',[App\Http\Controllers\API\Restaurant\Orders::class,'getOrder']);
Route::post('restaurant/getorderlist',[App\Http\Controllers\API\Restaurant\Orders::class,'orderList']);





//*******   Customer App ****************************************************************************************************************

//profile
Route::post('customer/restaurant_like',[App\Http\Controllers\API\Restaurant\RestaurantController::class,'restaurant_like']);
Route::post('customer/restaurant_unlike',[App\Http\Controllers\API\Restaurant\RestaurantController::class,'restaurant_unlike']);
Route::post('customer/get_restaurant_like',[App\Http\Controllers\API\Customer::class,'get_restaurant_like']);

Route::post('customer/restaurant/ratings', [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'restaurant_rating']);
Route::post('customer/food/ratings', [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'food_rating']);
Route::post('customer/restaurant/search',  [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'searchRestaurant']);



Route::post('customer/save_address',[App\Http\Controllers\API\Customer::class,'save_address']);
Route::post('customer/get_address',[App\Http\Controllers\API\Customer::class,'get_address']);

Route::post('customer/update_address',[App\Http\Controllers\API\Customer::class,'update_address']);
Route::post('customer/delete_address',[App\Http\Controllers\API\Customer::class,'delete_address']);

// Gift Card
Route::post('customer/purchaseGiftCard',[App\Http\Controllers\API\Customer::class,'purchaseGiftCard']);
Route::post('customer/get_purchaseGiftCard',[App\Http\Controllers\API\Customer::class,'get_purchaseGiftCard']);
Route::post('customer/claim_purchaseGiftCard',[App\Http\Controllers\API\Customer::class,'claim_purchaseGiftCard']);

Route::post('customer/add_wallet',[App\Http\Controllers\API\Customer::class,'add_wallet']);
Route::any('customer/wallet-response',[App\Http\Controllers\API\Customer::class,'wallet_response'])->name('wallet.response');
Route::post('customer/get_wallet_history',[App\Http\Controllers\API\Customer::class,'get_wallet_history']);

Route::post('/get_profile',[App\Http\Controllers\API\ProfileController::class, 'get_profile']);
Route::post('/update_profile',[App\Http\Controllers\API\ProfileController::class, 'profile_update']);
Route::post('/update_profile_images',[App\Http\Controllers\API\ProfileController::class,'profile_image']);
Route::post('/update_address',[App\Http\Controllers\API\ProfileController::class,'update_address']);

Route::post('restaurant/get/nearest_restaurant',  [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'findNearestRestaurant']);
Route::post('restaurant/user/food',  [App\Http\Controllers\API\Restaurant\Product::class, 'get_product_user']);
Route::post('restaurant/user/food/details/',  [App\Http\Controllers\API\Restaurant\Product::class, 'product_details_user']);
Route::post('restaurant/user/add_cart',  [App\Http\Controllers\API\Restaurant\Product::class, 'add_cart']);
Route::post('restaurant/user/get_cart',  [App\Http\Controllers\API\Restaurant\Product::class, 'getCartList']);
Route::post('restaurant/user/add_cart_new',  [App\Http\Controllers\API\Restaurant\Product::class, 'add_cart_new']);
Route::post('restaurant/user/add_cart_new_test',  [App\Http\Controllers\API\Restaurant\Product::class, 'add_cart_new_test']);
Route::post('restaurant/user/get_cart_new',  [App\Http\Controllers\API\Restaurant\Product::class, 'getCartList_new']);
Route::post('restaurant/cart/delete/item',  [App\Http\Controllers\API\Restaurant\Product::class, 'delete_cart_by_id']);
Route::post('restaurant/cart/delete/restaurant_item',  [App\Http\Controllers\API\Restaurant\Product::class, 'delete_cart_by_restaurant_id']);
Route::post('restaurant/cart/update_item',  [App\Http\Controllers\API\Restaurant\Product::class, 'update_item']);
Route::post('restaurant/user/save_order',  [App\Http\Controllers\API\Restaurant\Orders::class, 'save_order']);
Route::post('restaurant/user/delete_all_cart',  [App\Http\Controllers\API\Restaurant\Product::class, 'delete_all_cart']);
Route::post('restaurant/order/list',  [App\Http\Controllers\API\Restaurant\Product::class, 'getOrderList']);


Route::post('customer/get-order-list',[App\Http\Controllers\API\Customer::class,'getOrderList']);
Route::post('customer/order/details',[App\Http\Controllers\API\Customer::class,'getOrderDetails']);

Route::post('customer/food/search',[App\Http\Controllers\API\Restaurant\Product::class,'search_product']);
Route::post('customer/filter',[App\Http\Controllers\API\Restaurant\Product::class,'filter']);
Route::post('customer/search_dine',[App\Http\Controllers\API\Restaurant\Product::class,'search_dine']);
Route::post('customer/get_nearest_dine',[App\Http\Controllers\API\Restaurant\Product::class,'get_nearest_dine']);
Route::post('customer/book_dinner',[App\Http\Controllers\API\Restaurant\Orders::class,'book_dinner']);
Route::post('customer/book_dinner_list',[App\Http\Controllers\API\Customer::class,'book_dinner_list']);
Route::post('customer/get_product_by_restaurant_id_category_id',[App\Http\Controllers\API\Restaurant\Product::class,'get_product_by_restaurant_id_category_id']);

// Customer Addres




// ************************ Driver APP ***********************************************************************
Route::post('driver/login',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'login']);
Route::post('driver/check_fcm',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'check_fcm']);
Route::post('driver/logout',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'logout']);
Route::post('driver/get_profile',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'getProfile']);
Route::post('driver/update_bank_details',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'update_bank_details']);
Route::post('driver/update_profile',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'update_profile']);
Route::post('driver/abilable',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'update_abilable']);
Route::post('driver/otp',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'otp']);
Route::post('driver/verify_otp',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'verify_otp']);
Route::post('driver/getOrderList',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'getOrderList']);
Route::post('driver/getOrderHistoryList',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'getOrderHistoryList']);
Route::post('driver/driver-order-status',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'updateOrderStatus']);
Route::post('driver/register',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'register']);
Route::post('driver/order/details',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'getOrderDetails']);
Route::post('order/change_order_status',  [App\Http\Controllers\API\Restaurant\Orders::class, 'changeOrderStatus']);
Route::post('driver/get_notification',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'getNotification']);



// ************************ For Promocode api ***********************************************************************

Route::post('/getPromoCodes', [ App\Http\Controllers\API\PromoContoller::class, 'promo_codes']);
Route::post('/userpromocode', [App\Http\Controllers\API\PromoContoller::class, 'user_promo_code']);
Route::post('/promocodelist', [App\Http\Controllers\API\PromoContoller::class, 'promo_code_list']);


// Dashboard

Route::get('/get_product_offer', [ App\Http\Controllers\API\DashboardController::class, 'get_product_offer']);
Route::post('stocks_product', [ App\Http\Controllers\API\DashboardController::class, 'emptyStocksProduct']);
Route::post('get_total_earning', [ App\Http\Controllers\API\DashboardController::class, 'getTotalEarning']);
Route::post('nearestRestaurant', [ App\Http\Controllers\API\DashboardController::class, 'nearestRestaurant']);
Route::get('getTodaySpecial', [ App\Http\Controllers\API\DashboardController::class, 'getTodaySpecial']);
Route::get('getRestaurantByRating', [ App\Http\Controllers\API\DashboardController::class, 'getRestaurantByRating']);
Route::post('getOfferForYou', [ App\Http\Controllers\API\DashboardController::class, 'getOfferForYou']);
Route::get('mostSoldProductLast7Days', [ App\Http\Controllers\API\DashboardController::class, 'mostSoldProductLast7Days']);


Route::post('user/orderTransactions', [ App\Http\Controllers\API\DashboardController::class, 'orderTransactions']);
Route::post('restaurant/orderTransactions', [ App\Http\Controllers\API\DashboardController::class, 'restaurantOrderTransactions']);

# Restaurant Withdrawal Request
Route::post('restaurant/withdrawal/history', [ App\Http\Controllers\API\ResturantRequestController::class, 'getHistory']);
Route::post('restaurant/withdrawal/create', [ App\Http\Controllers\API\ResturantRequestController::class, 'createRequest']);

# User Withdrawal Request
Route::post('user/withdrawal/history', [ App\Http\Controllers\API\UserRequestController::class, 'getHistory']);
Route::post('user/withdrawal/create', [ App\Http\Controllers\API\UserRequestController::class, 'createRequest']);

# Driver Withdrawal Request
Route::post('driver/withdrawal/history', [ App\Http\Controllers\API\DriverRequestController::class, 'getHistory']);
Route::post('driver/withdrawal/create', [ App\Http\Controllers\API\DriverRequestController::class, 'createRequest']);



# Restaurant Rating
Route::post('customer/restaurantRating',  [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'restaurantRating']);
Route::post('customer/restaurantRating/list',  [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'restaurantRatingList']);
Route::post('customer/restaurantRating/delete',  [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'restaurantRatingDelete']);

# Restaurant Photo
Route::post('customer/restaurantPhoto',  [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'restaurantRatingPhoto']);
Route::post('customer/restaurantPhoto/list',  [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'restaurantRatingListPhoto']);
Route::post('customer/restaurantPhoto/delete',  [App\Http\Controllers\API\Restaurant\RestaurantController::class, 'restaurantRatingDeletePhoto']);

# Food Like
Route::post('customer/food_like',[App\Http\Controllers\API\Restaurant\RestaurantController::class,'food_like']);
Route::post('customer/food_unlike',[App\Http\Controllers\API\Restaurant\RestaurantController::class,'food_unlike']);
Route::post('customer/get_food_like',[App\Http\Controllers\API\Restaurant\RestaurantController::class,'get_food_like']);


# Customer Cover Image
Route::post('customer/cover/create',[App\Http\Controllers\API\Restaurant\RestaurantController::class,'coverCreateUpdate']);
Route::post('customer/cover/list',[App\Http\Controllers\API\Restaurant\RestaurantController::class,'coverlist']);
Route::post('customer/cover/delete',[App\Http\Controllers\API\Restaurant\RestaurantController::class,'coverDelete']);

# Customer Notification
Route::post('customer/get_customer_notification',[App\Http\Controllers\API\Restaurant\RestaurantController::class,'get_customer_notification']);

Route::get('customer/download/summary',[App\Http\Controllers\API\Restaurant\Orders::class,'summary']);

Route::post('customer/order_fev_list',[App\Http\Controllers\API\Restaurant\Orders::class,'get_list_fev_order']);
Route::post('customer/order_fev_create',[App\Http\Controllers\API\Restaurant\Orders::class,'order_like']);
Route::post('customer/order_fev_delete',[App\Http\Controllers\API\Restaurant\Orders::class,'order_unlike']);

# Gift Purchage
Route::post('customer/purchage_gift',[App\Http\Controllers\API\Customer::class,'purchage_gift']);
Route::any('customer/gift-response',[App\Http\Controllers\API\Customer::class,'gift_response'])->name('gift.response');

# Driver Rating
Route::post('driver/driverRating',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'driverRating']);
Route::post('driver/driverRating/list',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'driverRatingList']);
Route::post('driver/driverRating/delete',  [App\Http\Controllers\API\Restaurant\DriverController::class, 'driverRatingDelete']);
















