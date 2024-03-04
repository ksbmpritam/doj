<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\SplashController;




// Admin
Auth::routes();

Route::get('/',[App\Http\Controllers\Frontend\HomeController::class,'index']);


// Route::any('/payment-response',[App\Http\Controllers\PaymentController::class,'response'])->name('payment.response');

Route::get('send-mail', [App\Http\Controllers\MailController::class, 'index']);


Route::get('admin/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.dashboard');

//banners

Route::get('admin/banner', [App\Http\Controllers\Admin\BannerController::class, 'index'])->name('admin.banner');
Route::get('admin/banner/create', [App\Http\Controllers\Admin\BannerController::class, 'create'])->name('admin.banner.create');
Route::post('admin/banner/insert', [App\Http\Controllers\Admin\BannerController::class, 'insert'])->name('admin.banner.insert');
Route::get('admin/banner/edit/{id}', [App\Http\Controllers\Admin\BannerController::class, 'edit'])->name('admin.banner.edit');
Route::post('admin/banner/update/{id}', [App\Http\Controllers\Admin\BannerController::class, 'update'])->name('admin.banner.update');
Route::get('admin/banner/delete/{id}', [App\Http\Controllers\Admin\BannerController::class, 'destroy'])->name('admin.banner.destory');


//app splash
Route::post('/splash/insert', [SplashController::class, 'insert'])->name('splash.insert');
Route::get('/splash/create',[SplashController::class,'create'])->name('splash.create');
Route::get('/splash', [SplashController::class, 'index'])->name('splash.index');
Route::get('/splash/edit/{id}', [SplashController::class, 'edit'])->name('splash.edit');
Route::put('/splash/update/{id}', [SplashController::class, 'update'])->name('splash.update');
Route::get('/splash/delete/{id}', [SplashController::class, 'destroy'])->name('splash.destory');

