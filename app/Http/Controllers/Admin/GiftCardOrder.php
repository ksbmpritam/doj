<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GiftCardPurchase;
use App\Models\GiftCardPurchaseLog;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class GiftCardOrder extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index(Request $request)
    {
        $orders = GiftCardPurchase::with('customer')->get();
        return view('admin.giftCardOrder.index', compact('orders'));
    }

    public function edit($id)
    {
        $order = GiftCardPurchase::with(['customer'])->where('id', $id)->orderByDesc('id')->first();
        return view('admin.giftCardOrder.edit', compact('order'));
    }
    
    
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'expiration_date' => 'required',
            'cutoff_type' => 'required',
            'cutoff_value' => 'required',
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
       
    
        $gift = GiftCardPurchase::findOrFail($id);
        $gift->expiration_date = $request->expiration_date;
        $gift->cutoff_type = $request->cutoff_type;
        $gift->cutoff_value = $request->cutoff_value; 
        $gift->save();
    
        return redirect()->route('admin.gift_card_order')->with('success', 'Gift updated successfully.');
    }

    
    
    
    public function view($id)
    {
        $order = GiftCardPurchase::with(['customer'])->where('id', $id)->orderByDesc('id')->first();
        return view('admin.giftCardOrder.view', compact('order'));
    }

    public function delete($id){
        $order = GiftCardPurchase::findOrFail($id);
        
        GiftCardPurchaseLog::create([
            'gift_card_purchase_id' => $order->id,
            'customer_id' => $order->customer_id,
            'data' => json_encode($order->toArray()), 
        ]);
        
        $order->delete();
        return redirect()->route('admin.gift_card_order')->with('success', 'Card deleted successfully.');
    }


    public function sendNotification(Request $request)
    {
        $fcm=$request->fcm;
        $restaurantname=$request->restaurantname;
        $orderStatus=$request->orderStatus;
        $response=array();
        if($fcm && ($orderStatus=="Order Accepted" || $orderStatus=="Order Rejected")){
                $server_key = env('FIREBASE_KEY');
                if($server_key){
                    $target = $fcm;
                    $url = 'https://fcm.googleapis.com/fcm/send';
                    $fields = array();
                    $fields['priority']="high";
                    if($orderStatus=="Order Accepted"){
                        $fields['notification']['title']="Your Order has Accepted";
                        $fields['notification']['body'] = $restaurantname." has Accept Your Order";
                    }else if($orderStatus=="Order Rejected"){
                        $fields['notification']['title']="Your Order has Rejected";
                        $fields['notification']['body'] = $restaurantname." has Reject Your Order";
                    }
                    $fields['notification']['sound'] = 'default';
                    $fields['data']['click_action'] = 'FLUTTER_NOTIFICATION_CLICK';
                    $fields['data']['id'] = '1';
                    $fields['data']['status'] = 'done';
                    if(is_array($target)){
                        $fields['registration_ids'] = $target;
                    }else{
                        $fields['to'] = $target;
                    }
                    $headers = array(
                        'Content-Type:application/json',
                      'Authorization:key='.$server_key
                    );
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    $result = curl_exec($ch);
                    if ($result === FALSE) {
                        die('FCM Send Error: ' . curl_error($ch));
                    }
                    curl_close($ch);
                    $result2 = $result;
                    $result=json_decode($result);
                    $response = array();
                    $response['target'] = $target;
                    $response['fields'] = $fields;
                    $response['result'] = $result;
                }else{
                    $response = array();
                    $response['message'] = 'Firebase Server key not found!';
                    $response['target'] = '';
                    $response['fields'] = '';
                    $response['result'] = '';
                }
        }

        echo json_encode($response);
        exit;
    }

    public function orderprint($id){
        return view('admin.orders.print')->with('id',$id);
    }
    
   
 

}
