<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\CustomerCover;
use App\Models\CoverImage;

class CoverImageController extends Controller
{
    public function index()
    {
        $banners = CoverImage::all();
        return view('admin.cover_image.index', compact('banners'));
    }
    
    public function create()
    {
        return view('admin.cover_image.create');
    }
    
    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'banner_photo' => 'required|image|mimes:jpeg,png,jpg,gif', // Adjust the allowed image types and size
        ]);
    
        $image = $request->file('banner_photo');
        $banners = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/cover_image'), $banners);
    
        $banner = CoverImage::create([
            'title' => $request->title,
            'status' => $request->status,
            'banner_photo' => $banners,
        ]);
    
        return redirect()->route('admin.cover_image')->with('success', 'Cover image inserted successfully.');
    }

   
    
    public function edit($id)
    {
        $banner = CoverImage::findOrFail($id);
        return view('admin.cover_image.edit', compact('banner'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'banner_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $banner = CoverImage::findOrFail($id);
        $banner->title = $request->title;
        $banner->status = $request->status;
    
        if ($request->hasFile('banner_photo')) {
            $image = $request->file('banner_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/cover_image'), $imageName);
            $banner->banner_photo = $imageName;
        }
    
        $banner->save();
    
        return redirect()->route('admin.cover_image')->with('success', 'Cover Image updated successfully.');
    }


    public function destroy($id)
    {
        $banner = CoverImage::findOrFail($id);
        $banner->delete();

        return redirect()->route('admin.cover_image')->with('success', 'Cover Image deleted successfully.');
    }    
    
    
}