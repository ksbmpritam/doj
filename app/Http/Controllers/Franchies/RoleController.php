<?php

namespace App\Http\Controllers\Franchies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Str;


class RoleController extends Controller
{
    public function index(){
       $user = Session::get('user');

        if (!$user || empty($user->id) || $user->role !== "franchies") {
            return redirect('/franchies');
        }
        
        $roles = Roles::where('franchies_id',$user->id)->get();
        return view('franchies.role.index', compact('roles'));
    }
    
    public function create()
    {
        return view('franchies.role.create');
    }

    public function store(Request $request)
    {
        $user = Session::get('user');
    
        if (!$user) {
            return redirect('franchies');
        }
    
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        try {
            $title = $request->input('title');
    
            // Create a slug based on the 'title'
            $slug = Str::slug($title); // Use the Str::slug method from Laravel
    
            $data = [
                'franchies_id' => $user->id,
                'title' => $title,
                'status' => $request->has('status') ? 1 : 0,
                'slug' => $slug,
            ];
    
            $role = Roles::create($data);
    
            if ($role) {
                return redirect('franchies/role')->with('success', 'Role Created successfully!');
            } else {
                return redirect('franchies/role')->with('error', 'Something went wrong while creating the role.');
            }
        } catch (\Exception $th) {
            // Log the exception for debugging purposes
            \Log::error('Error creating role: ' . $th->getMessage());
    
            return redirect('franchies/role')->with('error', 'An error occurred while creating the role.');
        }
    }


    public function edit($id)
    {
        $role = Roles::find($id);
        
        if (!$role) {
            return redirect()->route('franchies.role.index')->with('error', 'Role not found');
        }
        return view('franchies.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Roles::find($id);
        if (!$role) {
            return redirect('/')->with('error', 'Role not found');
        }
        
        $user = Session::get('user');
    
        if (!$user) {
            return redirect('franchies');
        }
    
        try {
            $params = $request->all();
            
            $validator = Validator::make($params, [
                'title' => 'required',
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            if (!isset($params['slug']) || empty($params['slug'])) {
                $params['slug'] = Str::slug($params['title']);
            }
            
            $params['franchies_id'] = $user->id;
            $params['status'] = $request->has('status') ? 1 : 0;
            
            $role->update($params);
            
            return redirect('franchies/role')->with('success', 'Role updated successfully');
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
                return redirect('franchies/role')->with('success', 'role deleted successfully');
            } catch (\Exception $e) {
                return redirect('franchies/role')->with('error', 'Error deleting role');
            }
        }
    }
}
