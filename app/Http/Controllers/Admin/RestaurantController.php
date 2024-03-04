<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\RestaurantAdmin;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\GalleryImage;
use App\Models\DineGallery;
use App\Models\RestaurantOffer;
use App\Models\RestaurantWorkingHour;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class RestaurantController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
    {
        $restaurant = Restaurant::all();
        return view("admin.restaurants.index",compact('restaurant'));
    }
    
    public function create(){
        $category = Category::all();
        return view("admin.restaurants.create",compact('category'));
    }
    
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'restaurant_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            // Add validation rules for other fields if needed
            'restaurant_name' => 'required',
            'category_id' => 'required',
            'restaurant_phone' => 'required', 
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Upload and save the profile image
        $profile = $this->uploadImage($request, 'image', 'images/restaurants/profile');
    
        // Create a new RestaurantAdmin record
        $admin = RestaurantAdmin::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'image' => $profile,
        ]);
    
        if (!$admin->id) {
            return redirect()->back()->with('error', 'Error creating restaurant admin.')->withInput();
        }
    
        // Upload and save the restaurant image
        $restaurant_image = $this->uploadImage($request, 'restaurant_image', 'images/restaurants');
    
        // Create a new Restaurant record
        $restaurant = Restaurant::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'mobile_no' => $request->phone,
            'profile_image' => $profile,
            'name' => $request->restaurant_name,
            'category_id' => $request->category_id,
            'phone' => $request->restaurant_phone,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description,
            'image' => $restaurant_image,
            'restaurant_status' => $request->restaurant_status, 
            'restaurants_admin_id' => $admin->id,
            'services' => json_encode($request->services),
            'charge_within_km' => $request->charge_within_km, 
            'charges_km_min' => $request->charges_km_min, 
            'charges_per_km' => $request->charges_per_km, 
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'holder_name' => $request->holder_name,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code,
            'other_information' => $request->other_information,
        ]);
    
        if (!$restaurant->id) {
            $admin->delete(); 
            return redirect()->back()->with('error', 'Error creating restaurant.')->withInput();
        }
    
        // Save the working hours
        $days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
        foreach ($days as $day) {
            if ($request->has($day . '_start') && $request->has($day . '_end')) {
                $starts = $request->input($day . '_start');
                $ends = $request->input($day . '_end');
                $workingHours = [];
        
                foreach ($starts as $index => $start) {
                    $end = $ends[$index];
                    if (!empty($start) && !empty($end)) {
                        $workingHours[] = [
                            'start_time' => $start,
                            'end_time' => $end,
                        ];
                    }
                }
        
                if (!empty($workingHours)) {
                    foreach ($workingHours as $timeSlot) {
                        $startTime = $timeSlot['start_time'];
                        $endTime = $timeSlot['end_time'];
                
                        RestaurantWorkingHour::create([
                            'restaurant_id' => $restaurant->id,
                            'day_of_week' => $day,
                            'start_time' => $startTime,
                            'end_time' => $endTime,
                        ]);
                    }
                }
            }
        }
    
        // Save dine feature if enabled
        // if ($request->enable_dine == 1) { 
        //     $restaurant->update([
        //         'enable_dine' => $request->enable_dine,
        //         'dine_open_time' => $request->dine_open_time,
        //         'dine_close_time' => $request->dine_close_time,
        //         'dine_cost_price' => $request->dine_cost_price,
        //     ]);
    
        //     if ($request->hasFile('dine_image')) {
        //         $dine_image = $this->uploadImage($request, 'dine_image', 'images/restaurants/dine');
        //         $restaurant->update([
        //             'dine_image' => $dine_image,
        //         ]);
        //     }
        // }
    
        if ($request->enable_dine == 1) {
            if ($request->hasFile('dine_images')) {
                $dineImages = [];
        
                foreach ($request->file('dine_images') as $image) {
                    try {
                        $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images/restaurants/dine'), $image_name);
                        $dineImages[] = $image_name;
                    } catch (\Exception $e) {
                        return redirect()->back()->with('error', 'Error uploading dine images.');
                    }
                }
        
                $updateData = [
                    'enable_dine' => $request->enable_dine,
                    'dine_open_time' => $request->dine_open_time,
                    'dine_close_time' => $request->dine_close_time,
                    'dine_cost_price' => $request->dine_cost_price,
                ];
        
                
                $restaurant->update($updateData);
        
                foreach ($dineImages as $dine_image) {
                    DineGallery::create([
                        'resturant_id' => $restaurant->id, 
                        'dine_images' => $dine_image,
                    ]);
                }
            }
        }
    
        // Save special offers
        foreach ($days as $day) {
            if ($request->has($day . '_start_offer') && $request->has($day . '_end_offer') && $request->has($day . '_discount') && $request->has($day . '_discount_type') && $request->has($day . '_delivery_type')) {
                $starts = $request->input($day . '_start_offer');
                $ends = $request->input($day . '_end_offer');
                $discounts = $request->input($day . '_discount');
                $discount_types = $request->input($day . '_discount_type');
                $delivery_types = $request->input($day . '_delivery_type');
                $special_offers = [];
    
                foreach ($starts as $index => $start) {
                    $end = $ends[$index];
                    $discount = $discounts[$index];
                    $discount_type = $discount_types[$index];
                    $delivery_type = $delivery_types[$index];
                    if (!empty($start) && !empty($end) && !empty($discount) && !empty($discount_type) && !empty($delivery_type)) {
                        $special_offers[] = [
                            'start_time' => $start,
                            'end_time' => $end,
                            'discount' => $discount,
                            'discount_type' => $discount_type,
                            'delivery_type' => $delivery_type,
                        ];
                    }
                }
    
                if (!empty($special_offers)) {
                    foreach ($special_offers as $timeSlot) {
                        $startTime = $timeSlot['start_time'];
                        $endTime = $timeSlot['end_time'];
                        $discountT = $timeSlot['discount'];
                        $discountType = $timeSlot['discount_type'];
                        $deliveryType = $timeSlot['delivery_type'];
    
                        RestaurantOffer::create([
                            'restaurant_id' => $restaurant->id,
                            'day_of_week' => $day,
                            'opening_time' => $startTime,
                            'closing_time' => $endTime,
                            'discount' => $discountT,
                            'discount_sign' => $discountType,
                            'discount_type' => $deliveryType,
                        ]);
                    }
                }
            }
        }
    
        // Save gallery images if provided
        if ($request->hasFile('gallery_images')) {
            $gallery_images = [];
    
            foreach ($request->file('gallery_images') as $image) {
                try {
                    $image_name = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images/restaurants/gallery'), $image_name);
                    $gallery_images[] = $image_name;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error uploading one or more images.')->withInput();
                }
            }
    
            foreach ($gallery_images as $gallery_image) {
                GalleryImage::create([
                    'restaurant_id' => $restaurant->id,
                    'image_path' =>$gallery_image,
                ]);
            }
        }
    
        return redirect()->route('admin.restaurants')->with('success', 'Restaurant added successfully.');
    }

  
    public function vendors()
    {
        echo 'Coming soon...'; die();
        return view("vendors.index");
    }


    
    public function edit($id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id);
            $restaurant_admin = RestaurantAdmin::findOrFail($restaurant->restaurants_admin_id);
            $categories = Category::all(); // Assuming you have a Category model
    
            // Retrieve working hours for each day
            $days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
            $workingHours = [];
            foreach ($days as $day) {
                $workingHours[$day] = RestaurantWorkingHour::where('restaurant_id', $id)->where('day_of_week', $day)->get();
            }
    
            // Retrieve special offers for each day
            $specialOffers = [];
            foreach ($days as $day) {
                $specialOffers[$day] = RestaurantOffer::where('restaurant_id', $id)->where('day_of_week', $day)->get();
            }
    
            // Retrieve gallery images
            $galleryImages = GalleryImage::where('restaurant_id', $id)->get();
            $dineImages = DineGallery::where('resturant_id', $id)->get();
    
            // Pass all the data to the view
            return view('admin.restaurants.edit', compact('restaurant', 'categories', 'restaurant_admin', 'workingHours', 'specialOffers', 'galleryImages','dineImages','days'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Handle the case when either the restaurant or the restaurant admin is not found.
            // For example, return an error response or redirect back with an error message.
            // Example: return redirect()->back()->withErrors(['message' => 'Restaurant or Admin not found']);
        }
    }

   
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'restaurant_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'restaurant_name' => 'required',
            'category_id' => 'required',
            'restaurant_phone' => 'required', 
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $admin = RestaurantAdmin::find($id);
        
        if (!$admin) {
            return redirect()->back()->with('error', 'Restaurant admin not found.')->withInput();
        }
    
        // Update the RestaurantAdmin record
        $admin->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
        ]);
    
        // Upload and save the profile image if provided
        $profile=null;
        if ($request->hasFile('profile_image')) {
            $profile = $this->uploadImage($request, 'profile_image', 'images/restaurants/profile/');
            if($profile){
                $admin->update(['image' => $profile]);
            }
        }
        
        // dd($admin); 
        // $profile_img =$this->uploadImage($request, 'profile_image', 'images/restaurants/profile/');
        
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return redirect()->back()->with('error', 'Restaurant not found.')->withInput();
        }
        if($profile==null){
            $profile=$restaurant->profile_image;
        }
        // Update the Restaurant record
        $restaurant->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'mobile_no' => $request->phone,
            'profile_image' => $profile,
            'name' => $request->restaurant_name,
            'category_id' => $request->category_id,
            'phone' => $request->restaurant_phone,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description,
            'restaurant_status' => $request->restaurant_status,
            'services' => json_encode($request->services),
            'charge_within_km' => $request->charge_within_km,
            'charges_km_min' => $request->charges_km_min,
            'charges_per_km' => $request->charges_per_km,
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'holder_name' => $request->holder_name,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code,
            'other_information' => $request->other_information,
        ]);
    
    
    
        // Upload and save the restaurant image if provided
        if ($request->hasFile('restaurant_image')) {
            $restaurant_image = $this->uploadImage($request, 'restaurant_image', 'images/restaurants');
            $restaurant->update(['image' => $restaurant_image]);
        }
    
        // Update working hours
        $days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
        foreach ($days as $day) {
            if ($request->has($day . '_start') && $request->has($day . '_end')) {
                $starts = $request->input($day . '_start');
                $ends = $request->input($day . '_end');
                $workingHours = [];
    
                foreach ($starts as $index => $start) {
                    $end = $ends[$index];
                    if (!empty($start) && !empty($end)) {
                        $workingHours[] = [
                            'start_time' => $start,
                            'end_time' => $end,
                        ];
                    }
                }
               
                // Delete existing working hours and re-create them
                RestaurantWorkingHour::where('day_of_week', $day)->where('restaurant_id', $restaurant->id)->delete();
                foreach ($workingHours as $timeSlot) {
                    $startTime = $timeSlot['start_time'];
                    $endTime = $timeSlot['end_time'];
    
                    RestaurantWorkingHour::create([
                        'restaurant_id' => $restaurant->id,
                        'day_of_week' => $day,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                    ]);
                }
            }else{
                RestaurantWorkingHour::where('day_of_week', $day)->where('restaurant_id', $restaurant->id)->delete();
            }
        }
    
   
       if ($request->enable_dine == 1) {
            if ($request->hasFile('dine_images')) {
                $dineImages = [];
        
                foreach ($request->file('dine_images') as $image) {
                    try {
                        $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images/restaurants/dine'), $image_name);
                        $dineImages[] = $image_name;
                    } catch (\Exception $e) {
                        return redirect()->back()->with('error', 'Error uploading dine images.');
                    }
                }
        
                $updateData = [
                    'enable_dine' => $request->enable_dine,
                    'dine_open_time' => $request->dine_open_time,
                    'dine_close_time' => $request->dine_close_time,
                    'dine_cost_price' => $request->dine_cost_price,
                ];
        
                // Delete existing dine images from the folder and database
                $existingDineImages = DineGallery::where('resturant_id', $restaurant->id)->get(['dine_images']);
                foreach ($existingDineImages as $existingImage) {
                    $imagePath = public_path('images/restaurants/dine/' . $existingImage->dine_images);
                    if (file_exists($imagePath)) {
                        unlink($imagePath); // Unlink the file
                    }
                }
                DineGallery::where('resturant_id', $restaurant->id)->delete();
        
                $restaurant->update($updateData);
        
                foreach ($dineImages as $dine_image) {
                    DineGallery::create([
                        'resturant_id' => $restaurant->id, 
                        'dine_images' => $dine_image,
                    ]);
                }
            }
        } else {
            // Delete existing dine images from the folder and database
            $existingDineImages = DineGallery::where('resturant_id', $restaurant->id)->get(['dine_images']);
            foreach ($existingDineImages as $existingImage) {
                $imagePath = public_path('images/restaurants/dine/' . $existingImage->dine_images);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Unlink the file
                }
            }
            DineGallery::where('resturant_id', $restaurant->id)->delete();
        
            $restaurant->update([
                'enable_dine' => 0,
                'dine_open_time' => null,
                'dine_close_time' => null,
                'dine_cost_price' => null,
            ]);
        }

    
        // Update special offers
        foreach ($days as $day) {
            if ($request->has($day . '_start_offer') && $request->has($day . '_end_offer') && $request->has($day . '_discount') && $request->has($day . '_discount_type') && $request->has($day . '_delivery_type')) {
                $starts = $request->input($day . '_start_offer');
                $ends = $request->input($day . '_end_offer');
                $discounts = $request->input($day . '_discount');
                $discount_types = $request->input($day . '_discount_type');
                $delivery_types = $request->input($day . '_delivery_type');
                $special_offers = [];
    
                foreach ($starts as $index => $start) {
                    $end = $ends[$index];
                    $discount = $discounts[$index];
                    $discount_type = $discount_types[$index];
                    $delivery_type = $delivery_types[$index];
                    if (!empty($start) && !empty($end) && !empty($discount) && !empty($discount_type) && !empty($delivery_type)) {
                        $special_offers[] = [
                            'start_time' => $start,
                            'end_time' => $end,
                            'discount' => $discount,
                            'discount_type' => $discount_type,
                            'delivery_type' => $delivery_type,
                        ];
                    }
                }
    
                // Delete existing special offers and re-create them
                RestaurantOffer::where('day_of_week', $day)->where('restaurant_id', $restaurant->id)->delete();
                foreach ($special_offers as $timeSlot) {
                    $startTime = $timeSlot['start_time'];
                    $endTime = $timeSlot['end_time'];
                    $discountT = $timeSlot['discount'];
                    $discountType = $timeSlot['discount_type'];
                    $deliveryType = $timeSlot['delivery_type'];
    
                    RestaurantOffer::create([
                        'restaurant_id' => $restaurant->id,
                        'day_of_week' => $day,
                        'opening_time' => $startTime,
                        'closing_time' => $endTime,
                        'discount' => $discountT,
                        'discount_sign' => $discountType,
                        'discount_type' => $deliveryType,
                    ]);
                }
            }else{
                RestaurantOffer::where('day_of_week', $day)->where('restaurant_id', $restaurant->id)->delete();
            }
        }
    
        // Update gallery images if provided
        if ($request->hasFile('gallery_images')) {
            $gallery_images = [];
    
            foreach ($request->file('gallery_images') as $image) {
                try {
                    $image_name = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images/restaurants/gallery'), $image_name);
                    $gallery_images[] = $image_name;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error uploading one or more images.')->withInput();
                }
            }
    
            // Delete existing gallery images and re-create them
            GalleryImage::where('restaurant_id',$restaurant->id)->delete();
            foreach ($gallery_images as $gallery_image) {
                GalleryImage::create([
                    'restaurant_id' => $restaurant->id,
                    'image_path' => $gallery_image,
                ]);
            }
        }
    
        return redirect()->route('admin.restaurants')->with('success', 'Restaurant updated successfully.');
    }

    
    
    private function uploadImage($request, $fieldName, $folder)
    {
        if ($request->hasFile($fieldName)) {
            $image = $request->file($fieldName);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // Move the file to the specified folder
            $image->move(public_path($folder), $imageName);
    
            // Return the image name
            return $imageName;
        }
    
        return null;
    }
    
    
    // public function view($id)
    // {
    //     return view('admin.restaurants.view')->with('id',$id);
    // }

    public function payout($id)
    {
        return view('admin.restaurants.payout')->with('id',$id);
    }

    public function foods($id)
    {
        return view('admin.restaurants.foods')->with('id',$id);
    }

    public function orders($id)
    {
        return view('admin.restaurants.orders')->with('id',$id);
    }

    public function reviews($id)
    {
        return view('admin.restaurants.reviews')->with('id',$id);
    }

    public function promos($id)
    {
        return view('admin.restaurants.promos')->with('id',$id);
    }

    public function view($id)
    {
        $team_ids =$id;
        $restaurant = Restaurant::where('team_id',$id)->orderBy('id', 'desc')->get();
        return view('admin.franchies.detail.franchies.restaurant_list', compact('restaurant','team_ids'));
    }
    
    public function restaurantDetail($id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id);
            $team_ids = $restaurant->team_id;
            $restaurant_admin = RestaurantAdmin::findOrFail($restaurant->restaurants_admin_id);
            $categories = Category::all();
            $days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
            $workingHours = [];
            foreach ($days as $day) {
                $workingHours[$day] = RestaurantWorkingHour::where('restaurant_id', $id)->where('day_of_week', $day)->get();
            }
    
            $specialOffers = [];
            foreach ($days as $day) {
                $specialOffers[$day] = RestaurantOffer::where('restaurant_id', $id)->where('day_of_week', $day)->get();
            }
    
            $galleryImages = GalleryImage::where('restaurant_id', $id)->get();
            $dineImages = DineGallery::where('resturant_id', $id)->get();

            return view('admin.franchies.detail.franchies.restaurant_detail', compact('restaurant','team_ids', 'categories', 'restaurant_admin', 'workingHours', 'specialOffers', 'galleryImages','dineImages','days'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
        }
    }
    
    public function view2($id)
    {
        $team_ids =$id;
        $restaurant = Restaurant::where('team_id',$id)->orderBy('id', 'desc')->get();
        return view('admin.employee.detail.employee.restaurant_list', compact('restaurant','team_ids'));
    }
    
    public function restaurantDetail2($id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id);
            $team_ids = $restaurant->team_id;
            $restaurant_admin = RestaurantAdmin::findOrFail($restaurant->restaurants_admin_id);
            $categories = Category::all();
            $days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
            $workingHours = [];
            foreach ($days as $day) {
                $workingHours[$day] = RestaurantWorkingHour::where('restaurant_id', $id)->where('day_of_week', $day)->get();
            }
    
            $specialOffers = [];
            foreach ($days as $day) {
                $specialOffers[$day] = RestaurantOffer::where('restaurant_id', $id)->where('day_of_week', $day)->get();
            }
    
            $galleryImages = GalleryImage::where('restaurant_id', $id)->get();
            $dineImages = DineGallery::where('resturant_id', $id)->get();

            return view('admin.employee.detail.employee.restaurant_detail', compact('restaurant','team_ids', 'categories', 'restaurant_admin', 'workingHours', 'specialOffers', 'galleryImages','dineImages','days'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
        }
    }
   public function restaurantedit($id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id);
            $restaurant_admin = RestaurantAdmin::findOrFail($restaurant->restaurants_admin_id);
            $categories = Category::all(); // Assuming you have a Category model
    
            // Retrieve working hours for each day
            $days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
            $workingHours = [];
            foreach ($days as $day) {
                $workingHours[$day] = RestaurantWorkingHour::where('restaurant_id', $id)->where('day_of_week', $day)->get();
            }
    
            // Retrieve special offers for each day
            $specialOffers = [];
            foreach ($days as $day) {
                $specialOffers[$day] = RestaurantOffer::where('restaurant_id', $id)->where('day_of_week', $day)->get();
            }
    
            // Retrieve gallery images
            $galleryImages = GalleryImage::where('restaurant_id', $id)->get();
            $dineImages = DineGallery::where('resturant_id', $id)->get();
    
            // Pass all the data to the view
            return view('admin.employee.detail.employee.restaurantedit', compact('restaurant', 'categories', 'restaurant_admin', 'workingHours', 'specialOffers', 'galleryImages','dineImages','days'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Handle the case when either the restaurant or the restaurant admin is not found.
            // For example, return an error response or redirect back with an error message.
            // Example: return redirect()->back()->withErrors(['message' => 'Restaurant or Admin not found']);
        }
    }

    public function restauranteupdate(Request $request, $id){
             $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'restaurant_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'restaurant_name' => 'required',
            'category_id' => 'required',
            'restaurant_phone' => 'required', 
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $admin = RestaurantAdmin::find($id);
          
        if (!$admin) {
            return redirect()->back()->with('error', 'Restaurant admin not found.')->withInput();
        }
    
        // Update the RestaurantAdmin record
        $admin->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
        ]);
    
        // Upload and save the profile image if provided
        $profile=null;
        if ($request->hasFile('profile_image')) {
            $profile = $this->uploadImage($request, 'profile_image', 'images/restaurants/profile/');
            if($profile){
                $admin->update(['image' => $profile]);
            }
        }
        
        // dd($admin); 
        // $profile_img =$this->uploadImage($request, 'profile_image', 'images/restaurants/profile/');
        
        $restaurant = Restaurant::find($id);
        // dd($restaurant);
        if (!$restaurant) {
            return redirect()->back()->with('error', 'Restaurant not found.')->withInput();
        }
        if($profile==null){
            $profile=$restaurant->profile_image;
        }
        // Update the Restaurant record
        $restaurant->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'mobile_no' => $request->phone,
            'profile_image' => $profile,
            'name' => $request->restaurant_name,
            'category_id' => $request->category_id,
            'phone' => $request->restaurant_phone,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description,
            'restaurant_status' => $request->restaurant_status,
            'services' => json_encode($request->services),
            'charge_within_km' => $request->charge_within_km,
            'charges_km_min' => $request->charges_km_min,
            'charges_per_km' => $request->charges_per_km,
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'holder_name' => $request->holder_name,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code,
            'other_information' => $request->other_information,
        ]);
    
    
    
        // Upload and save the restaurant image if provided
        if ($request->hasFile('restaurant_image')) {
            $restaurant_image = $this->uploadImage($request, 'restaurant_image', 'images/restaurants');
            $restaurant->update(['image' => $restaurant_image]);
        }
    
        // Update working hours
        $days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
        foreach ($days as $day) {
            if ($request->has($day . '_start') && $request->has($day . '_end')) {
                $starts = $request->input($day . '_start');
                $ends = $request->input($day . '_end');
                $workingHours = [];
    
                foreach ($starts as $index => $start) {
                    $end = $ends[$index];
                    if (!empty($start) && !empty($end)) {
                        $workingHours[] = [
                            'start_time' => $start,
                            'end_time' => $end,
                        ];
                    }
                }
               
                // Delete existing working hours and re-create them
                RestaurantWorkingHour::where('day_of_week', $day)->where('restaurant_id', $restaurant->id)->delete();
                foreach ($workingHours as $timeSlot) {
                    $startTime = $timeSlot['start_time'];
                    $endTime = $timeSlot['end_time'];
    
                    RestaurantWorkingHour::create([
                        'restaurant_id' => $restaurant->id,
                        'day_of_week' => $day,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                    ]);
                }
            }else{
                RestaurantWorkingHour::where('day_of_week', $day)->where('restaurant_id', $restaurant->id)->delete();
            }
        }
    
   
       if ($request->enable_dine == 1) {
            if ($request->hasFile('dine_images')) {
                $dineImages = [];
        
                foreach ($request->file('dine_images') as $image) {
                    try {
                        $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images/restaurants/dine'), $image_name);
                        $dineImages[] = $image_name;
                    } catch (\Exception $e) {
                        return redirect()->back()->with('error', 'Error uploading dine images.');
                    }
                }
        
                $updateData = [
                    'enable_dine' => $request->enable_dine,
                    'dine_open_time' => $request->dine_open_time,
                    'dine_close_time' => $request->dine_close_time,
                    'dine_cost_price' => $request->dine_cost_price,
                ];
        
                // Delete existing dine images from the folder and database
                $existingDineImages = DineGallery::where('resturant_id', $restaurant->id)->get(['dine_images']);
                foreach ($existingDineImages as $existingImage) {
                    $imagePath = public_path('images/restaurants/dine/' . $existingImage->dine_images);
                    if (file_exists($imagePath)) {
                        unlink($imagePath); // Unlink the file
                    }
                }
                DineGallery::where('resturant_id', $restaurant->id)->delete();
        
                $restaurant->update($updateData);
        
                foreach ($dineImages as $dine_image) {
                    DineGallery::create([
                        'resturant_id' => $restaurant->id, 
                        'dine_images' => $dine_image,
                    ]);
                }
            }
        } else {
            // Delete existing dine images from the folder and database
            $existingDineImages = DineGallery::where('resturant_id', $restaurant->id)->get(['dine_images']);
            foreach ($existingDineImages as $existingImage) {
                $imagePath = public_path('images/restaurants/dine/' . $existingImage->dine_images);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Unlink the file
                }
            }
            DineGallery::where('resturant_id', $restaurant->id)->delete();
        
            $restaurant->update([
                'enable_dine' => 0,
                'dine_open_time' => null,
                'dine_close_time' => null,
                'dine_cost_price' => null,
            ]);
        }

    
        // Update special offers
        foreach ($days as $day) {
            if ($request->has($day . '_start_offer') && $request->has($day . '_end_offer') && $request->has($day . '_discount') && $request->has($day . '_discount_type') && $request->has($day . '_delivery_type')) {
                $starts = $request->input($day . '_start_offer');
                $ends = $request->input($day . '_end_offer');
                $discounts = $request->input($day . '_discount');
                $discount_types = $request->input($day . '_discount_type');
                $delivery_types = $request->input($day . '_delivery_type');
                $special_offers = [];
    
                foreach ($starts as $index => $start) {
                    $end = $ends[$index];
                    $discount = $discounts[$index];
                    $discount_type = $discount_types[$index];
                    $delivery_type = $delivery_types[$index];
                    if (!empty($start) && !empty($end) && !empty($discount) && !empty($discount_type) && !empty($delivery_type)) {
                        $special_offers[] = [
                            'start_time' => $start,
                            'end_time' => $end,
                            'discount' => $discount,
                            'discount_type' => $discount_type,
                            'delivery_type' => $delivery_type,
                        ];
                    }
                }
    
                // Delete existing special offers and re-create them
                RestaurantOffer::where('day_of_week', $day)->where('restaurant_id', $restaurant->id)->delete();
                foreach ($special_offers as $timeSlot) {
                    $startTime = $timeSlot['start_time'];
                    $endTime = $timeSlot['end_time'];
                    $discountT = $timeSlot['discount'];
                    $discountType = $timeSlot['discount_type'];
                    $deliveryType = $timeSlot['delivery_type'];
    
                    RestaurantOffer::create([
                        'restaurant_id' => $restaurant->id,
                        'day_of_week' => $day,
                        'opening_time' => $startTime,
                        'closing_time' => $endTime,
                        'discount' => $discountT,
                        'discount_sign' => $discountType,
                        'discount_type' => $deliveryType,
                    ]);
                }
            }else{
                RestaurantOffer::where('day_of_week', $day)->where('restaurant_id', $restaurant->id)->delete();
            }
        }
    
        // Update gallery images if provided
        if ($request->hasFile('gallery_images')) {
            $gallery_images = [];
    
            foreach ($request->file('gallery_images') as $image) {
                try {
                    $image_name = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images/restaurants/gallery'), $image_name);
                    $gallery_images[] = $image_name;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error uploading one or more images.')->withInput();
                }
            }
    
            // Delete existing gallery images and re-create them
            GalleryImage::where('restaurant_id',$restaurant->id)->delete();
            foreach ($gallery_images as $gallery_image) {
                GalleryImage::create([
                    'restaurant_id' => $restaurant->id,
                    'image_path' => $gallery_image,
                ]);
            }
        }
             return redirect()->route('admin.franchies.team.rider', ['id' => $restaurant->franchies_id])->with('success', 'Department updated successfully.');
    
        // return redirect()->route('admin.restaurants')->with('success', 'Restaurant updated successfully.');
        
        
        
    }


}
