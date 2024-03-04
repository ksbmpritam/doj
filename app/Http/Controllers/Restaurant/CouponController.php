<?php

namespace App\Http\Controllers;

use App\Models\Coupons;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class CouponController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
     public function index($id='')
    {
        $coupon = Coupons::all();
        return view("coupons.index",compact('coupon'))->with('id',$id);;
    }
    
    

    public function create($id='')
    {
        $restaurant = Restaurant::all();
        return view('coupons.create',compact('restaurant'))->with('id',$id);
    }
    public function insert(Request $request)
    {
         $image = $request->file('image');
            $coupon_images = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/coupons'), $coupon_images);
            
        if($request->status == 'on')
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }
        
        
        $coupons = Coupons::create([
            'code' => $request->code,
            'discount_type' => $request->discount_type,
            'discount' => $request->discount,
            'expire_at' => $request->expires_at,
            'restaurant_id' => $request->restaurant_id,
            'description' => $request->description,
            'image' => $coupon_images,
            'enabled' => $status,
            
            ]);
      
       
            
        
        $coupons->save();

       return redirect()->route('coupons')->with('success', 'coupons insert successfully.');
    }
    
    public function edit($id)
    {
        $coupon = Coupons::findOrFail($id);
        $restaurant = Restaurant::all();
        return view('coupons.edit',compact('coupon','restaurant'))->with('id', $id);
    }
    
    public function update(Request $request, $id)
    {
         $coupon = Coupons::findOrFail($id);
         
        if($request->status == 'on')
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }
        
       
        $coupon->code = $request->code;
        $coupon->discount_type =  $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->expire_at = $request->expire_at;
        $coupon->restaurant_id = $request->restaurant_id;
        $coupon->enabled = $status;
        
        if($request->image)
        {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/coupons'), $imageName);
            $coupon->image = $imageName;
        }
        
        $coupon->save();
         return redirect()->route('coupons')->with('success', 'coupons updated successfully.');
        
        
    }

}


