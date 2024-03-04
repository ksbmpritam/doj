<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Splash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class SplashController extends Controller
{
   public function index()
   {
       $splash = Splash::all();
       return view('app.splash.index', compact('splash'));
   }
   
    public function create()
    {
        return view('app.splash.create');
    }
    public function insert(Request $request)
    {
        if($request->status == 'on')
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }
        
        if($request->file('images'))
        {
            
            $image = $request->file('images');
                $images = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/splash'), $images);
            
            $data = Splash::create([
                'images' => $images,
                'status' => $status,
                ]);
      
        }
        else
        {
            $video = $request->file('video');
            $videos = time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('images/splash'), $videos);
            
            $data = Splash::create([
                'video' => $videos,
                'status' => $status,
                ]);
        }
            
        
        $data->save();

       return redirect()->route('splash.index')->with('success', 'Banner insert successfully.');
    }

    
    public function edit($id)
    {
        $banner = Splash::findOrFail($id);
        return view('app.splash.edit', compact('banner'));
    }
    public function update(Request $request, $id)
    {
        
        $banner = Splash::findOrFail($id);
        $banner->status = $request->status;
        
        

        if ($request->hasFile('banner_photo')) {
            $image = $request->file('banner_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/splash'), $imageName);
            $banner->banner_photo = $imageName;
        }

        $banner->save();

        return redirect()->route('app.splash.index')->with('success', 'Splash updated successfully.');
    }

    public function destroy($id)
    {
        $banner = Splash::findOrFail($id);
        $banner->delete();

        return redirect()->route('app.splash.index')->with('success', 'Splash deleted successfully.');
    }   
}
