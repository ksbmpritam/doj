<?php
/**
 * File name: RestaurantController.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\Restaurant;

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
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{

 
    
	public function index(Request $request)
    {
        $url = Storage::url('file1.jpg');
        $this->user = $request->session()->get('user');
        $restaurant = Restaurant::where('id',$this->user->id)->get();
        return view("restaurant_admin.restaurants.index",compact('restaurant','url'));
    }

    // public function create(){
    //     $category = Category::all();
    //     return view("restaurant_admin.restaurants.create",compact('category'));
    // }
    
    public function edit($id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id);
            $restaurant_admin = RestaurantAdmin::findOrFail($restaurant->restaurants_admin_id);
            $categories = Category::all(); 
    
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
            return view('restaurant_admin.restaurants.edit', compact('restaurant', 'categories', 'restaurant_admin', 'workingHours', 'specialOffers', 'galleryImages','dineImages','days'));
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'restaurant_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $restaurant = Restaurant::find($id);
        
        
        if($request->image != null)
        {
            $profile = $this->uploadImage($request, 'image', 'images/restaurants/profile');
             // Find the existing Restaurant record
            if ($restaurant->profile_image && file_exists(public_path('images/restaurants/profile/' . $restaurant->profile_image))) {
            unlink(public_path('images/restaurants/profile/' . $restaurant->profile_image));
            }
        }
        else
        {
            $profile = $restaurant->profile_image;
        }
        
        
       
        
        
        if (!$restaurant) {
            return redirect()->back()->with('error', 'Restaurant not found.')->withInput();
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
                // dd($workingHours);
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
            }
        }
    
       
        // Update dine feature if enabled
        // if ($request->enable_dine == 1) {
        //     $restaurant->update([
        //         'enable_dine' => $request->enable_dine,
        //         'dine_open_time' => $request->dine_open_time,
        //         'dine_close_time' => $request->dine_close_time,
        //         'dine_cost_price' => $request->dine_cost_price,
        //     ]);
    
        //     if ($request->hasFile('dine_image')) {
        //         $dine_image = $this->uploadImage($request, 'dine_image', 'images/restaurants/dine/');
        //         $restaurant->update(['dine_image' => $dine_image]);
        //     }
        // }else{
        //     $restaurant->update([
        //         'enable_dine' =>0,
        //         'dine_open_time' => '',
        //         'dine_close_time' => '',
        //         'dine_cost_price' => '',
        //         'dine_image' => '',
        //     ]);
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
    
        return redirect()->route('restaurant.restaurants')->with('success', 'Restaurant updated successfully.');
    }
    
    // public function insert(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'email' => 'required',
    //         'password' => 'required',
    //         'phone' => 'required',
    //         'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
    //         'restaurant_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
    //         // Add validation rules for other fields if needed
    //     ]);
        
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    
    //     // Upload and save the profile image
    //     $profile = $this->uploadImage($request, 'image', 'images/restaurants/profile');
    
    //     // Create a new RestaurantAdmin record
    //     $admin = RestaurantAdmin::create([
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         'phone' => $request->phone,
    //         'image' => $profile,
    //     ]);
    
    //     if (!$admin->id) {
    //         return redirect()->back()->with('error', 'Error creating restaurant admin.')->withInput();
    //     }
    
    //     // Upload and save the restaurant image
    //     $restaurant_image = $this->uploadImage($request, 'restaurant_image', 'images/restaurants');
    
    //     // Create a new Restaurant record
    //     $restaurant = Restaurant::create([
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         'mobile_no' => $request->phone,
    //         'profile_image' => $profile,
    //         'name' => $request->restaurant_name,
    //         'category_id' => $request->category_id,
    //         'phone' => $request->restaurant_phone,
    //         'address' => $request->address,
    //         'latitude' => $request->latitude,
    //         'longitude' => $request->longitude,
    //         'description' => $request->description,
    //         'image' => $restaurant_image,
    //         'restaurant_status' => $request->restaurant_status, 
    //         'restaurants_admin_id' => $admin->id,
    //         'services' => json_encode($request->services),
    //         'charge_within_km' => $request->charge_within_km, 
    //         'charges_km_min' => $request->charges_km_min, 
    //         'charges_per_km' => $request->charges_per_km, 
    //     ]);
    
    //     if (!$restaurant->id) {
    //         $admin->delete(); 
    //         return redirect()->back()->with('error', 'Error creating restaurant.')->withInput();
    //     }
    
    //     // Save the working hours
    //     $days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
    //     foreach ($days as $day) {
    //         if ($request->has($day . '_start') && $request->has($day . '_end')) {
    //             $starts = $request->input($day . '_start');
    //             $ends = $request->input($day . '_end');
    //             $workingHours = [];
        
    //             foreach ($starts as $index => $start) {
    //                 $end = $ends[$index];
    //                 if (!empty($start) && !empty($end)) {
    //                     $workingHours[] = [
    //                         'start_time' => $start,
    //                         'end_time' => $end,
    //                     ];
    //                 }
    //             }
        
    //             if (!empty($workingHours)) {
    //                 foreach ($workingHours as $timeSlot) {
    //                     $startTime = $timeSlot['start_time'];
    //                     $endTime = $timeSlot['end_time'];
                
    //                     RestaurantWorkingHour::create([
    //                         'restaurant_id' => $restaurant->id,
    //                         'day_of_week' => $day,
    //                         'start_time' => $startTime,
    //                         'end_time' => $endTime,
    //                     ]);
    //                 }
    //             }
    //         }
    //     }
    
    //     // Save dine feature if enabled
    //     if ($request->enable_dine == 1) { 
    //         $restaurant->update([
    //             'enable_dine' => $request->enable_dine,
    //             'dine_open_time' => $request->dine_open_time,
    //             'dine_close_time' => $request->dine_close_time,
    //             'dine_cost_price' => $request->dine_cost_price,
    //         ]);
    
    //         if ($request->hasFile('dine_image')) {
    //             $dine_image = $this->uploadImage($request, 'dine_image', 'images/restaurants/dine');
    //             $restaurant->update([
    //                 'dine_image' => $dine_image,
    //             ]);
    //         }
    //     }
    
    //     // Save special offers
    //     foreach ($days as $day) {
    //         if ($request->has($day . '_start_offer') && $request->has($day . '_end_offer') && $request->has($day . '_discount') && $request->has($day . '_discount_type') && $request->has($day . '_delivery_type')) {
    //             $starts = $request->input($day . '_start_offer');
    //             $ends = $request->input($day . '_end_offer');
    //             $discounts = $request->input($day . '_discount');
    //             $discount_types = $request->input($day . '_discount_type');
    //             $delivery_types = $request->input($day . '_delivery_type');
    //             $special_offers = [];
    
    //             foreach ($starts as $index => $start) {
    //                 $end = $ends[$index];
    //                 $discount = $discounts[$index];
    //                 $discount_type = $discount_types[$index];
    //                 $delivery_type = $delivery_types[$index];
    //                 if (!empty($start) && !empty($end) && !empty($discount) && !empty($discount_type) && !empty($delivery_type)) {
    //                     $special_offers[] = [
    //                         'start_time' => $start,
    //                         'end_time' => $end,
    //                         'discount' => $discount,
    //                         'discount_type' => $discount_type,
    //                         'delivery_type' => $delivery_type,
    //                     ];
    //                 }
    //             }
    
    //             if (!empty($special_offers)) {
    //                 foreach ($special_offers as $timeSlot) {
    //                     $startTime = $timeSlot['start_time'];
    //                     $endTime = $timeSlot['end_time'];
    //                     $discountT = $timeSlot['discount'];
    //                     $discountType = $timeSlot['discount_type'];
    //                     $deliveryType = $timeSlot['delivery_type'];
    
    //                     RestaurantOffer::create([
    //                         'restaurant_id' => $restaurant->id,
    //                         'day_of_week' => $day,
    //                         'opening_time' => $startTime,
    //                         'closing_time' => $endTime,
    //                         'discount' => $discountT,
    //                         'discount_sign' => $discountType,
    //                         'discount_type' => $deliveryType,
    //                     ]);
    //                 }
    //             }
    //         }
    //     }
    
    //     // Save gallery images if provided
    //     if ($request->hasFile('gallery_images')) {
    //         $gallery_images = [];
    
    //         foreach ($request->file('gallery_images') as $image) {
    //             try {
    //                 $image_name = time() . '_' . $image->getClientOriginalName();
    //                 $image->move(public_path('images/restaurants/gallery'), $image_name);
    //                 $gallery_images[] = $image_name;
    //             } catch (\Exception $e) {
    //                 return redirect()->back()->with('error', 'Error uploading one or more images.')->withInput();
    //             }
    //         }
    
    //         foreach ($gallery_images as $gallery_image) {
    //             GalleryImage::create([
    //                 'restaurant_id' => $restaurant->id,
    //                 'image_path' =>$gallery_image,
    //             ]);
    //         }
    //     }
    
    //     return redirect()->route('restaurant.restaurants')->with('success', 'Restaurant added successfully.');
    // }

  
    public function vendors()
    {
        echo 'Coming soon...'; die();
        return view("vendors.index");
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
    
    // private function uploadImage($request, $fieldName, $folder)
    // {
    //     // echo $folder; die();
    //     if ($request->hasFile($fieldName)) {
    //     $image = $request->file($fieldName);
        
    //     $randomString = Str::random(20);
    //     $currentDate = date('Y_m_d');

    //     // Combine the random string and current date
    //     $combinedValue = $randomString . '_' . $currentDate;
    //     $imageName = $combinedValue .'.'.$image->getClientOriginalExtension();
    //     $fullFilePath = $folder . '/' . $imageName;

    //     // Store the uploaded image using the Storage facade
    //     Storage::disk('public')->put($fullFilePath, file_get_contents($image));

    //     // Return the folder and image name
    //     return $imageName;
    // }

    // return null;
    // }
    
   

    
    
    public function view($id)
    {
        return view('restaurant_admin.restaurants.view')->with('id',$id);
    }

    public function payout($id)
    {
        return view('restaurant_admin.restaurants.payout')->with('id',$id);
    }

    public function foods($id)
    {
        return view('restaurant_admin.restaurants.foods')->with('id',$id);
    }

    public function orders($id)
    {
        return view('restaurant_admin.restaurants.orders')->with('id',$id);
    }

    public function reviews($id)
    {
        return view('restaurant_admin.restaurants.reviews')->with('id',$id);
    }

    public function promos($id)
    {
        return view('restaurant_admin.restaurants.promos')->with('id',$id);
    }

    


}