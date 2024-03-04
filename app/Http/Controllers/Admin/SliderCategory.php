<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SliderCategories;
use Illuminate\Support\Facades\Validator;

class SliderCategory extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $slider_category = SliderCategories::orderBy('id', 'desc')->get();

        return view('admin.slider_category.index', compact('slider_category'));
    }
    
    public function create()
    {
        return view('admin.slider_category.create');
    }
    
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:slider_category,title',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $status = $request->has('status') ? 1 : 0;
    
        $slider_category = SliderCategories::create([
            'title' => $request->title,
            'status' => $status,
        ]);
        if ($slider_category) {
            return redirect()->route('admin.slider_category')->with('success', 'Slider Category inserted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to insert Slider Category. Please try again.')->withInput();
        }
    }


    public function edit($id)
    {
        $slider_category = SliderCategories::findOrFail($id);
        return view('admin.slider_category.edit', compact('slider_category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:slider_category,title,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $slider_category = SliderCategories::findOrFail($id);
        $slider_category->title = $request->title;
        $slider_category->status = $request->has('status') ? 1 : 0;
        $slider_category->save();
        return redirect()->route('admin.slider_category')->with('success', 'Slider Category updated successfully.');
    }

    public function destroy($id)
    {
        $slider_category = SliderCategories::findOrFail($id);
        $slider_category->delete();

        return redirect()->route('admin.slider_category')->with('success', 'Slider Category deleted successfully.');
    }
}