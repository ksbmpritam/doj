<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\FoodAttribute;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
       
        $searchTerm = $request->input('search');
        $attributes = FoodAttribute::query();

        if ($searchTerm) {
            $attributes->where('name', 'like', $searchTerm . '%');
        }
    
        $attributes = $attributes->orderBy('id', 'desc')->get();
                                 

        return view('admin.attributes.index', compact('attributes','searchTerm'));
    }
    
    public function create()
    {
        return view('admin.attributes.create');
    }
    
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:food_attribute,name',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $status = $request->has('status') ? 1 : 0;
    
        $attribute = FoodAttribute::create([
            'name' => $request->name,
            'status' => $status,
        ]);
        if ($attribute) {
            return redirect()->route('admin.attributes')->with('success', 'Attribute inserted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to insert attribute. Please try again.')->withInput();
        }
    }


    public function edit($id)
    {
        $attribute = FoodAttribute::findOrFail($id);
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:food_attribute,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $attribute = FoodAttribute::findOrFail($id);
        $attribute->name = $request->name;
        $attribute->status = $request->has('status') ? 1 : 0;
        $attribute->save();
        return redirect()->route('admin.attributes')->with('success', 'Attribute updated successfully.');
    }

    public function destroy($id)
    {
        $attribute = FoodAttribute::findOrFail($id);
        $attribute->delete();

        return redirect()->route('admin.attributes')->with('success', 'Attribute deleted successfully.');
    }
}
