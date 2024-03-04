<?php

namespace App\Http\Controllers\Admin;
use App\Models\Sliders;
use App\Models\SliderCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {   
        
        $slider = Sliders::all();
        return view('admin.slider.index',compact('slider'));
    }
    

    public function create()
    {
        $slide_category=SliderCategories::all();
        return view('admin.slider.create',compact('slide_category'));
    }
    

    public function insert(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'slider_images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed image types and size
        ]);
    
        $image = $request->file('slider_images');
        $slider = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/slider'), $slider);
    
        Sliders::create([
            'type_id' => $request->type_id,
            'status' => $request->status,
            'image' => $slider,
        ]);
    
        return redirect()->route('admin.slider')->with('success', 'Slider inserted successfully.');
    }
    
    public function edit($id)
    {
        $sliders = Sliders::findOrFail($id);
         $slide_category=SliderCategories::all();
        return view('admin.slider.edit', compact('sliders','slide_category'));
    }
    
   public function update(Request $request, $id)
    {
        $request->validate([
            'type_id' => 'required',
            'slider_images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed image types and size
        ]);
    
        $slider = Sliders::findOrFail($id);
    
        $slider->type_id = $request->type_id;
    
        if ($request->hasFile('slider_images')) {
            $image = $request->file('slider_images');
            $newSliderImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/slider'), $newSliderImage);
            
            if ($slider->image) {
                $oldImagePath = public_path('images/slider/') . $slider->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $slider->image = $newSliderImage;
        }
    
        $slider->status = $request->status; 
        $slider->save();
    
        return redirect()->route('admin.slider')->with('success', 'Slider updated successfully.');
    }




    public function destroy($id)
    {
        $banner = Sliders::findOrFail($id);
        $banner->delete();

        return redirect()->route('admin.slider')->with('success', 'Categories deleted successfully.');
    }

}


