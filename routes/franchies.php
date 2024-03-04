<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('franchies/', [App\Http\Controllers\Franchies\Auth\LoginController::class, 'index'])->name('franchies'); 
Route::post('franchies/login', [App\Http\Controllers\Franchies\Auth\LoginController::class, 'login'])->name('franchies.login'); 
Route::post('franchies/logout', [App\Http\Controllers\Franchies\Auth\LoginController::class, 'logout'])->name('franchies.logout');
Route::get('franchies/dashboard', [App\Http\Controllers\Franchies\HomeController::class, 'index'])->name('franchies.dashboard');
// Route::get('franchies/profile', [App\Http\Controllers\Franchies\HomeController::class, 'profile'])->name('franchies.profile');
// Route::get('franchies/chanagepassword', [App\Http\Controllers\Franchies\HomeController::class, 'chanagepassword'])->name('franchies.chanagepassword');
// Route::post('franchies/updatepassword', [App\Http\Controllers\Franchies\HomeController::class, 'updatepassword'])->name('franchies.updatepassword');
Route::get('franchies/users/profile', [App\Http\Controllers\Franchies\HomeController::class, 'profile'])->name('franchies.users.profile');
Route::put('franchies/users/profile/update/{id}', [App\Http\Controllers\Franchies\HomeController::class, 'updateprofile'])->name('franchies.users.profile.update');
Route::get('franchies/users/password', [App\Http\Controllers\Franchies\HomeController::class, 'password'])->name('franchies.users.password');
Route::put('franchies/users/password/update/{id}', [App\Http\Controllers\Franchies\HomeController::class, 'updatepassword'])->name('franchies.users.password.update');


// Department
Route::get('franchies/department', [App\Http\Controllers\Franchies\DepartmentController::class, 'index'])->name('franchies.department');
Route::get('franchies/department/create', [App\Http\Controllers\Franchies\DepartmentController::class, 'create'])->name('franchies.department.create');
Route::post('franchies/department/insert', [App\Http\Controllers\Franchies\DepartmentController::class, 'insert'])->name('franchies.department.insert');
Route::get('franchies/department/edit/{id}', [App\Http\Controllers\Franchies\DepartmentController::class, 'edit'])->name('franchies.department.edit');
Route::post('franchies/department/update/{id}', [App\Http\Controllers\Franchies\DepartmentController::class, 'update'])->name('franchies.department.update');
Route::get('franchies/department/delete/{id}', [App\Http\Controllers\Franchies\DepartmentController::class, 'destroy'])->name('franchies.department.destroy');

    
// Team
Route::get('franchies/team', [App\Http\Controllers\Franchies\TeamController::class, 'index'])->name('franchies.team');
Route::get('franchies/team/create', [App\Http\Controllers\Franchies\TeamController::class, 'create'])->name('franchies.team.create');
Route::post('franchies/team/insert', [App\Http\Controllers\Franchies\TeamController::class, 'insert'])->name('franchies.team.insert');
Route::get('franchies/team/edit/{id}', [App\Http\Controllers\Franchies\TeamController::class, 'edit'])->name('franchies.team.edit');
Route::get('franchies/team/view/{id}', [App\Http\Controllers\Franchies\TeamController::class, 'view'])->name('franchies.team.view');
Route::post('franchies/team/update/{id}', [App\Http\Controllers\Franchies\TeamController::class, 'update'])->name('franchies.team.update');
Route::get('franchies/team/delete/{id}', [App\Http\Controllers\Franchies\TeamController::class, 'destroy'])->name('franchies.team.destroy');
Route::get('franchies/team/setting/{id}', [App\Http\Controllers\Franchies\TeamController::class, 'setting'])->name('franchies.team.setting');
Route::post('franchies/team/update_setting/{id}', [App\Http\Controllers\Franchies\TeamController::class, 'update_setting'])->name('franchies.team.update_setting');

Route::get('franchies/team/restaurant/{id}', [App\Http\Controllers\Franchies\RestaurantController::class, 'view'])->name('franchies.team.restaurant');
Route::get('franchies/team/restaurant/view/restaurantDetail/{id}', [App\Http\Controllers\Franchies\RestaurantController::class, 'restaurantDetail'])->name('franchies.team.view.restaurantDetail');
Route::get('franchies/team/restaurant/approval/edit/{id}', [App\Http\Controllers\Franchies\RestaurantController::class, 'approvalEdit'])->name('franchies.team.approval.edit');
Route::put('franchies/team/restaurant/approval/update/{id}', [App\Http\Controllers\Franchies\RestaurantController::class, 'approvalUpdate'])->name('franchies.team.approval.update');

Route::get('franchies/team/rider/{id}', [App\Http\Controllers\Franchies\RiderController::class, 'riderList'])->name('franchies.team.rider');
Route::get('franchies/team/rider/riderDetail/{id}', [App\Http\Controllers\Franchies\RiderController::class, 'riderDetail'])->name('franchies.team.view.riderDetail');
Route::get('franchies/team/rider/approvalRider/edit/{id}', [App\Http\Controllers\Franchies\RiderController::class, 'approvalEdit'])->name('franchies.team.approvalRider.edit');
Route::put('franchies/team/approvalRider/update/{id}', [App\Http\Controllers\Franchies\RiderController::class, 'approvalUpdate'])->name('franchies.team.approvalRider.update');

