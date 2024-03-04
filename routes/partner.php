<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\SplashController;

Auth::routes();

//login controller
Route::get('restaurant/', [App\Http\Controllers\Restaurant\Auth\LoginController::class, 'index'])->name('restaurant');
Route::post('restaurant/login', [App\Http\Controllers\Restaurant\Auth\LoginController::class, 'login'])->name('restaurant.login');
Route::post('restaurant/logout', [App\Http\Controllers\Restaurant\Auth\LoginController::class, 'logout'])->name('restaurant.logout');

//Register Controller
Route::get('restaurant/register', [App\Http\Controllers\Restaurant\Auth\RegisterController::class, 'index'])->name('restaurant.register');
Route::post('restaurant/register/create', [App\Http\Controllers\Restaurant\Auth\RegisterController::class, 'register'])->name('register.create');

//dasboard - HomeController
Route::get('restaurant/dashboard', [App\Http\Controllers\Restaurant\HomeController::class, 'index'])->name('restaurant.dashboard');

//RestaurantController
Route::get('restaurant/restaurants', [App\Http\Controllers\Restaurant\RestaurantController::class, 'index'])->name('restaurant.restaurants');
Route::get('restaurant/restaurants/edit/{id}', [App\Http\Controllers\Restaurant\RestaurantController::class, 'edit'])->name('restaurant.restaurants.edit');
Route::post('restaurant/restaurants/update/{id}', [App\Http\Controllers\Restaurant\RestaurantController::class, 'update'])->name('restaurant.restaurants.update');


//Categroy - CategoryController
Route::get('restaurant/category', [App\Http\Controllers\Restaurant\CategoryController::class, 'index'])->name('restaurant.category');
Route::get('restaurant/category/create', [App\Http\Controllers\Restaurant\CategoryController::class, 'create'])->name('restaurant.category.create');
Route::post('restaurant/category/insert', [App\Http\Controllers\Restaurant\CategoryController::class, 'insert'])->name('restaurant.category.insert');
Route::get('restaurant/category/edit/{id}', [App\Http\Controllers\Restaurant\CategoryController::class, 'edit'])->name('restaurant.category.edit');
Route::post('restaurant/category/update/{id}', [App\Http\Controllers\Restaurant\CategoryController::class, 'update'])->name('restaurant.category.update');
Route::get('restaurant/category/delete/{id}', [App\Http\Controllers\Restaurant\CategoryController::class, 'destroy'])->name('restaurant.category.destory');
Route::get('restaurant/category/search', [App\Http\Controllers\Restaurant\CategoryController::class, 'search'])->name('restaurant.category.search');


//product - ProductController
Route::get('restaurant/products', [App\Http\Controllers\Restaurant\ProductController::class, 'index'])->name('restaurant.products');
Route::get('restaurant/products/create', [App\Http\Controllers\Restaurant\ProductController::class, 'create'])->name('restaurant.products.create');
Route::post('restaurant/products/insert', [App\Http\Controllers\Restaurant\ProductController::class, 'insert'])->name('restaurant.products.insert');
Route::get('restaurant/products/edit/{id}', [App\Http\Controllers\Restaurant\ProductController::class, 'edit'])->name('restaurant.products.edit');
Route::post('restaurant/products/update/{id}', [App\Http\Controllers\Restaurant\ProductController::class, 'update'])->name('restaurant.products.update');
Route::get('restaurant/products/delete/{id}', [App\Http\Controllers\Restaurant\ProductController::class, 'destroy'])->name('restaurant.products.destory');
Route::get('restaurant/products/search', [App\Http\Controllers\Restaurant\ProductController::class, 'search'])->name('restaurant.products.search');