//category
Route::get('admin/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories');
Route::get('admin/categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('admin/categories/insert', [App\Http\Controllers\Admin\CategoryController::class, 'insert'])->name('admin.categories.insert');
Route::get('admin/categories/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::post('admin/categories/update/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.categories.update');
Route::get('admin/categories/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.categories.destory');


//Attribute
Route::get('admin/attributes', [App\Http\Controllers\Admin\AttributeController::class, 'index'])->name('admin.attributes');
Route::get('admin/attributes/edit/{id}', [App\Http\Controllers\Admin\AttributeController::class, 'edit'])->name('admin.attributes.edit');
Route::get('admin/attributes/create', [App\Http\Controllers\Admin\AttributeController::class, 'create'])->name('admin.attributes.create');
Route::post('admin/attributes/insert', [App\Http\Controllers\Admin\AttributeController::class, 'insert'])->name('admin.attributes.insert');
Route::post('admin/attributes/update/{id}', [App\Http\Controllers\Admin\AttributeController::class, 'update'])->name('admin.attributes.update');
Route::get('admin/attributes/delete/{id}', [App\Http\Controllers\Admin\AttributeController::class, 'destroy'])->name('admin.attributes.destory');
Route::get('/reviewattributes', [App\Http\Controllers\Admin\ReviewAttributeController::class, 'index'])->name('reviewattributes');

// Tags
Route::get('admin/tags', [App\Http\Controllers\Admin\TagController::class, 'index'])->name('admin.tags');
Route::get('admin/tags/edit/{id}', [App\Http\Controllers\Admin\TagController::class, 'edit'])->name('admin.tags.edit');
Route::get('admin/tags/create', [App\Http\Controllers\Admin\TagController::class, 'create'])->name('admin.tags.create');
Route::post('admin/tags/insert', [App\Http\Controllers\Admin\TagController::class, 'insert'])->name('admin.tags.insert');
Route::post('admin/tags/update/{id}', [App\Http\Controllers\Admin\TagController::class, 'update'])->name('admin.tags.update');
Route::get('admin/tags/delete/{id}', [App\Http\Controllers\Admin\TagController::class, 'destroy'])->name('admin.tags.destory');


//products
Route::get('admin/products', [App\Http\Controllers\Admin\FoodController::class, 'index'])->name('admin.products');
Route::get('admin/products/create', [App\Http\Controllers\Admin\FoodController::class, 'create'])->name('admin.products.create');
Route::post('admin/products/insert', [App\Http\Controllers\Admin\FoodController::class, 'insert'])->name('admin.products.insert');
Route::get('admin/products/edit/{id}', [App\Http\Controllers\Admin\FoodController::class, 'edit'])->name('admin.products.edit');
Route::post('admin/products/update/{id}', [App\Http\Controllers\Admin\FoodController::class, 'update'])->name('admin.products.update');
Route::get('admin/products/delete/{id}', [App\Http\Controllers\Admin\FoodController::class, 'destroy'])->name('admin.products.destory');
Route::get('admin/products/showFranchiesDetails', [App\Http\Controllers\Admin\FoodController::class, 'showFranchiesDetails'])->name('admin.products.showFranchiesDetails');

//PromoCode
Route::get('admin/promoCode', [App\Http\Controllers\Admin\PromoCode::class, 'index'])->name('admin.promoCode');
Route::get('admin/promoCode/edit/{id}', [App\Http\Controllers\Admin\PromoCode::class, 'edit'])->name('admin.promoCode.edit');
Route::get('admin/promoCode/kilometer', [App\Http\Controllers\Admin\PromoCode::class, 'kilometer'])->name('admin.promoCode.kilometer');
Route::get('admin/promoCode/create', [App\Http\Controllers\Admin\PromoCode::class, 'create'])->name('admin.promoCode.create');
Route::post('admin/promoCode/insert', [App\Http\Controllers\Admin\PromoCode::class, 'insert'])->name('admin.promoCode.insert');
Route::post('admin/promoCode/update/{id}', [App\Http\Controllers\Admin\PromoCode::class, 'update'])->name('admin.promoCode.update');
Route::get('admin/promoCode/delete/{id}', [App\Http\Controllers\Admin\PromoCode::class, 'destroy'])->name('admin.promoCode.destory');
Route::get('admin/promoCode//{id}', [App\Http\Controllers\Admin\PromoCode::class, 'deletekilometer'])->name('admin.promoCode.deletekilometer');
Route::get('admin/promoCode/restaurant/{id}', [App\Http\Controllers\Admin\PromoCode::class, 'restaurant'])->name('admin.promoCode.restaurant');
Route::post('admin/promoCode/store_restaurant/{id}', [App\Http\Controllers\Admin\PromoCode::class, 'store_restaurant'])->name('admin.promoCode.store_restaurant');
Route::get('admin/promoCode/users/{id}', [App\Http\Controllers\Admin\PromoCode::class, 'users'])->name('admin.promoCode.users');
Route::post('admin/promoCode/store_users/{id}', [App\Http\Controllers\Admin\PromoCode::class, 'store_users'])->name('admin.promoCode.store_users');
Route::get('admin/promoCode/get_users', [App\Http\Controllers\Admin\PromoCode::class, 'getUsers'])->name('admin.promoCode.get_users');
Route::get('admin/promoCode/search_users', [App\Http\Controllers\Admin\PromoCode::class, 'search_users'])->name('admin.promoCode.search_users');
Route::get('admin/promoCode/get_restaurant', [App\Http\Controllers\Admin\PromoCode::class, 'getRestaurant'])->name('admin.promoCode.get_restaurant');
Route::get('admin/promoCode/search_restaurant', [App\Http\Controllers\Admin\PromoCode::class, 'searchRestaurant'])->name('admin.promoCode.search_restaurant');
Route::get('admin/promoCode/restaurant_list', [App\Http\Controllers\Admin\PromoCode::class, 'restaurant_list'])->name('admin.promoCode.restaurant_list');
Route::get('admin/promoCode/restaurant/view/{id}', [App\Http\Controllers\Admin\PromoCode::class, 'restaurant_view'])->name('admin.promoCode.restaurant.view');

/////Prmo code kilomter //////////
 Route::get('admin/kilometer', [App\Http\Controllers\Admin\PromoCodeKm::class, 'index'])->name('admin.kilometer');
 Route::get('admin/kilometer/create', [App\Http\Controllers\Admin\PromoCodeKm::class, 'create'])->name('admin.kilometer.create');
 Route::post('admin/kilometer/insert', [App\Http\Controllers\Admin\PromoCodeKm::class, 'insert'])->name('admin.kilometer.insert');
 Route::get('admin/kilometer/edit/{id}', [App\Http\Controllers\Admin\PromoCodeKm::class, 'edit'])->name('admin.kilometer.edit');
 Route::post('admin/kilometer/update/{id}', [App\Http\Controllers\Admin\PromoCodeKm::class, 'update'])->name('admin.kilometer.update');
 Route::get('admin/kilometer/delete/{id}', [App\Http\Controllers\Admin\PromoCodeKm::class, 'destroy'])->name('admin.kilometer.destory');
 Route::get('admin/kilometer/get_restaurant/{id}', [App\Http\Controllers\Admin\PromoCodeKm::class, 'getRestaurant'])->name('admin.kilometer.get_restaurant');
 Route::get('admin/kilometer/search_restaurant', [App\Http\Controllers\Admin\PromoCodeKm::class, 'searchRestaurant'])->name('admin.kilometer.search_restaurant');
 Route::get('admin/kilometer/kmget_restaurant/', [App\Http\Controllers\Admin\PromoCodeKm::class, 'kmget_restaurant'])->name('admin.promoCode.kmget_restaurant');
 Route::post('admin/kilometer/kilometerstore_restaurant/{id}', [App\Http\Controllers\Admin\PromoCodeKm::class, 'kilometerstorerestaurant'])->name('admin.kilometerstorerestaurant');
  Route::get('admin/kilometer/kmget_user/{id}', [App\Http\Controllers\Admin\PromoCodeKm::class, 'kmgetuser'])->name('admin.kilometer.kmget_user');
  Route::post('admin/kilometer/storeusers/{id}', [App\Http\Controllers\Admin\PromoCodeKm::class, 'kmstoreuser'])->name('admin.kilometer.kmstoreusers');
  Route::get('admin/kilometer/searchusers', [App\Http\Controllers\Admin\PromoCodeKm::class, 'searchusers'])->name('admin.promoCode.kmsearchusers');
  Route::get('admin/kilometer/getusers', [App\Http\Controllers\Admin\PromoCodeKm::class, 'getUsers'])->name('admin.kilometer.get_users');
  Route::get('admin/kilometer/restaurant_list', [App\Http\Controllers\Admin\PromoCodeKm::class, 'restaurantList'])->name('admin.kilometer.restaurant_list');
  Route::post('admin/kilometer/restaurantupdate/{id}', [App\Http\Controllers\Admin\PromoCodeKm::class, 'restaurantupdate'])->name('admin.restaurants.restaurantupdate');
//   Route::get('admin/kilometer/view/{id}', [App\Http\Controllers\Admin\PromoCodeKm::class, 'promoCodeView'])->name('admin.kilometer.view');
   Route::get('admin/kilometer/view/{promo_code_kilometers_id}', [App\Http\Controllers\Admin\PromoCodeKm::class, 'promoCodeView'])->name('admin.kilometer.view');
  Route::get('admin/kilometer/restaurantDelete/{id}', [App\Http\Controllers\Admin\PromoCodeKm::class, 'restaurantDelete'])->name('admin.PromoCodeKm.restaurantDelete');
  Route::get('admin/kilometer/users_list', [App\Http\Controllers\Admin\PromoCodeKm::class, 'users_list'])->name('admin.kilometer.users_list');
  Route::get('admin/kilometer/userview/{id}', [App\Http\Controllers\Admin\PromoCodeKm::class, 'userview'])->name('admin.PromoCodeKm.userview');
  Route::get('admin/kilometer/promoCodeView/{id}', [App\Http\Controllers\Admin\PromoCodeKm::class, 'promoCodeView'])->name('admin.promoCodeView');
  Route::get('admin/kilometer/usersdelete/{promo_code_kilometers_id}', [App\Http\Controllers\Admin\PromoCodeKm::class, 'usersdelete'])->name('admin.foodpromoCode.usersdelete');
  
 //end
 
 
// food promocode
 Route::get('admin/foodpromoCode', [App\Http\Controllers\Admin\FoodPromoCode::class, 'index'])->name('admin.foodpromoCode');
Route::get('admin/foodpromoCode/edit/{id}', [App\Http\Controllers\Admin\FoodPromoCode::class, 'edit'])->name('admin.foodpromoCode.edit');
Route::get('admin/foodpromoCode/create', [App\Http\Controllers\Admin\FoodPromoCode::class, 'create'])->name('admin.foodpromoCode.create');
Route::post('admin/foodpromoCode/insert', [App\Http\Controllers\Admin\FoodPromoCode::class, 'insert'])->name('admin.foodpromoCode.insert');
Route::post('admin/foodpromoCode/update/{id}', [App\Http\Controllers\Admin\FoodPromoCode::class, 'update'])->name('admin.foodpromoCode.update');
Route::get('admin/foodpromoCode/delete/{id}', [App\Http\Controllers\Admin\FoodPromoCode::class, 'delete'])->name('admin.foodpromoCode.delete');
Route::get('admin/foodpromoCode/restaurant/{id}', [App\Http\Controllers\Admin\FoodPromoCode::class, 'restaurant'])->name('admin.foodpromoCode.restaurant');
Route::post('admin/foodpromoCode/store_restaurant/{id}', [App\Http\Controllers\Admin\FoodPromoCode::class, 'store_restaurant'])->name('admin.foodpromoCode.store_restaurant');
Route::get('admin/foodpromoCode/users/{id}', [App\Http\Controllers\Admin\FoodPromoCode::class, 'users'])->name('admin.foodpromoCode.users');
Route::post('admin/foodpromoCode/store_users/{id}', [App\Http\Controllers\Admin\FoodPromoCode::class, 'store_users'])->name('admin.foodpromoCode.store_users');
Route::get('admin/foodpromoCode/get_users', [App\Http\Controllers\Admin\FoodPromoCode::class, 'getUsers'])->name('admin.foodpromoCode.get_users');
Route::get('admin/foodpromoCode/search_users', [App\Http\Controllers\Admin\FoodPromoCode::class, 'search_users'])->name('admin.foodpromoCode.search_users');

Route::get('admin/foodpromoCode/product/{id}', [App\Http\Controllers\Admin\FoodPromoCode::class, 'product'])->name('admin.foodpromoCode.product');
Route::post('admin/foodpromoCode/store_product/{id}', [App\Http\Controllers\Admin\FoodPromoCode::class, 'store_product'])->name('admin.foodpromoCode.store_product');
Route::get('admin/foodpromoCode/get_product', [App\Http\Controllers\Admin\FoodPromoCode::class, 'getProduct'])->name('admin.foodpromoCode.get_product');
Route::get('admin/foodpromoCode/search_product', [App\Http\Controllers\Admin\FoodPromoCode::class, 'search_product'])->name('admin.foodpromoCode.search_product');

Route::get('admin/foodpromoCode/get_restaurant', [App\Http\Controllers\Admin\FoodPromoCode::class, 'getRestaurant'])->name('admin.foodpromoCode.get_restaurant');
Route::get('admin/foodpromoCode/search_restaurant', [App\Http\Controllers\Admin\FoodPromoCode::class, 'searchRestaurant'])->name('admin.foodpromoCode.search_restaurant');

Route::get('admin/foodpromoCode/restaurant_list', [App\Http\Controllers\Admin\FoodPromoCode::class, 'restaurant_list'])->name('admin.foodpromoCode.restaurant_list');
Route::get('admin/foodpromoCode/restaurant/delete/{id}', [App\Http\Controllers\Admin\FoodPromoCode::class, 'restaurantDelete'])->name('admin.foodpromoCode.restaurant.delete');
Route::get('admin/foodpromoCode/view/{id}', [App\Http\Controllers\Admin\FoodPromoCode::class, 'promoCodeView'])->name('admin.foodpromoCode.view');

Route::get('admin/foodpromoCode/users_list', [App\Http\Controllers\Admin\FoodPromoCode::class, 'users_list'])->name('admin.foodpromoCode.users_list');
Route::get('admin/foodpromoCode/user/delete/{id}', [App\Http\Controllers\Admin\FoodPromoCode::class, 'restaurantDelete'])->name('admin.foodpromoCode.user.delete');

 
 
// Order Wise promocode
 Route::get('admin/orderPromoCode', [App\Http\Controllers\Admin\OrderWisePromoCode::class, 'index'])->name('admin.orderPromoCode');
Route::get('admin/orderPromoCode/edit/{id}', [App\Http\Controllers\Admin\OrderWisePromoCode::class, 'edit'])->name('admin.orderPromoCode.edit');
Route::get('admin/orderPromoCode/create', [App\Http\Controllers\Admin\OrderWisePromoCode::class, 'create'])->name('admin.orderPromoCode.create');
Route::post('admin/orderPromoCode/insert', [App\Http\Controllers\Admin\OrderWisePromoCode::class, 'insert'])->name('admin.orderPromoCode.insert');
Route::post('admin/orderPromoCode/update/{id}', [App\Http\Controllers\Admin\OrderWisePromoCode::class, 'update'])->name('admin.orderPromoCode.update');
Route::get('admin/orderPromoCode/delete/{id}', [App\Http\Controllers\Admin\OrderWisePromoCode::class, 'delete'])->name('admin.orderPromoCode.delete');

Route::get('admin/orderPromoCode/users/{id}', [App\Http\Controllers\Admin\OrderWisePromoCode::class, 'users'])->name('admin.orderPromoCode.users');
Route::post('admin/orderPromoCode/store_users/{id}', [App\Http\Controllers\Admin\OrderWisePromoCode::class, 'store_users'])->name('admin.orderPromoCode.store_users');
Route::get('admin/orderPromoCode/get_users', [App\Http\Controllers\Admin\OrderWisePromoCode::class, 'getUsers'])->name('admin.orderPromoCode.get_users');
Route::get('admin/orderPromoCode/search_users', [App\Http\Controllers\Admin\OrderWisePromoCode::class, 'search_users'])->name('admin.orderPromoCode.search_users');
Route::get('admin/orderPromoCode/users_list', [App\Http\Controllers\Admin\OrderWisePromoCode::class, 'users_list'])->name('admin.orderPromoCode.users_list');
Route::get('admin/orderPromoCode/user/delete/{id}', [App\Http\Controllers\Admin\OrderWisePromoCode::class, 'userDelete'])->name('admin.orderPromoCode.user.delete');

Route::get('admin/orderPromoCode/view/{id}', [App\Http\Controllers\Admin\OrderWisePromoCode::class, 'promoCodeView'])->name('admin.orderPromoCode.view');


 
 
 
//Slider
Route::get('admin/slider', [App\Http\Controllers\Admin\SliderController::class, 'index'])->name('admin.slider');
Route::get('admin/slider/create', [App\Http\Controllers\Admin\SliderController::class, 'create'])->name('admin.slider.create');
Route::post('admin/slider/insert', [App\Http\Controllers\Admin\SliderController::class, 'insert'])->name('admin.slider.insert');
Route::get('admin/slider/edit/{id}', [App\Http\Controllers\Admin\SliderController::class, 'edit'])->name('admin.slider.edit');
Route::post('admin/slider/update/{id}', [App\Http\Controllers\Admin\SliderController::class, 'update'])->name('admin.slider.update');
Route::get('admin/slider/delete/{id}', [App\Http\Controllers\Admin\SliderController::class, 'destroy'])->name('admin.slider.destory');


// SliderCategories
Route::get('admin/slider_category', [App\Http\Controllers\Admin\SliderCategory::class, 'index'])->name('admin.slider_category');
Route::get('admin/slider_category/edit/{id}', [App\Http\Controllers\Admin\SliderCategory::class, 'edit'])->name('admin.slider_category.edit');
Route::get('admin/slider_category/create', [App\Http\Controllers\Admin\SliderCategory::class, 'create'])->name('admin.slider_category.create');
Route::post('admin/slider_category/insert', [App\Http\Controllers\Admin\SliderCategory::class, 'insert'])->name('admin.slider_category.insert');
Route::post('admin/slider_category/update/{id}', [App\Http\Controllers\Admin\SliderCategory::class, 'update'])->name('admin.slider_category.update');
Route::get('admin/slider_category/delete/{id}', [App\Http\Controllers\Admin\SliderCategory::class, 'destroy'])->name('admin.slider_category.destory');


// OfferCategories
Route::get('admin/offer_category', [App\Http\Controllers\Admin\OfferCategory::class, 'index'])->name('admin.offer_category');
Route::get('admin/offer_category/edit/{id}', [App\Http\Controllers\Admin\OfferCategory::class, 'edit'])->name('admin.offer_category.edit');
Route::get('admin/offer_category/create', [App\Http\Controllers\Admin\OfferCategory::class, 'create'])->name('admin.offer_category.create');
Route::post('admin/offer_category/insert', [App\Http\Controllers\Admin\OfferCategory::class, 'insert'])->name('admin.offer_category.insert');
Route::post('admin/offer_category/update/{id}', [App\Http\Controllers\Admin\OfferCategory::class, 'update'])->name('admin.offer_category.update');
Route::get('admin/offer_category/delete/{id}', [App\Http\Controllers\Admin\OfferCategory::class, 'destroy'])->name('admin.offer_category.destory');

// Offer
Route::get('admin/offer', [App\Http\Controllers\Admin\OfferController::class, 'index'])->name('admin.offer');
Route::get('admin/offer/edit/{id}', [App\Http\Controllers\Admin\OfferController::class, 'edit'])->name('admin.offer.edit');
Route::get('admin/offer/create', [App\Http\Controllers\Admin\OfferController::class, 'create'])->name('admin.offer.create');
Route::post('admin/offer/insert', [App\Http\Controllers\Admin\OfferController::class, 'insert'])->name('admin.offer.insert');
Route::post('admin/offer/update/{id}', [App\Http\Controllers\Admin\OfferController::class, 'update'])->name('admin.offer.update');
Route::get('admin/offer/delete/{id}', [App\Http\Controllers\Admin\OfferController::class, 'destroy'])->name('admin.offer.destory');

// Ticket Type
Route::get('admin/ticket_type', [App\Http\Controllers\Admin\TicketType::class, 'index'])->name('admin.ticket_type');
Route::get('admin/ticket_type/edit/{id}', [App\Http\Controllers\Admin\TicketType::class, 'edit'])->name('admin.ticket_type.edit');
Route::get('admin/ticket_type/create', [App\Http\Controllers\Admin\TicketType::class, 'create'])->name('admin.ticket_type.create');
Route::post('admin/ticket_type/insert', [App\Http\Controllers\Admin\TicketType::class, 'insert'])->name('admin.ticket_type.insert');
Route::post('admin/ticket_type/update/{id}', [App\Http\Controllers\Admin\TicketType::class, 'update'])->name('admin.ticket_type.update');
Route::get('admin/ticket_type/delete/{id}', [App\Http\Controllers\Admin\TicketType::class, 'destroy'])->name('admin.ticket_type.destory');

// Ticket
Route::get('admin/ticket', [App\Http\Controllers\Admin\Ticket::class, 'index'])->name('admin.ticket');
Route::get('admin/ticket/edit/{id}', [App\Http\Controllers\Admin\Ticket::class, 'edit'])->name('admin.ticket.edit');
Route::get('admin/ticket/create', [App\Http\Controllers\Admin\Ticket::class, 'create'])->name('admin.ticket.create');
Route::post('admin/ticket/insert', [App\Http\Controllers\Admin\Ticket::class, 'insert'])->name('admin.ticket.insert');
Route::post('admin/ticket/update/{id}', [App\Http\Controllers\Admin\Ticket::class, 'update'])->name('admin.ticket.update');
Route::get('admin/ticket/delete/{id}', [App\Http\Controllers\Admin\Ticket::class, 'destory'])->name('admin.ticket.destory');


// Employee
Route::get('admin/employee', [App\Http\Controllers\Admin\EmployeeController::class, 'index'])->name('admin.employee');
Route::get('admin/employee/create', [App\Http\Controllers\Admin\EmployeeController::class, 'create'])->name('admin.employee.create');
Route::get('admin/employee/view/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'view'])->name('admin.employee.view');
Route::post('admin/employee/insert', [App\Http\Controllers\Admin\EmployeeController::class, 'insert'])->name('admin.employee.insert');
Route::get('admin/employee/edit/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'edit'])->name('admin.employee.edit');
Route::post('admin/employee/update/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'update'])->name('admin.employee.update');
Route::get('admin/employee/setting/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'setting'])->name('admin.employee.setting');
Route::post('admin/employee/update_setting/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'update_setting'])->name('admin.employee.update_setting');
Route::get('admin/employee/delete/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'destroy'])->name('admin.employee.destory');

# Franchies Department
Route::get('admin/employee/department/view/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'view'])->name('admin.employee.department');
Route::get('admin/employee/department/departmentlist/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'departmentList2'])->name('admin.employee.department.departmentlist');
Route::get('admin/employee/department/departmentDetail/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'departmentDetail2'])->name('admin.employee.department.departmentDetail');
Route::get('admin/employee/department/departmentEdit/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'departmentEdit'])->name('admin.employee.department.departmentEdit');
Route::post('admin/employee/department/departmentupdate/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'departmentupdate'])->name('admin.employee.department.departmentupdate');
# Franchies Zone
Route::get('admin/employee/zone/zonelist/{id}', [App\Http\Controllers\Admin\ZoneController::class, 'zonelist2'])->name('admin.employee.zone.zonelist');
Route::get('admin/employee/zone/zoneDetail/{id}', [App\Http\Controllers\Admin\ZoneController::class, 'zoneDetail2'])->name('admin.employee.zone.zoneDetail');

# Franchies Team
Route::get('admin/employee/team/teamlist/{id}', [App\Http\Controllers\Admin\TeamController::class, 'teamList2'])->name('admin.employee.team.teamlist');
Route::get('admin/employee/team/teamDetail/{id}', [App\Http\Controllers\Admin\TeamController::class, 'teamDetail2'])->name('admin.employee.team.teamDetail');
Route::get('admin/employee/team/teamEdit/{id}', [App\Http\Controllers\Admin\TeamController::class, 'teamEdit'])->name('admin.employee.team.teamEdit');
// Route::post('admin/employee/team/teamUpdate/{id}', [App\Http\Controllers\Admin\TeamController::class, 'teamUpdate'])->name('admin.employee.team.teamUpdate');
# Franchies Team Restaurant
Route::get('admin/employee/team/restaurant/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'view2'])->name('admin.employee.team.restaurant');
Route::get('admin/employee/team/restaurant/view/restaurantDetail/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'restaurantDetail2'])->name('admin.employee.team.view.restaurantDetail');

# Franchies Team Rider
Route::get('admin/employee/team/rider/{id}', [App\Http\Controllers\Admin\RiderController::class, 'riderList2'])->name('admin.employee.team.rider');
Route::get('admin/employee/team/rider/riderDetail/{id}', [App\Http\Controllers\Admin\RiderController::class, 'riderDetail2'])->name('admin.employee.team.view.riderDetail');
Route::get('admin/employee/team/rider/ridersEdit/{id}', [App\Http\Controllers\Admin\RiderController::class, 'ridersEdit'])->name('admin.employee.team.view.riderEdit');
# Franchies Team Product
Route::get('admin/employee/team/product/{id}', [App\Http\Controllers\Admin\FoodController::class, 'productList2'])->name('admin.employee.team.product');
Route::get('admin/employee/team/product/view/productDetail/{id}', [App\Http\Controllers\Admin\FoodController::class, 'productDetail2'])->name('admin.employee.team.view.productDetail');
Route::get('admin/employee/team/product/edit/productEdit/{id}', [App\Http\Controllers\Admin\FoodController::class, 'productsEdit'])->name('admin.employee.team.view.productEdit');
Route::post('admin/employee/team/product/update/productUpdate/{id}', [App\Http\Controllers\Admin\FoodController::class, 'productUpdate'])->name('admin.products.productUpdate');
// Franchies
Route::get('admin/franchies', [App\Http\Controllers\Admin\FranchiesController::class, 'index'])->name('admin.franchies');
Route::get('admin/franchies/create', [App\Http\Controllers\Admin\FranchiesController::class, 'create'])->name('admin.franchies.create');
Route::get('admin/franchies/view/{id}', [App\Http\Controllers\Admin\FranchiesController::class, 'view'])->name('admin.franchies.view');
Route::post('admin/franchies/insert', [App\Http\Controllers\Admin\FranchiesController::class, 'insert'])->name('admin.franchies.insert');
Route::get('admin/franchies/edit/{id}', [App\Http\Controllers\Admin\FranchiesController::class, 'edit'])->name('admin.franchies.edit');
Route::post('admin/franchies/update/{id}', [App\Http\Controllers\Admin\FranchiesController::class, 'update'])->name('admin.franchies.update');
Route::get('admin/franchies/setting/{id}', [App\Http\Controllers\Admin\FranchiesController::class, 'setting'])->name('admin.franchies.setting');
Route::post('admin/franchies/update_setting/{id}', [App\Http\Controllers\Admin\FranchiesController::class, 'update_setting'])->name('admin.franchies.update_setting');
Route::get('admin/franchies/delete/{id}', [App\Http\Controllers\Admin\FranchiesController::class, 'destroy'])->name('admin.franchies.destory');
 
# Franchies Department
Route::get('admin/franchies/department/view/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'view'])->name('admin.franchies.department');
Route::get('admin/franchies/department/departmentlist/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'departmentList'])->name('admin.franchies.department.departmentlist');
Route::get('admin/franchies/department/departmentDetail/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'departmentDetail'])->name('admin.franchies.department.departmentDetail');
Route::get('admin/franchies/department/edit/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'edit'])->name('employee.franchies.departments.edit');
Route::post('admin/franchies/department/update/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'update'])->name('employee.departments.update');


# Franchies Zone
Route::get('admin/franchies/zone/zonelist/{id}', [App\Http\Controllers\Admin\ZoneController::class, 'zonelist'])->name('admin.franchies.zone.zonelist');
Route::get('admin/franchies/zone/zoneDetail/{id}', [App\Http\Controllers\Admin\ZoneController::class, 'zoneDetail'])->name('admin.franchies.zone.zoneDetail');

# Franchies Team

Route::get('admin/franchies/team/teamlist/{id}', [App\Http\Controllers\Admin\TeamController::class, 'teamList'])->name('admin.franchies.team.teamlist');
Route::get('admin/franchies/team/teamDetail/{id}', [App\Http\Controllers\Admin\TeamController::class, 'teamDetail'])->name('admin.franchies.team.teamDetail');
Route::get('admin/franchies/team/teamEdit/{id}', [App\Http\Controllers\Admin\TeamController::class, 'teamEdit'])->name('admin.franchies.team.teamEdit');
Route::post('admin/franchies/team/update/{id}', [App\Http\Controllers\Admin\TeamController::class, 'teamUpdate'])->name('admin.franchies.team.teamUpdate');
// Route::post('admin/franchies/team/teamUpdateall/{id}', [App\Http\Controllers\Admin\TeamController::class, 'teamUpdateall'])->name('admin.franchies.team.teamUpdateall');
# Franchies Team Restaurant
Route::get('admin/franchies/team/restaurant/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'view'])->name('admin.franchies.team.restaurant');
Route::get('admin/franchies/team/restaurant/view/restaurantDetail/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'restaurantDetail'])->name('admin.franchies.team.view.restaurantDetail');
Route::get('admin/franchies/team/restaurantedit/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'restaurantedit'])->name('admin.franchies.team.restaurantedit');
Route::post('admin/franchies/team/restauranteupdate/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'restauranteupdate'])->name('admin.franchies.team.restauranteupdate');
# Franchies Team Rider
Route::get('admin/franchies/team/rider/{id}', [App\Http\Controllers\Admin\RiderController::class, 'riderList'])->name('admin.franchies.team.rider');
Route::get('admin/franchies/team/rider/riderDetail/{id}', [App\Http\Controllers\Admin\RiderController::class, 'riderDetail'])->name('admin.franchies.team.view.riderDetail');
Route::get('admin/franchies/team/rider/riderEdit/{id}', [App\Http\Controllers\Admin\RiderController::class, 'riderEdit'])->name('admin.franchies.team.view.riderEdit');
Route::post('admin/franchies/team/rider/riderUpdate/{id}', [App\Http\Controllers\Admin\RiderController::class, 'riderUpdate'])->name('admin.franchies.team.view.riderUpdate');

# Franchies Team Product
Route::get('admin/franchies/team/product/{id}', [App\Http\Controllers\Admin\FoodController::class, 'productList'])->name('admin.franchies.team.product');
Route::get('admin/franchies/team/product/view/productDetail/{id}', [App\Http\Controllers\Admin\FoodController::class, 'productDetail'])->name('admin.franchies.team.view.productDetail');
Route::get('admin/franchies/team/productEdit/{id}', [App\Http\Controllers\Admin\FoodController::class, 'productEdit'])->name('admin.franchies.team.productEdit');
Route::post('admin/franchies/team/productEdit/{id}', [App\Http\Controllers\Admin\FoodController::class, 'productupdate'])->name('admin.franchies.team.productupdate');


// ?sdjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj

// RoleController
Route::get('admin/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.role');
Route::get('admin/role/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('admin.role.create');
Route::post('admin/role/insert', [App\Http\Controllers\Admin\RoleController::class, 'insert'])->name('admin.role.insert');
Route::get('admin/role/edit/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('admin.role.edit');
Route::post('admin/role/update/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('admin.role.update');
Route::get('admin/role/delete/{id}', [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('admin.role.destory');


//restuarant
Route::get('admin/restaurants', [App\Http\Controllers\Admin\RestaurantController::class, 'index'])->name('admin.restaurants');
Route::get('admin/restaurants/create', [App\Http\Controllers\Admin\RestaurantController::class, 'create'])->name('admin.restaurants.create');
Route::post('admin/restaurants/insert', [App\Http\Controllers\Admin\RestaurantController::class, 'insert'])->name('admin.restaurants.insert');
Route::get('admin/restaurants/edit/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'edit'])->name('admin.restaurants.edit');
Route::get('admin/restaurants/view/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'view'])->name('admin.restaurants.view');
Route::post('admin/restaurants/update/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'update'])->name('admin.restaurants.update');
Route::get('admin/restaurants/foods/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'view'])->name('admin.restaurants.foods');
Route::get('admin/restaurants/orders/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'view'])->name('admin.restaurants.orders');
Route::get('admin/restaurants/coupons/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'view'])->name('admin.restaurants.coupons');
Route::get('admin/restaurants/payout/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'view'])->name('admin.restaurants.payout');


//RequestController
Route::get('admin/restaurants/request', [App\Http\Controllers\Admin\RequestController::class, 'index'])->name('admin.restaurants.request');
Route::get('admin/restaurants/request/view/{id}', [App\Http\Controllers\Admin\RequestController::class, 'view'])->name('admin.restaurants.request.view');
Route::get('admin/restaurants/request/edit/{id}', [App\Http\Controllers\Admin\RequestController::class, 'edit'])->name('admin.restaurants.request.edit');
Route::post('admin/restaurants/request/update/{id}', [App\Http\Controllers\Admin\RequestController::class, 'Update'])->name('admin.restaurants.request.update');
Route::get('admin/restaurant/request/{id}', [App\Http\Controllers\Admin\RequestController::class, 'show']);


Route::get('admin/rider/request', [App\Http\Controllers\Admin\RequestController::class, 'riderList'])->name('admin.rider.request');
Route::get('admin/rider/request/view/{id}', [App\Http\Controllers\Admin\RequestController::class, 'riderDetail'])->name('admin.rider.request.view');
Route::get('admin/rider/request/edit/{id}', [App\Http\Controllers\Admin\RequestController::class, 'riderEdit'])->name('admin.rider.request.edit');
Route::post('admin/rider/request/approvalUpdate/{id}', [App\Http\Controllers\Admin\RequestController::class, 'approvalUpdate'])->name('admin.rider.request.approvalUpdate');
Route::get('admin/rider/request/{id}', [App\Http\Controllers\Admin\RequestController::class, 'showRider']);
Route::post('admin/drivers/request/update/{id}',[App\Http\Controllers\Admin\RequestController::class,'updateRider'])->name('admin.drivers.request.update');
Route::get('admin/drivers/request/{id}', [App\Http\Controllers\Admin\RequestController::class, 'showEmployeeDetails'])->name('admin.drivers.showEmployeeDetails');
Route::get('admin/drivers/showteamrequest/{id}', [App\Http\Controllers\Admin\RequestController::class, 'showteamDetails'])->name('admin.drivers.showteamDetails');
Route::get('admin/drivers/showFranchiesDetails/{id}', [App\Http\Controllers\Admin\RequestController::class, 'showFranchiesDetails'])->name('admin.drivers.showFranchiesDetails');

Route::get('admin/product/request', [App\Http\Controllers\Admin\RequestController::class, 'productList'])->name('admin.product.request');
Route::get('admin/product/request/view/{id}', [App\Http\Controllers\Admin\RequestController::class, 'productDetail'])->name('admin.product.request.view');
Route::get('admin/product/request/edit/{id}', [App\Http\Controllers\Admin\RequestController::class, 'productEdit'])->name('admin.product.request.edit');
Route::post('admin/product/request/approvalUpdate/{id}', [App\Http\Controllers\Admin\RequestController::class, 'approvalProduct'])->name('admin.product.request.approvalUpdate');
Route::get('admin/product/request/{id}', [App\Http\Controllers\Admin\RequestController::class, 'showProduct']);
Route::post('admin/product/request/update/{id}',[App\Http\Controllers\Admin\RequestController::class,'updateProduct'])->name('admin.product.request.update');

Route::get('admin/rider/request/franchiesName/{id}', [App\Http\Controllers\Admin\RequestController::class, 'showFranchiesDetails']);
Route::get('admin/rider/request/employeeName/{id}', [App\Http\Controllers\Admin\RequestController::class, 'showEmployeeDetails']);
Route::get('admin/rider/request/teamName/{id}', [App\Http\Controllers\Admin\RequestController::class, 'showTeamDetails']);



Route::get('admin/foods/{id}', [App\Http\Controllers\Admin\FoodController::class, 'index'])->name('restaurants.foods');
Route::get('admin/food/create/{id}', [App\Http\Controllers\Admin\FoodController::class, 'create']);

//users
Route::get('admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
Route::get('admin/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
Route::post('admin/users/insert', [App\Http\Controllers\Admin\UserController::class, 'insert'])->name('admin.users.insert');
Route::get('admin/users/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
Route::post('admin/users/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
Route::get('admin/users/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('admin.users.delete');
Route::get('admin/users/view/{id}', [App\Http\Controllers\Admin\UserController::class, 'view'])->name('admin.users.view');
Route::get('admin/users/orders/{id}', [App\Http\Controllers\Admin\UserController::class, 'orders'])->name('admin.users.orders');
Route::get('admin/users/order_details/{id}', [App\Http\Controllers\Admin\UserController::class, 'order_details'])->name('admin.users.order_details');
Route::get('admin/users/order/pdf/{id}',[App\Http\Controllers\Admin\UserController::class,'downloadPDF'])->name('admin.users.order.pdf');

Route::get('admin/users/payout/{id}', [App\Http\Controllers\Admin\UserController::class, 'payout'])->name('admin.users.payout');
Route::get('admin/users/profile', [App\Http\Controllers\Admin\UserController::class, 'profile'])->name('admin.users.profile');
Route::get('admin/users/qr', [App\Http\Controllers\Admin\UserController::class, 'qr'])->name('admin.users.qr');
// Route::post('admin/users/profile/update/{id}', [App\Http\Admin\Controllers\UserController::class, 'update'])->name('admin.users.profile.update');



//driver
Route::get('admin/drivers', [App\Http\Controllers\Admin\DriverController::class, 'index'])->name('admin.drivers');
Route::get('admin/drivers/create', [App\Http\Controllers\Admin\DriverController::class, 'create'])->name('admin.drivers.create');
Route::post('admin/drivers/insert',[App\Http\Controllers\Admin\DriverController::class,'insert'])->name('admin.drivers.insert');
Route::get('admin/drivers/edit/{id}', [App\Http\Controllers\Admin\DriverController::class, 'edit'])->name('admin.drivers.edit');
Route::post('admin/drivers/update/{id}', [App\Http\Controllers\Admin\DriverController::class, 'update'])->name('admin.drivers.update');
Route::get('admin/drivers/delete/{id}', [App\Http\Controllers\Admin\DriverController::class, 'delete'])->name('admin.drivers.delete');
Route::get('admin/drivers/view/{id}', [App\Http\Controllers\Admin\DriverController::class, 'view'])->name('admin.drivers.view');
Route::get('admin/drivers/orders/{id}', [App\Http\Controllers\Admin\DriverController::class, 'orders'])->name('admin.drivers.orders');
Route::get('admin/drivers/orders/edit/{id}', [App\Http\Controllers\Admin\DriverController::class, 'edit_order'])->name('admin.drivers.orders.edit');
Route::get('admin/drivers/order/pdf/{id}',[App\Http\Controllers\Admin\DriverController::class,'downloadPDF'])->name('admin.drivers.order.pdf');


//coupons
Route::get('admin/coupons', [App\Http\Controllers\Admin\CouponController::class, 'index'])->name('admin.coupons');
Route::get('admin/coupons/edit/{id}', [App\Http\Controllers\Admin\CouponController::class, 'edit'])->name('admin.coupons.edit');
Route::post('admin/coupons/update/{id}',[App\Http\Controllers\Admin\CouponController::class, 'update'])->name('admin.coupons.update');
Route::get('admin/coupons/create', [App\Http\Controllers\Admin\CouponController::class, 'create'])->name('admin.coupons.create');
Route::post('admin/coupons/insert', [App\Http\Controllers\Admin\CouponController::class, 'insert'])->name('admin.coupons.insert');

//Gift Cards Amount
Route::get('admin/gift_card_amount', [App\Http\Controllers\Admin\GiftCardAmount::class, 'index'])->name('admin.gift_card_amount');
Route::get('admin/gift_card_amount/create', [App\Http\Controllers\Admin\GiftCardAmount::class, 'create'])->name('admin.gift_card_amount.create');
Route::post('admin/gift_card_amount/insert', [App\Http\Controllers\Admin\GiftCardAmount::class, 'insert'])->name('admin.gift_card_amount.insert');
Route::get('admin/gift_card_amount/edit/{id}', [App\Http\Controllers\Admin\GiftCardAmount::class, 'edit'])->name('admin.gift_card_amount.edit');
Route::post('admin/gift_card_amount/update/{id}',[App\Http\Controllers\Admin\GiftCardAmount::class, 'update'])->name('admin.gift_card_amount.update');
Route::get('admin/gift_card_amount/delete/{id}',[App\Http\Controllers\Admin\GiftCardAmount::class, 'delete'])->name('admin.gift_card_amount.delete');

//Gift Cards
Route::get('admin/gift_card', [App\Http\Controllers\Admin\GiftCard::class, 'index'])->name('admin.gift_card');
Route::get('admin/gift_card/create', [App\Http\Controllers\Admin\GiftCard::class, 'create'])->name('admin.gift_card.create');
Route::post('admin/gift_card/insert', [App\Http\Controllers\Admin\GiftCard::class, 'insert'])->name('admin.gift_card.insert');
Route::get('admin/gift_card/edit/{id}', [App\Http\Controllers\Admin\GiftCard::class, 'edit'])->name('admin.gift_card.edit');
Route::post('admin/gift_card/update/{id}',[App\Http\Controllers\Admin\GiftCard::class, 'update'])->name('admin.gift_card.update');
Route::get('admin/gift_card/delete/{id}',[App\Http\Controllers\Admin\GiftCard::class, 'delete'])->name('admin.gift_card.delete');

//Gift Cards Orders
Route::get('admin/gift_card_order', [App\Http\Controllers\Admin\GiftCardOrder::class, 'index'])->name('admin.gift_card_order');
Route::get('admin/gift_card_order/create', [App\Http\Controllers\Admin\GiftCardOrder::class, 'create'])->name('admin.gift_card_order.create');
Route::post('admin/gift_card_order/insert', [App\Http\Controllers\Admin\GiftCardOrder::class, 'insert'])->name('admin.gift_card_order.insert');
Route::get('admin/gift_card_order/edit/{id}', [App\Http\Controllers\Admin\GiftCardOrder::class, 'edit'])->name('admin.gift_card_order.edit');
Route::get('admin/gift_card_order/view/{id}', [App\Http\Controllers\Admin\GiftCardOrder::class, 'view'])->name('admin.gift_card_order.view');
Route::post('admin/gift_card_order/update/{id}',[App\Http\Controllers\Admin\GiftCardOrder::class, 'update'])->name('admin.gift_card_order.update');
Route::get('admin/gift_card_order/delete/{id}',[App\Http\Controllers\Admin\GiftCardOrder::class, 'delete'])->name('admin.gift_card_order.delete');

//Filter Option
Route::get('admin/filter', [App\Http\Controllers\Admin\FilterOptions::class, 'index'])->name('admin.filter');
Route::get('admin/filter/create', [App\Http\Controllers\Admin\FilterOptions::class, 'create'])->name('admin.filter.create');
Route::post('admin/filter/insert', [App\Http\Controllers\Admin\FilterOptions::class, 'insert'])->name('admin.filter.insert');
Route::get('admin/filter/edit/{id}', [App\Http\Controllers\Admin\FilterOptions::class, 'edit'])->name('admin.filter.edit');
Route::post('admin/filter/update/{id}',[App\Http\Controllers\Admin\FilterOptions::class, 'update'])->name('admin.filter.update');
Route::get('admin/filter/delete/{id}',[App\Http\Controllers\Admin\FilterOptions::class, 'delete'])->name('admin.filter.delete');


//Notification
Route::get('admin/notification', [App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('admin.notification');
Route::get('admin/notification/create', [App\Http\Controllers\Admin\NotificationController::class, 'create'])->name('admin.notification.create');
Route::post('admin/notification/insert', [App\Http\Controllers\Admin\NotificationController::class, 'insert'])->name('admin.notification.insert');
Route::get('admin/notification/edit/{id}', [App\Http\Controllers\Admin\NotificationController::class, 'edit'])->name('admin.notification.edit');
Route::post('admin/notification/update/{id}',[App\Http\Controllers\Admin\NotificationController::class, 'update'])->name('admin.notification.update');
Route::get('admin/notification/delete/{id}',[App\Http\Controllers\Admin\NotificationController::class, 'delete'])->name('admin.notification.delete');


//Term and Conditions
Route::get('admin/termsAndConditions', [App\Http\Controllers\Admin\TermsAndConditionsController::class, 'index'])->name('admin.termsAndConditions');
Route::get('admin/termsAndConditions/create', [App\Http\Controllers\Admin\TermsAndConditionsController::class, 'create'])->name('admin.termsAndConditions.create');
Route::post('admin/termsAndConditions/insert', [App\Http\Controllers\Admin\TermsAndConditionsController::class, 'insert'])->name('admin.termsAndConditions.insert');
Route::get('admin/termsAndConditions/edit/{id}', [App\Http\Controllers\Admin\TermsAndConditionsController::class, 'edit'])->name('admin.termsAndConditions.edit');
Route::post('admin/termsAndConditions/update/{id}',[App\Http\Controllers\Admin\TermsAndConditionsController::class, 'update'])->name('admin.termsAndConditions.update');
Route::get('admin/termsAndConditions/delete/{id}',[App\Http\Controllers\Admin\TermsAndConditionsController::class, 'delete'])->name('admin.termsAndConditions.delete');

//Privacy Policy
Route::get('admin/privacyPolicy', [App\Http\Controllers\Admin\PrivacyPolicies::class, 'index'])->name('admin.privacyPolicy');
Route::get('admin/privacyPolicy/create', [App\Http\Controllers\Admin\PrivacyPolicies::class, 'create'])->name('admin.privacyPolicy.create');
Route::post('admin/privacyPolicy/insert', [App\Http\Controllers\Admin\PrivacyPolicies::class, 'insert'])->name('admin.privacyPolicy.insert');
Route::get('admin/privacyPolicy/edit/{id}', [App\Http\Controllers\Admin\PrivacyPolicies::class, 'edit'])->name('admin.privacyPolicy.edit');
Route::post('admin/privacyPolicy/update/{id}',[App\Http\Controllers\Admin\PrivacyPolicies::class, 'update'])->name('admin.privacyPolicy.update');
Route::get('admin/privacyPolicy/delete/{id}',[App\Http\Controllers\Admin\PrivacyPolicies::class, 'delete'])->name('admin.privacyPolicy.delete');

//Privacy Policy
Route::get('admin/payments', [App\Http\Controllers\Admin\AdminPaymentsController::class, 'index'])->name('admin.payments');
Route::get('admin/payments/create', [App\Http\Controllers\Admin\AdminPaymentsController::class, 'create'])->name('admin.payments.create');
Route::post('admin/payments/insert', [App\Http\Controllers\Admin\AdminPaymentsController::class, 'insert'])->name('admin.payments.insert');
Route::get('admin/payments/edit/{id}', [App\Http\Controllers\Admin\AdminPaymentsController::class, 'edit'])->name('admin.payments.edit');
Route::post('admin/payments/update/{id}',[App\Http\Controllers\Admin\AdminPaymentsController::class, 'update'])->name('admin.payments.update');
Route::get('admin/payments/delete/{id}',[App\Http\Controllers\Admin\AdminPaymentsController::class, 'delete'])->name('admin.payments.delete');




Route::get('lang/change', [App\Http\Controllers\Admin\LangController::class, 'change'])->name('changeLang');

Route::post('payments/razorpay/createorder', [App\Http\Controllers\Admin\RazorPayController::class, 'createOrderid']);

Route::post('payments/getpaytmchecksum', [App\Http\Controllers\Admin\PaymentController::class, 'getPaytmChecksum']);

Route::post('payments/validatechecksum', [App\Http\Controllers\Admin\PaymentController::class, 'validateChecksum']);

Route::post('payments/initiatepaytmpayment', [App\Http\Controllers\Admin\PaymentController::class, 'initiatePaytmPayment']);

Route::get('payments/paytmpaymentcallback', [App\Http\Controllers\Admin\PaymentController::class, 'paytmPaymentcallback']);

Route::post('payments/paypalclientid', [App\Http\Controllers\Admin\PaymentController::class, 'getPaypalClienttoken']);

Route::post('payments/paypaltransaction', [App\Http\Controllers\Admin\PaymentController::class, 'createBraintreePayment']);

Route::post('payments/stripepaymentintent', [App\Http\Controllers\Admin\PaymentController::class, 'createStripePaymentIntent']);




Route::get('admin/orders', [App\Http\Controllers\Admin\HomeController::class, 'users'])->name('admin.orders');

Route::get('/vendors', [App\Http\Controllers\Admin\RestaurantController::class, 'vendors'])->name('vendors');



Route::get('admin/coupon/{id}', [App\Http\Controllers\CouponController::class, 'index'])->name('restaurants.coupons');



Route::get('/coupon/create/{id}', [App\Http\Controllers\Admin\CouponController::class, 'create']);

Route::get('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('restaurants.orders');

Route::get('/restaurants/promos/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'promos'])->name('restaurants.promos');

Route::get('/coupons/create/{id}', [App\Http\Controllers\Admin\CouponController::class, 'create']);



Route::get('/restaurantFilters', [App\Http\Controllers\Admin\RestaurantFiltersController::class, 'index'])->name('restaurantFilters');

Route::get('/restaurantFilters/create', [App\Http\Controllers\Admin\RestaurantFiltersController::class, 'create'])->name('restaurantFilters.create');

Route::get('/restaurantFilters/edit/{id}', [App\Http\Controllers\Admin\RestaurantFiltersController::class, 'edit'])->name('restaurantFilters.edit');




Route::get('admin/orders/', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders');
Route::get('/admin/orders/fetch', [App\Http\Controllers\Admin\OrderController::class, 'fetchOrders'])->name('admin.orders.fetch');



Route::get('admin/get_self_order', [App\Http\Controllers\Admin\OrderController::class, 'get_self_order'])->name('admin.get_self_order');
Route::get('admin/orders/edit/{id}', [App\Http\Controllers\Admin\OrderController::class, 'edit'])->name('admin.orders.edit');
Route::get('admin/orders/pdf/{id}', [App\Http\Controllers\Admin\OrderController::class, 'downloadPDF'])->name('admin.orders.pdf');
Route::get('admin/orders/delete/{id}', [App\Http\Controllers\Admin\OrderController::class, 'delete'])->name('admin.orders.delete');
Route::get('admin/orderReview', [App\Http\Controllers\Admin\OrderReviewController::class, 'index'])->name('admin.orderReview');
Route::get('admin/orderReview/edit/{id}', [App\Http\Controllers\Admin\OrderReviewController::class, 'edit'])->name('admin.orderReview.edit');



Route::get('driverpayments', [App\Http\Controllers\Admin\AdminPaymentsController::class, 'driverIndex'])->name('driver.driverpayments');
Route::get('restaurantsPayouts', [App\Http\Controllers\Admin\RestaurantsPayoutController::class, 'index'])->name('restaurantsPayouts');
Route::get('restaurantsPayouts/create', [App\Http\Controllers\Admin\RestaurantsPayoutController::class, 'create'])->name('restaurantsPayouts.create');
Route::get('/restaurantsPayout/{id}', [App\Http\Controllers\Admin\RestaurantsPayoutController::class, 'index'])->name('restaurants.payout');
Route::get('/restaurantsPayouts/create/{id}', [App\Http\Controllers\Admin\RestaurantsPayoutController::class, 'create']);
Route::get('driversPayouts', [App\Http\Controllers\Admin\DriversPayoutController::class, 'index'])->name('driversPayouts');
Route::get('driversPayouts/create', [App\Http\Controllers\Admin\DriversPayoutController::class, 'create'])->name('driversPayouts.create');

Route::get('driverPayout/{id}', [App\Http\Controllers\Admin\DriversPayoutController::class, 'index'])->name('driver.payout');

Route::get('driverPayout/create/{id}', [App\Http\Controllers\Admin\DriversPayoutController::class, 'create'])->name('driver.payout.create');

Route::get('walletstransaction', [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('walletstransaction');

Route::get('admin/walletstransaction/{id}', [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('admin.users.walletstransaction');


// Route::prefix('settings')->group(function () {

//     Route::get('/currencies', [App\Http\Controllers\Admin\CurrencyController::class, 'index'])->name('currencies');
//     Route::get('/currencies/edit/{id}', [App\Http\Controllers\Admin\CurrencyController::class, 'edit'])->name('currencies.edit');
//     Route::get('/currencies/create', [App\Http\Controllers\Admin\CurrencyController::class, 'create'])->name('currencies.create');
//     Route::get('app/globals', [App\Http\Controllers\Admin\SettingsController::class, 'globals'])->name('settings.app.globals');
//     Route::get('app/adminCommission', [App\Http\Controllers\Admin\SettingsController::class, 'adminCommission'])->name('settings.app.adminCommission');
//     Route::get('app/radiusConfiguration', [App\Http\Controllers\Admin\SettingsController::class, 'radiosConfiguration'])->name('settings.app.radiusConfiguration');
//     Route::get('app/bookTable', [App\Http\Controllers\Admin\SettingsController::class, 'bookTable'])->name('settings.app.bookTable');
//     Route::get('app/vatSetting', [App\Http\Controllers\Admin\SettingsController::class, 'vatSetting'])->name('settings.app.vatSetting');
//     Route::get('app/deliveryCharge', [App\Http\Controllers\Admin\SettingsController::class, 'deliveryCharge'])->name('settings.app.deliveryCharge');
//     Route::get('mobile/globals', [App\Http\Controllers\Admin\SettingsController::class, 'mobileGlobals'])->name('settings.mobile.globals');
//     Route::get('payment/stripe', [App\Http\Controllers\Admin\SettingsController::class, 'stripe'])->name('payment.stripe');
//     Route::get('payment/applepay', [App\Http\Controllers\Admin\SettingsController::class, 'applepay'])->name('payment.applepay');
//     Route::get('payment/razorpay', [App\Http\Controllers\Admin\SettingsController::class, 'razorpay'])->name('payment.razorpay');
//     Route::get('payment/cod', [App\Http\Controllers\Admin\SettingsController::class, 'cod'])->name('payment.cod');
//     Route::get('payment/paypal', [App\Http\Controllers\Admin\SettingsController::class, 'paypal'])->name('payment.paypal');
//     Route::get('payment/paytm', [App\Http\Controllers\Admin\SettingsController::class, 'paytm'])->name('payment.paytm');
//     Route::get('payment/wallet', [App\Http\Controllers\Admin\SettingsController::class, 'wallet'])->name('payment.wallet');
//     Route::get('payment/payfast', [App\Http\Controllers\Admin\SettingsController::class, 'payfast'])->name('payment.payfast');
//     Route::get('payment/paystack', [App\Http\Controllers\Admin\SettingsController::class, 'paystack'])->name('payment.paystack');
//     Route::get('payment/flutterwave', [App\Http\Controllers\Admin\SettingsController::class, 'flutterwave'])->name('payment.flutterwave');
//     Route::get('payment/mercadopago', [App\Http\Controllers\Admin\SettingsController::class, 'mercadopago'])->name('payment.mercadopago');
//     Route::get('app/languages', [App\Http\Controllers\Admin\SettingsController::class, 'languages'])->name('settings.app.languages');
//     Route::get('app/languages/create', [App\Http\Controllers\Admin\SettingsController::class, 'languagescreate'])->name('settings.app.languages.create');
//     Route::get('app/languages/edit/{id}', [App\Http\Controllers\Admin\SettingsController::class, 'languagesedit'])->name('settings.app.languages.edit');
//     Route::get('app/specialOffer', [App\Http\Controllers\Admin\SettingsController::class, 'specialOffer'])->name('setting.specialOffer');
//     Route::get('app/story', [App\Http\Controllers\Admin\SettingsController::class, 'story'])->name('setting.story');
// });

Route::get('/booktable/{id}', [App\Http\Controllers\Admin\BookTableController::class, 'index'])->name('restaurants.booktable');

Route::get('/booktable/edit/{id}', [App\Http\Controllers\Admin\BookTableController::class, 'edit'])->name('booktable.edit');






Route::get('admin/payoutRequests/drivers', [App\Http\Controllers\Admin\PayoutRequestController::class, 'index'])->name('admin.payoutRequests.drivers');

Route::get('admin/payoutRequests/drivers/{id}', [App\Http\Controllers\Admin\PayoutRequestController::class, 'index'])->name('admin.payoutRequests.drivers.view');

Route::get('admin/payoutRequests/restaurants', [App\Http\Controllers\Admin\PayoutRequestController::class, 'restaurant'])->name('admin.payoutRequests.restaurants');

Route::get('admin/payoutRequests/restaurants/{id}', [App\Http\Controllers\Admin\PayoutRequestController::class, 'restaurant'])->name('admin.payoutRequests.restaurants.view');

Route::get('order_transactions', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('order_transactions');

Route::get('/order_transactions/{id}', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('order_transactions.index');

Route::get('/orders/print/{id}', [App\Http\Controllers\Admin\OrderController::class, 'orderprint'])->name('vendors.orderprint');


Route::get('payment/success', [App\Http\Controllers\Admin\PaymentController::class, 'paymentsuccess'])->name('payment.success');

Route::get('payment/failed', [App\Http\Controllers\Admin\PaymentController::class, 'paymentfailed'])->name('payment.failed');

Route::get('payment/pending', [App\Http\Controllers\Admin\PaymentController::class, 'paymentpending'])->name('payment.pending');


Route::get('/reviewattributes/edit/{id}', [App\Http\Controllers\Admin\ReviewAttributeController::class, 'edit'])->name('reviewattributes.edit');

Route::get('/reviewattributes/create', [App\Http\Controllers\Admin\ReviewAttributeController::class, 'create'])->name('reviewattributes.create');

Route::get('footerTemplate', [App\Http\Controllers\Admin\SettingsController::class, 'footerTemplate'])->name('footerTemplate');

Route::get('/homepageTemplate', [App\Http\Controllers\Admin\SettingsController::class, 'homepageTemplate'])->name('homepageTemplate');

Route::get('cms', [App\Http\Controllers\Admin\CmsController::class, 'index'])->name('cms');

Route::get('/cms/edit/{id}', [App\Http\Controllers\Admin\CmsController::class, 'edit'])->name('cms.edit');

Route::get('/cms/create', [App\Http\Controllers\Admin\CmsController::class, 'create'])->name('cms.create');



//************************* Partner Restaurant panel  *************************************************************************************




// Route::prefix('Partner_admin')->group(function () {
    
// });