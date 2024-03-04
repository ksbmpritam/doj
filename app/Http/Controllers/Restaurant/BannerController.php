<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('banner.index', compact('banners'));
    }
    public function banner_create()
    {
        return view('banner.create');
    }
    public function insert(Request $request)
    {
        
        $image = $request->file('banner_photo');
            $banners = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/banner'), $banners);
        
        $banner = Banner::create([
            'title' => $request->title,
            'status' => $request->status,
            'banner_photo' => $banners,
            ]);
      
       
            
        
        $banner->save();

       return redirect()->route('banner.index')->with('success', 'Banner insert successfully.');
    }

    
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('banner.edit', compact('banner'));
    }
    public function update(Request $request, $id)
    {
        
        $banner = Banner::findOrFail($id);
        $banner->title = $request->title;
        $banner->status = $request->status;

        if ($request->hasFile('banner_photo')) {
            $image = $request->file('banner_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/banner'), $imageName);
            $banner->banner_photo = $imageName;
        }

        $banner->save();

        return redirect()->route('banner.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->route('banner.index')->with('success', 'Banner deleted successfully.');
    }    
    
}
