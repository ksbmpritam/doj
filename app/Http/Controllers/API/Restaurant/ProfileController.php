<?php

namespace App\Http\Controllers\API\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\RestaurantAdmin;
use App\Models\Restaurant;
use App\Models\Otp;
use App\Models\Rating;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function get_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        // Find the restaurant admin by id
        $profile = Restaurant::where('id', $request->id)
            ->first();
    
        if ($profile) {
            $profile_image = $profile->image
                ? asset('images/restaurants/' . $profile->image)
                : asset('images/restaurants/profile.png');
    
            $profile['profile_photo_url'] = $profile_image;
    
            return [
                'message' => 'Profile data retrieved successfully',
                'status' => true,
                'profile' => $profile,
            ];
        } else {
            // Profile data does not exist for the given conditions
            return [
                'message' => 'No Profile data found',
            ];
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
        
        $customer = DB::table('restaurant_admin')
            ->where('id', $request->id)
            ->first();
            
        if($customer)
        {
           $update_name = DB::table('restaurant_admin')
            ->where('id', $request->id)
            ->update(['first_name' => $request->name]);
            
            return [
                'message' => 'Update Name Restaurant Successfully',
                'data' => $customer,
                ];
        }
        else
        {
            return [
                'message' => 'id do not match customer',
                ];
        }
    }
    
    public function profile_update(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'id' => 'required',
            // 'mobile_number' => 'required',
            // 'name' => 'required',
            // 'email' => 'required',
            // 'gender' => 'required',
            // 'dob' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
       $update = DB::table('customer')
        ->where('id', $request->id) 
        ->update([
        'mobile_number' => $request->mobile_number,
        'name' => $request->name,
        'email' => $request->email,
        'gender' => $request->gender,
        'dob' => $request->dob,
        ]);

        if($update)
        {
           return [
            'message' => 'profile update successfully.',
            'profile' => $update
            ]; 
        }
        else
        {
            return [
                'message' => 'profile update already exists.'
                ];
        }
    }
    
    public function profile_image(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
            // Handle the image upload and update the user's profile image
            $image = $request->file('profile_image');
            $profile_image = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/upload'), $profile_image);

       
         $profile_image = DB::table('customer')
        ->where('id', $request->id) 
        ->update([
        'profile_image' => $profile_image,
        ]);
            
        
      
        
        if ($profile_image) {
            
    
            return [
                'message' => 'Profile Image Update Sucessfully',
                ];
        } else {
           
            return [
                'message' => 'profile image already exist.',
            ];
        }
        
    }
    
    public function update_address(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'address' => 'required',
            'type' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
        //get longitude and latitude
        $apiKey = config('app.google_maps_api_key');
        $client = new Client();

        try {
            $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json', [
                'query' => [
                    'address' => $request->address,
                    'key' => $apiKey,
                ]
            ]);

            $data = $response->getBody()->getContents();
            $result = json_decode($data, true);

            if ($result['status'] === 'OK') {
                $location = $result['results'][0]['geometry']['location'];
                $latitude = $location['lat'];
                $longitude = $location['lng'];

                return response()->json([
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                ]);
            } else {
                return response()->json([
                    'error' => 'Geocoding API error: ' . $result['status'],
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
        
        
        
        $update = DB::table('customer')
        ->where('id', $request->id) 
        ->update([
        'address' => $request->address,
        'type' => $request->type,
        'latitude' => $latitude,
        'longitude' => $longitude,
        ]);
            
        if($customer)
        {
           return [
                'message' => 'Update address Successfully'
                ];
        }
        else
        {
            return [
                'message' => 'update address failed..',
                ];
        }
    }
    
    public function get_ratings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        // Find the restaurant admin by id
        $profiles = Rating::where('restaurant_id', $request->id)
            ->get();
            
      
       if ($profiles->isNotEmpty()) {
            // Accessing customer_id for each profile in the collection
            $customerIds = $profiles->pluck('customer_id')->all();
        
            // Find customers with matching IDs
            $customers = Customer::whereIn('id', $customerIds)->get();
        
            // Merge profiles and customers based on the 'customer_id' key
            $mergedData = $profiles->map(function ($profile) use ($customers) {
                $customer = $customers->where('id', $profile['customer_id'])->first();
            
                // Check if $customer is not null before calling toArray()
                if ($customer) {
                    // Convert models to arrays and merge
                    return array_merge($profile->toArray(), $customer->toArray());
                } else {
                    // Handle the case where $customer is null (optional)
                    return $profile->toArray();  // or any other handling you prefer
                }
            });
                    
            return [
                'message' => 'Profile data retrieved successfully',
                'status' => true,
                'mergedData' => $mergedData->all(),
            ];
        } else {
            // No profiles found for the given conditions
            return [
                'message' => 'No Profile data found',
            ];
        }



    }



}
