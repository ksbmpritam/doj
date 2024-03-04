<?php

namespace App\Http\Controllers\Employee;
use App\Models\Team;
use App\Models\Roles;
use App\Models\Restaurant;
use App\Models\Department;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TeamController extends Controller
{   


    public function index(Request $request)
    {
        $user = Session::get('user');
 
        if (!$user || empty($user->id) || $user->role !== "employee") {
            return redirect('/employee');
        }
        
        $userId = Session::get('user')->id;
        
        $team = Team::where('employee_id',$userId)->with('department')->orderBy('id', 'desc')->get();
        return view('employee.team.index', compact('team'));
    }



    public function create()
    {
        $user = Session::get('user');
 
        if (!$user || empty($user->id) || $user->role !== "employee") {
            return redirect('/employee');
        }
        
        $userId = Session::get('user')->id;
        $department = Department::where('employee_id',$userId)->where('status',1)->get();
        $zone = Zone::where('employee_id',$userId)->where('status',1)->get();
        $employeeRoles = Roles::where('employee_id', $user->id)->where('status', '1')->get();
        return view('employee.team.create',compact('employeeRoles','department','zone'));
    }
    

    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
          
            'name' => 'required',
            'email' => 'required|email|unique:team,email',
            'password' => 'required',
            'mobile_no' => 'required|regex:/^[789]\d{9}$/|size:10|unique:team,mobile_no',
            'permanent_address' => 'required',
            // 'address_same' => 'required',
            'communication_address' => 'required',
            'aadhar_no' => ['required', 'regex:/^\d{12}$/'],
            'pan_card_no' => ['required', 'regex:/[A-Z]{5}[0-9]{4}[A-Z]{1}/'],
            'department_id' => 'required',
            // 'zone_id' => 'required',
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
            $profile->move(public_path('images/team/profile/'), $images);
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
            'role_type' => "employee",
            'employee_id' =>  $userId = Session::get('user')->id,
            'department_id' => $request->input('department_id'),
            // 'zone_id' => $request->input('zone_id'),
        ];
        
        $team = Team::create($formData);
    
        return redirect()->route('employee.team')->with('success', 'Team inserted successfully.');
    }
    
    public function edit($id)
    {
        $team = Team::findOrFail($id);
        $user = Session::get('user');
 
        if (!$user || empty($user->id) || $user->role !== "employee") {
            return redirect('/employee');
        }
        $userId = Session::get('user')->id;
        $department=Department::where('employee_id',$userId)->where('status',1)->get();
        $zone = Zone::where('employee_id',$userId)->where('status',1)->get();
        $employeeRoles = Roles::where('employee_id',$userId)->get();
        return view('employee.team.edit', compact('team','employeeRoles','department','zone'));
    }
    
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:team,email,' . $id,
            'password' => 'required',
            'mobile_no' => 'required|regex:/^[789]\d{9}$/|size:10|unique:team,mobile_no,' . $id,
            'permanent_address' => 'required',
            'communication_address' => 'required',
            'aadhar_no' =>'required',
            'pan_card_no' => ['required', 'regex:/[A-Z]{5}[0-9]{4}[A-Z]{1}/'],
            'department_id' => 'required',
            // 'zone_id' => 'required',
            // 'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
  
         if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $team = Team::find($id);
        if (!$team) {
            return redirect()->route('employee.team')->with('error', 'Team not found.');
        }
    
        $images = $team->image;
    
        if ($request->hasFile('images')) {
            $profile = $request->file('images');
            $images = time() . '.' . $profile->getClientOriginalExtension();
            $profile->move(public_path('images/team/profile/'), $images);
        }
    
    
        // Update the Team model instance with the new data
        $team->update([
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
            'role_type' => "employee",
            'employee_id' =>  $userId = Session::get('user')->id,
            'department_id' => $request->input('department_id'),
            // 'zone_id' => $request->input('zone_id'),
        ]);
    
        return redirect()->route('employee.team')->with('success', 'Team updated successfully.');
    }
   
    private function generateUniqueReferralCode()
    {
        do {
            $referralCode = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));
        } while (Team::where('referral_code', $referralCode)->exists());
    
        return $referralCode;
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return redirect()->route('employee.team')->with('success', 'Team deleted successfully.');
    }
    
    public function setting($id){
        $team = Team::findOrFail($id);
        $role = Roles::orderBy('id', 'desc')->get();
        return view('employee.team.setting', compact('team','role'))->with('id', $id);
    }

    public function update_setting(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'add_restaurant' => 'required',
            'add_rider' => 'required',
            'add_order' => 'required',
            'add_product' => 'required',
          
        ]);
  
         if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $team = Team::find($id);
        if (!$team) {
            return redirect()->route('admin.employee')->with('error', 'Team not found.');
        }
    
        $team->update([
            'add_restaurant' => $request->input('add_restaurant'),
            'add_rider' => $request->input('add_rider'),
            'add_order' => $request->input('add_order'),
            'add_product' => $request->input('add_product'),
        ]);
    
        return redirect()->route('employee.team')->with('success', 'Team updated successfully.');
    }
    
    public function view($id)
    {
        $team = Team::findOrFail($id);
        $user = Session::get('user');
 
        if (!$user || empty($user->id) || $user->role !== "employee") {
            return redirect('/employee');
        }
        $team_id=$id;
        $userId = Session::get('user')->id;
        $department=Department::where('employee_id',$userId)->where('status',1)->get();
        $zone = Zone::where('employee_id',$userId)->where('status',1)->get();
        $employeeRoles = Roles::where('employee_id',$userId)->get();
        return view('employee.team.view', compact('team','employeeRoles','department','zone','team_id'));
    }
    
    public function teamList($id){
        $team_id =$id;
        $team_ids =$id;
        $teams = Team::where('franchies_id',$id)->get();
        return view('employee.franchies.detail.franchies.team_list', compact('teams','team_id','team_ids'))->with('id', $id);
    }
    public function teamDetail($id){
        $team = Team::findOrFail($id);
        $team_id = $team->franchies_id;
        $team_ids = $id;
        return view('employee.franchies.detail.franchies.team_detail', compact('team','team_id','team_ids'));
    }

}


