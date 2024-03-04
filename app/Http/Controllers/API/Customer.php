<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Custommer_address;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\RestaurantLike;
use App\Models\DinnerBook;
use App\Models\CustomerAmount;
use App\Models\WalletHistory;
use App\Models\GiftCardPurchase;
use App\Models\Rating;
use App\Models\FoodRating;
use Carbon\Carbon;
use Http;

class Customer extends Controller
{
    public function save_address(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|integer',
            'name' => 'required',
            'pincode' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'streetname' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $customerAddress = new Custommer_address($request->all());
        $customerAddress->save();

        return response()->json(['message' => 'Address Added successfully','status'=>200,'error'=>false,'data'=>$customerAddress], Response::HTTP_CREATED);
        
    }
    
    public function update_address(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'name' => 'required',
            'pincode' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'streetname' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $id = $request->id;
        $customerAddress = Custommer_address::find($id);
    
        if (!$customerAddress) {
            return response()->json(['message' => 'Address not found','error' => true], Response::HTTP_NOT_FOUND);
        }
    
        // Update the address fields
        $customerAddress->update($request->all());
    
        return response()->json(['message' => 'Address updated successfully', 'status' => 200,'data' => $customerAddress], Response::HTTP_OK);
    }
    
    public function delete_address(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $id = $request->id;
        $customerAddress = Custommer_address::find($id);
    
        if (!$customerAddress) {
            return response()->json(['message' => 'Address not found','error' => true], Response::HTTP_NOT_FOUND);
        }
    
        // Update the address fields
        $customerAddress->delete();
    
        return response()->json(['message' => 'Address deleted successfully', 'status' => 200,], Response::HTTP_OK);
    }

    
    public function get_address(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'customer_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        $userId = $request->input('customer_id'); 
        $userOrders = Custommer_address::where('customer_id', $userId)->get();
        
        
        $status = count($userOrders) > 0;
          
        return response()->json(['status' => $status,'orders' => $userOrders], 200);
    }
    
    
    public function getOrderList(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        $userId = $request->input('user_id'); 
        $userOrders = Order::with('restaurant','order_items','driver')->where('user_id', $userId)->get();
        
        foreach ($userOrders as $order) {
            $order->invoice_pdf = asset($order->invoice_pdf);
            $order->qr_code = asset('orders/qrcode/'.$order->qr_code_content);
        }
        
        $status = $userOrders !== null;
          
        return response()->json(['status' => $status,'orders' => $userOrders], 200);
    }
    
    // public function getOrderDetails(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => 'required|integer',
    //         'order_id' => 'required|integer',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
    //     }
    
    //     $userId = $request->input('user_id'); 
    //     $order_id = $request->input('order_id'); 
    //     $userOrders = Order::with('restaurant','order_items','driver')->where('user_id', $userId)->where('id', $order_id)->first();
        
    //     if ($userOrders !== null) {
    //         $userOrders->invoice_pdf =  asset($userOrders->invoice_pdf);
    //     }
    //     $status = $userOrders !== null;
    
    //     return response()->json(['orders' => $userOrders, 'status' => $status], 200);
    // }
    
    public function getOrderDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'order_id' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        $userId = $request->input('user_id');
        $orderId = $request->input('order_id');
        
        $userOrders = Order::with('restaurant', 'order_items', 'driver')
            ->where('user_id', $userId)
            ->where('id', $orderId)
            ->first();
    
        if ($userOrders !== null) {
            $restaurantRating = Rating::where('order_id', $orderId)->where('customer_id', $userId)->first();
            $userOrders->restaurant_rating = $restaurantRating ?? 0;
    
            $foodRating = FoodRating::where('order_id', $orderId)->where('customer_id', $userId)->first();
            $userOrders->food_rating = $foodRating ?? 0;
    
            // Append the full URL to the invoice PDF
            $userOrders->invoice_pdf = asset($userOrders->invoice_pdf);
        }
    
        $status = $userOrders !== null;
    
