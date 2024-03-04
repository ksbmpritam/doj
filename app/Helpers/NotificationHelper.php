<?php

namespace App\Helpers;

use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class NotificationHelper
{
    public static function get_restaurant()
    {
        $now = Carbon::now('Asia/Kolkata');

        $restaurantsToUpdate = Restaurant::where('restaurant_status', 0)
            ->whereNotNull('enable_self_pickup_date')
            ->whereNotNull('enable_self_pickup_time')
            ->where('enable_self_pickup_date', '<=', $now->toDateString())
            ->where('enable_self_pickup_time', '<=', $now->format('H:i:s')) 
            ->get();
            
        Log::warning("cron working restaurant self disable Notification");

        foreach ($restaurantsToUpdate as $restaurant) {
            Log::warning("cron working self Enable Notification");
            $message = [
                'url' => '',
                'title' => 'Self Pickup Inactive',
                'sub_title' => 'Your Self Pickup Inactive Activated Now.',
                'type' => 'update',
                'image' => '',
            ];

            self::sendNotification($message, $restaurant->fcm_token);
        }
    }

    public static function getSelfOrder()
    {
        $currentDate = Carbon::now('Asia/Kolkata')->format('Y-m-d');
        $twentyMinutesAhead = Carbon::now('Asia/Kolkata')->addMinutes(10)->format('H:i:s');

        $orders = Order::whereDate('created_at', $currentDate)
            ->where('order_status', 1)
            ->where('order_type', 0)
            ->whereTime('keep_time', '<=', $twentyMinutesAhead)
            ->get();

        $message = [
            'url' => '',
            'title' => 'Order Ready for Customer',
            'sub_title' => 'Order Ready for Customer',
            'type' => 'order_ready',
            'image' => '',
        ];
        $message2 = [
            'url' => '',
            'title' => 'Order Ready Under 20 minute',
            'sub_title' => 'Order Ready Under 20 minute',
            'type' => 'order_ready',
            'image' => '',
        ];

        foreach ($orders as $order) {
            if ($order->restaurant) {
                self::sendNotification($message, $order->restaurant->fcm_token);
            }

            if ($order->users) {
                self::sendNotification($message2, $order->users->fcm_token);
            }
        }
    }

    public static function sendNotification($message, $fcm_token)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = [
            "to" => $fcm_token,
            "collapse_key" => "type_a",
            "notification" => [
                "body" => $message['url'],
                "title" => $message['title'],
                "sub_title" => $message['sub_title'],
                "type" => $message['type'],
                "image" => $message['image'] . "?format=jpg&crop=4560,2565,x790,y784,safe&fit=crop",
                "action" => json_encode(["view"]),
            ],
            "data" => [
                "body" => $message['url'],
                "title" => $message['title'],
                "sub_title" => $message['sub_title'],
                "type" => $message['type'],
                "action" => json_encode(["view"]),
            ],
        ];

        $headers = [
            'Authorization' => 'key=' . env('FCM_SERVER_KEY'),
            'Content-Type' => 'application/json',
        ];

        $response = Http::withHeaders($headers)->post($url, $fields);

        if ($response->successful()) {
            return $response->json();
        } else {
            Log::error('Failed to send FCM notification: ' . $response->body());
            return null;
        }
    }

}
