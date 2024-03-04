<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Foods;
use App\Models\OrderItems;
use App\Models\Restaurant;
use PDF;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index(Request $request)
    {
        $order_status = $request->input('order_status');
        $orders = Order::query();
    
        if ($order_status == 'order_accepted') {
            $orders->where('order_status', 2);
        } elseif ($order_status == 'order_rejected') {
            $orders->where('order_status', -1);
        } elseif ($order_status == 'order_completed') {
            $orders->where('order_status', 4);
        }
    
        $orders->with(['restaurant', 'users', 'driver'])->orderBy('id', 'desc');
    
        // Get all matching results without pagination
        $orders = $orders->get();
    
        return view('admin.orders.index', compact('orders'));
    }

    
//  	public function edit($id){
//         $orders = Order::with('restaurant','users', 'driver','order_items','reviews')->where('id',$id)->orderByDesc('id')->first(); 
//         // dd($orders);
//         return view('admin.orders.order_edit',compact('orders','id'));
//     }

    public function edit($id)
    {
        $orders = Order::with('restaurant', 'users', 'driver', 'order_items', 'reviews','foodreviews','resturantreviews')
            ->where('id', $id)
            ->orderByDesc('id')
            ->first();
        // dd($orders);
        $orderItems = $orders->order_items;
    
        $foodDetails = [];
    
        foreach ($orderItems as $orderItem) {
            $foodId = $orderItem->food_id;
            $food = Foods::find($foodId);
            if ($food) {
                $foodDetails[] = [
                    'foodName' => $food->name,
                    // 'foodImage' => $food->images,
                    'foodImage' => asset('/images/foods/' . $food->images),
                    'amount' => $orderItem->amount, 
                    'size' => $orderItem->size,
                ];
            }
        }
        // dd($foodDetails);
        return view('admin.orders.order_edit', compact('orders', 'id', 'foodDetails'));
    }



    public function fetchOrders(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 10; // Number of orders to show per page
        $offset = ($page - 1) * $perPage;

        $orders = Order::with(['users', 'restaurant','driver'])
            ->skip($offset)
            ->take($perPage)
            ->get();

        return response()->json(['orders' => $orders]);
    }

    public function downloadPDF($id)
    {
        
        $order = Order::where('id', $id)->first();
        $customer = Customer::where('id',$order->user_id)->first();
        $orderItems = OrderItems::where('order_id',$order->id)->get();
        $restaurant = Restaurant::where('id',$order->restaurant_id)->first();
        
        $dateTime = Carbon::parse($order->date);

        $formattedDate = $dateTime->format('D M j Y g:i:s A');

        $orderArray = [];
        foreach ($orderItems as $o) {
            $orderArray[] = [
                'Image' => $o->foodImage,
                'Itms' => $o->foodName,
                'Price' => $o->amount,
                'QTY' => $o->quantity,
                'Size' => $o->size,
                'Total' => $o->amount,
                // Add more fields as needed
            ];
        }
        
        
        
        $data = [
            'order_id' => $order->order_id,
            'order_date' => $formattedDate, 
            'CustomerName' => $customer->name,
            'CustomerAddress' => $customer->address,
            'CustomerEmail' => $customer->email,
            'CustomerPhone' => $customer->mobile_number,
            'orderArray' => $orderArray,
            'RestaurantName' => $restaurant->first_name,
            'RestaurantPhone' => $restaurant->mobile_no,
            'RestaurantAddress' => $restaurant->address,
            'RestaurantEmail' => $restaurant->email,
        ];
    
        $pdf = PDF::loadView('admin.pdf.pdf_template', $data);
    
        $fileName = 'orders.pdf'; // Set the desired filename
        return $pdf->download($fileName);
    }

    //  public function get_self_order() {
        
    //     $currentDate = Carbon::now('Asia/Kolkata')->format('Y-m-d');
    //     $twentyMinutesAhead = Carbon::now('Asia/Kolkata')->addMinutes(20)->format('H:i:s');
    //     $currentTime = Carbon::now('Asia/Kolkata');
        
    //     $orders = Order::with('restaurant','users', 'driver','order_items')->whereDate('created_at', $currentDate)
    //               ->where('order_status', 1)
    //               ->where('order_type', 0)
    //               ->whereTime('keep_time', '<', $twentyMinutesAhead)
    //               ->get();
        
    //     $restaurantTokens = [];
    //     $userTokens = [];
        
    //     foreach ($orders as $order) {
    //         // Collect restaurant fcm_token
    //         if ($order->restaurant) {
    //             $restaurantTokens[] = $order->restaurant->fcm_token;
    //         }
        
    //         // Collect user fcm_token
    //         if ($order->users) {
    //             $userTokens[] = $order->users->fcm_token;
    //         }
    //     }

    //     echo "<pre>";
    //     print_r($userTokens);
    //     print_r($restaurantTokens);
    //     die;
    // }
    
    public function delete($id){
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.orders')->with('success', 'orders deleted successfully.');

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
