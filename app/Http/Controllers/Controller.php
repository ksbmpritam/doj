<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//use Twilio\Rest\Client;
use Mail;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use Illuminate\Http\Request;
use Twilio\Jwt\ClientToken;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;
    
    protected function send_notification($fcm,$notification,$body = []){
		$url = 'https://fcm.googleapis.com/fcm/send';
		
		if(count($body) == 0){
    		$fields = array(
    			"to" => $fcm,
    			"collapse_key" => "type_a",
    			"notification" => $notification,
    		);
		}else{
		    $fields = array(
    			"to" => $fcm,
    			"collapse_key" => "type_a",
    			"notification" => $notification,
    			"body" => $body
    		);
		}
        
		$fields = json_encode($fields, true);
		$headers = array(
			'Authorization: key=' . env('FCM_SERVER_KEY'),
			'Content-Type:  application/json'
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

    
    public function sendNotificationDriver($title, $desc, $id){
        
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            "to" => $id,
            "collapse_key" => "type_a", 
            "notification" => array(
                "body" => $desc,
                "title" => $title,
                "image" => "?format=jpg&crop=4560,2565,x790,y784,safe&fit=crop"
                ), 
            "data" => array(
                "body" => "r",
                "title" => "You got a order request",
                ),
        );
        
        $fields = json_encode ( $fields , true);
    
        $headers = array ('Authorization: key=' . env('FCM_SERVER_KEY'),'Content-Type:  application/json');
    
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
    
        $result = curl_exec ( $ch );
        curl_close ( $ch );
        return $result;
    }
    
    public function distance($lat1, $lon1, $lat2, $lon2, $unit = "K") {
      $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;
      $unit = strtoupper($unit);
    
      if ($unit == "K") {
          return ($miles * 1.609344);
      } else if ($unit == "N") {
          return ($miles * 0.8684);
      } else {
          return $miles;
      }
    }
    
    public function sendError($message) {
        $message = $message->all();
        $response['error'] = "validation_error";
        $response['message'] = implode('', $message);
        $response['status'] = "0";
        return response()->json($response, 200);
    }
    
    public function send_order_mail($mail_header, $subject, $to_mail) {
        try {
            Mail::send('mail_templates.trip_invoice', $mail_header, function ($message)
                    use ($subject, $to_mail) {
                $message->from(env('MAIL_USERNAME'), env('APP_NAME'));
                $message->subject($subject);
                $message->to($to_mail);
            });
            return 1;
        } catch (\Exception $e) {
          // echo $e->getMessage();
          // exit;
            return 0;

         // return $e->getMessage();

        }

    }

    public function send_fcm($title, $description, $token) {

        try {
            $factory = (new Factory)->withServiceAccount(config_path() . '/' . env('FIREBASE_FILE'));
            $messaging = $factory->createMessaging();

            $message = CloudMessage::fromArray([
                        'token' => $token,
                        'notification' => [],
                        'data' => [],
            ]);

            $config = AndroidConfig::fromArray([
                        'ttl' => '3600s',
                        'priority' => 'normal',
                        'notification' => [
                            'title' => $title,
                            'body' => $description,
                            'icon' => '',
                            'color' => '',
                        ],
            ]);

            $message = $message->withAndroidConfig($config);

            return $messaging->send($message);
        } catch (\Exception $e) {
//            return $e->getMessage();
        }
    }

    public function sendSms($phone_number, $message) {
        $phone_number = preg_replace('/^\+?91|\|1|\D/', '', ($phone_number));
        $api_key = '463EDEEC5EF80F'; 
        
        $url = "http://msg.pwasms.com/app/smsapi/index.php";
    	$params = array(
    	    'key' => $api_key,
    	    'campaign' => 0,
    	    'routeid' => 69,
    	    'type' => 'text',
    	    'contacts' => $phone_number,
    	    'senderid' => 'PWASMS',
    	    'msg' => "Dear Customer. welcome to {$message} Thank you for checking our services.",
    	);
        $url = $url . '?' . http_build_query($params);
    	
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        return $result;
        
        //Submit to server

        // $ch = curl_init();
        // $endpoint = 'http://cp.smscart.co.in/pushsms.php';
        // $params = array(
        //     'username' => 'mechaniclane',
        //     'api_password' => 'd219dxw7takckgw1l',
        //     'sender' => 'MechLN',
        //     'to' => $phone_number,
        //     'message' => "Please use OTP $message to verify your Mobile No for registering with Mechaniclane.",
        //     'priority' => '11',
        //     'e_id' => '1001868254458735900',
        //     't_id' => '1007174630871323728'
        // );
        // $url = $endpoint . '?' . http_build_query($params);
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // $response = curl_exec($ch);
        // curl_close($ch);
        // return $result;
        
    }

    public function ride_completeion($mail_header, $subject, $to_mail) {
        Mail::send('mail_templates.ride_completeion_mail', $mail_header, function ($message)
                use ($subject, $to_mail) {
            $message->from(env('MAIL_USERNAME'), env('APP_NAME'));
            $message->subject($subject);
            $message->to($to_mail);
        });
    }

}
