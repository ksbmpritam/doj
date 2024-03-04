<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    // Display a list of roles
    public function index()
    {
        $role = Roles::orderBy('id', 'desc')->get();

        return view("admin.role.index",compact('role'));
    }

    // Show the form for creating a new role
    public function create()
    {
        return view('admin.role.create');
    }

   
    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|unique:roles,title',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $status = $request->has('status') ? 1 : 0;
    
        $role = Roles::create([
            'title' => $request->title,
            'status' => $status,
        ]);
        if ($role) {
            return redirect()->route('admin.role')->with('success', 'Role inserted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to insert Role. Please try again.')->withInput();
        }
    }
    

    public function edit($id)
    {
        $role = Roles::findOrFail($id);
        return view('admin.role.edit', compact('role'));
    }

   public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|unique:roles,title',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $Role = Roles::find($id);
        
        if (!$Role) {
            return redirect()->back()->with('error', 'Roles not found.');
        }
    
    
        $Role->title = $request->input('title');
        $Role->status = $request->input('status');
        $Role->save();
    
        return redirect()->route('admin.role')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $Rolesr = Roles::findOrFail($id);
        $Rolesr->delete();

        return redirect()->route('admin.role')->with('success', 'Role deleted successfully.');
    }
}
