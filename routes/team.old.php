<?php

use Illuminate\Support\Facades\Route;

Auth::routes();




Route::get('team/', [App\Http\Controllers\Team\Auth\LoginController::class, 'index'])->name('team'); 
Route::post('team/login', [App\Http\Controllers\Team\Auth\LoginController::class, 'login'])->name('team.login'); 
Route::post('team/logout', [App\Http\Controllers\Team\Auth\LoginController::class, 'logout'])->name('team.logout');
Route::get('team/dashboard', [App\Http\Controllers\Team\HomeController::class, 'index'])->name('team.dashboard');
Route::get('team/profile', [App\Http\Controllers\Team\HomeController::class, 'profile'])->name('team.profile');

//restuarant
Route::get('team/restaurants', [App\Http\Controllers\Team\RestaurantController::class, 'index'])->name('team.restaurants');
Route::get('team/restaurants/{id}', [App\Http\Controllers\Team\RestaurantController::class, 'showRestaurants'])->name('approved.restaurants');
Route::get('team/restaurants/create', [App\Http\Controllers\Team\RestaurantController::class, 'create'])->name('team.restaurants.create');
Route::post('team/restaurants/insert', [App\Http\Controllers\Team\RestaurantController::class, 'insert'])->name('team.restaurants.insert');
Route::get('team/restaurants/view/{id}', [App\Http\Controllers\Team\RestaurantController::class, 'view'])->name('team.restaurants.view');
Route::get('team/restaurants/edit/{id}', [App\Http\Controllers\Team\RestaurantController::class, 'edit'])->name('team.restaurants.edit');
Route::post('team/restaurants/update/{id}', [App\Http\Controllers\Team\RestaurantController::class, 'update'])->name('team.restaurants.update');
Route::get('team/restaurants/delete/{id}', [App\Http\Controllers\Team\RestaurantController::class, 'delete'])->name('team.restaurants.delete');

Route::get('team/restaurants/view/{id}', [App\Http\Controllers\Team\RestaurantController::class, 'view'])->name('team.restaurants.view');



//driver
Route::get('team/riders', [App\Http\Controllers\Team\RiderController::class, 'index'])->name('team.riders');
Route::get('team/riders/{id}', [App\Http\Controllers\Team\RiderController::class, 'showRider'])->name('show.riders');

Route::get('team/riders/{id}', [App\Http\Controllers\Team\RiderController::class, 'showRider'])->name('team.showRider');
Route::get('team/riders/create', [App\Http\Controllers\Team\RiderController::class, 'create'])->name('team.riders.create');
Route::post('team/riders/insert',[App\Http\Controllers\Team\RiderController::class,'insert'])->name('team.riders.insert');
Route::get('team/riders/edit/{id}', [App\Http\Controllers\Team\RiderController::class, 'edit'])->name('team.riders.edit');
Route::post('team/riders/update/{id}', [App\Http\Controllers\Team\RiderController::class, 'update'])->name('team.riders.update');
Route::get('team/riders/delete/{id}', [App\Http\Controllers\Team\RiderController::class, 'delete'])->name('team.riders.delete');
Route::get('team/riders/view/{id}', [App\Http\Controllers\Team\RiderController::class, 'view'])->name('team.riders.view');
Route::get('team/riders/orders/{id}', [App\Http\Controllers\Team\RiderController::class, 'orders'])->name('team.riders.orders');
Route::get('team/riders/orders/edit/{id}', [App\Http\Controllers\Team\RiderController::class, 'edit_order'])->name('team.riders.orders.edit');
Route::get('team/riders/order/pdf/{id}',[App\Http\Controllers\Team\RiderController::class,'downloadPDF'])->name('team.riders.order.pdf');
Route::get('team/riders/order/balance/{id}',[App\Http\Controllers\Team\RiderController::class,'balanceHistory'])->name('team.riders.order.balance');


// Route::get('team/users/orders/{id}', [App\Http\Controllers\Team\UserController::class, 'orders'])->name('team.users.orders');
// Route::get('team/users/order_details/{id}', [App\Http\Controllers\Team\UserController::class, 'order_details'])->name('team.users.order_details');
// Route::get('team/users/order/pdf/{id}',[App\Http\Controllers\Team\UserController::class,'downloadPDF'])->name('team.users.order.pdf');

//products
Route::get('team/products', [App\Http\Controllers\Team\FoodController::class, 'index'])->name('team.products');
Route::get('team/products/{id}', [App\Http\Controllers\Team\FoodController::class, 'showProducts'])->name('show.products');
Route::get('team/products/create', [App\Http\Controllers\Team\FoodController::class, 'creates'])->name('team.products.create');
Route::post('team/products/insert', [App\Http\Controllers\Team\FoodController::class, 'insert'])->name('team.products.insert');
Route::get('team/products/view/{id}', [App\Http\Controllers\Team\FoodController::class, 'view'])->name('team.products.view');
Route::get('team/products/edit/{id}', [App\Http\Controllers\Team\FoodController::class, 'edit'])->name('team.products.edit');
Route::post('team/products/update/{id}', [App\Http\Controllers\Team\FoodController::class, 'update'])->name('team.products.update');
Route::get('team/products/delete/{id}', [App\Http\Controllers\Team\FoodController::class, 'destroy'])->name('team.products.destory');

//orders
Route::get('team/orders', [App\Http\Controllers\Team\OrderController::class, 'index'])->name('team.orders');
Route::get('team/orders/edit/{id}', [App\Http\Controllers\Team\OrderController::class, 'edit'])->name('team.orders.edit');
Route::get('team/orders/pdf/{id}', [App\Http\Controllers\Team\OrderController::class, 'downloadPDF'])->name('team.orders.pdf');
Route::get('team/orders/delete/{id}', [App\Http\Controllers\Team\OrderController::class, 'delete'])->name('team.orders.delete');
