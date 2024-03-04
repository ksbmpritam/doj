<?php

namespace App\Http\Controllers\API\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\RestaurantAdmin;
use App\Models\Restaurant;
use App\Models\GalleryImage;
use App\Models\DineGallery;
use App\Models\Restaurant_otp;
use App\Models\RestaurantDine;
use App\Models\RestaurantOffer;
use App\Models\RestaurantWorkingHour;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{

   
    public function restaurant_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required|unique:restaurant_admin,phone',
            'fcm_token' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            // for Restaurant
            'restaurant_name' => 'required',
            'category_id' => 'required',
            'restaurant_phone' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'restaurant_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'services' => 'required',
            'self_pickup' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $profile = $this->uploadImage($request, 'image', 'images/restaurants/profile');
       
        $restaurant_image = $this->uploadImage($request, 'restaurant_image', 'images/restaurants');
    
        $data = RestaurantAdmin::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'image' => $profile,
            'fcm_token' => $request->fcm_token,
        ]);
      
        if (!$data) {
            return response()->json([
                'message' => 'Failed to create RestaurantAdmin record'
            ], 500);
        }
    
    
        if ($data->id) {
            $res = Restaurant::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->password,
                'mobile_no' => $request->phone,
                'profile_image' => $profile,
                'fcm_token' => $request->fcm_token,
                'name' => $request->restaurant_name,
                'category_id' => $request->category_id,
                'phone' => $request->restaurant_phone,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'description' => $request->description,
                'image' => $restaurant_image,
                'self_pickup' => $request->self_pickup,
                'restaurant_status' => 0,
                'restaurants_admin_id' => $data->id,
                'services' => $request->services,
            ]);
            
            if(!$res->id){
                RestaurantAdmin::where('id',$data->id)->delete();
            }
            
            if ($res->id) {
               
                if ($request->working_hours) {
                    $unescapedJsonString = stripcslashes($request->working_hours);
                    $workingHoursData = json_decode($unescapedJsonString, true);
                    

                    if (is_array($workingHoursData)) {
                        foreach ($workingHoursData as $workingHour) {
                            $restaurantId = $res->id;
                            $dayOfWeek = $workingHour['days_of_week'];
                            $workingHours = $workingHour['working_hours'];
                
                            if (is_array($workingHours)) {
                                foreach ($workingHours as $timeSlot) {
                                    $startTime = $timeSlot['start_time'];
                                    $endTime = $timeSlot['end_time'];
                
                                    RestaurantWorkingHour::create([
                                        'restaurant_id' => $restaurantId,
                                        'day_of_week' => $dayOfWeek,
                                        'start_time' => $startTime,
                                        'end_time' => $endTime,
                                    ]);
                                }
                            } else {
                                RestaurantAdmin::where('id', $res->id)->delete();
                                Restaurant::where('restaurants_admin_id', $res->id)->delete();
                                return response()->json(['message' => 'Invalid working hours data format'], 422);
                            }
                        }
                
                        // return response()->json(['message' => 'Working hours saved successfully'], 200);
                    } else {
                        RestaurantAdmin::where('id', $res->id)->delete();
                        Restaurant::where('restaurants_admin_id', $res->id)->delete();
                        return response()->json(['message' => 'Invalid working hours data format'], 422);
                    }
                }


                
                if ($request->restaurant_offer) {
                    $offerJsonString = stripcslashes($request->restaurant_offer);

                    $workingHoursData = json_decode($offerJsonString, true);
                    
                    if (is_array($workingHoursData)) {
                        foreach ($workingHoursData as $workingHour) {
                            $restaurantId = $res->id; 
                            $dayOfWeek = $workingHour['day_of_week'];
                            $workingHours = $workingHour['working_hours'];
                            
                            if (is_array($workingHours)) {
                                foreach ($workingHours as $timeSlot) {
                                    $openingTime = $timeSlot['opening_time'];
                                    $closingTime = $timeSlot['closing_time'];
                                    $discount = $timeSlot['discount'];
                                    $discoun_sign = $timeSlot['discount_sign'];
                                    $discountType = $timeSlot['discount_type'];
                
                                    RestaurantOffer::create([
                                        'restaurant_id' => $restaurantId,
                                        'day_of_week' => $dayOfWeek,
                                        'opening_time' => $openingTime,
                                        'closing_time' => $closingTime,
                                        'discount' => $discount,
                                        'discount_sign' => $discoun_sign,
                                        'discount_type' => $discountType,
                                    ]);
                                }
                            } else {
                                RestaurantAdmin::where('id', $res->id)->delete();
                                Restaurant::where('restaurants_admin_id', $res->id)->delete();
                                RestaurantWorkingHour::where('restaurant_id', $res->id)->delete();
                                return response()->json(['message' => 'Invalid Offer data format'], 422);
                            }
                        }
                        
                        // return response()->json(['message' => 'Restaurant offer saved successfully'], 200);
                    } else {
                        RestaurantAdmin::where('id', $res->id)->delete();
                        Restaurant::where('restaurants_admin_id', $res->id)->delete();
                        RestaurantWorkingHour::where('restaurant_id', $res->id)->delete();
                        return response()->json(['message' => 'Invalid offer data format'], 422);
                    }
                }
                
                
                
                if ($request->hasFile('gallery_images')) {
                    $gallery_images = [];
                // $offerJsonString = stripcslashes($request->restaurant_offer);

                //     $workingHoursData = json_decode($offerJsonString, true);
                    foreach ($request->file('gallery_images') as $image) {
                        try {
                            $image_name = time() . '_' . $image->getClientOriginalName();
                            $image->move(public_path('images/restaurants/gallery'), $image_name);
                            $gallery_images[] = $image_name;
                        } catch (\Exception $e) {
                            return response()->json(['message' => 'Error uploading one or more images.'], 500);
                        }
                    }
                
                    if (!empty($gallery_images)) {
                        foreach ($gallery_images as $gallery_image) {
                            GalleryImage::create([
                                'restaurant_id' => $res->id,
                                'image_path' => $gallery_image,
                            ]);
                        }
                    } else {
                        // If images were not inserted successfully, remove records
                        GalleryImage::where('restaurant_id', $res->id)->delete();
                        RestaurantAdmin::where('id', $res->id)->delete();
                        Restaurant::where('restaurants_admin_id', $res->id)->delete();
                        RestaurantOffer::where('restaurant_id', $res->id)->delete();
                
                        return response()->json(['message' => 'Error uploading one or more images.'], 500);
                    }
                
                
                }


                
                if ($request->enable_dine == 1) {
                    $restaurant = Restaurant::find($res->id);
                    
                    if ($restaurant) {
                        $restaurant->update([
                            'enable_dine' => $request->enable_dine,
                            'dine_open_time' => $request->open_time,
                            'dine_close_time' => $request->close_time,
                            'dine_cost_price' => $request->cost_price,
                        ]);
                        
                        $dineImages = [];
                        
                        foreach ($request->file('dine_images') as $image) {
                            try {
                                $image_name = time() . '_' . $image->getClientOriginalName();
                                $image->move(public_path('images/restaurants/dine'), $image_name);
                                $dineImages[] = $image_name;
                            } catch (\Exception $e) {
                                return response()->json(['message' => 'Error uploading one or more images.'], 500);
                            }
                        }
                        if (!empty($dineImages)) {
                        foreach ($dineImages as $dine_image) {
                            DineGallery::create([
                                'resturant_id' => $res->id, 
                                'dine_images' => $dine_image,
                            ]);
                        }
                        }else {
                        // If images were not inserted successfully, remove records
                        DineGallery::where('resturant_id', $res->id)->delete();
                        RestaurantAdmin::where('id', $res->id)->delete();
                        Restaurant::where('restaurants_admin_id', $res->id)->delete();
                
                        return response()->json(['message' => 'Error uploading one or more images.'], 500);
                        }
                    }
                }

                return response()->json([
                    'message' => 'register success',
                    'restaurant_id' => $res->id,
                    'restaurant_admin_id' => $data->id
                ], 200);
    
            } else {
                return response()->json([
                    'message' => 'Not Register'
                ], 200);
            }
        }
    
        return response()->json([
            'message' => 'Failed to create RestaurantAdmin record'
        ], 500);
    }
    
    public function update_restaurant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $id=$request->id;
        
        $restaurant = Restaurant::where('restaurants_admin_id',$id)->first();
        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }
        // Update the Restaurant record
        $restaurant->update([
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
       if ($request->working_hours) {
            $unescapedJsonString = stripcslashes($request->working_hours);
            $workingHoursData = json_decode($unescapedJsonString, true);
            

            if (is_array($workingHoursData)) {
                RestaurantWorkingHour::where('restaurant_id', $restaurant->id)->delete();
                foreach ($workingHoursData as $workingHour) {
                    $restaurantId = $restaurant->id;
                    $dayOfWeek = $workingHour['days_of_week'];
                    $workingHours = $workingHour['working_hours'];
        
                    if (is_array($workingHours)) {
                        foreach ($workingHours as $timeSlot) {
                            $startTime = $timeSlot['start_time'];
                            $endTime = $timeSlot['end_time'];
        
                            RestaurantWorkingHour::create([
                                'restaurant_id' => $restaurantId,
                                'day_of_week' => $dayOfWeek,
                                'start_time' => $startTime,
                                'end_time' => $endTime,
                            ]);
                        }
                    } else {
                        return response()->json(['message' => 'Invalid working hours data format'], 422);
                    }
                }
        
                // return response()->json(['message' => 'Working hours saved successfully'], 200);
            } else {
                return response()->json(['message' => 'Invalid working hours data format'], 422);
            }
        }


        
        if ($request->restaurant_offer) {
            $offerJsonString = stripcslashes($request->restaurant_offer);

            $workingHoursData = json_decode($offerJsonString, true);
            
            if (is_array($workingHoursData)) {
                RestaurantOffer::where('restaurant_id', $restaurant->id)->delete();
                foreach ($workingHoursData as $workingHour) {
                    $restaurantId = $restaurant->id; 
                    $dayOfWeek = $workingHour['day_of_week'];
                    $workingHours = $workingHour['working_hours'];
                    
                    if (is_array($workingHours)) {
                        foreach ($workingHours as $timeSlot) {
                            $openingTime = $timeSlot['opening_time'];
                            $closingTime = $timeSlot['closing_time'];
                            $discount = $timeSlot['discount'];
                            $discoun_sign = $timeSlot['discount_sign'];
                            $discountType = $timeSlot['discount_type'];
        
                            RestaurantOffer::create([
                                'restaurant_id' => $restaurantId,
                                'day_of_week' => $dayOfWeek,
                                'opening_time' => $openingTime,
                                'closing_time' => $closingTime,
                                'discount' => $discount,
                                'discount_sign' => $discoun_sign,
                                'discount_type' => $discountType,
                            ]);
                        }
                    } else {
                        return response()->json(['message' => 'Invalid Offer data format'], 422);
                    }
                }
                
                // return response()->json(['message' => 'Restaurant offer saved successfully'], 200);
            } else {
                return response()->json(['message' => 'Invalid offer data format'], 422);
            }
        }
        
        // Update dine feature if enabled
        if ($request->enable_dine == 1) {
            $restaurant->update([
                'enable_dine' => $request->enable_dine,
                'dine_open_time' => $request->dine_open_time,
                'dine_close_time' => $request->dine_close_time,
                'dine_cost_price' => $request->dine_cost_price,
            ]);
    
            if ($request->hasFile('dine_image')) {
                $dine_image = $this->uploadImage($request, 'dine_image', 'images/restaurants/dine/');
                $restaurant->update(['dine_image' => $dine_image]);
            }
        }else{
            $restaurant->update([
                'enable_dine' =>0,
                'dine_open_time' => '',
                'dine_close_time' => '',
                'dine_cost_price' => '',
                'dine_image' => '',
            ]);
        }
    
        // Update special offers

        // if ($request->hasFile('gallery_images')) {
        //     $gallery_images = [];
        
        //     foreach ($request->file('gallery_images') as $image) {
        //         try {
        //             $image_name = time() . '_' . $image->getClientOriginalName();
        //             $image->move(public_path('images/restaurants/gallery'), $image_name);
        //             $gallery_images[] = $image_name;
        //         } catch (\Exception $e) {
        //             return redirect()->back()->with('error', 'Error uploading one or more images.')->withInput();
        //         }
        //     }
        //     // Delete existing gallery images and re-create them
        //     GalleryImage::where('restaurant_id', $restaurant->id)->delete();
        //     foreach ($gallery_images as $gallery_image) {
        //         GalleryImage::create([
        //             'restaurant_id' => $restaurant->id,
        //             'image_path' => $gallery_image,
        //         ]);
        //     }
        // }
        
        if ($request->hasFile('gallery_images')) {
            // Get the paths of existing gallery images
            $existingImages = GalleryImage::where('restaurant_id', $restaurant->id)->pluck('image_path')->toArray();
        
            foreach ($request->file('gallery_images') as $newImage) {
                try {
                    $newImageName = time() . '_' . $newImage->getClientOriginalName();
                    $newImage->move(public_path('images/restaurants/gallery'), $newImageName);
        
                    foreach ($existingImages as $existingImage) {
                        $existingImagePath = public_path('images/restaurants/gallery') . '/' . $existingImage;
        
                        // Delete the old image if it exists
                        if (file_exists($existingImagePath)) {
                            unlink($existingImagePath);
                        }
                    }
        
                    // Create new gallery image record
                    GalleryImage::create([
                        'restaurant_id' => $restaurant->id,
                        'image_path' => $newImageName,
                    ]);
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error uploading one or more images.')->withInput();
                }
            }
        }


    
        return response()->json(['message' => 'Record Update Successfully','status'=>true], 200);
    }
   
   
    
    public function update_restaurantInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $id=$request->id;
        
        $restaurant = Restaurant::where('restaurants_admin_id',$id)->first();
        
        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }
        
        $restaurant->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        
        
        return response()->json(['message' => 'Record Update Successfully','status'=>true], 200);
    }
   
   
   
   

   private function uploadImage($request, $fieldName, $folder)
    {
        $existingImage = $request->input($fieldName . '_existing');
        
        if ($existingImage) {
            $existingImagePath = public_path($folder . '/' . $existingImage);
            if (file_exists($existingImagePath)) {
                unlink($existingImagePath);
            }
        }
        
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


    public function login(Request $request)
    {
        $credentials = [
            'phone' => $request->input('phone'),
            'fcm_token' => $request->input('fcm_token'),
        ];
    
        //Find the restaurant by mobile number
        $restaurant = RestaurantAdmin::where('phone', $credentials['phone'])->first();
    
        if (!$restaurant) {
            return response()->json([
                'message' => 'Restaurant not found'
            ], 404);
        }
    
        $restaurant->fcm_token = $credentials['fcm_token'];
        $restaurant->save();
      
        return response()->json([
            'message' => 'Login successful',
            // 'token' => $token,
            'restaurant' => $restaurant
        ]);
    }
    
   
    public function otp(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'fcm_token' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
        
        $otp = 1234;
        
        if ($otp) {
            
            return [
                'message' => 'OTP send successfully',
                'otp' => $otp,
            ];
        } else {
            // OTP data does not exist for the given conditions
            return [
                'message' => 'Otp not send',
            ];
        }
        
    }
    
    public function verify_otp(Request $request)
    {
        // Validate request parameters
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'fcm_token' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        // Check if the phone number exists in the restaurant_admin table
        // $restaurantAdmin = RestaurantAdmin::where('phone', $request->phone)->first();
        $restaurant = Restaurant::where('mobile_no', $request->phone)->first();


        if ($restaurant) {
            // $restaurantAdmin->update(['fcm_token' => $request->fcm_token]);
            $restaurant->update(['fcm_token' => $request->fcm_token]);
            return [
                'message' => 'Verification Successful',
                'data' => $restaurant->id,
                'status' => true
            ];
        } else {
            return [
                'message' => 'Record not found',
                'status' => false
            ];
        }
    }
    
    // public function verify_otp(Request $request)
    // {
    //   $validator = Validator::make($request->all(), [
    //         'phone' => 'required',
    //         'fcm_token' => 'required',
    //     ]);
        
    //     if ($validator->fails()) {
    //         return response(['errors' => $validator->errors()->all()], 422);
    //     };
        
      
    //     if ($request->phone) {
            
    //       $match = DB::table('restaurant_admin')
    //         ->where('phone', $request->phone)
    //         ->first();
    //         if($match)
    //         { 
    //             $update_name = DB::table('restaurant_admin')
    //             ->where('id',$match->id)
    //             ->update(['fcm_token' => $request->fcm_token]);
                
                
    //              return [
    //                 'message' => 'verify  Successfully',
    //                 'data'=>$match->id,
    //                 'status'=>true
    //             ];
    //         }
    //         else
    //         {
              
    //             return [ 
    //                 'message' => 'Record not found',
    //                 'status'=>false
    //             ];
    //         }
            
            
            
    //     } else {
            
    //         return [
    //             'message' => 'Mobile no Required',
    //             'status'=>false
    //         ];
    //     }
        
        
    // }
    
    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            // 'first_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            // 'address' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all(),'status'=>false], 422);
        }
    
        $restaurantAdmin = RestaurantAdmin::find($request->id);
        
    
        if ($restaurantAdmin) {
            $restaurantAdmin->first_name = $request->first_name;
            $restaurantAdmin->last_name = $request->last_name;
            $restaurantAdmin->phone = $request->phone;
            $restaurantAdmin->email = $request->email;
            $restaurantAdmin->password = $request->password;
            $restaurantAdmin->address = $request->address;
    
            // Update the image only if it's present in the request
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                // if ($restaurantAdmin->image) {
                //     $oldImagePath = public_path('images/restaurants/profile' . $restaurantAdmin->image);
                //     // if (File::exists($oldImagePath)) {
                //     //     File::delete($oldImagePath);
                //     // }
                // }
    
                // Handle image upload logic here
                $image = $request->file('image');
                $newImageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/restaurants/profile'), $newImageName);
                $restaurantAdmin->image = $newImageName;
            }
    
            if($restaurantAdmin->save()){
                $restaurant = Restaurant::find($request->id);
                
                $restaurant->first_name = $request->first_name;
                $restaurant->last_name = $request->last_name;
                $restaurant->mobile_no = $request->phone;
                $restaurant->password = $request->password;
                $restaurant->address = $request->address;
                
                $restaurant->save();
            }
    
            return response()->json(['success' => true, 'message' => 'Profile updated successfully','status'=>true,'data'=>$restaurant,]);

    
            // return response([ 'message' => 'Profile updated successfully',
            //     'status'=>true,
            //     'data'=>$restaurant,
            // ]);
        } else {
            return response()->json(['success' => false, 'message' => 'User with the given ID not found' ,'status'=>false], 500);

            // return response(['message' => 'User with the given ID not found','status'=>false]);
        }
    }

    
    public function update_name(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
        $resturant = DB::table('RestaurantAdmin')
            ->where('id', $request->id)
            ->first();
            
        if($resturant)
        {
           $update_name = DB::table('restaurant_admin')
            ->where('id', $request->id)
            ->update(['name' => $request->name]);
            
            return [
                'message' => 'Update Name  Successfully'
                ];
        }
        else
        {
            return [
                'message' => 'id do not match ',
                ];
        }
    }



}
