<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Otp;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class ProfileController extends Controller
{
    public function get_profile(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 200);
        };
    
        // Find the customer by id
        // $profile = DB::table('customer')
        //     ->leftJoin('cover_images', 'customer.cover_image', '=', 'cover_images.id')
        //     ->where('id', $request->id)
        //     ->first();
        $profile = DB::table('customer')
        ->leftJoin('cover_images', 'customer.cover_image', '=', 'cover_images.id')
        ->where('customer.id', $request->id)
        ->select('customer.*', 'cover_images.banner_photo')
        ->first();
            
        if(!$profile){
             return response(['errors' =>false,'message'=>"record not found"], 501);
        }
        
        if($profile->status == 1)
        {
            $status = true;
        }
        else
        {
            $status = false;
        }
        
        if ($profile) {
            if($profile->banner_photo == null)
            {
                $banner_photo = $profile->cover_photo_url = asset('images/upload/profile.png');
            }
            else
            {
                $banner_photo = $profile->cover_photo_url = asset('images/cover_image/' . $profile->banner_photo);
            }
            
            if($profile->profile_image == null)
            {
                $profile_image = $profile->profile_photo_url = asset('images/upload/profile.png');
            }
            else
            {
                $profile_image = $profile->profile_photo_url = asset('images/upload/' . $profile->profile_image);
            }

            return [
                'message' => 'Profile get data successfully',
                'status' => $status,
                'profile' => $profile,
            ];
        } else {
            // OTP data does not exist for the given conditions
            return [
                'message' => 'No Profile data found',
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



}
