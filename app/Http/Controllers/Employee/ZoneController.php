<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Zone;
use  Validator;
use Illuminate\Support\Facades\Session;

class ZoneController extends Controller
{

    public function index()
    {
        $userId = session()->get('user')['id'];
        $zone = Zone::where('role_type','employee')->where('employee_id',$userId)->get();
        return view('employee.zones.index', compact('zone'));
    }

    public function create()
    {
        return view('employee.zones.create');
    }

  
   public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'polygonData' => 'required',
            'name' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'city_full_address' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }
    
    

        $polygon = new Zone();
        $polygon->map_polygon = $request->input('polygonData');
        $polygon->name = $request->input('name');
        $polygon->city = $request->input('city');
        $polygon->state = $request->input('state');
        $polygon->city_full_address = $request->input('city_full_address');
        $polygon->status = $request->has('status')?1:0;
        $polygon->role_type = "employee";
        $polygon->employee_id = Session::get('user')->id;
        $polygon->from_latitude = $request->input('from_latitude');
        $polygon->from_longitude = $request->input('from_longitude');
        $polygon->from_city = $request->input('from_city');
        $polygon->from_state = $request->input('from_state');
        $polygon->from_state_short = $request->input('from_state_short');
        $polygon->from_pincode = $request->input('from_pincode');
        $polygon->from_loc_transporter = $request->input('from_loc_transporter');
        $polygon->save();
    
        return response()->json(['success' => true, 'message' => 'Polygon created successfully']);
    }

    public function edit($id)
    {
        $zone = Zone::findOrFail($id);
        $map_polygon = json_decode($zone->map_polygon);
        return view('employee.zones.edit', compact('zone', 'map_polygon'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'polygonId' => 'sometimes|integer', 
            'polygonData' => 'required',
            'name' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'city_full_address' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }
    
  
        $data = [
            'name' => $request->input('name'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'city_full_address' => $request->input('city_full_address'),
            'map_polygon' =>json_decode($request->input('polygonData'), true) ,
            'status' =>$request->has('status')?1:0,
            'role_type' =>"employee",
            'employee_id' =>Session::get('user')->id,
            'from_latitude' =>$request->input('from_latitude'),
            'from_longitude' =>$request->input('from_longitude'),
            'from_city' =>$request->input('from_city'),
            'from_state' =>$request->input('from_state'),
            'from_state_short' =>$request->input('from_state_short'),
            'from_pincode' =>$request->input('from_pincode'),
            'from_loc_transporter' =>$request->input('from_loc_transporter'),
        ];
    
        if ($request->has('polygonId')) { 
            $polygon = zone::where('id', $request->input('polygonId'))->update($data);
        }
    
        if ($polygon) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function destroy($id)
    {
        $zone = Zone::findOrFail($id);
        $zone->delete();

        return redirect()->route('employee.zone')->with('success', 'Zone deleted successfully.');
    }

    public function zonelist($id)
    {
        $team_id = $id;
        $zone = Zone::where('role_type','franchies')->where('franchies_id',$id)->get();
        return view('employee.franchies.detail.franchies.zone_list', compact('zone','team_id'));
    }

    public function details($id){
        $zone = Zone::findOrFail($id);
        $team_id=$zone->franchies_id;
        $map_polygon = json_decode($zone->map_polygon);
        return view('employee.franchies.detail.franchies.zone_detail', compact('zone','map_polygon','team_id'));

    }
    
  

}
