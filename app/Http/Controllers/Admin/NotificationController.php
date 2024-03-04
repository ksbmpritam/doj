<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\VendorUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Notifications;

class NotificationController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id = '')
    {
        $notifications = Notifications::orderBy('id', 'desc')->get();

        foreach ($notifications as $notification) {
            if ($notification->role == 'partner') {
                if ($notification->sender_id == 0) {
                    $notification->name = "All";
                } else {
                    $notification->name = Restaurant::where('id', $notification->sender_id)->value('name');
                }
            } elseif ($notification->role == 'customer') {
                if ($notification->sender_id == 0) {
                    $notification->name = "All";
                } else {
                    $notification->name = Customer::where('id', $notification->sender_id)->value('name');
                }
            } elseif ($notification->role == 'driver') {
                if ($notification->sender_id == 0) {
                    $notification->name = "All";
                } else {
                    $notification->name = Driver::where('id', $notification->sender_id)->value('first_name');
                }
            }
        }
    
        return view("admin.notification.index", compact('notifications'))->with('id', $id);
    }


    public function create($id='')
    {
        return view('admin.notification.send')->with('id',$id);
    }
    
   
   public function insert(Request $request){
        $validation = Validator::make($request->all(), [
            'roles' => 'required',
            'sender_id' => 'required',
            'title' => 'required', 
            'description' => 'required', 
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        
        $message = [
            "url" => "",
            "title" => $request->title,
            "sub_title" => $request->description,
            "type" => "admin_notification",
            "image" => "",
        ];
    
         $roleModelMap = [
            'partner' => Restaurant::class,
            'customer' => Customer::class,
            'driver' => Driver::class,
        ];
    
        $role = $request->roles;
        $senderId = $request->sender_id;
    
        if ($senderId == 0) {
            
            $fcmTokens = $roleModelMap[$role]::pluck('fcm_token')->all();
            $res_data = $this->sendNotification($message, $fcmTokens);

        } else {
          
            $fcmToken = $roleModelMap[$role]::where('id', $senderId)->value('fcm_token');
            if ($fcmToken) {
                $res_data = $this->sendNotification($message, $fcmToken);

            }
        }
    
        $notification = Notifications::create([
            'role' => $role,
            'sender_id' => $senderId, 
            'title' => $request->title,
            'description' => $request->description,
            'status' => 1,
        ]);
    
        return redirect()->route('admin.notification')->with('success', 'Notification inserted successfully.');
    }


    public function edit($id)
    {
        $notification = Notifications::findOrFail($id);
        return view('admin.notification.edit', compact('notification'));
    }
    
    public function update(Request $request, $id){
        $validation = Validator::make($request->all(), [
            'roles' => 'required',
            'send_id' => 'required',
            'title' => 'required', 
            'description' => 'required', 
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $notification = Notifications::find($id);
        
        if (!$notification) {
            return redirect()->back()->with('error', 'Notification not found.');
        }
    
        $notification->role = $request->roles;
        $notification->sender_id = $request->send_id;
        $notification->title = $request->title;
        $notification->description = $request->description;
        
        $notification->save();
    
        return redirect()->route('admin.notification')->with('success', 'Notification updated successfully.');
    }

    public function delete($id)
    {
        $notifications = Notifications::findOrFail($id);
        $notifications->delete();

        return redirect()->route('admin.notification')->with('success', 'Notification deleted successfully.');
    }  
    
    
    
    protected function sendNotification($message, $fcm_token)
    {

        $url = 'https://fcm.googleapis.com/fcm/send';
        
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
        
        $fields = json_encode($fields, true);
        $headers = array('Authorization: key=' . env('FCM_SERVER_KEY'), 'Content-Type:  application/json');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }
    
}