//order - OrderController
Route::get('restaurant/orders/', [App\Http\Controllers\Restaurant\OrderController::class, 'index'])->name('restaurant.orders');
Route::get('restaurant/orders/edit/{id}',[App\Http\Controllers\Restaurant\OrderController::class, 'edit'])->name('restaurant.orders.edit');
Route::post('restaurant/orders/update/{id}',[App\Http\Controllers\Restaurant\OrderController::class, 'update'])->name('restaurant.orders.update');
Route::get('restaurant/orders/view/{id}',[App\Http\Controllers\Restaurant\OrderController::class, 'view'])->name('restaurant.orders.view');
Route::get('restaurant/orders/pdf/{id}',[App\Http\Controllers\Restaurant\OrderController::class,'downloadPDF'])->name('restaurant.orders.pdf');


// Route::get('restaurant/orders/excel',[App\Http\Controllers\Restaurant\OrderController::class, 'excel'])->name('restaurant.orders.excel');

//Dine in Order
Route::get('restaurant/dine_orders', [App\Http\Controllers\Restaurant\DineController::class, 'index'])->name('restaurant.dine_orders');
Route::get('restaurant/dine_orders/edit/{id}',[App\Http\Controllers\Restaurant\DineController::class, 'edit'])->name('restaurant.dine_orders.edit');
Route::post('restaurant/dine_orders/update/{id}',[App\Http\Controllers\Restaurant\DineController::class, 'update'])->name('restaurant.dine_orders.update');
Route::get('restaurant/dine_orders/view/{id}',[App\Http\Controllers\Restaurant\DineController::class, 'view'])->name('restaurant.dine_orders.view');
Route::get('restaurant/dine_orders/pdf/{id}',[App\Http\Controllers\Restaurant\DineController::class,'downloadPDF'])->name('restaurant.dine_orders.pdf');


//payment
Route::get('restaurant/payment', [App\Http\Controllers\Restaurant\PaymentController::class, 'index'])->name('restaurant.payment');
Route::get('restaurant/orders/details/{id}',[App\Http\Controllers\Restaurant\PaymentController::class, 'details'])->name('restaurant.orders.details');


# Driver order start
// Route::get('restaurant/driver', [App\Http\Controllers\Restaurant\DriverController::class, 'index'])->name('restaurant.driver');
// Route::get('restaurant/driver/view/{id}', [App\Http\Controllers\Restaurant\DriverController::class, 'view'])->name('restaurant.driver.view');

Route::get('restaurant/drivers', [App\Http\Controllers\Restaurant\DriverController::class, 'index'])->name('restaurant.drivers');
Route::get('restaurant/drivers/edit/{id}', [App\Http\Controllers\Restaurant\DriverController::class, 'edit'])->name('restaurant.drivers.edit');
Route::get('restaurant/drivers/create', [App\Http\Controllers\Restaurant\DriverController::class, 'create'])->name('restaurant.drivers.create');
Route::post('restaurant/drivers/update/{id}', [App\Http\Controllers\Restaurant\DriverController::class, 'update'])->name('restaurant.drivers.update');
Route::post('restaurant/drivers/insert',[App\Http\Controllers\Restaurant\DriverController::class,'insert'])->name('restaurant.drivers.insert');
Route::get('restaurant/drivers/view/{id}', [App\Http\Controllers\Restaurant\DriverController::class, 'view'])->name('restaurant.drivers.view');
Route::get('restaurant/drivers/orders/{id}', [App\Http\Controllers\Restaurant\DriverController::class, 'orders'])->name('restaurant.drivers.orders');
Route::get('restaurant/drivers/orders/edit/{id}', [App\Http\Controllers\Restaurant\DriverController::class, 'edit_order'])->name('restaurant.drivers.orders.edit');
Route::get('restaurant/drivers/orders_list/{id}', [App\Http\Controllers\Restaurant\DriverController::class, 'driver_order_list'])->name('restaurant.drivers.orders_list');
Route::get('restaurant/drivers/balanceHistory/{id}', [App\Http\Controllers\Restaurant\DriverController::class, 'driver_balance_list'])->name('restaurant.drivers.balance_list');

