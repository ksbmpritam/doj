<?php

namespace App\Http\Controllers\Team;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Category;
use App\Models\Foods;
use App\Models\RestaurantAdmin;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Customer;
use App\Models\Team;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
   
    
    public function index(Request $request)
    {
        $this->user = Session::get('user');
 
        if (!$this->user) {
            return redirect('team');
        }
        
        $customer = Customer::all();
        $count = count($customer);
        $driver = Driver::all();
        $countd = count($driver);
        $order = Order::all();
        $countOrder = count($order);
        $restaurant_admin = RestaurantAdmin::all();
        $rcount = count($restaurant_admin);
        
        $food = count(Foods::all());
    	return view('team.home',compact('customer','count','countd','countOrder','rcount','food'));
        
    }
    
    // public function profile()
    // {
        
    //     $user = Session::get('user');
 
    //     if (!$user || empty($user->id)) {
    //         return redirect('/team');
    //     }
    //     $userId = Session::get('user')->id;
    //     $team = Team::findOrFail($userId);
    //     return view('team.user.index' ,compact('team','userId'));
    // }
    
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
    // public function changepassword()
    // {
    //       return view('team.Changepassword.Changepassword');
    // }

    // public function newpassword(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'pwd' => 'required',
    //         'cpwd' => 'required',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    
    //     $team_id = Session::get('user')->id;
    //     $team = Team::find($team_id);
    //     if (!$team) {
    //         return redirect()->route('team')->with('error', 'Team not found.');
    //     }
    
    //     $team->password = Hash::make($request->input('cpwd'));
    //     $team->pwd = $request->input('pwd');
    //     $team->save();
    
    //     return back()->with('success', 'Password changed successfully.');
    // }
    
    public function profile(Request $request)
    {
        $user = $request->session()->get('user');
        // dd($user);
        return view('team.user.profile', compact('user'));
    }
    

    public function updateprofile(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $data = Team::findOrFail($id);
    
        // Delete old image
        if ($request->hasFile('profile_image')) {
            $oldImagePath = public_path('images/team/profile/') . $data->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
    
            // Upload new image
            $image = $request->file('profile_image');
            $profileImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/team/profile/'), $profileImage);
    
            // Update the profile_image attribute in the model
            $data->image = $profileImage;
        }
    
        // Update other fields
        $data->name = $request->input('name');
    
        // Save changes
        if ($data->save()) {
            return redirect()->route('team.users.profile')->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update user.')->withInput();
        }
    }
    
    public function password(Request $request)
    {
        $user = $request->session()->get('user');
        // dd($user);
        return view('team.user.password', compact('user'));
    }
    
    public function updatepassword(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'pwd' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $data = Team::findOrFail($id);
    
        // Check if the old password is correct
        if ($request->input('pwd') != $data->pwd) {
            return redirect()->back()->with('error', 'Incorrect old password.')->withInput();
        }
    
        // Update the password
        $data->pwd = $request->input('new_password');
        $data->password = Hash::make($request->input('new_password'));
    
        // Save changes
        if ($data->save()) {
            return redirect()->route('team.users.password')->with('success', 'Password updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update password.')->withInput();
        }
    }

}
