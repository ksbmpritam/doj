<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class PrivacyPolicies extends Controller
{

    public function index()
    {
       $data=PrivacyPolicy::all(); 
       return view("admin.privacy_policy.index",compact('data'));
    }

    public function create()
    {
        
        return view('admin.privacy_policy.create');
    }
    
    public function insert(Request $request){
        $validation = Validator::make($request->all(), [
            'app' => 'required|unique:privacy_policy',
            'title' => 'required', 
            'content' => 'required', 
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        
        $policy = PrivacyPolicy::create([
            'app' => $request->app,
            'title' => $request->title,
            'content' => $request->content,
            'status' => 1,
        ]);
    
        return redirect()->route('admin.privacyPolicy')->with('success', 'Privacy Policy  added successfully.');
    }

    public function edit($id)
    {
        $privacy = PrivacyPolicy::findOrFail($id);
        return view("admin.privacy_policy.edit",compact('privacy'));
        
    }
    
    public function update(Request $request, $id){
         $validation = Validator::make($request->all(), [
            'app' => 'required|unique:privacy_policy,app,' . $id,
            'title' => 'required', 
            'content' => 'required', 
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $privacy = PrivacyPolicy::find($id);
        
        if (!$privacy) {
            return redirect()->back()->with('error', 'Privacy Policy  not found.');
        }
         
        $privacy->app = $request->app;
        $privacy->title = $request->title;
        $privacy->content = $request->content;
        
        $privacy->save();
    
        return redirect()->route('admin.privacyPolicy')->with('success', 'Privacy Policy updated successfully.');
    }

    public function delete($id)
    {
        $privacy = PrivacyPolicy::findOrFail($id);
        $privacy->delete();

        return redirect()->route('admin.privacyPolicy')->with('success', 'Privacy Policy deleted successfully.');
    }  

}
