<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Ixudra\Curl\Facades\Curl;

class PaymentController extends Controller
{
    // public function phonePe(Request $request)
    // {
    //     // $validator = Validator::make($request->all(), [
    //     //     'user_id' => 'required',
    //     //     'amount' => 'required',
    //     // ]);
    
    //     // if ($validator->fails()) {
    //     //     return response()->json(['errors' => $validator->errors(),'status'=>false]);
    //     // }
        
    //     $transaction_id = "DOJ" . uniqid();
    //     $transaction_id .= strtoupper($transaction_id);
    
        
    //     $data = array(
    //             "merchantId"=> "U123456789",
    //             "merchantTransactionId"=> $transaction_id,
    //             "merchantUserId"=> "U123456789",
    //             "amount"=> 10000,
    //             "redirectUrl"=> route('payment.response'),
    //             "redirectMode"=> "POST",
    //             "callbackUrl"=> route('payment.response'),
    //             "mobileNumber"=> "9999999999",
    //             "deviceContext" =>array(
    //                 "deviceOS" => "ANDROID"
    //                 ),
    //             "paymentInstrument" => array(
    //                 "type" => "UPI_INTENT",
    //                 "targetApp" => "com.phonepe.app"
    //             )
    //         );
    //     $encode = base64_encode(json_encode($data));
    //     $saltKey = "099eb0cd-02cf-4e2a-8aca-3e6c6aff0399";
    //     $saltIndex = 1;
    
    //     $string = $encode . '/v3/merchant/otp/send' . $saltKey;
    //     $sha256 = hash('sha256', $string);
    //     $finalHeader = $sha256 . '###' . $saltIndex;


    //     $response = Curl::to('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay')
    //         ->withHeader('Content-Type: application/json')
    //         ->withHeader('X-VERIFY: ' . $finalHeader)
    //         ->withData(json_encode(['request' => $encode]))
    //         ->post();
     
    
    //     $rData = json_decode($response);
    //     dd($rData);
    //     // return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
    //     // return response()->json($rData->data->instrumentResponse->intentUrl);
    //     // return response()->json($rData);

    // }
    
    public function phonePe(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'amount' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>false]);
        }
     
        $transaction_id = "DOJ" . uniqid();
        $transaction_id .= strtoupper($transaction_id);
    
        $data = array(
            "merchantId" => "M1HI7FHTJBIS",
            "merchantTransactionId" => $transaction_id,
            "merchantUserId" => "MUID123",
            "amount" => $request->input('amount')*100, 
            "redirectUrl" => route('payment.response'),
            "redirectMode" => "POST",
            "callbackUrl" => route('payment.response'),
            "mobileNumber" => "8578805451", 
            "deviceContext" => array(
                "deviceOS" => "ANDROID"
            ),
            "paymentInstrument" => array(
                "type"=>"PAY_PAGE",// UPI_INTENT
                "targetApp"=> "com.phonepe.app"
            )
        );
   
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

        return response()->json($rData->data->instrumentResponse->redirectInfo);
    
        // Return the entire response (customize as needed)
        // return response()->json($rData);
    }
    public function response(Request $request)
    {
        $input = $request->all();
        $saltKey = "4fae74ff-21a7-4126-aa34-c7399e04a998";
        $saltIndex = 1;
        $finalHeader = hash('sha256','/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'].$saltKey).'###'.$saltIndex;
        $response = Curl::to('https://api.phonepe.com/apis/hermes/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'])
            ->withHeader('Content-Type: application/json')
            ->withHeader('accept: application/json')
            ->withHeader('X-VERIFY: ' . $finalHeader)
            ->withHeader('X-MERCHANT-ID: ' . $input['merchantId'])
            ->get();
        //   dd(json_decode($response));
        return response()->json(json_decode($response));
    }
}
