<?php

namespace App\Http\Controllers\Franchies;
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
use App\Models\FormRequest;

class RequestFormController extends Controller
{   


    public function index(Request $request)
    {
        $user = Session::get('user');
        if (!$user || empty($user->id)) {
            return redirect('/franchies');
        }
        
        $userId = Session::get('user')->id;
        
        $forms = FormRequest::where('role_type','franchies')->orderBy('id', 'desc')->get();
        
        return view('franchies.request_forms.index', compact('forms'));
    }

    public function edit($id)
    {
        $forms = FormRequest::findOrFail($id);
        $user = Session::get('user');
 
        if (!$user || empty($user->id)) {
            return redirect('/franchies');
        }
        $userId = Session::get('user')->id;
        // $forms =  FormRequest::all();
        return view('franchies.request_forms.edit', compact('forms'));
    }
    
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
  
         if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $user = Session::get('user');
 
        if (!$user || empty($user->id)) {
            return redirect('/franchies');
        }
        
        $userId = Session::get('user')->id;
        
        $forms = FormRequest::find($id);
        if (!$forms) {
            return redirect()->route('franchies.form')->with('error', 'Request not found.');
        }
    
        // Update the Team model instance with the new data
        $forms->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => $userId,
            'role_type' => $user->role,
            'status' => $request->has('status') ? 1 : 0,
        ]);
    
        return redirect()->route('franchies.form')->with('success', 'Request updated successfully.');
    }
    public function delete($id)
    {
        $team = FormRequest::findOrFail($id);
        $team->delete();

        return redirect()->route('franchies.form')->with('success', 'Request deleted successfully.');
    }
    public function view($id)
    {
        $forms = FormRequest::findOrFail($id);
        $user = Session::get('user');
 
        if (!$user || empty($user->id)) {
            return redirect('/franchies');
        }
        $userId = Session::get('user')->id;
        // $forms =  FormRequest::all();
        return view('franchies.request_forms.view', compact('forms'));
    }

}

