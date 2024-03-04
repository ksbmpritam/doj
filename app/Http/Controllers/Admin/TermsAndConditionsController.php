<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TermsCondition ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class TermsAndConditionsController extends Controller
{

    public function index()
    {
       $data=TermsCondition::all(); 
       return view("admin.terms_conditions.index",compact('data'));
    }

    public function create()
    {
        
        return view('admin.terms_conditions.create');
    }
    
    public function insert(Request $request){
        $validation = Validator::make($request->all(), [
            'app' => 'required',
            'title' => 'required', 
            'content' => 'required', 
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        
        $termsAndConditions = TermsCondition::create([
            'app' => $request->app,
            'title' => $request->title,
            'content' => $request->content,
            'status' => 1,
        ]);
    
        return redirect()->route('admin.termsAndConditions')->with('success', 'Terms And Conditions added successfully.');
    }

     public function edit($id)
    {
        $termsCondition = TermsCondition::findOrFail($id);
        return view('admin.terms_conditions.edit', compact('termsCondition'));
    }
    
    public function update(Request $request, $id){
         $validation = Validator::make($request->all(), [
            'app' => 'required',
            'title' => 'required', 
            'content' => 'required', 
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $termsCondition = TermsCondition::find($id);
        
        if (!$termsCondition) {
            return redirect()->back()->with('error', 'Terms And Conditions not found.');
        }
         
        $termsCondition->app = $request->app;
        $termsCondition->title = $request->title;
        $termsCondition->content = $request->content;
        
        $termsCondition->save();
    
        return redirect()->route('admin.termsAndConditions')->with('success', 'Terms And Conditions updated successfully.');
    }

    public function delete($id)
    {
        $termsCondition = TermsCondition::findOrFail($id);
        $termsCondition->delete();

        return redirect()->route('admin.termsAndConditions')->with('success', 'Terms And Conditions deleted successfully.');
    }  

    public function privacyindex()
    {
       return view("privacy_policy.index");
    }

    

   

}
