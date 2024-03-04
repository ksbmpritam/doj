<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles;
use  Validator;
use Session;
use Str;

class RoleController extends Controller
{
    public function index(){
        $user = Session::get('user');
 
        if (!$user || empty($user->id) || $user->role !== "employee") {
            return redirect('/employee');
        }
        $roles = Roles::where('employee_id',$user->id)->get();
        return view('employee.role.index', compact('roles'));
    }
    public function create()
    {
        return view('employee.role.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = Session::get('user');
    
        if (!$user) {
            return redirect('employee');
        }
        try {
            $title = $request['title'];
            $slug = Str::slug($title); // Generate the slug from the title
    
            $data = [
                'employee_id' => $user->id,
                'title' => $title,
                'status' => $request->has('status') ? 1 : 0,
                'slug' => $slug, // Assign the generated slug
            ];
            $role = Roles::create($data);
    
            if ($role) {
                return redirect('employee/role')->with('success', 'Role Created successfully!');
            } else {
                return redirect('employee/role')->with('error', 'Something went wrong while creating the role.');
            }
        } catch (\Exception $th) {
            // Log the exception for debugging purposes
            \Log::error('Error creating role: ' . $th->getMessage());
    
            return redirect('employee/role')->with('error', 'An error occurred while creating the role.');
        }
    }

    public function edit($id)
    {
        $role = Roles::find($id);
        
        if (!$role) {
            return redirect()->route('employee.role.index')->with('error', 'Role not found');
        }
        return view('employee.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Roles::find($id);
        if (!$role) {
            return redirect('/')->with('error', 'Role not found');
        }
        $user = Session::get('user');
    
        if (!$user) {
            return redirect('employee');
        }
        try {
            $params = $request->all();
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $title = $request['title'];
                $slug = Str::slug($title); 
                $params['employee_id'] = $user->id;
                $params['title'] = $title;
                $params['status'] = $request->has('status') ? 1 : 0;
                $params['slug'] = $slug; 
    
                Roles::find($role->id)->update($params);
                return redirect('employee/role')->with('success', 'Role updated successfully');
            }
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error updating role');
        }
    }


    public function delete($id)
    {
        $role = Roles::find($id);
        if (!$role) {
            return redirect('/')->with('error', 'role not found');
        } else {
            try {
                $role->delete();
                return redirect('employee/role')->with('success', 'role deleted successfully');
            } catch (\Exception $e) {
                return redirect('employee/role')->with('error', 'Error deleting role');
            }
        }
    }
}
