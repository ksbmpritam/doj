<?php

namespace App\Http\Controllers\Franchies;
use App\Models\Team;
use App\Models\Restaurant;
use App\Models\Roles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Department;
use App\Models\Zone;

class TeamController extends Controller
{   

    public function index(Request $request)
    {
        $user = Session::get('user');
        
        if (!$user || empty($user->id) || $user->role !== "franchies") {
            return redirect('/franchies');
        }
        
        $userId = Session::get('user')->id;
        $team = Team::where('franchies_id',$userId)->with('department')->orderBy('id', 'desc')->get();
        

        return view('franchies.team.index', compact('team'));
    }



    public function create()
    {
        $userId = Session::get('user')->id;
        $departments =Department::where("franchies_id",$userId)->where('status',1)->get();
        $zone = Zone::where('franchies_id',$userId)->where('status',1)->get();
        return view('franchies.team.create',compact('departments','zone'));
    }
    

    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
          
            'name' => 'required',
            'email' => 'required|email|unique:team,email',
            'password' => 'required',
            'mobile_no' => 'required|unique:team,mobile_no',
            'permanent_address' => 'required',
            // 'address_same' => 'required',
            'communication_address' => 'required',
            'aadhar_no' => ['required', 'regex:/^\d{12}$/'],
            'pan_card_no' => ['required', 'regex:/[A-Z]{5}[0-9]{4}[A-Z]{1}/'],
            // 'zone_id' => 'required',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'department_id' => 'required',
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
            'role_type' => "franchies",
            'franchies_id' => Session::get('user')->id,
            'department_id' => $request->input('department_id'),
            // 'zone_id' => $request->input('zone_id'),
        ];
        
        $team = Team::create($formData);
    
        return redirect()->route('franchies.team')->with('success', 'Team inserted successfully.');
    }
    
    public function edit($id)
    {   
        $userId = Session::get('user')->id;
        $team = Team::findOrFail($id);
        $departments =Department::where("franchies_id",$userId)->where('status',1)->get();
        $zone = Zone::where('franchies_id',$userId)->where('status',1)->get();
        return view('franchies.team.edit', compact('team','departments','zone'));
    }
    
    public function view($id)
    {   
        $team_id=$id;
        $team = Team::findOrFail($id);
        $userId = Session::get('user')->id;
        $departments =Department::where("franchies_id",$userId)->where('status',1)->get();
        $zone = Zone::where('franchies_id',$userId)->where('status',1)->get();
        return view('franchies.team.view', compact('team','departments','team_id','zone'));
    }
    
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:team,email,' . $id,
            'password' => 'required',
            'mobile_no' => 'required|unique:team,mobile_no,' . $id,
            'permanent_address' => 'required',
            'communication_address' => 'required',
            'aadhar_no' =>'required',
            'pan_card_no' => ['required', 'regex:/[A-Z]{5}[0-9]{4}[A-Z]{1}/'],
            // 'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'department_id' => 'required',
            // 'zone_id' => 'required',
        ]);
  
         if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $team = Team::find($id);
        if (!$team) {
            return redirect()->route('franchies.team')->with('error', 'Team not found.');
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
            'role_type' => "franchies",
            'franchies_id' => Session::get('user')->id,
            'department_id' => $request->input('department_id'),
            // 'zone_id' => $request->input('zone_id'),
        ]);
    
        return redirect()->route('franchies.team')->with('success', 'Team updated successfully.');
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

        return redirect()->route('franchies.team')->with('success', 'Team deleted successfully.');
    }
    
    public function setting($id){
        $team = Team::findOrFail($id);
        $role = Roles::orderBy('id', 'desc')->get();
        return view('franchies.team.setting', compact('team','role'))->with('id', $id);
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
            return redirect()->route('franchies.team')->with('error', 'Team not found.');
        }
    
        $team->update([
            'add_restaurant' => $request->input('add_restaurant'),
            'add_rider' => $request->input('add_rider'),
            'add_order' => $request->input('add_order'),
            'add_product' => $request->input('add_product'),
        ]);
    
        return redirect()->route('franchies.team')->with('success', 'Team updated successfully.');
    }

}