Route::get('restaurant/drivers/transaction/history/{id}', [App\Http\Controllers\Restaurant\DriverController::class, 'history'])->name('restaurant.driver.transaction.history'); 
 
//PromoCode
Route::get('restaurant/promoCode', [App\Http\Controllers\Restaurant\PromoCode::class, 'index'])->name('restaurant.promoCode');
Route::get('restaurant/promoCode/view/{id}', [App\Http\Controllers\Restaurant\PromoCode::class, 'view'])->name('restaurant.promoCode.view');
Route::get('restaurant/promoCode/edit/{id}', [App\Http\Controllers\Restaurant\PromoCode::class, 'edit'])->name('restaurant.promoCode.edit');
Route::get('restaurant/promoCode/create', [App\Http\Controllers\Restaurant\PromoCode::class, 'create'])->name('restaurant.promoCode.create');
Route::post('restaurant/promoCode/insert', [App\Http\Controllers\Restaurant\PromoCode::class, 'insert'])->name('restaurant.promoCode.insert');
Route::post('restaurant/promoCode/update/{id}', [App\Http\Controllers\Restaurant\PromoCode::class, 'update'])->name('restaurant.promoCode.update');
Route::get('restaurant/promoCode/delete/{id}', [App\Http\Controllers\Restaurant\PromoCode::class, 'destroy'])->name('restaurant.promoCode.destory');
Route::get('restaurant/promoCode/restaurant/{id}', [App\Http\Controllers\Restaurant\PromoCode::class, 'restaurant'])->name('restaurant.promoCode.restaurant');
Route::post('restaurant/promoCode/store_restaurant/{id}', [App\Http\Controllers\Restaurant\PromoCode::class, 'store_restaurant'])->name('restaurant.promoCode.store_restaurant');
Route::get('restaurant/promoCode/users/{id}', [App\Http\Controllers\Restaurant\PromoCode::class, 'users'])->name('restaurant.promoCode.users');
Route::post('restaurant/promoCode/store_users/{id}', [App\Http\Controllers\Restaurant\PromoCode::class, 'store_users'])->name('restaurant.promoCode.store_users');

Route::get('restaurant/promoCode/get_users', [App\Http\Controllers\Restaurant\PromoCode::class, 'getUsers'])->name('restaurant.promoCode.get_users');
Route::get('restaurant/promoCode/search_users', [App\Http\Controllers\Restaurant\PromoCode::class, 'search_users'])->name('restaurant.promoCode.search_users');

Route::get('restaurant/promoCode/get_restaurant', [App\Http\Controllers\Restaurant\PromoCode::class, 'getRestaurant'])->name('restaurant.promoCode.get_restaurant');
Route::get('restaurant/promoCode/search_restaurant', [App\Http\Controllers\Restaurant\PromoCode::class, 'searchRestaurant'])->name('restaurant.promoCode.search_restaurant');


Route::get('restaurant/users/profile', [App\Http\Controllers\Restaurant\HomeController::class, 'profile'])->name('restaurant.users.profile');
Route::put('restaurant/users/profile/update/{id}', [App\Http\Controllers\Restaurant\HomeController::class, 'updateprofile'])->name('restaurant.users.profile.update');
Route::get('restaurant/users/password', [App\Http\Controllers\Restaurant\HomeController::class, 'password'])->name('restaurant.users.password');
Route::put('restaurant/users/password/update/{id}', [App\Http\Controllers\Restaurant\HomeController::class, 'updatepassword'])->name('restaurant.users.password.update');

Route::get('restaurant/transaction/history', [App\Http\Controllers\Restaurant\ResturantHistoryController::class, 'index'])->name('restaurant.transaction.history');

Route::get('restaurant/rating', [App\Http\Controllers\Restaurant\RatingController::class, 'index'])->name('restaurant.rating');
