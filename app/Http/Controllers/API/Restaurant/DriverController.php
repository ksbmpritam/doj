<?php

namespace App\Http\Controllers\API\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Driver;
use App\Models\DriverNotification;
use App\Models\OrderItems;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount; 
use App\Helpers\Config;
use App\Models\DriverRating;

class DriverController extends Controller
{

   
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'phone' =>['required', 'unique:driver'],
            'fcm_token' => 'required',
            // 'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'language' => 'required',
            'vehicle' => 'required',
            'work_area' => 'required',
            'aadhar_no' => 'required',
            // 'aadhar_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pan_card_no' => 'required',
            // 'pancart_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'father_name' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $profile = $this->uploadImage($request, 'profile_image', 'images/driver/profile');
        $aadhar_image = $this->uploadImage($request, 'aadhar_image', 'images/driver/document');
        $pancart_image = $this->uploadImage($request, 'pancart_image', 'images/driver/document');
    
        $data = Driver::create([
            'first_name' => $request->first_name,
            'phone' => $request->phone,
            'fcm_token' => $request->fcm_token,
            'profile_image' => $profile,
            'address' => $request->address,
            'father_name' => $request->father_name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'language' => $request->language,
            'vehicle' => $request->vehicle,
            'work_area' => $request->work_area,
            'aadhar_no' => $request->aadhar_no,
            'aadhar_image' => $aadhar_image,
            'aadhar_verification_status' => 2,
            'pan_card_no' => $request->pan_card_no,
            'pancart_image' => $pancart_image,
        ]);
    
        if (!$data) {
            return response()->json(['message' => 'Failed to Register Driver','status'=>false], 500);
        }
    
