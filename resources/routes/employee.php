<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\PolygonController;

Auth::routes();

Route::get('employee/', [App\Http\Controllers\Employee\Auth\LoginController::class, 'index'])->name('employee'); 
Route::post('employee/login', [App\Http\Controllers\Employee\Auth\LoginController::class, 'login'])->name('employee.login'); 
Route::post('employee/logout', [App\Http\Controllers\Employee\Auth\LoginController::class, 'logout'])->name('employee.logout');
Route::get('employee/dashboard', [App\Http\Controllers\Employee\HomeController::class, 'index'])->name('employee.dashboard');
Route::get('employee/profile', [App\Http\Controllers\Employee\HomeController::class, 'profile'])->name('employee.profile');
Route::get('employee/change-password', [App\Http\Controllers\Employee\HomeController::class, 'changepassword'])->name('employee.changepassword');
Route::post('employee/update-password', [App\Http\Controllers\Employee\HomeController::class, 'updatepassword'])->name('employee.updatepassword');



// Department
Route::get('employee/department', [App\Http\Controllers\Employee\DepartmentController::class, 'index'])->name('employee.department');
Route::get('employee/department/create', [App\Http\Controllers\Employee\DepartmentController::class, 'create'])->name('employee.department.create');
Route::post('employee/department/insert', [App\Http\Controllers\Employee\DepartmentController::class, 'insert'])->name('employee.department.insert');
Route::get('employee/department/edit/{id}', [App\Http\Controllers\Employee\DepartmentController::class, 'edit'])->name('employee.department.edit');
Route::post('employee/department/update/{id}', [App\Http\Controllers\Employee\DepartmentController::class, 'update'])->name('employee.department.update');
Route::get('employee/department/delete/{id}', [App\Http\Controllers\Employee\DepartmentController::class, 'destroy'])->name('employee.department.destroy');


// Team
Route::get('employee/team', [App\Http\Controllers\Employee\TeamController::class, 'index'])->name('employee.team');
Route::get('employee/team/create', [App\Http\Controllers\Employee\TeamController::class, 'create'])->name('employee.team.create');
Route::post('employee/team/insert', [App\Http\Controllers\Employee\TeamController::class, 'insert'])->name('employee.team.insert');
Route::get('employee/team/edit/{id}', [App\Http\Controllers\Employee\TeamController::class, 'edit'])->name('employee.team.edit');
Route::post('employee/team/update/{id}', [App\Http\Controllers\Employee\TeamController::class, 'update'])->name('employee.team.update');
Route::get('employee/team/delete/{id}', [App\Http\Controllers\Employee\TeamController::class, 'destroy'])->name('employee.team.destroy');
Route::get('employee/team/setting/{id}', [App\Http\Controllers\Employee\TeamController::class, 'setting'])->name('employee.team.setting');   
Route::post('employee/team/update_setting/{id}', [App\Http\Controllers\Employee\TeamController::class, 'update_setting'])->name('employee.team.update_setting');

Route::get('employee/team/view/{id}', [App\Http\Controllers\Employee\TeamController::class, 'view'])->name('employee.team.view');
Route::get('employee/team/restaurant/{id}', [App\Http\Controllers\Employee\RestaurantController::class, 'view'])->name('employee.team.restaurant');
Route::get('employee/team/restaurant/view/restaurantDetail/{id}', [App\Http\Controllers\Employee\RestaurantController::class, 'restaurantDetail'])->name('employee.team.view.restaurantDetail');
Route::get('employee/team/restaurant/approval/edit/{id}', [App\Http\Controllers\Employee\RestaurantController::class, 'approvalEdit'])->name('employee.team.approval.edit');
Route::put('employee/team/restaurant/approval/update/{id}', [App\Http\Controllers\Employee\RestaurantController::class, 'approvalUpdate'])->name('employee.team.approval.update');

