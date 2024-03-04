<?php

namespace App\Http\Controllers\Franchies;
use App\Models\Department;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class AttandanceController extends Controller
{   

   
    public function index(Request $request)
    {
        $user = Session::get('user');
 
        if (!$user || empty($user->id) || $user->role !== "franchies") {
            return redirect('/franchies');
        }
        
        $userId = Session::get('user')->id;

        return view('employee.attandance.index');
    }



    public function create()
    {
        return view('employee.department.create');
    }
    

    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $userId = Session::get('user')->id;
        $department = Department::create([
            'name' => $request->input('name'),
            'employee_id' => $userId,
            'type' => "employee",
            'status' => $request->has('status')?1:0,
        ]);
    
        return redirect()->route('employee.department')->with('success', 'Department inserted successfully.');
    }
    
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('employee.department.edit', compact('department'));
    }
    
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $userId = Session::get('user')->id;
        $department = Department::find($id);
        
        if (!$department) {
            return redirect()->back()->with('error', 'Department not found.');
        }
    
       
        $department->name = $request->input('name');
        $department->employee_id = $userId;
        $department->type = "employee";
        $department->status = $request->has('status')?1:0;
        $department->save();
    
        return redirect()->route('employee.department')->with('success', 'Department updated successfully.');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('employee.department')->with('success', 'Department deleted successfully.');
    }
}