        return response()->json(['message' => 'Driver Registered Successfully','status'=>true], 200);
    }
    
    
    public function check_fcm(Request $request){
        $validator = Validator::make($request->all(), [
            'fcm_token' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $fcm_token = $request->input('fcm_token');
        $fcm = Driver::where('fcm_token', $fcm_token)->where('is_login', 1)->first();
        
        if (!$fcm) {
            return response()->json(['status' => false, 'message' => 'Invalid FCM Token']);
        }
        $fcm->profile_image = asset('images/driver/profile/' . $fcm->profile_image);
        return response()->json(['status' => true, 'data' => $fcm, 'message' => 'successfully']);
    }
    
    public function getProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $driverId = $request->input('driver_id');
    
        $profile = Driver::where('id', $driverId)->first();
    
        if (!$profile) {
            return response()->json(['status' => false, 'message' => 'Invalid id']);
        }
    
        // Corrected the transformation using a map closure
        $profile->profile_image = asset('images/driver/profile/' . $profile->profile_image);
    
        return response()->json(['status' => true, 'data' => $profile, 'message' => 'Profile get successfully']);
    }


    
    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
        $profile = $this->uploadImage($request, 'profile_image', 'images/driver/profile');

        $resturant = Driver::where('id', $request->id)
            ->first();
            
        if($resturant)
        {
           $update_name =Driver::where('id', $request->id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'email' => $request->email,
                'profile_image' => $profile,
                ]);
            
            return [
                'status'=>true,
                'message' => 'Profile updated  Successfully',
                ];
        }
        else
        {
            return [
                'message' => 'id do not match ',
                ];
        }
    }
    
    public function update_abilable(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'available' => 'required|boolean',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $driver = Driver::find($request->id);
    
        if (!$driver) {
            return response(['message' => 'Driver not found','status'=>false], 404);
        }
    
        $driver->available = $request->available;
        $driver->save();
    
        $message = $request->available ? 'You are available' : 'You are not available';
    
        return response(['status' => true, 'message' => $message]);
    }

    private function uploadImage($request, $fieldName, $folder)
    {
        if ($request->hasFile($fieldName)) {
            $image = $request->file($fieldName);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            $image->move(public_path($folder), $imageName);
    
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
    
        $driver = Driver::where('phone', $credentials['phone'])->first();
    
        if (!$driver) {
            return response()->json([
                'message' => 'Restaurant not found'
            ], 404);
        }
    
        $driver->fcm_token = $credentials['fcm_token'];
        $driver->save();
      
        return response()->json([
            'message' => 'Login successful',
            // 'token' => $token,
            'restaurant' => $driver
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
       $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'fcm_token' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
      
        if ($request->phone) {
            
           $match = DB::table('driver')->where('phone', $request->phone)->first();
            if($match)
            { 
                $update_name = DB::table('driver')->where('id',$match->id)->update(['fcm_token' => $request->fcm_token,'is_login'=>1]);
                
                
                 return [
                    'message' => 'verify  Successfully',
                    'id'=>$match->id,
                    'status'=>true
                ];
            }
            else
            {
              
                return [ 
                    'message' => 'Record not found',
                    'status'=>false
                ];
            }
            
            
            
        } else {
            
            return [
                'message' => 'Mobile no Required',
                'status'=>false
            ];
        }
        
        
    }
   
   
    public function getOrderList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $driverId = $request->input('driver_id');  
        $orders = Order::with('restaurant','users')->where('drivers_id', $driverId)->where('order_status','!=', 4)->where('driver_status','!=', 0)->orderBy('id', 'desc')->get();
        //  $orders = Order::with('restaurant', 'users')->where('drivers_id', $driverId)->where('order_status', '!=', 6)->whereIn('driver_status', [1,2])->orderBy('id', 'desc')->get(); 
       
        return response()->json(['status'=>true,'orders' => $orders]);
       
    }
    
    public function getOrderHistoryList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $driverId = $request->input('driver_id');  
        $orders = Order::with('restaurant','users')->where('drivers_id', $driverId)->where('order_status', 4)->where('driver_status','!=', 0)->orderBy('id', 'desc')->get();
        //  $orders = Order::with('restaurant', 'users')->where('drivers_id', $driverId)->where('order_status', '!=', 6)->whereIn('driver_status', [1,2])->orderBy('id', 'desc')->get(); 
       
        return response()->json(['status'=>true,'orders' => $orders]);
       
    }
    
   
    public function updateOrderStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'action' => 'required|in:1,0,2,3,4,5',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $orderId = $request->input('order_id');
        $driverId =  $request->input('driver_id');
        $action =(int) $request->input('action');
    
        $order = Order::findOrFail($orderId);
        
        if(!empty($order->restaurant_id)){
            $restaurant_fcm = DB::table('restaurant_admin')->where('id', $order->restaurant_id)->first()->fcm_token;
         }

         if(!empty($order->drivers_id)){
            $driver_fcm = DB::table('driver')->where('id', $order->drivers_id)->first()->fcm_token;
         }
       
        if ($action === 1) {
            $order->driver_status = 1;
            $order->save();
            
            $message = array(
                "url" => "Order Accept Success",
                "title" => "Order Accept Success",
                "sub_title" => "Order Accept Success",
                "type" => "driver_order_accept",
                "image" => "",
            );
            
            if(!empty($restaurant_fcm)){
                $res_data = $this->sendNotification($message, $restaurant_fcm);
            }
            
            if(!empty($driver_fcm)){
                $res_data = $this->sendNotification($message, $driver_fcm);
            }
            
            return response()->json(['message' => 'Order accepted successfully','status'=>true]);
        } elseif ($action ===0) {
            $driver_arr=[];
            if (!empty($order->cancle_driver)) {
                $old_arr = json_decode($order->cancle_driver);
                $old_arr[] = $driverId;
                $driver_arr = $old_arr;
            } else {
                $driver_arr[] = $driverId;
            }
            
            $order->driver_status = $action;
            $order->cancle_driver=json_encode($driver_arr);
            $order->save();
            $drivr_id=$this->assignDriverToOrder($orderId,$driverId,$driver_arr);
            return response()->json(['message' => 'Order cancelled successfully','status'=>true,'driver_id'=>$drivr_id]);
        }elseif ($action ===2) {
            
            $order->driver_status = $action;
            $order->save();
            return response()->json(['message' => 'Driving Start successfully','status'=>true]);
        }elseif ($action ===3) {
            
            $order->driver_status = $action;
            $order->save();
            return response()->json(['message' => 'Keep Order items successfully','status'=>true]);
        }elseif ($action ===4) {
            
            $order->driver_status = $action;
            $order->save();
            return response()->json(['message' => 'start drive successfully','status'=>true]);
        }elseif ($action ===5) {
            
            $order->driver_status = $action;
            $order->save();
            return response()->json(['message' => 'finish successfully','status'=>true]);
        }
        
    
        return response()->json(['message' => 'Invalid action provided','status'=>false], 400);
    }


    public function assignDriverToOrder($order_id,$driver_id,$driver_arr)
    {
        $order = Order::findOrFail($order_id);
    
        $factory = (new Factory())->withDatabaseUri(Config::getFirebaseDatabaseUrl());
        $database = $factory->createDatabase();
    
        // Get the drivers who are available and not assigned to other orders
        $availableDrivers = Driver::where('available', 1)->where('status', 1)->get();
        if ($availableDrivers->isEmpty()) {
            return response()->json(['message' => 'No available drivers.'], 404);
        }
    
        // Fetch driver locations from Firebase
        $driverLocations = [];
        foreach ($availableDrivers as $driver) {
            $driverLocation = $database->getReference('driver/' . $driver->id)->getValue();
            if ($driverLocation) {
                $driverLocations[$driver->id] = $driverLocation;
            }
        }
    
        // Calculate distances for each driver and the order's destination
        foreach ($availableDrivers as $driver) {
            if (isset($driverLocations[$driver->id])) {
                $distance = $this->calculateDistance(
                    $driverLocations[$driver->id]['latitude'],
                    $driverLocations[$driver->id]['longitude'],
                    $order->longitude,
                    $order->latitude
                );
                $driver->distance = $distance;
            }
        }

        $driverIdsToExclude =$driver_arr; 
        $otherAvailableDrivers = $availableDrivers->reject(function ($driver) use ($driverIdsToExclude) {
            return in_array($driver->id, $driverIdsToExclude);
        });
        
        if ($otherAvailableDrivers->isEmpty()) {
            return response()->json(['message' => 'No available drivers.','status'=>false], 404);
        }
        
        $nearestDriver = $otherAvailableDrivers->sortBy('distance')->first();
        $order->drivers_id = $nearestDriver->id;
        $order->save();
        
        return  $driverIdsToExclude;
    }


    function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radius of the Earth in kilometers
    
        $lat1Rad = deg2rad($lat1);
        $lon1Rad = deg2rad($lon1);
        $lat2Rad = deg2rad($lat2);
        $lon2Rad = deg2rad($lon2);
    
        $deltaLat = $lat2Rad - $lat1Rad;
        $deltaLon = $lon2Rad - $lon1Rad;
    
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($lat1Rad) * cos($lat2Rad) * sin($deltaLon / 2) * sin($deltaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        $distance = $earthRadius * $c;
    
        return $distance; // Distance in kilometers
    }


    public function getOrderDetails(Request $request){
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        } 
        
        $order_id = $request->input('order_id'); 
        $orders = Order::with('restaurant','order_items','users')->where('id', $order_id)->first(); 
        return response()->json(['status'=>true,'orders' => $orders]);
    }
    
    
    public function update_bank_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'holder_name' => 'required',
            'account_number' => 'required',
            'ifsc_code' => 'required',
            'other_information' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
        $details = Driver::where('id', $request->id)
            ->first();
            
        if($details)
        {
           $update_details =Driver::where('id', $request->id)
            ->update([
                'bank_name' => $request->bank_name,
                'branch_name' => $request->branch_name,
                'holder_name' => $request->holder_name,
                'account_number' => $request->account_number,
                'ifsc_code' => $request->ifsc_code,
                'other_information' => $request->other_information,
                ]);
            
                return response()->json(['message' => 'Bank Details updated success fully','status'=>true], 200);
        }
        else
        {
           return response()->json(['message' => 'Driver Not found','status'=>false], 200);
        }
    }
    
    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
        $details = Driver::where('id', $request->id)
            ->first();
            
        if($details)
        {
           $update_details =Driver::where('id', $request->id)
            ->update([
                'is_login' =>0
                ]);
            
                return response()->json(['message' => 'Logout successfully','status'=>true], 200);
        }else{
           return response()->json(['message' => 'Not found','status'=>false], 200);
        }
    }
    
    public function getNotification(Request $request){
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
        $driver_id=$request->driver_id;
        
        $result=DriverNotification::where('driver_id',$driver_id)->orWhere('driver_id',0)->get();
        
        return response()->json(['status'=>true,'data'=>$result]);
        
    }
    
    
    protected function sendNotification($message, $fcm_token)
    {

        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            "to" => $fcm_token,
            "collapse_key" => "type_a",
            "notification" => array(
                "body" => $message['url'],
                "title" => $message['title'],
                "sub_title" => $message['sub_title'],
                "type" => $message['type'],
                "image" => $message['image'] . "?format=jpg&crop=4560,2565,x790,y784,safe&fit=crop",
                "action" => json_encode(array("view")),
            ),
            "data" => array(
                "body" => $message['url'],
                "title" => $message['title'],
                "sub_title" => $message['sub_title'],
                "type" => $message['type'],
                "action" => json_encode(array("view")),
            ),
        );

        $fields = json_encode($fields, true);

        $headers = array('Authorization: key=' . env('FCM_SERVER_KEY'), 'Content-Type:  application/json');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }

    
    
    public function driverRating(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'driver_id' => 'required',
            'rating' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $customer_id = $request->input('customer_id');
        $driver_id = $request->input('driver_id');
        $rating = $request->input('rating');
        
        $existingRating = DriverRating::where('customer_id', $customer_id)
                            ->where('driver_id', $driver_id)
                            ->first();
        
        if ($existingRating) {
            $existingRating->rating = $rating;
            $existingRating->status = 1;
            $existingRating->save();
            return response(['message' => 'Driver rating updated  successfully', 'status' => true]);
        } else {
            DriverRating::create([
                'customer_id' => $customer_id,
                'driver_id' => $driver_id,
                'rating' => $rating,
                'status' => 1,
            ]);
            
            return response(['message' => 'Driver rating added successfully', 'status' => true]);
        }
    }
    
    public function driverRatingList(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
    
        $list = DriverRating::where('customer_id', $request->customer_id)->get();
        return response()->json([
            'status' => true,
            'drivers' => $list,
        ], 200);
    }

    
    public function driverRatingDelete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
        
        $rating = DriverRating::find($request->id);
        
        if (!$rating) {
            return response()->json([
                'status' => false,
                'message' => 'Driver Rating not found.'
            ], 404);
        } else {
            $rating->delete();
            return response()->json([
                'status' => true,
                'message' => 'Driver Rating deleted successfully.',
            ], 200);
        }
    }
}