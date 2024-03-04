<?php

namespace App\Http\Controllers\API\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\FoodAttribute;
use App\Models\Foods;
use App\Models\Order;
use App\Models\DinnerBook;
use App\Models\Custommer_address;
use App\Models\OrderItems;
use App\Models\AddToCart;
use App\Models\FoodAddons;
use App\Models\Commission ;
use App\Models\FoodSpecification;
use App\Models\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Dompdf\Dompdf;
use PDF;
use App\Helpers\Config;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Http\Response;
use App\Models\Restaurant;
use App\Models\FevOrder;
use App\Models\Driver;

class Orders extends Controller
{
    
    public function save_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'address_id' => 'required',
            'amount' => 'required',
            'restaurant_id' => 'required',
            'order_type' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $orderId = $this->generateOrderId();
        $restaurantId = $request->restaurant_id;
        $userId = $request->user_id;
        $addressId = $request->address_id;
        
        
    
        $transactionId = "DOJ" . uniqid() . strtoupper(uniqid());
    
        $data = AddToCart::where('user_id', $userId)->where('restaurant_id', $restaurantId)->get();
        
        // dd($data->toArray());
    
        if ($data->isEmpty()) {
            return response()->json(['message' => "Your Cart is Empty"], Response::HTTP_OK);
        }
        
        $addressObj = Custommer_address::where('id', $addressId)->first();

        if (!$addressObj) {
            return response()->json(['message' => "Your Cart is Empty"], Response::HTTP_OK);
        }
        
        $userId = $request->user_id;
        $addressString = $addressObj->address;
        $latitude = $addressObj->latitude;
        $longitude = $addressObj->longitude;
        $amount = $request->amount;
        $orderType = $request->order_type;
        $keepTime = $request->keep_time;
        $currentDateTime = now()->setTimezone('Asia/Kolkata')->format('Y-m-d');
    
    
        //Doj commission 
        if ($restaurantId) {
            $commisson=0;
            $commission = Commission::where('restaurant_id', $restaurantId)->first();
        
            if ($commission !== null) {
                $commissionPrice = $commission->commission_price;
                
                $commisson = ($commissionPrice/100)*$amount;
            }
        }


        $orderData = Order::create([
            'transactionId' => $transactionId,
            'order_id' => $orderId,
            'user_id' => $userId,
            'address' => $addressString,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'amount' => $amount,
            'doj_commession' => $commisson,
            'restaurant_id' => $restaurantId,
            'order_type' => $orderType,
            'keep_time' => $keepTime,
            'date' => $currentDateTime,
            'type' => "CASH_ON_DELEVERY",

        ]);
    
        if ($restaurantId) {
            $this->orderInFirebase($restaurantId, $orderId, $userId, $addressString, $latitude, $longitude, $amount, $orderData->id, $orderType);
        }
    
        if ($orderData->id) {
            $this->generateQRCode($orderData->id);
            $devilArray = [];
            foreach ($data as $item) {
                OrderItems::create([
                    'order_id' => $orderData->id,
                    'user_id' => $userId,
                    'food_id' => $item->food_id,
                    'restaurant_id' => $item->restaurant_id,
                    'quantity' => $item->quantity,
                    'amount' => $amount,
                    'food_name' => $item->foodName,
                    'food_image' => $item->foodImage,
                    'size' => $item->size,
                ]);
    
                $devilArray[] = $item;
            }
            
            // AddToCart::where('user_id',$userId)->where('food_id',$item->food_id)->where('restaurant_id',$item->restaurant_id)->delete();
        }
        
        // $res= $this->phonePe($transactionId,$amount);
    
        if (!empty($restaurantId)) {
            // $restaurantFcm = DB::table('restaurant_admin')->where('id', $restaurantId)->value('fcm_token');
            $restaurantFcm = DB::table('restaurant')->where('id', $restaurantId)->value('fcm_token');
            // dd($restaurantFcm);
            if($orderData){
                $orderData->item=$devilArray;
            }
            
            if (!empty($restaurantFcm)) {
                $message = [
                    "url" => "You Got New Order",
                    "title" => "You Got New Order",
                    "sub_title" => "You Got New Order",
                    "type" => "new_order",
                    "image" => "",
                    "data"=>$orderData,
                    // "item"=>$devilArray
                ];
                // dd($message,$restaurantFcm);
                $resData = $this->sendNotification($message, $restaurantFcm);
            }
        }
    
