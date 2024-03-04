<?php

namespace App\Http\Controllers\Admin;

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
        return view("admin.coupons.index",compact('coupon'))->with('id',$id);;
    }
    
    

    public function create($id='')
    {
        $restaurant = Restaurant::all();
        return view('admin.coupons.create',compact('restaurant'))->with('id',$id);
    }
    
   
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'promo_code' => 'required|unique:coupons',
            'discount_type' => 'required|in:percentage,up_topercentage,amount,up_to_amount',
            'discount' => 'required|numeric|min:0',
            'start_date'=>'required',
            'expires_at' => 'required|date|after_or_equal:today',
            'restaurant_id' => 'required|exists:restaurants,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:on',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $status = $request->has('status') ? 1 : 0;
    
        $coupon_image = null; // Initialize the variable
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $coupon_image = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/coupons'), $coupon_image);
        }
    
        $coupon = Coupons::create([
            'code' => $request->code,
            'discount_type' => $request->discount_type,
            'discount' => $request->discount,
            'expire_at' => $request->expires_at,
            'restaurant_id' => $request->restaurant_id,
            'description' => $request->description,
            'image' => $coupon_image,
            'enabled' => $status,
        ]);
    
        return redirect()->route('admin.coupons')->with('success', 'Coupon inserted successfully.');
    }

    
    public function edit($id)
    {
        $coupon = Coupons::findOrFail($id);
        $restaurant = Restaurant::all();
        return view('admin.coupons.edit',compact('coupon','restaurant'))->with('id', $id);
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
         return redirect()->route('admin.coupons')->with('success', 'coupons updated successfully.');
        
        
    }

}


