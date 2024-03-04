<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Category;
use App\Models\Foods;
use App\Models\RestaurantAdmin;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Customer;
use App\Models\Employee;
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
        $this->user = Session::get('user');
 
        if (!$this->user) {
            return redirect('employee');
        }
        
        $userId = Session::get('user')->id;
        $team_count = count(Team::where('employee_id',$userId)->with('department')->orderBy('id', 'desc')->get()); 
        $departments_count = count(Department::where('employee_id',$userId)->orderBy('id', 'desc')->get());
        $zone_count = count(Zone::where('role_type','employee')->where('employee_id',$userId)->get());

    	return view('employee.home',compact('team_count','departments_count','zone_count'));
        
    }
    
    // public function profile()
    // {
        
    //     $user = Session::get('user');
 
    //     if (!$user || empty($user->id) || $user->role !== "employee") {
    //         return redirect('/employee');
    //     }
    //     $userId = Session::get('user')->id;
        
    //     $employee = Employee::findOrFail($userId);
    //     $role = Roles::orderBy('id', 'desc')->get();
    //     return view('employee.user.index', compact('employee','role'));
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
    //     return view('employee.Changepasswordemployee.Changepassword');
         
    // }
    // public function updatepassword(Request $request){
    //       $validator = Validator::make($request->all(), [
    //         'pwd' => 'required',
    //         'cpwd' => 'required',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    
    //     $employee_id = Session::get('user')->id;
    //     $employee = employee::find($employee_id);
    //     if (!$employee) {
    //         return redirect()->route('employee')->with('error', 'Team not found.');
    //     }
    
    //     $employee->password = Hash::make($request->input('cpwd'));
    //     $employee->pwd = $request->input('pwd');
    //     $employee->save();
    
    //     return back()->with('success', 'Password changed successfully.');
    // }
    
    public function profile(Request $request)
    {
        $user = $request->session()->get('user');
        // dd($user);
        return view('employee.user.profile', compact('user'));
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
    
        $data = Employee::findOrFail($id);
    
        // Delete old image
        if ($request->hasFile('profile_image')) {
            $oldImagePath = public_path('images/employee/profile/') . $data->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
    
            // Upload new image
            $image = $request->file('profile_image');
            $profileImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/employee/profile/'), $profileImage);
    
            // Update the profile_image attribute in the model
            $data->image = $profileImage;
        }
    
        // Update other fields
        $data->name = $request->input('name');
    
        // Save changes
        if ($data->save()) {
            return redirect()->route('employee.users.profile')->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update user.')->withInput();
        }
    }
    
    public function password(Request $request)
    {
        $user = $request->session()->get('user');
        // dd($user);
        return view('employee.user.password', compact('user'));
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
    
        $data = Employee::findOrFail($id);
    
        // Check if the old password is correct
        if ($request->input('pwd') != $data->pwd) {
            return redirect()->back()->with('error', 'Incorrect old password.')->withInput();
        }
    
        // Update the password
        $data->pwd = $request->input('new_password');
        $data->password = Hash::make($request->input('new_password'));
    
        // Save changes
        if ($data->save()) {
            return redirect()->route('employee.users.password')->with('success', 'Password updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update password.')->withInput();
        }
    }
    
}
