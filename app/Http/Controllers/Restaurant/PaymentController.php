<?php

namespace App\Http\Controllers\Restaurant;
use App\Http\Controllers\Controller;
use paytm\paytmchecksum\PaytmChecksum;
use Illuminate\Http\Request;
use Response;
use Braintree;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\Foods;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\OrderItems;
use App\Models\FoodRating;
use App\Models\Rating;

class PaymentController extends Controller
{
   
    public function getPaytmChecksum(Request $request)
    {   
        $input=$request->all();   
        
        $paytmParams = array();

        $paytmParams["MID"] = $input['mid'];
        $paytmParams["ORDERID"] = $input['order_id'];
        $merchant_key=$input['key_secret'];
      
        $paytmChecksum = PaytmChecksum::generateSignature($paytmParams, $merchant_key);
        $result=array('code'=>$paytmChecksum);
        return response()->json($result);
    }

    public function validateChecksum(Request $request)
    {   
        $input=$request->all();   
        
        $paytmParams = array();

        /* add parameters in Array */
        $paytmParams["MID"] = $input['mid'];
        $paytmParams["ORDERID"] = $input['order_id'];
        $merchant_key=$input['key_secret'];
        /**
        * Generate checksum by parameters we have
        * Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
        */
        /*$paytmChecksum = PaytmChecksum::generateSignature($paytmParams, $merchant_key);*/
        $mid=$input['mid'];
        $orderId=$input['order_id'];
        //$body = "{"\mid\":".$mid.","\orderId\":".$orderId."}";
        $body= array('mid'=>$mid,'orderId'=>$orderId);
        //$body=json_encode($body);
        /* checksum that we need to verify */
        $paytmChecksum = $input['checksum_value'];

        /**
        * Verify checksum
        * Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
        */
        $isVerifySignature = PaytmChecksum::verifySignature($body, $merchant_key, $paytmChecksum);
        
        if($isVerifySignature) {
            $result=array('status'=>true);
        } else {
            $result=array('status'=>false);
        }
        
        return response()->json($result);
    }


