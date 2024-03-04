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
use App\Models\Foods;
use App\Models\FoodRating;
use App\Models\Rating;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class OrderController extends Controller
{
    protected $user;

    public function __construct()
    {
        // Perform authentication check in the constructor
        if (!Auth::check()) {
            // Redirect to the login page
            return redirect('restaurant');
        }

        // Get the authenticated user
        $this->user = Auth::user();
    }
    // public function index(Request $request)
    // {
        
    //     $this->user = $request->session()->get('user');
    //     $customer = Customer::all();
    //     $driver = Driver::all();
    //     $order = Order::where('restaurant_id', $this->user->id)->get();
    //     return view("restaurant_admin.orders.index",compact('order','customer','driver'))->with('id',$id);
    // }
    
    public function index(Request $request)
    {
        

        $this->user = $request->session()->get('user');
        $customer = Customer::all();
        $driver = Driver::all();
        $order = Order::where('restaurant_id', $this->user->id)->get();
        return view("restaurant_admin.orders.index",compact('order','customer','driver'));
    }
  
    
 	public function edit($id)
    {
    
        $order = Order::with('restaurant','customer', 'driver','order_items.food','reviews')->where('id',$id)->orderByDesc('id')->first(); 
        $orderId = $order->id;
        // dd($order);
        return view('restaurant_admin.orders.edit',compact('order','id','orderId'));
    
    }
    
    
    // public function downloadPDF($id)
    // {
        
    //     $order = Order::where('id', $id)->first();
    //     $customer = Customer::where('id',$order->user_id)->first();
    //     $orderItems = OrderItems::where('order_id',$order->id)->get();
    //     $restaurant = Restaurant::where('id',$order->restaurant_id)->first();
        
    //     $orderArray = [];
    //     foreach ($orderItems as $o) {
    //         $orderArray[] = [
    //             'Image' => $o->foodImage,
    //             'Itms' => $o->foodName,
    //             'Price' => $o->amount,
    //             'QTY' => $o->quantity,
    //             'Size' => $o->size,
    //             'Total' => $o->amount,
    //             // Add more fields as needed
    //         ];
    //     }
        
        
        
    //     $data = [
    //         'CustomerName' => $customer->name,
    //         'CustomerAddress' => $customer->address,
    //         'CustomerEmail' => $customer->email,
    //         'CustomerPhone' => $customer->mobile_number,
    //         'orderArray' => $orderArray,
    //         'RestaurantName' => $restaurant->first_name,
    //         'RestaurantPhone' => $restaurant->mobile_no,
    //         'RestaurantAddress' => $restaurant->address,
    //         'RestaurantEmail' => $restaurant->email, 
    //     ];
    
    //     $pdf = PDF::loadView('restaurant_admin.pdf.pdf_template', $data);
    
    //     $fileName = 'orders.pdf'; // Set the desired filename
    //     return $pdf->download($fileName);
    // }
    
    
    public function downloadPDF($id)
    {
        $order = Order::where('id', $id)->first();
        $customer = Customer::where('id', $order->user_id)->first();
        $orderItems = OrderItems::where('order_id', $order->id)->get();
        $restaurant = Restaurant::where('id', $order->restaurant_id)->first();
    
        $orderItems->transform(function ($item) {
            $food = Foods::where('id', $item->food_id)
                ->select('id', 'name', 'price', 'discount', 'category_id', 'images', 'non_veg')
                ->first();
    
            if ($food) {
                $food->image_url = asset('images/foods/' . $food->images);
            }
    
            $item->food = $food;
    
            return $item;
        });
    
        $orderArray = [];
        $sum=0;
        foreach ($orderItems as $o) {
             $sum += $o->amount;
            $orderArray[] = [
                'Image' => $o->food->image_url,
                'Itms' => $o->food->name,
                'Price' => $o->amount,
                'QTY' => $o->quantity,
                'Size' => $o->size,
                'Total' => $sum,
            ];
        }
    
        $data = [
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
    
        $pdf = PDF::loadView('restaurant_admin.pdf.pdf_template', $data);
    
        $fileName = 'orders.pdf';
        return $pdf->download($fileName);
    }

    
    public function excel(Request $request)
    {
        $this->user = session('user');
        $order = Order::where('restaurant_id', $this->user->id)->get();
    
        $fileName = 'orders.xlsx';
    
        $orderArray = [];
        foreach ($order as $o) {
            $orderArray[] = [
                'Order ID' => $o->id,
                'Customer Name' => $o->customer_name,
                'Total Amount' => $o->total_amount,
                
            ];
        }
    
        $sheetName = 'Sheet1';
    
        $writerType = 'Xlsx'; 
        
        dd($orderArray); 
    
        return Excel::download(function ($excel) use ($orderArray, $sheetName) {
            $excel->sheet($sheetName, function ($sheet) use ($orderArray) {
                $sheet->fromArray($orderArray);
            });
        }, $fileName, $writerType, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
    
    public function view($id)
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
        
        
        // $driver = Driver::all();
        // $order = Order::where('id',$id)->first();
        // $orderId = $order->id;
        // $customer = Customer::all();
        // $orderItems = OrderItems::all();
        // dd($order);
        return view('restaurant_admin.orders.view', compact( 'order','orderId'));
        
    }
    
    public function update($id, Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'order_status' => 'required',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;
      
        $order->save();

       return redirect()->route('restaurant.orders')->with('success', 'Order Status Update successfully.');
        
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
        return view('restaurant_admin.orders.print')->with('id',$id);
    }
}
