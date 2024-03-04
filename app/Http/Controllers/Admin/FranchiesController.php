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
use App\Models\Franchise;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use App\Models\Team;
use App\Models\Zone;
use App\Models\Restaurant;


class FranchiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $franchise = Franchise::orderBy('id', 'desc')->get();
        return view("admin.franchies.index",compact('franchise'));
    }

    public function create()
    {
        $role = Roles::orderBy('id', 'desc')->get();
        $zone = Zone::where('status',1)->get();

        return view('admin.franchies.create',compact('role','zone'));
    }
    
    // public function view()
    // {
    //     $franchise = Franchise::orderBy('id', 'desc')->get();
    //     return view('admin.franchies.view');
    // }

    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'franchies_name' => 'required',
            'franchies_tag_line' => 'required',
            'franchies_permanent_address' => 'required',
            // 'franchies_same' => 'required',
            'franchies_communication_address' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:franchises,email',
            'password' => 'required',
            'mobile_no' => 'required|unique:franchises,mobile_no',
            'permanent_address' => 'required',
            // 'address_same' => 'required',
            'communication_address' => 'required',
            'aadhar_no' => ['required', 'regex:/^\d{12}$/'],
            'pan_card_no' => ['required', 'regex:/^([A-Z]){5}([0-9]){4}([A-Z]){1}$/'],
            // 'status' => 'required',
            'zone_id' => 'required',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        
        $uniqueReferralCode = $this->generateUniqueReferralCode();

        
        $images = null;
        if ($request->hasFile('images')) {
            $profile = $request->file('images');
            $images = time() . '.' . $profile->getClientOriginalExtension();
            $profile->move(public_path('images/franchies/profile/'), $images);
        }
    
        $frachiesData = [
            'franchies_name' => $request->input('franchies_name'),
            'franchies_tag_line' => $request->input('franchies_tag_line'),
            'franchies_permanent_address' => $request->input('franchies_permanent_address'),
            'franchies_same' => $request->has('franchies_same')?1:0,
            'franchies_communication_address' => $request->input('franchies_communication_address'),
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
            'role' => "franchies",
            'zone_id' => $request->input('zone_id')
        ];
        
        $franchies = Franchise::create($frachiesData);
    
        return redirect()->route('admin.franchies')->with('success', 'Franchises inserted successfully.');
    }


    public function edit($id)
    {
        $franchise = Franchise::findOrFail($id);
        $role = Roles::orderBy('id', 'desc')->get();
        $zone = Zone::where('status',1)->get();
        return view('admin.franchies.edit', compact('franchise','role','zone'))->with('id', $id);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'franchies_name' => 'required',
            'franchies_tag_line' => 'required',
            'franchies_permanent_address' => 'required',
            'franchies_communication_address' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:franchises,email,' . $id,
            'password' => 'required',
            'mobile_no' => 'required|unique:franchises,mobile_no,' . $id,
            'permanent_address' => 'required',
            'zone_id' => 'required',
            'communication_address' => 'required',
            'aadhar_no' => ['required', 'regex:/^\d{12}$/'],
            'pan_card_no' => ['required', 'regex:/^([A-Z]){5}([0-9]){4}([A-Z]){1}$/'],
            // 'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
  
         if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $franchise = Franchise::find($id);
        if (!$franchise) {
            return redirect()->route('admin.franchies')->with('error', 'Franchise not found.');
        }
    
        $images = $franchise->image;
    
        if ($request->hasFile('images')) {
            $profile = $request->file('images');
            $images = time() . '.' . $profile->getClientOriginalExtension();
            $profile->move(public_path('images/franchies/profile/'), $images);
        }
    
    
        // Update the Franchise model instance with the new data
        $franchise->update([
            'franchies_name' => $request->input('franchies_name'),
            'franchies_tag_line' => $request->input('franchies_tag_line'),
            'franchies_permanent_address' => $request->input('franchies_permanent_address'),
            'franchies_same' => $request->has('franchies_same') ? 1 : 0,
            'franchies_communication_address' => $request->input('franchies_communication_address'),
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
            'role' => "franchies",
            'zone_id' => $request->input('zone_id')
        ]);
    
        return redirect()->route('admin.franchies')->with('success', 'Franchise updated successfully.');
    }

    public function setting($id){
        $franchise = Franchise::findOrFail($id);
        $role = Roles::orderBy('id', 'desc')->get();
        return view('admin.franchies.setting', compact('franchise','role'))->with('id', $id);
    }

    public function update_setting(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'add_attandance' => 'required',
            'add_department' => 'required',
            'add_team' => 'required',
            'add_zone' => 'required',
          
        ]);
  
         if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $franchise = Franchise::find($id);
        if (!$franchise) {
            return redirect()->route('admin.franchies')->with('error', 'Franchise not found.');
        }
    
        $franchise->update([
            'add_attandance' => $request->input('add_attandance'),
            'add_department' => $request->input('add_department'),
            'add_team' => $request->input('add_team'),
            'add_zone' => $request->input('add_zone'),
        ]);
    
        return redirect()->route('admin.franchies')->with('success', 'Franchise updated successfully.');
    }
    
    private function generateUniqueReferralCode()
    {
        do {
            $referralCode = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));
        } while (Franchise::where('referral_code', $referralCode)->exists());
    
        return $referralCode;
    }

    public function destroy($id)
    {
        $franchise = Franchise::findOrFail($id); 

         $franchise->delete();
    
        return redirect()->route('admin.franchies')->with('success', 'Franchies deleted successfully.');
    }
    
    public function departmentList($id){
        $departments = Department::where('franchies_id',$id)->get();
        return view('admin.franchies.detail.franchies.view', compact('departments'))->with('id', $id);
    }
    
    public function departmentDetail($id){
        $department = Department::findOrFail($id);
        return view('admin.franchies.detail.franchies.department_detail', compact('department'));
    }
    
    public function teamList($id){
        $teams = Team::where('franchies_id',$id)->get();
        return view('admin.franchies.detail.franchies.team_list', compact('teams'))->with('id', $id);
    }
    public function teamDetail($id){
        $team = Team::findOrFail($id);
        return view('admin.franchies.detail.franchies.team_detail', compact('team'));
    }
    public function restaurantList($id){
        $restaurant = Restaurant::where('team_id',$id)->get();
        $restaurants = Restaurant::where('team_id',$id)->first();
        // dd($restaurants->team_id);
        return view('admin.franchies.detail.franchies.restaurant_list', compact('restaurant','restaurants'))->with('id', $id);
    }
    public function restaurantDetail($id){
        $team = Restaurant::findOrFail($id);
        return view('admin.franchies.detail.franchies.restaurant_detail', compact('team'));
    }
    // public function zoneList($id){
    //     $zones = Zone::where('franchies_id',$id)->get();
    //     return view('admin.franchies.detail.franchies.zone_list', compact('zones'))->with('id', $id);
    // }
    
    public function view($id)
    {
        $team_id = $id;
        $franchise = Franchise::findOrFail($id);
        $role = Roles::orderBy('id', 'desc')->get();
        return view('admin.franchies.view', compact('franchise','role','team_id'))->with('id', $id);
    }
}