        return response()->json(['orders' => $userOrders, 'status' => $status], 200);
    }
    
    
    public function get_restaurant_like(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        $customer_id = $request->input('customer_id'); 
        $userLikes = RestaurantLike::with('restaurant')->where('customer_id', $customer_id)->get();
        
        $status = $userLikes->isEmpty() ? false : true;

        return response()->json(['userLikes' => $userLikes,'status'=>$status]);
    }
    
    public function book_dinner_list(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $customerId = $request->input('customer_id');
    
        $bookings = DinnerBook::with(['restaurant', 'users'])->where('customer_id', $customerId)->get();
    
        if ($bookings->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'No dinner bookings found']);
        }
    
        return response()->json(['status' => true, 'data' => $bookings]);
    }
    
    
    public function add_wallet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customer,id',
            'amount' => 'required|numeric|min:0',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $customer_id = $request->customer_id;
        $amount = $request->amount;
    
        $user = CustomerAmount::findOrFail($customer_id);
        
        $payload = [
            "merchantId" => "PGTESTPAYUAT",
            "merchantTransactionId" => $this->merchantTransactionId(),
            "merchantUserId" => "MUID123",
            "amount" => $amount * 100,
            "redirectUrl" => route('wallet.response'),
            "redirectMode" => "POST",
            "callbackUrl" => route('wallet.response'),
            "mobileNumber" => $user->mobile_number,
            "deviceContext" => [
                "deviceOS" => "ANDROID"
            ],
            "paymentInstrument" => [
                "type" => "PAY_PAGE",
                "targetApp" => "com.phonepe.app"
            ]
        ];
        
        $base64Payload = base64_encode(json_encode($payload));
        
        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;
        
        $xVerifyHeaderValue = hash('sha256', $base64Payload . "/pg/v1/pay" . $saltKey) . "###". $saltIndex;
        
        // dd($payload);
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-VERIFY' => $xVerifyHeaderValue,
            'accept' => 'application/json',
        ])->post('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay', [
            'request' => $base64Payload,
        ]);
        
        
        
        $rData = json_decode($response);
        
        $rData = json_decode($response);
        if($rData->code=="FRA_CHECK_FAILED"){
           return response()->json($rData);
        }else{
            $user->transactionId =$rData->data->merchantTransactionId;
            $user->save();
            return response()->json($rData->data->instrumentResponse->redirectInfo);
        }
    }
    
    public function merchantTransactionId(){
        $prefix = 'DOJ';
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = $prefix;
        
        for ($i = 0; $i < 24; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        return $code;
    }
    
    public function wallet_response(Request $request)
    {
        $input = $request->all();
        
        // dd($input['merchantId']);
        $merchantTransactionId = $input['transactionId'];
    
        $merchantId = $input['merchantId'];
        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;
        
        $string = "/pg/v1/status/{$merchantId}/{$merchantTransactionId}" . $saltKey; 
        $sha256 = hash('sha256', $string);
        $xVerifyHeaderValue = $sha256 . '###' . $saltIndex;
    
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-MERCHANT-ID' => $merchantId,
            'X-VERIFY' => $xVerifyHeaderValue,
            'accept' => 'application/json',
        ])->get("https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/{$merchantId}/{$merchantTransactionId}");
    
        $responseData = json_decode($response);
        
        $customer = CustomerAmount::where('transactionId', $input['transactionId'])->first();
        // dd($customer->id); 
        if (!isset($responseData->data->paymentInstrument) || !isset($responseData->data->paymentInstrument->type)) {
            return response()->json([
                'status' => 'Error', 
                'message' => 'Payment failed or not completed' 
            ], 200);
        }
        if ($responseData->success && $responseData->code === 'PAYMENT_PENDING') {
            
            $this->manageTransaction($customer->id, $responseData->data->amount, $merchantTransactionId, $responseData->data->transactionId, $responseData->data->paymentInstrument->type ,'pending');
            return response(['status' => 'Pending', 'message' => 'Payment is pending'], 200);
        } elseif ($responseData->success && $responseData->code === 'PAYMENT_SUCCESS') {
            $this->updateWallet($customer->id, $responseData->data->amount);
            $this->manageTransaction($customer->id, $responseData->data->amount, $merchantTransactionId, $responseData->data->transactionId, $responseData->data->paymentInstrument->type, 'success');
    
            return response(['status' => 'Success', 'message' => 'Payment successful'], 200);
        } else {
            // Payment failed or has not been completed
            $this->manageTransaction($customer->id, $responseData->data->amount, $merchantTransactionId,$responseData->data->transactionId, $responseData->data->paymentInstrument->type, 'failed');
            return response(['status' => 'Error', 'message' => 'Payment failed or not completed'], 200);
        }
    }
    
    private function updateWallet($customerId, $amount) {
        $user = CustomerAmount::findOrFail($customerId);
        $user->total_wallet += $amount/100;
        $user->save();
    }
    
    private function manageTransaction($customerId, $amount, $merchantTransactionId, $transactionId,$type, $status) {
        $transactionDate = Carbon::now('Asia/Kolkata');

        WalletHistory::create([
            'customer_id' => $customerId,
            'amount' => $amount/100,
            'type' => 'credit', 
            'transaction_date' => $transactionDate, 
        ]);

    }
    
    // public function get_wallet_history(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'customer_id' => 'required|exists:customer,id',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response(['errors' => $validator->errors()->all()], 422);
    //     }
    
    //     $customer_id = $request->customer_id;
        
    //     // Get total_wallet for the customer
    //     $user = CustomerAmount::findOrFail($customer_id);
    //     if(!$user){
    //         return response([
    //         'status' => false,
    //         'message' => "Customer Not found",
    //     ]);
    //     }
    //     $totalWallet = $user->total_wallet;
    
    //     // Get wallet history for the customer
    //     $walletHistory = WalletHistory::where('customer_id', $customer_id)
    //         ->orderBy('transaction_date', 'desc')
    //         ->get();
    
    //     return response([
    //         'total_wallet' => $totalWallet,
    //         'wallet_history' => $walletHistory,
    //         'status' => true
    //     ], 200);
    // }
    
    
    public function get_wallet_history(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customer,id',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $customer_id = $request->customer_id;
    
        $user = CustomerAmount::find($customer_id); 
        if (!$user) {
            return response([
                'status' => false,
                'message' => "Customer Not found",
            ]);
        }
        
        $totalWallet = $user->total_wallet;
    
        $walletHistory = WalletHistory::where('customer_id', $customer_id)
            ->orderBy('transaction_date', 'desc')
            ->get();
    
        return response([
            'total_wallet' => $totalWallet,
            'wallet_history' => $walletHistory,
            'status' => true
        ], 200);
    }


    public function purchaseGiftCard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'image_url' => 'required',
            'message' => 'required',
            'card_value' => 'required|numeric|min:0',
            // Add more validation rules as needed
        ]);
        
        // ['card_code', 'card_value', 'expiration_date', 'date_issued','date_redeemed','customer_id','image_id','recipient_name','recipient_email','message','is_redeemed','redeemed_order_id','is_active']
        
        if ($validator->fails()) {
            return response(['status'=>false,'errors' => $validator->errors()->all()], 422);
        }
        
        $customer_id = $request->customer_id;
        
        $checkWallet = CustomerAmount::findOrFail($customer_id);
        if($checkWallet->total_wallet >= $request->card_value){
            $currentDate = Carbon::now('Asia/Kolkata');
            
            $checkWallet = CustomerAmount::findOrFail($customerId);
            $checkWallet->total_wallet -= $request->card_value;
            $checkWallet->save();
            
            // Create and save the gift card
            $giftCard = new GiftCardPurchase([
                'customer_id' => $request->input('customer_id'),
                'image_url' => $request->input('image_url'),
                'message' => $request->input('message'),
                'card_code' => $this->generateOrderId(),
                'card_value' => $request->input('card_value'),
                'expiration_date' => $currentDate->addDays(30),
                'date_issued' => Carbon::now('Asia/Kolkata'),
                'is_active' =>1,
            ]);
            
            $transactionDate = Carbon::now('Asia/Kolkata');
            WalletHistory::create([
                'customer_id' => $customerId,
                'amount' => $request->card_value,
                'type' => 'credit', 
                'transaction_date' => $transactionDate, 
            ]);
            if ($giftCard->save()) {
                return response(['message' => 'Gift Card Purchase successfully', 'status' => true], 201);
            } else {
                return response(['message' => 'Something went wrong', 'status' => false], 500);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'You have not enough wallet amount to purchage this Gift Card'
            ],200);
        }
        
    }
    
    public function get_purchaseGiftCard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response(['status'=>false,'errors' => $validator->errors()->all()], 422);
        }
        $giftCard = GiftCardPurchase::where('customer_id',$request->customer_id)->where('is_active',1)->get();
        
        return response([
            'status' => true,
            'gift' => $giftCard
        ], 200);

    }
    
    public function claim_purchaseGiftCard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_code' => 'required',
            'customer_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response(['status' => false, 'errors' => $validator->errors()->all()], 422);
        }
        
        $giftCard = GiftCardPurchase::where('card_code', $request->card_code)->first();
        
        if (!$giftCard) {
            return response(['status' => false, 'message' => 'Invalid gift card code'], 200);
        }
        
        if ($giftCard->is_redeemed == 0) {
            $giftCard->is_redeemed = 1;
            $giftCard->date_redeemed = Carbon::now('Asia/Kolkata');
            $giftCard->save();
            
            $user = CustomerAmount::findOrFail($request->customer_id);
            $user->total_wallet += $giftCard->card_value;
            $user->save();
            
            return response([
                'status' => true,
                'message' => 'Gift card is claimed successfully'
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Gift card is already claimed'
            ], 200);
        }
    }
    
    public function generateOrderId()
    {
        $prefix = 'DOJ';
        $randomPart = rand(1000000, 9999999);
        $currentTime = Carbon::now('Asia/Kolkata')->format('His');
    
        $orderId = $prefix .$randomPart. $currentTime;
    
        return $orderId;
    }
    
    
    
    
    public function purchage_gift(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'image_url' => 'required',
            'message' => 'required',
            'card_value' => 'required|numeric|min:0',
        ]);
        
        if ($validator->fails()) {
            return response(['status'=>false,'errors' => $validator->errors()->all()], 422);
        }
        
        $customer_id = $request->customer_id;
        $amount = $request->card_value;
    
        $user = CustomerAmount::findOrFail($customer_id);
        
        $payload = [
            "merchantId" => "PGTESTPAYUAT",
            "merchantTransactionId" => $this->merchantTransactionId(),
            "merchantUserId" => "MUID123",
            "amount" => $amount * 100,
            "redirectUrl" => route('gift.response'),
            "redirectMode" => "POST",
            "callbackUrl" => route('gift.response'),
            "mobileNumber" => $user->mobile_number,
            "deviceContext" => [
                "deviceOS" => "ANDROID"
            ],
            "paymentInstrument" => [
                "type" => "PAY_PAGE",
                "targetApp" => "com.phonepe.app"
            ]
        ];
        
        $base64Payload = base64_encode(json_encode($payload));
        
        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;
        
        $xVerifyHeaderValue = hash('sha256', $base64Payload . "/pg/v1/pay" . $saltKey) . "###". $saltIndex;
        
        // dd($payload);
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-VERIFY' => $xVerifyHeaderValue,
            'accept' => 'application/json',
        ])->post('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay', [
            'request' => $base64Payload,
        ]);
        
        $rData = json_decode($response);
        
        $rData = json_decode($response);
        if($rData->code=="FRA_CHECK_FAILED"){
           return response()->json($rData);
        }else{
            $currentDate = Carbon::now('Asia/Kolkata');
            $giftCard = new GiftCardPurchase([
                'customer_id' => $request->input('customer_id'),
                'image_url' => $request->input('image_url'),
                'message' => $request->input('message'),
                'card_code' => $this->generateOrderId(),
                'card_value' => $request->input('card_value'),
                'expiration_date' => $currentDate->addDays(30),
                'date_issued' => Carbon::now('Asia/Kolkata'),
                'is_active' => 0,
                'transactionId' =>$rData->data->merchantTransactionId,
            ]);
            $giftCard->save();
            return response()->json($rData->data->instrumentResponse->redirectInfo);
        }
    }
    
    public function gift_response(Request $request)
    {
        $input = $request->all();
        
        // dd($input['merchantId']);
        $merchantTransactionId = $input['transactionId'];
    
        $merchantId = $input['merchantId'];
        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;
        
        $string = "/pg/v1/status/{$merchantId}/{$merchantTransactionId}" . $saltKey; 
        $sha256 = hash('sha256', $string);
        $xVerifyHeaderValue = $sha256 . '###' . $saltIndex;
    
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-MERCHANT-ID' => $merchantId,
            'X-VERIFY' => $xVerifyHeaderValue,
            'accept' => 'application/json',
        ])->get("https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/{$merchantId}/{$merchantTransactionId}");
    
        $responseData = json_decode($response);
        
        $gift = GiftCardPurchase::where('transactionId', $input['transactionId'])->first();
        // dd($customer->id); 
        if (!isset($responseData->data->paymentInstrument) || !isset($responseData->data->paymentInstrument->type)) {
            return response()->json([
                'status' => 'Error', 
                'message' => 'Payment failed or not completed' 
            ], 200);
        }
        if ($responseData->success && $responseData->code === 'PAYMENT_PENDING') {
            return response(['status' => 'Pending', 'message' => 'Payment is pending'], 200);
        } elseif ($responseData->success && $responseData->code === 'PAYMENT_SUCCESS') {
            $gift->is_active = 1;
            $gift->save();
            return response(['status' => 'Success', 'message' => 'Payment successful'], 200);
        } else {
            return response(['status' => 'Error', 'message' => 'Payment failed or not completed'], 200);
        }
    }
    
    

}