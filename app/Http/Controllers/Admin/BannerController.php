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
use App\Models\Order;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
    }
    
    public function create()
    {
        return view('admin.banner.create');
    }
    
    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'banner_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed image types and size
        ]);
    
        $image = $request->file('banner_photo');
        $banners = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/banner'), $banners);
    
        $banner = Banner::create([
            'title' => $request->title,
            'status' => $request->status,
            'banner_photo' => $banners,
        ]);
    
        return redirect()->route('admin.banner')->with('success', 'Banner inserted successfully.');
    }

   
    
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'banner_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
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
    
        return redirect()->route('admin.banner')->with('success', 'Banner updated successfully.');
    }


    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->route('admin.banner')->with('success', 'Banner deleted successfully.');
    }    
    
     
    public function invoice(){
     $order = Order::with('restaurant', 'users', 'driver','order_items')->where('id',1)->first();
     return view('email_template.order_invoice', compact('order'));
    
    }
    
}