Route::get('employee/team/rider/{id}', [App\Http\Controllers\Employee\RiderController::class, 'riderList'])->name('employee.team.rider');
Route::get('employee/team/rider/view/riderDetail/{id}', [App\Http\Controllers\Employee\RiderController::class, 'riderDetail'])->name('employee.team.view.riderDetail');
Route::get('employee/team/rider/approvalRider/edit/{id}', [App\Http\Controllers\Employee\RiderController::class, 'approvalEdit'])->name('employee.team.approvalRider.edit');
Route::put('employee/team/rider/approvalRider/update/{id}', [App\Http\Controllers\Employee\RiderController::class, 'approvalUpdate'])->name('employee.team.approvalRider.update');

Route::get('employee/team/product/{id}', [App\Http\Controllers\Employee\FoodController::class, 'productList'])->name('employee.team.product');
Route::get('employee/team/product/view/productDetail/{id}', [App\Http\Controllers\Employee\FoodController::class, 'productDetail'])->name('employee.team.view.productDetail');
Route::get('employee/team/product/approvalProduct/edit/{id}', [App\Http\Controllers\Employee\FoodController::class, 'approvalEdit'])->name('employee.team.approvalProduct.edit');
Route::put('employee/team/product/approvalProduct/update/{id}', [App\Http\Controllers\Employee\FoodController::class, 'approvalUpdate'])->name('employee.team.approvalProduct.update');


// Zone 

Route::get('employee/zone', [App\Http\Controllers\Employee\ZoneController::class, 'index'])->name('employee.zone');
Route::get('employee/zone/create', [App\Http\Controllers\Employee\ZoneController::class, 'create'])->name('employee.zone.create');
Route::post('employee/zone/insert', [App\Http\Controllers\Employee\ZoneController::class, 'insert'])->name('employee.zone.insert');
Route::get('employee/zone/edit/{id}', [App\Http\Controllers\Employee\ZoneController::class, 'edit'])->name('employee.zone.edit');
Route::post('employee/zone/update', [App\Http\Controllers\Employee\ZoneController::class, 'update'])->name('employee.zone.update');
Route::get('employee/zone/delete/{id}', [App\Http\Controllers\Employee\ZoneController::class, 'destroy'])->name('employee.zone.destroy');


// Role
Route::get('employee/role', [App\Http\Controllers\Employee\RoleController::class, 'index'])->name('employee.role');
Route::get('employee/role/create', [App\Http\Controllers\Employee\RoleController::class, 'create'])->name('employee.role.create');
Route::post('employee/role/store', [App\Http\Controllers\Employee\RoleController::class, 'store'])->name('employee.role.store');
Route::get('employee/role/edit/{id}', [App\Http\Controllers\Employee\RoleController::class, 'edit'])->name('employee.role.edit');
Route::post('employee/role/update/{id}', [App\Http\Controllers\Employee\RoleController::class, 'update'])->name('employee.role.update');
Route::get('employee/role/delete/{id}', [App\Http\Controllers\Employee\RoleController::class, 'delete'])->name('employee.role.delete');


// Attandance
Route::get('employee/attandance', [App\Http\Controllers\Employee\AttandanceController::class, 'index'])->name('employee.attandance');



// Form Request
Route::get('employee/form', [App\Http\Controllers\Employee\RequestFormController::class, 'index'])->name('employee.form');
Route::get('employee/form/create', [App\Http\Controllers\Employee\RequestFormController::class, 'create'])->name('employee.form.create');
Route::post('employee/form/store', [App\Http\Controllers\Employee\RequestFormController::class, 'store'])->name('employee.form.store');
Route::get('employee/form/edit/{id}', [App\Http\Controllers\Employee\RequestFormController::class, 'edit'])->name('employee.form.edit');
Route::get('employee/form/view/{id}', [App\Http\Controllers\Employee\RequestFormController::class, 'view'])->name('employee.form.view');
Route::post('employee/form/update/{id}', [App\Http\Controllers\Employee\RequestFormController::class, 'update'])->name('employee.form.update');
Route::get('employee/form/delete/{id}', [App\Http\Controllers\Employee\RequestFormController::class, 'delete'])->name('employee.form.delete');




