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

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'mobile_number' => $request->input('mobile_number'),
            'fcm_token' => $request->input('fcm_token'),
        ];
    
        // Find the user by mobile number
        $user = Customer::where('mobile_number', $credentials['mobile_number'])->first();
    
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
    
        // Update the FCM token for the user
        $user->fcm_token = $credentials['fcm_token'];
        $user->save();
    
        // Generate a new access token
        // $token = $user->createToken('API Token')->accessToken;
    
        return response()->json([
            'message' => 'Login successful',
            // 'token' => $token,
            'user' => $user
        ]);
    }
    
    public function login_google(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'fcm_token' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
        $existingUser = Customer::where('email', $request->email)->first();
    
        if ($existingUser) {
             return response()->json(['message' => 'Login successful','user' => $existingUser,'status'=>true]);
        } else {
            $newCustomer = new Customer();
            $newCustomer->name = $request->name;
            $newCustomer->email = $request->email;
            $newCustomer->fcm_token = $request->fcm_token;

            if($newCustomer->save()){
                return response()->json(['message' => 'Register successful','data' => $newCustomer,'status'=>true]);
            }else{
                return response()->json(['message' => 'Something Wrong', 'status'=>false]);
            }
        }
    
    }
    
    public function login1(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'mobile_number' => 'required',
            'fcm_token' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
    
        // $otp = mt_rand(1000, 9999);
        $otp = 1234;
        // print_r($otp);die;
        $otp1 = Otp::create([
            'mobile_number' => $request->mobile_number,
            'otp' => $otp,
            'fcm_token' => $request->uniqueId,
            ]);
        
        
        $user = Customer::create([
            'mobile_number' => $request->mobile_number,
            'fcm_token' => $request->fcm_token,
            'status' => 0,
        ]);
    
        return [
            'message' => 'Registration successful',
            'user' => $user
        ];
    }
    
    public function otp(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required',
            'fcm_token' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
         $otp = 1234;
        
        $otp1 = Otp::create([
            'mobile_number' => $request->mobile_number,
            'otp' => $otp,
            ]);
        
        
        $otpByConditions = DB::table('otp')
            ->where('mobile_number', $request->mobile_number)
            ->latest('id')
            ->first();
        if ($otpByConditions) {
            
            $otp = $otpByConditions->otp;
    
            return [
                'message' => 'OTP data retrieved successfully',
                'otp' => $otp,
                'data' => $otpByConditions,
            ];
        } else {
            // OTP data does not exist for the given conditions
            return [
                'message' => 'No OTP data found',
            ];
        }
        
    }
    public function verify_otp(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'mobile_number' => 'required',
            'fcm_token' => 'required',
            'otp' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
        
        $otpBy = DB::table('otp')
            ->where('mobile_number', $request->mobile_number)
            ->where('otp', $request->otp)
            ->latest('id')
            ->first();
        
        if ($otpBy) {
            
            $otp = $otpBy->otp;
            
           
            
            $match = DB::table('customer')
            ->where('mobile_number', $request->mobile_number)
            ->first();
            
            if($match)
            {
                
                
                 return [
                'message' => 'Otp Verification Successfully',
                'user' => $match,
                ];
            }
            else
            {
               $user = Customer::create([
                'mobile_number' => $request->mobile_number,
                'status' => 1,
                ]); 
                
                return [ 
                    'message' => 'OTP verification Successfully',
                    'user' => $user,
                    
                ];
            }
            
            
            
        } else {
            
            return [
                'message' => 'OTP Failed successfully',
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
        
        $customer = DB::table('customer')
            ->where('id', $request->id)
            ->first();
            
        if($customer)
        {
           $update_name = DB::table('customer')
            ->where('id', $request->id)
            ->update(['name' => $request->name]);
            
            return [
                'message' => 'Update Name Customer Successfully'
                ];
        }
        else
        {
            return [
                'message' => 'id do not match customer',
                ];
        }
    }



}
