<?php

namespace App\Http\Controllers\Franchies;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Category;
use App\Models\Foods;
use App\Models\RestaurantAdmin;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Customer;
use App\Models\Franchise;
use App\Models\Roles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Models\Team;
use App\Models\Department;
use App\Models\Zone;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
   
    public function index(Request $request)
    {
        $user = Session::get('user');

        if (!$user || empty($user->id) || $user->role !== "franchies") {
            return redirect('/franchies');
        }
        
        $userId = Session::get('user')->id;
        $team_count = count(Team::where('franchies_id',$userId)->with('department')->orderBy('id', 'desc')->get());
        $departments_count = count(Department::where('franchies_id', $user->id)->orderBy('id', 'desc')->get());
        $zone_count = count(Zone::where('role_type','franchies')->where('franchies_id',$userId)->get());

    	return view('franchies.home',compact('team_count','departments_count','zone_count'));
        
    }
    
    // public function profile()
    // {
        
    //     $user = Session::get('user');
 
    //     if (!$user || empty($user->id) || $user->role !== "franchies") {
    //         return redirect('/franchies');
    //     }
    //     $userId = Session::get('user')->id;
        
    //     $franchise = Franchise::findOrFail($userId);
    //     $role = Roles::orderBy('id', 'desc')->get();
    //     return view('franchies.user.index', compact('franchise','role'));
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
    // public function chanagepassword(){
    //     return view('franchies.Changepassword.Changepassword');  
    // }
    // public function updatepassword(Request $request ){
    //      $validator = Validator::make($request->all(), [
    //         'pwd' => 'required',
    //         'cpwd' => 'required',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    
    //     $Franchise_id = Session::get('user')->id;
    //     $Franchise = Franchise::find($Franchise_id);
    //     if (!$Franchise) {
    //         return redirect()->route('employee')->with('error', 'Team not found.');
    //     }
    
    //     $Franchise->password = Hash::make($request->input('cpwd'));
    //     $Franchise->pwd = $request->input('pwd');
    //     $Franchise->save();
    
    //     return back()->with('success', 'Password changed successfully.');
    // }
    
    public function profile(Request $request)
    {
        $user = $request->session()->get('user');
        // dd($user);
        return view('franchies.user.profile', compact('user'));
    }
    

    public function updateprofile(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'permanent_address' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $data = Franchise::findOrFail($id);
    
        // Delete old image
        if ($request->hasFile('profile_image')) {
            $oldImagePath = public_path('images/franchies/profile/') . $data->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
    
            // Upload new image
            $image = $request->file('profile_image');
            $profileImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/franchies/profile/'), $profileImage);
    
            // Update the profile_image attribute in the model
            $data->image = $profileImage;
        }
    
        // Update other fields
        $data->name = $request->input('name');
        $data->permanent_address = $request->input('permanent_address');
    
        // Save changes
        if ($data->save()) {
            return redirect()->route('franchies.users.profile')->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update user.')->withInput();
        }
    }
    
    public function password(Request $request)
    {
        $user = $request->session()->get('user');
        // dd($user);
        return view('franchies.user.password', compact('user'));
    }
    
    public function updatepassword(Request $request, $id)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'pwd' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $data = Franchise::findOrFail($id);
        // dd($data->pwd);
        // Check if the old password is correct
        if ($request->input('pwd') != $data->pwd) {
            return redirect()->back()->with('error', 'Incorrect old password.')->withInput();
        }
    
        // Update the password
        $data->pwd = $request->input('new_password');
        $data->password = Hash::make($request->input('new_password'));
    
        // Save changes
        if ($data->save()) {
            return redirect()->route('franchies.users.password')->with('success', 'Password updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update password.')->withInput();
        }
    }

}
