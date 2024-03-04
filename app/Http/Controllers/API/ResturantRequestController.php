<?php

namespace App\Http\Controllers\API;

use App\Models\ResturantWithdrawalRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Restaurant;
use Carbon\Carbon;

class ResturantRequestController extends Controller
{
    public function createRequest(Request $request)
    {
        $validate = [
            'amount' => 'required',
            'resturant_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $validate);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ], 200);
        }
    
        $rest_data = Restaurant::find($request->resturant_id); // Using find() instead of where()
        
        if ($rest_data) {
            if ($rest_data->wallet_amount >= $request->amount) {
                $check_request = ResturantWithdrawalRequest::where('resturant_id', $request->resturant_id)
                    ->where('status', 1)
                    ->first();
                
                if ($check_request) {
                    return response()->json([
                        'status' => false,
                        'message' => 'You have already sent a withdrawal request. Please wait for a response.',
                    ], 200);
                } else {
                    $data = ResturantWithdrawalRequest::create([
                        'amount' => $request->amount,
                        'resturant_id' => $request->resturant_id,
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
            'resturant_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $validate);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ], 200);
        }
        $resturants = ResturantWithdrawalRequest::where('resturant_id', $request->resturant_id)->get();
        
        $resturants->transform(function ($resturant) {
            $resturant->photo_url = asset('images/restaurants/transaction/' . $resturant->image);
            return $resturant;
        });
        return response()->json([
            'status' => true,
            'message' => 'Withdrawal history get successfully.',
            'data' => $resturants,
        ], 200);
    }
    
}