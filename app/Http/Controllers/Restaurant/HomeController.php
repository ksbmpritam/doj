<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Category;
use App\Models\Foods;
use App\Models\RestaurantAdmin;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
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
    
    public function index(Request $request)
    {
        $this->user = $request->session()->get('user');
        if (!$this->user) {
            return redirect('restaurant');
        }
        // $user = Restaurant::where('id',$this->user->id)->first();
        $customer = Customer::all();
        $count = count($customer);
        
        $order = Order::where('restaurant_id',$this->user->id)->get();
        $countOrder = count($order);
        
        $orderAmount = Order::where('restaurant_id', $this->user->id)->sum('amount');
  
        
        $restaurant_admin = Restaurant::where('id',$this->user->id)->get();
        $rcount = count($restaurant_admin);
        
        
        $food = count(Foods::where('restaurant_id',$this->user->id)->get());
        
        $todayOrders = Order::where('restaurant_id',$this->user->id)->with('restaurant','order_items')->where('date', now()->toDateString())->get();
        
    	return view('restaurant_admin.home',compact('customer','count','orderAmount','countOrder','rcount','food','todayOrders'));
        
    }
    
    public function profile(Request $request)
    {
        $user = $request->session()->get('user');
        // dd($user);
        return view('restaurant_admin.user.profile', compact('user'));
    }
    

    public function updateprofile(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required',
            'address' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $data = Restaurant::findOrFail($id);
    
        // Delete old image
        if ($request->hasFile('profile_image')) {
            $oldImagePath = public_path('images/restaurants/profile/') . $data->profile_image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
    
            // Upload new image
            $image = $request->file('profile_image');
            $profileImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/restaurants/profile/'), $profileImage);
    
            // Update the profile_image attribute in the model
            $data->profile_image = $profileImage;
        }
    
        // Update other fields
        $data->first_name = $request->input('first_name');
        $data->last_name = $request->input('last_name');
        $data->address = $request->input('address');
    
        // Save changes
        if ($data->save()) {
            return redirect()->route('restaurant.users.profile')->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update user.')->withInput();
        }
    }
    
    public function password(Request $request)
    {
        $user = $request->session()->get('user');
        // dd($user);
        return view('restaurant_admin.user.password', compact('user'));
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
    
        $data = Restaurant::findOrFail($id);
    
        // Check if the old password is correct
        if ($request->input('password') != $data->password) {
            return redirect()->back()->with('error', 'Incorrect old password.')->withInput();
        }
    
        // Update the password
        $data->password = $request->input('new_password');
    
        // Save changes
        if ($data->save()) {
            return redirect()->route('restaurant.users.password')->with('success', 'Password updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update password.')->withInput();
        }
    }

    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        return view('dashboard');
    }    
    
    public function users()
    {
        return view('users');
    }
    
}
