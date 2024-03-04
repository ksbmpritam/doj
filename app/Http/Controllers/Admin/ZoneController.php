<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Zone;
use  Validator;
use Illuminate\Support\Facades\Session;

class ZoneController extends Controller
{
    public function zonelist($id)
    {
        $team_id = $id;
        $zone = Zone::where('franchies_id', $id)->get();
        
        $map_polygon = [];
        foreach ($zone as $zone1) {
            $map_polygon[] = json_decode($zone1->map_polygon);
        }
        
        return view('admin.franchies.detail.franchies.zone_list', compact('zone', 'map_polygon', 'team_id'));
    }
    
    public function zonelist2($id)
    {
        $team_id = $id;
        $zone = Zone::where('employee_id', $id)->get();
        
        $map_polygon = [];
        foreach ($zone as $zone1) {
            $map_polygon[] = json_decode($zone1->map_polygon);
        }
        
        return view('admin.employee.detail.employee.zone_list', compact('zone', 'map_polygon', 'team_id'));
    }

    
    public function zoneDetail($id){
        $zone = Zone::findOrFail($id);
        $team_id = $zone->franchies_id;
        $map_polygon = json_decode($zone->map_polygon);
        return view('admin.franchies.detail.franchies.zone_detail', compact('zone', 'map_polygon','team_id'));
    }
    
    public function zoneDetail2($id){
        $zone = Zone::findOrFail($id);
        $team_id = $zone->employee_id;
        $map_polygon = json_decode($zone->map_polygon);
        return view('admin.employee.detail.employee.zone_detail', compact('zone', 'map_polygon','team_id'));
    }
    
    public function index()
    {
        $user = Session::get('user');
        
        if (!$user || empty($user->id) || $user->role !== "franchies") {
            return redirect('/franchies');
        }
        
        $userId = Session::get('user')->id;
        $zone = Zone::where('role_type','franchies')->where('franchies_id',$userId)->get();
        return view('franchies.zones.index', compact('zone'));
    }

    public function create()
    {
        return view('franchies.zones.create');
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
        $polygon->role_type = "franchies";
        $polygon->franchies_id = Session::get('user')->id;
        
        $polygon->save();
    
        return response()->json(['success' => true, 'message' => 'Polygon created successfully']);
    }

    public function edit($id)
    {
        $zone = Zone::findOrFail($id);
        $map_polygon = json_decode($zone->map_polygon);
        return view('franchies.zones.edit', compact('zone', 'map_polygon'));
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
            'role_type' =>"franchies",
            'franchies_id' =>Session::get('user')->id,
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

        return redirect()->route('franchies.zone')->with('success', 'Zone deleted successfully.');
    }

}