        return response()->json(["data"=>$message,'message' => "Order Successfully", 'status' => true], Response::HTTP_OK);
    }
    
    public function phonePe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'amount' => 'required',
            'restaurant_id' => 'required',
            'order_type' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $orderId = $this->generateOrderId();
        $restaurantId = $request->restaurant_id;
    
        $transactionId = "DOJ" . uniqid();
        $transactionId .= strtoupper(uniqid());
    
        $data = AddToCart::where('restaurant_id', $restaurantId)->get();
    
        if ($data->isEmpty()) {
            return response()->json(['message' => "Your Cart is Empty"], Response::HTTP_OK);
        }
    
        $userId = $request->user_id;
        $address = $request->address;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $amount = $request->amount;
        $orderType = $request->order_type;
        $keepTime = $request->keep_time;
        $currentDateTime = now()->setTimezone('Asia/Kolkata')->format('Y-m-d');
    
    
        /// Commission price
    
        if ($restaurantId) {
            $commisson=0;
            $commission = Commission::where('restaurant_id', $restaurantId)->first();
        
            if ($commission !== null) {
                $commissionPrice = $commission->commission_price;
                
                $commisson = ($commissionPrice/100)*$amount;
            }
        }

        $orderData = Order::create([
            'transactionId' => $transactionId,
            'order_id' => $orderId,
            'user_id' => $userId,
            'address' => $address,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'amount' => $amount,
            'doj_commession' => $commisson,
            'restaurant_id' => $restaurantId,
            'order_type' => $orderType,
            'keep_time' => $keepTime,
            'date' => $currentDateTime,
        ]);
    
        if ($restaurantId) {
            $this->orderInFirebase($restaurantId, $orderId, $userId, $address, $latitude, $longitude, $amount, $orderData->id, $orderType);
        }
    
        if ($orderData->id) {
            $this->generateQRCode($orderData->id);
    
            $devilArray = [];
            foreach ($data as $item) {
                OrderItems::create([
                    'order_id' => $orderData->id,
                    'user_id' => $userId,
                    'food_id' => $item->food_id,
                    'restaurant_id' => $item->restaurant_id,
                    'quantity' => $item->quantity,
                    'amount' => $amount,
                    'food_name' => $item->foodName,
                    'food_image' => $item->foodImage,
                    'size' => $item->size,
                ]);
    
                $devilArray[] = $item;
            }
            
            // AddToCart::where('user_id',$userId)->where('food_id',$item->food_id)->where('restaurant_id',$item->restaurant_id)->delete();

        }
    
        $data = [
            "merchantId" => "M1HI7FHTJBIS",
            "merchantTransactionId" => $transactionId,
            "merchantUserId" => "MUID123",
            "amount" => $amount * 100,
            "redirectUrl" => route('payment.response'),
            "redirectMode" => "POST",
            "callbackUrl" => route('payment.response'),
            "mobileNumber" => "8578805451",
            "deviceContext" => [
                "deviceOS" => "ANDROID"
            ],
            "paymentInstrument" => [
                "type" => "PAY_PAGE", // UPI_INTENT /// PAY_PAGE
                "targetApp" => "com.phonepe.app"
            ],
        ];
    
        $encode = base64_encode(json_encode($data));
    
        $saltKey = "4fae74ff-21a7-4126-aa34-c7399e04a998";
        $saltIndex = 1;
        
        $string = $encode . '/pg/v1/pay' . $saltKey;
        $sha256 = hash('sha256', $string);
        $finalHeader = $sha256 . '###' . $saltIndex;
    
        $response = Curl::to('https://api.phonepe.com/apis/hermes/pg/v1/pay')
            ->withHeader('Content-Type: application/json')
            ->withHeader('X-VERIFY: ' . $finalHeader)
            ->withData(json_encode(['request' => $encode]))
            ->post();
        
        $rData = json_decode($response);
        
        $rData = json_decode($response);
        if($rData->code=="FRA_CHECK_FAILED"){
           return response()->json($rData);
        }else{
            return response()->json($rData->data->instrumentResponse->redirectInfo);
        }
    }

    public function response(){
        
        $input = request()->all();
        
        $saltKey = "4fae74ff-21a7-4126-aa34-c7399e04a998";
        $saltIndex = 1;
        $finalHeader = hash('sha256', '/pg/v1/status/' . $input['merchantId'] . '/' . $input['transactionId'] . $saltKey) . '###' . $saltIndex;
    
        $response = Curl::to('https://api.phonepe.com/apis/hermes/pg/v1/status/' . $input['merchantId'] . '/' . $input['transactionId'])
            ->withHeader('Content-Type: application/json')
            ->withHeader('accept: application/json')
            ->withHeader('X-VERIFY: ' . $finalHeader)
            ->withHeader('X-MERCHANT-ID: ' . $input['merchantId'])
            ->get();
    
        
        $responseArray = json_decode($response, true);
        
        $order = Order::where('transactionId', $input['transactionId'])->first();
        
        if ($order && $order->amount) {
            $restaurant = Restaurant::where('restaurant_id', $order->restaurant_id)->first();
        
            if ($restaurant) {
                $newWalletAmount = $restaurant->wallet_amount + ($order->amount - $order->doj_commession);
                
                $restaurant->update(['wallet_amount' =>$newWalletAmount]);
                
                $restaurant->save();
            }
        }
        
        if ($order) {
            if($responseArray['code']=="PAYMENT_ERROR"){
               $updateData = [
                    'merchantId' => $responseArray['data']['merchantId'],
                    'transactionId' => $responseArray['data']['merchantTransactionId'],
                    'state' => $responseArray['data']['state'],
                    'responseCode' => $responseArray['data']['responseCode'],
                    'merchantTransactionId' => $responseArray['data']['merchantTransactionId'],
                    'payment_response' => json_encode($responseArray),
                ];
            }else{
                $updateData = [
                    'merchantId' => $responseArray['data']['merchantId'],
                    'state' => $responseArray['data']['state'],
                    'transactionId' => $input['transactionId'],
                    'responseCode' => $responseArray['data']['responseCode'],
                    'type' => $responseArray['data']['paymentInstrument']['type'],
                    'accountType' => $responseArray['data']['paymentInstrument']['accountType'],
                    'code' => $responseArray['code'],
                    'merchantTransactionId' => $responseArray['data']['merchantTransactionId'],
                    'payment_response' => json_encode($responseArray),
                    'order_status' =>4,
                ];
            }
            
            $order->update($updateData);
        }
    
        return response()->json($responseArray);
    }


    public function generateQRCode($orderId)
    {
        $order = Order::findOrFail($orderId);
    
        $qrCodeContent = [
            'order_id' => $order->order_id,
            'type' => 'qr_code',
        ];
    
        $fileName = Str::random(10) . ".png";
        QrCode::size(200)->format('png')
            ->backgroundColor(255, 255, 255)
            ->color(0, 0, 0)
            ->generate(json_encode($qrCodeContent), public_path('orders/qrcode/') . "/$fileName");
    
        $order->qr_code_content = $fileName;
        $order->save();
    
        return $fileName;
    }
    
    public function orderInFirebase($restaurantId,$orderId,$userId,$address,$latitude,$longitude,$amount,$id,$order_type){
      
        $factory = (new Factory())->withDatabaseUri(Config::getFirebaseDatabaseUrl());
        $database = $factory->createDatabase();
        
        $data = AddToCart::where('restaurant_id', $restaurantId)->get();
         if(!$data->isEmpty()){
          
          $order_data= [
            'order_id' => $orderId,
            'user_id' => $userId,
            'address' => $address,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'amount' => $amount,
            'order_status' => 0,
            'restaurant_id' => $restaurantId,
            'order_type' => $order_type,
            ];
         }
       
        
        $database->getReference('orders/'.$id) 
           ->update($order_data);
           $driver_data = [
                'driver_id' => '',
                'first_name' => '',
                'last_name' => '',
                'email' => '',
                'latitude' => '',
                'longitude' => '',
                'fcm_token' => '',
                'work_area' => '',
                'phone' => '',
                'vehicle' => '',
               ];
        $database->getReference('orders/'.$id.'/driver') 
           ->update($driver_data);
               
    }
    
    public function generateOrderId()
    {
        $prefix = 'DOJ';
        $randomPart = rand(10000, 99999); 
        
        $orderId = $prefix . '-' . $randomPart;
        
        return $orderId;
    }

    public function getOrderList(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        $restaurantId = $request->input('restaurant_id'); 
        // $userOrders = Order::with('restaurant', 'users', 'driver','order_items')->where('restaurant_id', $restaurantId)->orderByDesc('id')->get(); 
        
        $userOrders = Order::with('restaurant', 'users', 'driver', 'order_items')->where('restaurant_id', $restaurantId)->whereHas('driver', function ($query) {
            $query->where('driver_status', 1);
        })
        ->orderByDesc('id')
        ->get(); 
        
        
        return response()->json(['orders' => $userOrders,'status'=>true], 200);
    }
    
    
    public function getOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        $restaurantId = $request->input('restaurant_id');
        $today = Carbon::now()->format('Y-m-d');
        $orders = Order::where('restaurant_id', $restaurantId)
            ->where('date', $today)
            ->get();
    
        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found for the specified restaurant and date.'], Response::HTTP_NOT_FOUND);
        }
    
        $data = [
            'total_orders' => $orders->count(),
            'confirm_order' => $orders->where('order_status', 1)->count(),
            'cancel_order' => $orders->where('order_status', -1)->count(),
            'dispatch_order' => $orders->where('order_status', 2)->count(),
            'complete_order' => $orders->where('order_status', 4)->count(),
        ];
    
        return response()->json(['data' => $data, 'status' => true]);
    }
    
    public function orderList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        $restaurantId = $request->input('restaurant_id');
        $orderlist = Order::where('restaurant_id', $restaurantId)->orderBy('id', 'DESC')->get();
        return response()->json(['data'=>$orderlist, 'status'=>true]);
    }

    public function changeOrderStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'action' => 'required|in:3,4',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $orderId = $request->input('order_id');
        $action = $request->input('action');
       
        $order = Order::findOrFail($orderId);
        
        if(!empty($order->restaurant_id)){
            $restaurantAdmin = DB::table('restaurant_admin')->where('id', $order->restaurant_id)->first();
            
            if ($restaurantAdmin && $restaurantAdmin->fcm_token) {
                $restaurant_fcm = $restaurantAdmin->fcm_token;
            }
         }
         
         
         if(!empty($order->user_id)){
            $customer = DB::table('customer')->where('id', $order->user_id)->first();
            if ($customer && $customer->fcm_token) {
                $customer_fcm = $customer->fcm_token;
            }
         }
         
         if(!empty($order->drivers_id)){
            $driver_fcm = DB::table('driver')->where('id', $order->drivers_id)->first()->fcm_token;
         }
        
        if ($action === "3") {
            $order->order_status = $action;
            $order->save();
            
           
            if($order->type=="CASH_ON_DELEVERY"){
                $driver = Driver::findOrFail($order->drivers_id);
                $currentWalletAmount = $driver->wallet;
                $orderAmount = $order->amount;
                
                $newWalletAmount = $currentWalletAmount - $orderAmount;

                $driver->update(['wallet' => $newWalletAmount]);

            }
            
            $this->updateOrderFirebase($orderId,$action);
            $message = array(
                "url" => "Payment Successfully",
                "title" => "Payment Successfully",
                "sub_title" => "Payment Successfully",
                "type" => "payment_success",
                "image" => "",
            );
            
            if(!empty($restaurant_fcm)){
                $res_data = $this->sendNotification($message, $restaurant_fcm);
            }
            
            if(!empty($customer_fcm)){
                $res_data = $this->sendNotification($message, $customer_fcm);
            }
            
            if(!empty($driver_fcm)){
                $res_data = $this->sendNotification($message, $driver_fcm);
            }
            
            return response()->json(['message' => 'Payment Successfully','status'=>true]);
        }elseif($action === "4"){
            $order->order_status = $action;
            $order->save();
             $this->updateOrderFirebase($orderId,$action);
            $data = $this->generate_invoice($orderId);
            
            $message = array(
                "url" => "Order Completed Successfully",
                "title" => "Order Completed Successfully",
                "sub_title" => "Order Completed Successfully",
                "type" => "order_complete",
                "image" => "",
            );
            if(!empty($restaurant_fcm)){
                $res_data = $this->sendNotification($message, $restaurant_fcm);
            }
            
            if(!empty($customer_fcm)){
                $res_data = $this->sendNotification($message, $customer_fcm);
            }
            
            if(!empty($driver_fcm)){
                $res_data = $this->sendNotification($message, $driver_fcm);
            }
            
            return response()->json(['message' => 'Order Completed','status'=>true]);
        }
    
        return response()->json(['message' => 'Invalid action provided','status'=>false], 400);
    }
    
    public function updateOrderFirebase($orderId,$status){
       
        $factory = (new Factory())->withDatabaseUri(Config::getFirebaseDatabaseUrl());
        $database = $factory->createDatabase();
        $database->getReference('orders/'.$orderId)->update(['order_status' => $status]);
    } 
   
    public function generate_invoice($order_id='') {
        $order = Order::with('restaurant', 'users', 'driver', 'order_items')
            ->where('id', $order_id)
            ->first();
    
        if (!$order) {
            return abort(404); 
        }
    
        // Generate PDF
        $html = view('email_template.order_invoice', compact('order'))->render();
        $pdf = PDF::loadHTML($html);
        $name = strtolower(uniqid());
        $v_file_name = "orders/invoice/" . $name . ".pdf";
        $pdf->setPaper('a4', 'portrait');
        $pdf->save(public_path($v_file_name));
    
        // Update the invoice path in the database
        DB::table('orders')->where('id', $order_id)->update(['invoice_pdf' => $v_file_name]);
    
        // Retrieve the updated order record
        $updatedOrder = Order::find($order_id);
    
        return $updatedOrder;
    }
   
    public function book_dinner(Request $request){
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
            'customer_id' => 'required',
            'book_date' => 'required',
            'book_time' => 'required',
            'number_of_guests' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $dinnerBooking = new DinnerBook();
        $dinnerBooking->restaurant_id = $request->input('restaurant_id');
        $dinnerBooking->customer_id = $request->input('customer_id');
        $dinnerBooking->booking_date = $request->input('book_date');
        $dinnerBooking->booking_time = $request->input('book_time');
        $dinnerBooking->number_of_guests = $request->input('number_of_guests');
    
        if ($dinnerBooking->save()) {
            $message = [
                "url" => "Dinner Booked Successfully",
                "title" => "Dinner Booked Successfully",
                "sub_title" => "Dinner Booked Successfully",
                "type" => "dinner_book",
                "image" => "",
            ];
    
            $restaurant_fcm = DB::table('restaurant_admin')->where('id', $dinnerBooking->restaurant_id)->value('fcm_token');
    
            $customer_fcm = DB::table('customer')->where('id', $dinnerBooking->customer_id)->value('fcm_token');
    
            if (!empty($restaurant_fcm)) {

                $newOrderMessage = [
                    "url" => "New Order Received",
                    "title" => "New Order Received",
                    "sub_title" => "You have a new order",
                    "type" => "new_order",
                    "image" => "",
                ];
                
                $res_data = $this->sendNotification($newOrderMessage, $restaurant_fcm);
            }
    
            if (!empty($customer_fcm)) {
                $res_data = $this->sendNotification($message, $customer_fcm);
            }
    
            return response()->json(['status' => true, 'message' => 'Booking successful']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong!']);
        }
    }

    

    protected function sendNotification($message, $fcm_token)
    {

        $url = 'https://fcm.googleapis.com/fcm/send';
        // dd($message);
        if($message['type'] == 'payment_success' || $message['type'] == 'order_complete')
        {
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
        } else {
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
                "data" => $message['data'],
                "action" => json_encode(array("view")),
            ),
        );
        }
        
        // dd(env('FIREBASE_KEY'));
        $fields = json_encode($fields, true);
        $headers = array('Authorization: key=AAAA7DzmY8Q:APA91bFiESWHN5VYdm-0QBljhZwJLXQn_pQ-2vVTa3HQ12dn4rG51YJxYEhozXfvKovoUcmyyNT-wHgFdQ_QP699q1d217owQLiC1mlLC_EQ8b4gEQZcisR2g9TPtUj68rGSwVPEf2Qc', 'Content-Type:  application/json');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);
        // dd($result);
        return json_decode($result);
    }
    
    public function summary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $order_summary = Order::with('customer', 'restaurant:id,name,address,latitude,longitude', 'driver:id,first_name,last_name', 'order_items')->where('order_id', $request->order_id)->first();
    
        if (!$order_summary) {
            return response()->json(['status' => false, 'message' => 'Order not found.'], 404);
        }
    
        $orderItems = $order_summary->order_items->map(function ($item) {
            return [
                'size' => $item->size ?? '',
                'quantity' => $item->quantity ?? '',
            ];
        });
    
        $data = [
            'status' => true,
            'order_summary' => [
                'id' => $order_summary->id ?? '',
                'order_id' => $order_summary->order_id ?? '',
                'transactionId' => $order_summary->transactionId ?? '',
                'date' => $order_summary->date ?? '',
                'amount' => $order_summary->amount ?? '',
                'address' => $order_summary->address ?? '',
                'order_type' => $order_summary->order_type ?? '',
                'order_status' => $order_summary->order_status ?? '',
                'latitude' => $order_summary->latitude ?? '',
                'restaurant' => [
                    'id' => $order_summary->restaurant->id ?? '',
                    'name' => $order_summary->restaurant->name ?? '',
                    'address' => $order_summary->restaurant->address ?? '',
                    'latitude' => $order_summary->restaurant->latitude ?? '',
                    'longitude' => $order_summary->restaurant->longitude ?? ''
                ],
                'driver' => [
                    'first_name' => $order_summary->driver->first_name ?? '',
                    'last_name' => $order_summary->driver->last_name ?? ''
                ],
                'order_items' => $orderItems
            ]
        ];
    
        // Generate PDF using Dompdf or TCPDF
        $pdf = PDF::loadView('pdf.summary', $data);
    
        // Return PDF as a response
        return $pdf->download('order_summary.pdf');
    }
    
    public function get_list_fev_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        // Assuming you have an Eloquent model named FevOrder
        $fev_orders = FevOrder::where('customer_id', $request->customer_id)->get();
    
        return response()->json([
            'status' => true,
            'fev_orders' => $fev_orders
        ], 200);
    }

    public function order_like(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'order_id' => 'required',
            'status' => 'required', // Assuming status indicates whether it's liked or not
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $customer_id = $request->input('customer_id');
        $order_id = $request->input('order_id');
        $status = $request->input('status');
    
        $like = FevOrder::where('customer_id', $customer_id)
                         ->where('order_id', $order_id)
                         ->first();
    
        if (!$like) {
            $like = new FevOrder();
            $like->customer_id = $customer_id;
            $like->order_id = $order_id;
        }
    
        $like->status = $status;
        $like->save();
    
        return response(['message' => 'Order liked successfully', 'status' => true]);
    }
    
    public function order_unlike(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'order_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $customer_id = $request->input('customer_id');
        $order_id = $request->input('order_id');
    
        // Find and delete the like record if it exists
        $like = FevOrder::where('customer_id', $customer_id)
                         ->where('order_id', $order_id)
                         ->first();
    
        if ($like) {
            $like->delete();
            return response(['message' => 'Order unliked successfully', 'status' => true]);
        } else {
            return response(['message' => 'Order was not previously liked', 'status' => false]);
        }
    }

    
    
}