// Franchies
Route::get('employee/franchies', [App\Http\Controllers\Employee\FranchiesController::class, 'index'])->name('employee.franchies');
Route::get('employee/franchies/create', [App\Http\Controllers\Employee\FranchiesController::class, 'create'])->name('employee.franchies.create');
Route::get('employee/franchies/view/{id}', [App\Http\Controllers\Employee\FranchiesController::class, 'view'])->name('employee.franchies.view');
Route::post('employee/franchies/insert', [App\Http\Controllers\Employee\FranchiesController::class, 'insert'])->name('employee.franchies.insert');
Route::get('employee/franchies/edit/{id}', [App\Http\Controllers\Employee\FranchiesController::class, 'edit'])->name('employee.franchies.edit');
Route::post('employee/franchies/update/{id}', [App\Http\Controllers\Employee\FranchiesController::class, 'update'])->name('employee.franchies.update');
Route::get('employee/franchies/setting/{id}', [App\Http\Controllers\Employee\FranchiesController::class, 'setting'])->name('employee.franchies.setting');
Route::post('employee/franchies/update_setting/{id}', [App\Http\Controllers\Employee\FranchiesController::class, 'update_setting'])->name('employee.franchies.update_setting');
Route::get('employee/franchies/delete/{id}', [App\Http\Controllers\Employee\FranchiesController::class, 'destroy'])->name('employee.franchies.destory');
 
# Franchies Department
Route::get('employee/franchies/department/view/{id}', [App\Http\Controllers\Employee\DepartmentController::class, 'view'])->name('employee.franchies.department');
Route::get('employee/franchies/department/list/{id}', [App\Http\Controllers\Employee\DepartmentController::class, 'list'])->name('employee.franchies.department.list');
Route::get('employee/franchies/department/details/{id}', [App\Http\Controllers\Employee\DepartmentController::class, 'details'])->name('employee.franchies.department.details');

# Franchies Zone
Route::get('employee/franchies/zone/list/{id}', [App\Http\Controllers\Employee\ZoneController::class, 'zonelist'])->name('employee.franchies.zone.list');
Route::get('employee/franchies/zone/details/{id}', [App\Http\Controllers\Employee\ZoneController::class, 'details'])->name('employee.franchies.zone.details');

# Franchies Team
Route::get('employee/franchies/team/list/{id}', [App\Http\Controllers\Employee\TeamController::class, 'teamList'])->name('employee.franchies.team.list');
Route::get('employee/franchies/team/details/{id}', [App\Http\Controllers\Employee\TeamController::class, 'teamDetail'])->name('employee.franchies.team.details');

# Franchies Team Restaurant
Route::get('employee/franchies/team/restaurant/{id}', [App\Http\Controllers\Employee\RestaurantController::class, 'fracnchies_restaurant'])->name('employee.franchies.team.restaurant');
Route::get('employee/franchies/team/restaurant/details/{id}', [App\Http\Controllers\Employee\RestaurantController::class, 'fracnchiesRestaurantDetail'])->name('employee.franchies.team.restaurant.details');
Route::get('employee/franchies/team/restaurant/edit/{id}', [App\Http\Controllers\Employee\RestaurantController::class, 'fracnchiesRestaurantEdit'])->name('employee.franchies.team.restaurant.edit');
Route::post('employee/franchies/team/restaurant/update/{id}', [App\Http\Controllers\Employee\RestaurantController::class, 'fracnchiesRestaurantUpdate'])->name('employee.franchies.team.restaurant.update');

# Franchies Team Rider
Route::get('employee/franchies/team/rider/{id}', [App\Http\Controllers\Employee\RiderController::class, 'franchiesRiderList'])->name('employee.franchies.team.rider');
Route::get('employee/franchies/team/rider/details/{id}', [App\Http\Controllers\Employee\RiderController::class, 'franchiesRiderDetail'])->name('employee.franchies.team.rider.details');
Route::get('employee/franchies/team/rider/edit/{id}', [App\Http\Controllers\Employee\RiderController::class, 'fracnchiesRiderEdit'])->name('employee.franchies.team.rider.edit');
Route::post('employee/franchies/team/rider/update/{id}', [App\Http\Controllers\Employee\RiderController::class, 'fracnchiesRiderUpdate'])->name('employee.franchies.team.rider.update');

