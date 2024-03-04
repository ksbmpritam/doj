<?php

namespace App\Http\Controllers\API;

use App\Models\DriverWithdrawalRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Driver;
use Carbon\Carbon;

class DriverRequestController extends Controller
{
    public function createRequest(Request $request)
    {
        $validate = [
            'amount' => 'required',
            'driver_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $validate);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ], 200);
        }
    
        $rest_data = Driver::find($request->driver_id); // Using find() instead of where()
        
        if ($rest_data) {
            if ($rest_data->wallet >= $request->amount) {
                $check_request = DriverWithdrawalRequest::where('driver_id', $request->driver_id)
                    ->where('status', 1)
                    ->first();
                
                if ($check_request) {
                    return response()->json([
                        'status' => false,
                        'message' => 'You have already sent a withdrawal request. Please wait for a response.',
                    ], 200);
                } else {
                    $data = DriverWithdrawalRequest::create([
                        'amount' => $request->amount,
                        'driver_id' => $request->driver_id,
                        'date' => now(),
                        'status' => 1,
                    ]);
    
                    if ($data) {
                        return response()->json([
                            'status' => true,
                            'message' => 'Withdrawal request sent successfully.',
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'Something went wrong.',
                        ], 200);
                    }
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'You do not have sufficient amount to send a withdrawal request.',
                ], 200);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'ID not found.',
            ], 200);
        }
    }

    
    public function getHistory(Request $request)
    {
        $validate = [
            'driver_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $validate);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ], 200);
        }
        $drivers = DriverWithdrawalRequest::where('driver_id', $request->driver_id)->get();
        
        $drivers->transform(function ($driver) {
            $driver->photo_url = asset('images/driver/transaction/' . $driver->image);
            return $driver;
        });
        return response()->json([
            'status' => true,
            'message' => 'Withdrawal history get successfully.',
            'data' => $drivers,
        ], 200);
    }
    
}