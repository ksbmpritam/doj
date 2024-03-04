<?php

namespace App\Http\Controllers;

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
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => 'required',
    //         'amount' => 'required',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors(), 'status' => false]);
    //     }
    
    //     $data = [
    //         "merchantId" => "MERCHANTUAT",
    //         "merchantTransactionId" => "MT7850590068188104",
    //         "merchantUserId" => "MUID123",
    //         "amount" => $request->input('amount') * 100,
    //         "redirectUrl" => "https://doj.patialamart.com/admin/doj/api/phonepe-response",
    //         "redirectMode" => "GET",
    //         "callbackUrl" => "https://doj.patialamart.com/admin/doj/api/phonepe-response",
    //         "mobileNumber" => "9999999999",
    //         "deviceContext" => [
    //             "deviceOS" => "ANDROID"
    //         ],
    //         "paymentInstrument" => [
    //             "type" => "UPI_INTENT",
    //             "targetApp" => "com.phonepe.app"
    //         ]
    //     ];
    
    //     $encode = json_encode($data);
    //     $saltKey = "099eb0cd-02cf-4e2a-8aca-3e6c6aff0399";
    //     $saltIndex = 1;
    
    //     $string = $encode . '/pg/v1/pay' . $saltKey;
    //     $sha256 = hash('sha256', $string);
    //     $finalHeader = $sha256 . '###' . $saltIndex;
    
    //     $curl = curl_init();
    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "POST",
    //         CURLOPT_POSTFIELDS => $encode,
    //         CURLOPT_HTTPHEADER => [
    //             "Content-Type: application/json",
    //             "X-VERIFY: $finalHeader",
    //         ],
    //     ]);
    
    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);
    //     curl_close($curl);
        
    //     return response()->json(['data' => $response]);
    // }
    
    public function phonePe(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'user_id' => 'required',
        //     'amount' => 'required',
        // ]);
    
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors(),'status'=>false]);
        // }
        
        $transaction_id = "DOJ" . uniqid();
        $transaction_id = strtoupper($transaction_id);
    
        
        $data = array(
                "merchantId"=> "MERCHANTUAT",
                "merchantTransactionId"=> "MT7850590068188104",
                "merchantUserId"=> "MUID123",
                "amount"=> 10000,
                "redirectUrl"=> route('payment.response'),
                "redirectMode"=> "POST",
                "callbackUrl"=> route('payment.response'),
                "mobileNumber"=> "9999999999",
                "paymentInstrument"=> array(
                "type"=> "PAY_PAGE"
              )
        );
        $encode = base64_encode(json_encode($data));
        $saltKey = "099eb0cd-02cf-4e2a-8aca-3e6c6aff0399";
        $saltIndex = 1;
    
        $string = $encode . '/pg/v1/pay' . $saltKey;
        $sha256 = hash('sha256', $string);
        $finalHeader = $sha256 . '###' . $saltIndex;


        $response = Curl::to('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay')
            ->withHeader('Content-Type: application/json')
            ->withHeader('X-VERIFY: ' . $finalHeader)
            ->withData(json_encode(['request' => $encode]))
            ->post();
    
    
        $rData = json_decode($response);
        return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
        // return response()->json($rData);

    }
    
    public function response(Request $request)
    {
        $input = $request->all();
        $saltKey = "099eb0cd-02cf-4e2a-8aca-3e6c6aff0399";
        $saltIndex = 1;
        $finalHeader = hash('sha256','/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'].$saltKey).'###'.$saltIndex;
        $response = Curl::to('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'])
            ->withHeader('Content-Type: application/json')
            ->withHeader('accept: application/json')
            ->withHeader('X-VERIFY: ' . $finalHeader)
            ->withHeader('X-MERCHANT-ID: ' . $input['merchantId'])
            ->get();
           dd($response);
        // return response()->json($response);
    }

    
    // public function makePayment(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'merchantUserId' => 'required',
    //         'amount' => 'required',
    //         'mobileNumber' => 'required',
    //         'email' => 'required|email',
    //         'shortName' => 'required',
    //         'currency' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
    //     }

    //     $merchantId = "M1HI7FHTJBIS";
    //     $clientSecret = "4fae74ff-21a7-4126-aa34-c7399e04a998";
    //     $saltkay="";
    //     $requestData = [
    //         'merchantId' => $merchantId,
    //         'transactionId' => $request->input('transactionId'),
    //         'merchantUserId' => $request->input('merchantUserId'),
    //         'amount' => $request->input('amount'),
    //         'merchantOrderId' => 'OD1234',
    //         'mobileNumber' => $request->input('mobileNumber'),
    //         'message' => 'Payment for order placed OD1234',
    //         'subMerchant' => 'DemoMerchant',
    //         'email' => $request->input('email'),
    //         'shortName' => $request->input('shortName'),
    //         'currency' => $request->input('currency'),
    //     ];
    //     $payload = json_encode($requestData);

    //     $curl = curl_init();

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => "https://mercury-uat.phonepe.com/v4/debit/",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "POST",
    //         CURLOPT_POSTFIELDS => $payload, 
    //         CURLOPT_HTTPHEADER => [
    //             "Content-Type: application/json",
    //             "Authorization: Bearer " . $clientSecret,
    //             "X-CALLBACK-URL: https://www.demoMerchant.com/callback",
    //             "accept: application/json",
    //         ],
    //     ]);

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);

    //     if ($err) {
    //         Log::error("cURL Error: " . $err);
    //         return response()->json(['error' => 'Payment Request Failed'], Response::HTTP_INTERNAL_SERVER_ERROR);
    //     } else {
    //         echo $response;
    //     }
    // }

    // public function handlePhonePeCallback(Request $request)
    // {
    //     // Handle the PhonePe callback logic here
    //     $data = $request->all();

    //     Log::info('PhonePe Callback Data: ' . json_encode($data));

    //     // You can add your custom logic to handle the callback data

    //     return response()->json(['message' => 'Callback received and processed.']);
    // }
}