# Franchies Team Product
Route::get('employee/franchies/team/product/{id}', [App\Http\Controllers\Employee\FoodController::class, 'productList'])->name('employee.franchies.team.product');
Route::get('employee/franchies/team/product/detail/{id}', [App\Http\Controllers\Employee\FoodController::class, 'productDetail'])->name('employee.franchies.team.product.detail');
Route::get('employee/franchies/team/product/edit/{id}', [App\Http\Controllers\Employee\FoodController::class, 'fracnchiesProductEdit'])->name('employee.franchies.team.product.edit');
Route::post('employee/franchies/team/product/update/{id}', [App\Http\Controllers\Employee\FoodController::class, 'fracnchiesProductUpdate'])->name('employee.franchies.team.product.update');


//RequestController
Route::get('employee/restaurants/request', [App\Http\Controllers\Employee\RequestController::class, 'index'])->name('employee.restaurants.request');
Route::get('employee/restaurants/request/view/{id}', [App\Http\Controllers\Employee\RequestController::class, 'view'])->name('employee.restaurants.request.view');
Route::get('employee/restaurants/request/edit/{id}', [App\Http\Controllers\Employee\RequestController::class, 'edit'])->name('employee.restaurants.request.edit');
Route::post('employee/restaurants/request/update/{id}', [App\Http\Controllers\Employee\RequestController::class, 'Update'])->name('employee.restaurants.request.update');
Route::get('employee/restaurant/request/{id}', [App\Http\Controllers\Employee\RequestController::class, 'show']);


Route::get('employee/rider/request', [App\Http\Controllers\Employee\RequestController::class, 'riderList'])->name('employee.rider.request');
Route::get('employee/rider/request/view/{id}', [App\Http\Controllers\Employee\RequestController::class, 'riderDetail'])->name('employee.rider.request.view');
Route::get('employee/rider/request/edit/{id}', [App\Http\Controllers\Employee\RequestController::class, 'riderEdit'])->name('employee.rider.request.edit');
Route::post('employee/rider/request/approvalUpdate/{id}', [App\Http\Controllers\Employee\RequestController::class, 'approvalUpdate'])->name('employee.rider.request.approvalUpdate');
Route::get('employee/rider/request/{id}', [App\Http\Controllers\Employee\RequestController::class, 'showRider']);
Route::post('employee/drivers/request/update/{id}',[App\Http\Controllers\Employee\RequestController::class,'updateRider'])->name('employee.drivers.request.update');


Route::get('employee/product/request', [App\Http\Controllers\Employee\RequestController::class, 'productList'])->name('employee.product.request');
Route::get('employee/product/request/view/{id}', [App\Http\Controllers\Employee\RequestController::class, 'productDetail'])->name('employee.product.request.view');
Route::get('employee/product/request/edit/{id}', [App\Http\Controllers\Employee\RequestController::class, 'productEdit'])->name('employee.product.request.edit');
Route::post('employee/product/request/approvalUpdate/{id}', [App\Http\Controllers\Employee\RequestController::class, 'approvalProduct'])->name('employee.product.request.approvalUpdate');
Route::get('employee/product/request/{id}', [App\Http\Controllers\Employee\RequestController::class, 'showProduct']);
Route::post('employee/product/request/update/{id}',[App\Http\Controllers\Employee\RequestController::class,'updateProduct'])->name('employee.product.request.update');

Route::get('employee/rider/request/franchiesName/{id}', [App\Http\Controllers\Employee\RequestController::class, 'showFranchiesDetails']);
Route::get('employee/rider/request/employeeName/{id}', [App\Http\Controllers\Employee\RequestController::class, 'showEmployeeDetails']);
Route::get('employee/rider/request/teamName/{id}', [App\Http\Controllers\Employee\RequestController::class, 'showTeamDetails']);

