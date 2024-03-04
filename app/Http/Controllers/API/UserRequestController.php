<?php

namespace App\Http\Controllers\API;

use App\Models\UserWithdrawalRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Customer;
use Carbon\Carbon;

class UserRequestController extends Controller
{
    public function createRequest(Request $request)
    {
        $validate = [
            'amount' => 'required',
            'customer_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $validate);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ], 200);
        }
    
        $rest_data = Customer::find($request->customer_id); // Using find() instead of where()
        
        if ($rest_data) {
            if ($rest_data->total_wallet >= $request->amount) {
                $check_request = UserWithdrawalRequest::where('customer_id', $request->customer_id)
                    ->where('status', 1)
                    ->first();
                
                if ($check_request) {
                    return response()->json([
                        'status' => false,
                        'message' => 'You have already sent a withdrawal request. Please wait for a response.',
                    ], 200);
                } else {
                    $data = UserWithdrawalRequest::create([
                        'amount' => $request->amount,
                        'customer_id' => $request->customer_id,
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
            'customer_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $validate);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ], 200);
        }
        $customers = UserWithdrawalRequest::where('customer_id', $request->customer_id)->get();
        
        $customers->transform(function ($customer) {
            $customer->photo_url = asset('images/user/transaction/' . $customer->image);
            return $customer;
        });
        return response()->json([
            'status' => true,
            'message' => 'Withdrawal history get successfully.',
            'data' => $customers,
        ], 200);
    }
    
}