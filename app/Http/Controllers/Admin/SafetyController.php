<?php

namespace App\Http\Controllers\Admin;

use App\Models\Safety;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Order;

class SafetyController extends Controller
{
    public function index()
    {
        $safetys = Safety::all();
        return view('admin.safety.index', compact('safetys'));
    }
    
    public function create()
    {
        return view('admin.safety.create');
    }
    
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'question' => 'required',
            'message' => 'required',
        ]);
    
        $safety = Safety::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'question' => $request->question,
            'message' => $request->message,
            'status' => $request->status ?? 0,
        ]);
    
        return redirect()->route('admin.safety')->with('success', 'Safety information inserted successfully.');
    }


   
    
    public function edit($id)
    {
        $safety = safety::findOrFail($id);
        return view('admin.safety.edit', compact('safety'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'question' => 'required',
            'message' => 'required',
        ]);
    
        $safety = Safety::findOrFail($id);
        $safety->name = $request->name;
        $safety->email = $request->email;
        $safety->phone = $request->phone;
        $safety->question = $request->question;
        $safety->message = $request->message;
        $safety->status = $request->status;
        $safety->save();
    
        return redirect()->route('admin.safety')->with('success', 'Safety information updated successfully.');
    }



    public function destroy($id)
    {
        $safety = safety::findOrFail($id);
        $safety->delete();

        return redirect()->route('admin.safety')->with('success', 'safety deleted successfully.');
    }    
    
    
}