Route::get('franchies/team/product/{id}', [App\Http\Controllers\Franchies\FoodController::class, 'productList'])->name('franchies.team.product');
Route::get('franchies/team/product/view/productDetail/{id}', [App\Http\Controllers\Franchies\FoodController::class, 'productDetail'])->name('franchies.team.view.productDetail');
Route::get('franchies/team/product/approvalProduct/edit/{id}', [App\Http\Controllers\Franchies\FoodController::class, 'approvalEdit'])->name('franchies.team.approvalProduct.edit');
Route::put('franchies/team/product/approvalProduct/update/{id}', [App\Http\Controllers\Franchies\FoodController::class, 'approvalUpdate'])->name('franchies.team.approvalProduct.update');
// Route::get('franchies/team/rider/{id}', [App\Http\Controllers\Team\RiderController::class, 'riderList'])->name('franchies.team.rider');


// Role
Route::get('franchies/role', [App\Http\Controllers\Franchies\RoleController::class, 'index'])->name('franchies.role');
Route::get('franchies/role/create', [App\Http\Controllers\Franchies\RoleController::class, 'create'])->name('franchies.role.create');
Route::post('franchies/role/store', [App\Http\Controllers\Franchies\RoleController::class, 'store'])->name('franchies.role.store');
Route::get('franchies/role/edit/{id}', [App\Http\Controllers\Franchies\RoleController::class, 'edit'])->name('franchies.role.edit');
Route::post('franchies/role/update/{id}', [App\Http\Controllers\Franchies\RoleController::class, 'update'])->name('franchies.role.update');
Route::get('franchies/role/delete/{id}', [App\Http\Controllers\Franchies\RoleController::class, 'delete'])->name('franchies.role.delete');


// Zone 
Route::get('franchies/zone', [App\Http\Controllers\Franchies\ZoneController::class, 'index'])->name('franchies.zone');
Route::get('franchies/zone/create', [App\Http\Controllers\Franchies\ZoneController::class, 'create'])->name('franchies.zone.create');
Route::post('franchies/zone/insert', [App\Http\Controllers\Franchies\ZoneController::class, 'insert'])->name('franchies.zone.insert');
Route::get('franchies/zone/edit/{id}', [App\Http\Controllers\Franchies\ZoneController::class, 'edit'])->name('franchies.zone.edit');
Route::post('franchies/zone/update', [App\Http\Controllers\Franchies\ZoneController::class, 'update'])->name('franchies.zone.update');
Route::get('franchies/zone/delete/{id}', [App\Http\Controllers\Franchies\ZoneController::class, 'destroy'])->name('franchies.zone.destroy');

// Attandance
Route::get('franchies/attandance', [App\Http\Controllers\Franchies\AttandanceController::class, 'index'])->name('franchies.attandance');

// Form Request
Route::get('franchies/form', [App\Http\Controllers\Franchies\RequestFormController::class, 'index'])->name('franchies.form');
Route::get('franchies/form/create', [App\Http\Controllers\Franchies\RequestFormController::class, 'create'])->name('franchies.form.create');
Route::post('franchies/form/store', [App\Http\Controllers\Franchies\RequestFormController::class, 'store'])->name('franchies.form.store');
Route::get('franchies/form/edit/{id}', [App\Http\Controllers\Franchies\RequestFormController::class, 'edit'])->name('franchies.form.edit');
Route::get('franchies/form/view/{id}', [App\Http\Controllers\Franchies\RequestFormController::class, 'view'])->name('franchies.form.view');
Route::post('franchies/form/update/{id}', [App\Http\Controllers\Franchies\RequestFormController::class, 'update'])->name('franchies.form.update');
Route::get('franchies/form/delete/{id}', [App\Http\Controllers\Franchies\RequestFormController::class, 'delete'])->name('franchies.form.delete');



//RequestController
Route::get('franchies/restaurants/request', [App\Http\Controllers\Franchies\RequestController::class, 'index'])->name('franchies.restaurants.request');
Route::get('franchies/restaurants/request/view/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'view'])->name('franchies.restaurants.request.view');
Route::get('franchies/restaurants/request/edit/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'edit'])->name('franchies.restaurants.request.edit');
Route::post('franchies/restaurants/request/update/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'Update'])->name('franchies.restaurants.request.update');
Route::get('franchies/restaurant/request/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'show']);


Route::get('franchies/rider/request', [App\Http\Controllers\Franchies\RequestController::class, 'riderList'])->name('franchies.rider.request');
Route::get('franchies/rider/request/view/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'riderDetail'])->name('franchies.rider.request.view');
Route::get('franchies/rider/request/edit/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'riderEdit'])->name('franchies.rider.request.edit');
Route::post('franchies/rider/request/approvalUpdate/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'approvalUpdate'])->name('franchies.rider.request.approvalUpdate');
Route::get('franchies/rider/request/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'showRider']);
Route::post('franchies/drivers/request/update/{id}',[App\Http\Controllers\Franchies\RequestController::class,'updateRider'])->name('franchies.drivers.request.update');


Route::get('franchies/product/request', [App\Http\Controllers\Franchies\RequestController::class, 'productList'])->name('franchies.product.request');
Route::get('franchies/product/request/view/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'productDetail'])->name('franchies.product.request.view');
Route::get('franchies/product/request/edit/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'productEdit'])->name('franchies.product.request.edit');
Route::post('franchies/product/request/approvalUpdate/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'approvalProduct'])->name('franchies.product.request.approvalUpdate');
Route::get('franchies/product/request/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'showProduct']);
Route::post('franchies/product/request/update/{id}',[App\Http\Controllers\Franchies\RequestController::class,'updateProduct'])->name('franchies.product.request.update');

Route::get('franchies/rider/request/franchiesName/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'showFranchiesDetails']);
Route::get('franchies/rider/request/franchiesName/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'showfranchiesDetails']);
Route::get('franchies/rider/request/teamName/{id}', [App\Http\Controllers\Franchies\RequestController::class, 'showTeamDetails']);



