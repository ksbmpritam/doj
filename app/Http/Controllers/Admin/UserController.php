<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\OrderItems;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = Customer::orderBy('id', 'desc')->get();
        return view("admin.users.index", compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customer,email',
            'mobile_number' => 'required|string|unique:customer,mobile_number',
            'gender' => 'required|string',
            'dob' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $profileImage = null; 
    
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $profileImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/upload'), $profileImage);
        }
    
        $customerData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile_number' => $request->input('mobile_number'),
            'gender' => $request->input('gender'),
            'dob' => $request->input('dob'),
            'address' => $request->input('address'),
            'status' => $request->input('status'),
            'latitude' => $request->input('latitude'), 
            'longitude' => $request->input('longitude'),
        ];

        if ($profileImage !== null) {
            $customerData['profile_image'] = $profileImage;
        }
    
        $customer = Customer::create($customerData);
    
        return redirect()->route('admin.users')->with('success', 'Users inserted successfully.');
    }




    public function edit($id)
    {
        $orderCount = Order::where('user_id', $id)->count();
        $user = Customer::findOrFail($id);
        return view('admin.users.edit', compact('user', 'orderCount'))->with('id', $id);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
    
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required',
            'mobile_number' => 'required',
            'gender' => 'required|string',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
     
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $profileImage = $customer->profile_image;
    
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $profileImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/upload'), $profileImage);
        }
    
        $customer->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile_number' => $request->input('mobile_number'),
            'gender' => $request->input('gender'),
            'dob' => $request->input('dob'),
            'address' => $request->input('address'),
            'status' => $request->has('status')? 1 : 0,
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'profile_image' => $profileImage,
        ]);
    
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }


    public function view($id)
    {
        $orderCount = Order::where('user_id', $id)->count();
        $user = Customer::findOrFail($id);
        return view('admin.users.view', compact('user', 'orderCount'))->with('id', $id);
    }
    
    public function orders($id)
    {
        $user = Customer::findOrFail($id); 
        $orders = $user->orders_t() 
        ->with(['restaurant', 'users', 'driver'])
        ->orderBy('id', 'desc')
        ->paginate(10);
        
        return view('admin.users.orders', compact('orders'))->with('id', $id);
    }
    
    public function order_details($id){
        $orders = Order::with('restaurant','users', 'driver','order_items')->where('id',$id)->first(); 
         $orderId = $id;
        return view('admin.users.order_details',compact('orders','id','orderId'));
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
    
    public function payout($id)
    {
        $user = Customer::findOrFail($id); 
        $wallet = $user->wallet()
        ->orderBy('id', 'desc')
        ->get();
        $userId=$id;
        return view('admin.users.walletHistory', compact('wallet','userId'))->with('id', $id);
    }

    // public function profile()
    // {
    //     $user = Auth::user();
    //     return view('admin.users.profile', compact(['user']));
    // }
   
    public function delete($id)
    {
        $user = Customer::findOrFail($id); 
    
        // Delete the Filter
        $user->delete();
    
        return redirect()->route('admin.users')->with('success', 'Users deleted successfully.');
    }
   
   
    public function profile(Request $request)
    {   
        $user = Auth::user();
        // dd($user);
        return view('admin.users.user.profile', compact('user'));
    }
    

    public function updateprofile(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $data = User::findOrFail($id);
        $data->name = $request->input('name');
        if ($data->save()) {
            return redirect()->route('admin.users.profile')->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update user.')->withInput();
        }
    }
    
    public function password(Request $request)
    {
        $user = Auth::user();
        // dd($user);
        return view('admin.users.user.password', compact('user'));
    }
    
    public function updatepassword(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $data = User::findOrFail($id);
    
        // Check if the old password is correct
        if (!Hash::check($request->input('password'), $data->password)) {
            return redirect()->back()->with('error', 'Incorrect old password.')->withInput();
        }
    
        // Update the password with the new hashed password
        $data->password = Hash::make($request->input('new_password'));
    
        if ($data->save()) {
            return redirect()->route('admin.users.password')->with('success', 'Password updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update password.')->withInput();
        }
    }


}
