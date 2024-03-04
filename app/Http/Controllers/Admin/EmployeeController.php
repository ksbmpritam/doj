<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PDF; 
use App\Models\Employee;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use App\Models\Zone;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->get();
        return view("admin.employee.index",compact('employees'));
    }

    public function create()
    {
        $role = Roles::orderBy('id', 'desc')->get();
        $zone = Zone::where('status',1)->get();
        return view('admin.employee.create',compact('role','zone'));
    }
    
    public function view($id)
    {
        $team_id = $id;
        $employee = Employee::findOrFail($id);
        $role = Roles::orderBy('id', 'desc')->get();
        return view('admin.employee.view', compact('employee','role','team_id'))->with('id', $id);
    }
    // $team_id = $id;
    //     $franchise = Franchise::findOrFail($id);
    //     $role = Roles::orderBy('id', 'desc')->get();
    //     return view('admin.franchies.view', compact('franchise','role','team_id'))->with('id', $id);

    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required',
            'mobile_no' => 'required|unique:employees,mobile_no',
            'permanent_address' => 'required',
            // 'address_same' => 'required',
            'communication_address' => 'required',
            'aadhar_no' => ['required', 'regex:/^\d{12}$/'],
            'pan_card_no' => ['required', 'regex:/^([A-Z]){5}([0-9]){4}([A-Z]){1}$/'],
            // 'status' => 'required',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
             'zone_id' => 'required',
        ]);
        
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        
        $uniqueReferralCode = $this->generateUniqueReferralCode();

        
        $images = null;
        if ($request->hasFile('images')) {
            $profile = $request->file('images');
            $images = time() . '.' . $profile->getClientOriginalExtension();
            $profile->move(public_path('images/employee/profile/'), $images);
        }
    
        $formData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), 
            'pwd' => $request->input('password'),
            'mobile_no' => $request->input('mobile_no'),
            'permanent_address' => $request->input('permanent_address'),
            'address_same' => $request->has('address_same')?1:0,
            'communication_address' => $request->input('communication_address'),
            'image' => $images,
            'status' => $request->has('status')?1:0,
            'aadhar_no' => $request->input('aadhar_no'),
            'pan_card_no' => $request->input('pan_card_no'),
            'referral_code' => $uniqueReferralCode,
            'role' => "employee",
            'zone_id' => $request->input('zone_id')
        ];
        
        $employee = Employee::create($formData);
    
        return redirect()->route('admin.employee')->with('success', 'Employee inserted successfully.');
    }


    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $role = Roles::orderBy('id', 'desc')->get();
        $zone = Zone::where('status',1)->get();
        return view('admin.employee.edit', compact('employee','role','zone'))->with('id', $id);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $id,
            'password' => 'required',
            'mobile_no' => 'required|unique:employees,mobile_no,' . $id,
            'permanent_address' => 'required',
            'communication_address' => 'required',
            'aadhar_no' => ['required', 'regex:/^\d{12}$/'],
            'pan_card_no' => ['required', 'regex:/^([A-Z]){5}([0-9]){4}([A-Z]){1}$/'],
            // 'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
             'zone_id' => 'required',
        ]);
  
         if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $employee = Employee::find($id);
        if (!$employee) {
            return redirect()->route('admin.employee')->with('error', 'Employee not found.');
        }
    
        $images = $employee->image;
    
        if ($request->hasFile('images')) {
            $profile = $request->file('images');
            $images = time() . '.' . $profile->getClientOriginalExtension();
            $profile->move(public_path('images/employee/profile/'), $images);
        }
    
    
        // Update the employees model instance with the new data
        $employee->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), 
            'pwd' => $request->input('password'),
            'mobile_no' => $request->input('mobile_no'),
            'permanent_address' => $request->input('permanent_address'),
            'address_same' => $request->has('address_same') ? 1 : 0,
            'communication_address' => $request->input('communication_address'),
            'image' => $images,
            'status' => $request->has('status') ? 1 : 0,
            'aadhar_no' => $request->input('aadhar_no'),
            'pan_card_no' => $request->input('pan_card_no'),
            'role' => "employee",
            'zone_id' => $request->input('zone_id')
        ]);
    
        return redirect()->route('admin.employee')->with('success', 'Employee updated successfully.');
    }

    public function setting($id){
        $employee = Employee::findOrFail($id);
        $role = Roles::orderBy('id', 'desc')->get();
        return view('admin.employee.setting', compact('employee','role'))->with('id', $id);
    }

    public function update_setting(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'add_attandance' => 'required',
            'add_department' => 'required',
            'add_team' => 'required',
            'add_zone' => 'required',
            'manage_fsc' => 'required',
          
        ]);
  
         if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $employee = Employee::find($id);
        if (!$employee) {
            return redirect()->route('admin.employee')->with('error', 'Employee not found.');
        }
    
        $employee->update([
            'add_attandance' => $request->input('add_attandance'),
            'add_department' => $request->input('add_department'),
            'add_team' => $request->input('add_team'),
            'add_zone' => $request->input('add_zone'),
            'manage_fsc' => $request->input('manage_fsc'),
        ]);
    
        return redirect()->route('admin.employee')->with('success', 'Employee updated successfully.');
    }
    
    private function generateUniqueReferralCode()
    {
        do {
            $referralCode = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));
        } while (Employee::where('referral_code', $referralCode)->exists());
    
        return $referralCode;
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id); 

        $employee->delete();
    
        return redirect()->route('admin.employee')->with('success', 'Employee deleted successfully.');
    }
    
    
}