<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class FaqController extends Controller
{
    
    public function index()
    {
       $data = Faq::orderBy('id', 'desc')->get();
       return view("admin.faq.index",compact('data'));
    }

    public function create()
    {
        
        return view('admin.faq.create');
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
        
        $faq = Faq::create([
            'app' => $request->app,
            'title' => $request->title,
            'content' => $request->content,
            'status' => 1,
        ]);
    
        return redirect()->route('admin.faq')->with('success', 'FAQ  added successfully.');
    }

    public function edit($id)
    {
        $data = Faq::findOrFail($id);
        return view("admin.faq.edit",compact('data'));
        
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
    
        $faq = Faq::find($id);
        
        if (!$faq) {
            return redirect()->back()->with('error', 'FAQ  not found.');
        }
         
        $faq->app = $request->app;
        $faq->title = $request->title;
        $faq->content = $request->content;
        
        $faq->save();
    
        return redirect()->route('admin.faq')->with('success', 'FAQ updated successfully.');
    }

    public function delete($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faq')->with('success', 'FAQ deleted successfully.');
    }  

}