    public function initiatePaytmPayment(Request $request)
    { 
        
        $inputs=$request->all();  
        $paytmParams = array();

        $paytmParams["body"] = array(
            "requestType" => "Payment",
            "mid" => $inputs['mid'],
            "websiteName" => "Foodie",
            "orderId" => $inputs['order_id'],
            "callbackUrl" => $inputs['callback_url'],
            "txnAmount" => array(
            "value" => $inputs['amount'],
            "currency"=> $inputs['currency'],
            ),
            "userInfo"=> array(
            "custId"=> $inputs['custId'],
            ),
        );

        //print_r($paytmParams["body"]);exit;
        /*
        * Generate checksum by parameters we have in body
        * Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys
        */
        $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), $inputs['key_secret']);

        $paytmParams["head"] = array("signature"=> $checksum);

        $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

        /* for Staging */
        if($inputs['issandbox']){
            $url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=".$inputs['mid']."&orderId=".$inputs['order_id'];
        }else{
        /* for Production */
         $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=".$inputs['mid']."&orderId=".$inputs['order_id'];
        }

        //echo $url;exit;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $response = curl_exec($ch);
        $response=json_decode($response);
        return response()->json($response);
    }

    public function paytmPaymentcallback(Request $request)
    {   
        return response()->json(array('success'=>true,'data'=>$request->all()));  
    }

    public function getPaypalClienttoken(Request $request){

        
        $input=$request->all();
        $gateway = new Braintree\Gateway([
            'environment' => $input['environment'],
            'merchantId' => $input['merchant_id'],
            'publicKey' => $input['public_key'],
            'privateKey' => $input['private_key']
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return response()->json(array('success'=>true,'data'=>$clientToken));  
    }

    public function createBraintreePayment(Request $request){

        $input=$request->all();
        $nonceFromTheClient=$input['nonceFromTheClient'];
        $amount=$input['amount'];
        $deviceDataFromTheClient=$input['deviceDataFromTheClient'];
        $gateway = new Braintree\Gateway([
            'environment' => $input['environment'],
            'merchantId' => $input['merchant_id'],
            'publicKey' => $input['public_key'],
            'privateKey' => $input['private_key']
        ]);

        /*$result = $gateway->transaction()->adjustAuthorization(
              $the_transaction_id,
              [
                "amount" => $amount
              ]
            );
            if ($result->success) {
                $adjustedTransaction = $result->transaction;
                echo $adjustedTransaction;exit;
            } else {
                print_r($result->errors);
            }*/

            /*$result = $gateway->transaction()->submitForSettlement($the_transaction_id);

            if ($result->success) {
                $settledTransaction = $result->transaction;
            } else {
                print_r($result->errors);
            }*/

            /*if(!$input['currency']){
                $currency='USD';
            }else{
                $currency=$input['currency'];
            }*/
            $result = $gateway->transaction()->sale([
              'amount' => $amount,
              'paymentMethodNonce' => $nonceFromTheClient,
              'deviceData' => $deviceDataFromTheClient,
              'options' => [
                'submitForSettlement' => True
              ]
            ]);

        return response()->json(array('success'=>true,'data'=>$result));
    }

    public function createStripePaymentIntent(Request $request)
    {
        
        $input=$request->all();
        $stripeSecret=$input['stripesecret'];
        $amount=$input['amount'];
        $currency=$input['currency'];
        $stripe = new \Stripe\StripeClient($stripeSecret);


        $payment=$stripe->paymentIntents->create(
          [
            'currency' => 'usd',
            'amount' => $amount*1000,
            'payment_method_types' => ['card'],
          ]
        );

        return response()->json(array('success'=>true,'data'=>$payment));

        /*\Stripe\PaymentIntent::create([
          'amount' => 1099,
          'currency' => 'usd',
          'payment_method_types' => ['card'],
        ]);*/


    }
    
    public function index(Request $request)
    {
        $this->user = $request->session()->get('user');
     
        if (!$this->user->id) {
            return redirect('restaurant');
        }
        
        $orders=Order::where('restaurant_id',$this->user->id)->get();
        
        $orders->transform(function ($order) {

            $order->driver = Driver::where('id',$order->drivers_id)->select('first_name','last_name')->first();
            $order->customer = Customer::where('id',$order->user_id)->select('name')->first();
            return $order;
        });
        
        
        return view("restaurant_admin.order_transactions.index",compact('orders'));
    }

    public function details($id)
    {
        $order = Order::where('id', $id)->first();
        $orderId = $order->id;
    
        if ($order->drivers_id) {
            $order->driver = Driver::where('id', $order->drivers_id)->first();
        }
        
        if ($order->id) {
            $order->foodreviews = FoodRating::where('order_id', $order->id)->first();
        }
        
        if ($order->id) {
            $order->resturantreviews = Rating::where('order_id', $order->id)->first();
        }
        
        if ($order->user_id) {
            $order->customer = Customer::where('id', $order->user_id)->first();
        }
    
        if ($order->id) {
            $order->items = OrderItems::where('order_id', $order->id)->get();
            
            $order->items->transform(function ($item) {
                $food = Foods::where('id', $item->food_id)->select('id', 'name', 'price', 'discount', 'category_id', 'images', 'non_veg')->first();
            
                if ($food) {
                    $food->image_url = asset('images/foods/' . $food->images);
               }
            
                $item->food = $food;
            
                return $item;
            });
        }
    
   
        return view('restaurant_admin.order_transactions.details', compact('order', 'orderId'));
    }


    
    public function paymentsuccess()
    {
        return response()->json(array('result'=>$_REQUEST));
    }

    public function paymentfailed()
    {
        return response()->json(array('result'=>$_REQUEST));
    }

    public function paymentpending()
    {
        return response()->json(array('result'=>$_REQUEST));
    }
    

}
