<?php

namespace App\Http\Controllers\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\OrderItems;
use App\Models\DinnerBook;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class DineController extends Controller
{
    
    
    // public function index($id='',Request $request)
    // {
    //     $this->user = $request->session()->get('user');
    //     if (!$this->user) {
    //         return redirect('restaurant');
    //     }
        
    //     $customer = Customer::all();
    //     $book = DinnerBook::where('restaurant_id',$this->user->id)->get();
    //     return view("restaurant_admin.dine_order.index",compact('book','customer'))->with('id',$id);
    // }
    public function index(Request $request)
    {
        $this->user = $request->session()->get('user');
        if (!$this->user) {
            return redirect('restaurant');
        }
        
        $customer = Customer::all();
        $book = DinnerBook::with('restaurant','users')->where('restaurant_id',$this->user->id)->get();
        // dd($book);
        return view("restaurant_admin.dine_order.index",compact('book','customer'));
    }
    
 	public function edit($id)
    {
        $order = DinnerBook::with('restaurant','users')->where('id',$id)->orderByDesc('id')->first(); 
        $orderId = $order->id;
        return view('restaurant_admin.dine_order.edit',compact('order','id','orderId'));
    
    }
    
    public function view($id)
    {
        $driver = Driver::all();
        $order = DinnerBook::where('id',$id)->first();
        $orderId = $order->id;
        $customer = Customer::all();
        return view('restaurant_admin.dine_order.view', compact('customer', 'driver', 'order','orderId'));
        
    }
    
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $order = DinnerBook::findOrFail($id);
        $order->status = $request->status;
        $order->total_amount = $request->total_amount;
      
        if ($order->save()) {
            
            $restaurant_fcm = DB::table('restaurant_admin')->where('id', $order->restaurant_id)->value('fcm_token');
    
            $customer_fcm = DB::table('customer')->where('id', $order->customer_id)->value('fcm_token');
            
            if($request->status==1){
                $title="Order Accept Successfully";
            }elseif($request->status==-1){
                $title="Order Cancel Successfully";
            }elseif($request->status==2){
                $title="Order Completed Successfully";
            }else{
                $title="";
            }
            
            $message = [
                "url" => $title,
                "title" => $title,
                "sub_title" =>$title,
                "type" => "order_accept",
                "image" => "",
                ];
                
            if (!empty($restaurant_fcm)) {
                $res_data = $this->sendNotification($message, $restaurant_fcm);
            }
    
            if (!empty($customer_fcm)) {
                $res_data = $this->sendNotification($message, $customer_fcm);
            }
    
            return redirect()->route('restaurant.dine_orders')->with('success', 'Order Status Update successfully.');
        } else {
            return redirect()->route('restaurant.dine_orders')->with('error', 'Something wants to wrong.');
        }

    //   return redirect()->route('restaurant.dine_orders')->with('success', 'Order Status Update successfully.');
        
    }
    
    protected function sendNotification($message, $fcm_token)
    {
    
    dd($fcm_token);
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

   

    public function orderprint($id){
        return view('restaurant_admin.orders.print')->with('id',$id);
    }
}
