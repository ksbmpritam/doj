<?php

namespace App\Http\Controllers\API\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use App\Models\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class BannerController extends Controller
{
    public function get_banner()
    {
        $banners = Banner::all();
        
         $banners->transform(function ($banner) {
            $banner->banner_photo_url = asset('images/banner/' . $banner->banner_photo);
            return $banner;
        });
        
        return response()->json($banners, Response::HTTP_OK);    
    }
    
    
    public function get_app_video()
    {
        $banners = App::where('status', '1')->get();
    
        $banners->transform(function ($banner) {
            $banner->banner_photo_url = asset('images/splash/' . (!empty($banner->images) ? $banner->images : $banner->video));
            return $banner;
        });
    
        return response()->json($banners, Response::HTTP_OK);
    }


    
}