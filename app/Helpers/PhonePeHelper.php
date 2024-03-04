<?php

namespace App\Helpers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class PhonePeHelper
{
    public function initiatePayment($requestData)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://mercury-uat.phonepe.com/v4/debit/",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "X-CALLBACK-URL: https://www.demoMerchant.com/callback",
            "accept: application/json"
          ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }
    }

}
