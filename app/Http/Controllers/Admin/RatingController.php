<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Customer;
use App\Models\Restaurant;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::with('customer','restaurant')->orderBy('created_at', 'desc')->get();
        // dd($ratings);
        return view('admin.rating.index', compact('ratings'));
    }
    
    public function create()
    {
        $customers = Customer::pluck('name', 'id');
        $restaurants = Restaurant::pluck('name', 'id');
        return view('admin.rating.create', compact('customers', 'restaurants'));
    }

    
    public function insert(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'restaurant_id' => 'required',
            'customer_id' => 'required',
            'value' => 'required',
        ]);
        
        
        $Rating = Rating::create([
            'restaurant_id' => $request->restaurant_id,
            'customer_id' => $request->customer_id,
            'value' => $request->value,
            'status' => $request->status,
        ]);
    
        return redirect()->route('admin.rating')->with('success', 'Rating inserted successfully.');
    }

   
    
    public function edit($id)
    {
        $rating = Rating::findOrFail($id);
        $customers = Customer::pluck('name', 'id');
        $restaurants = Restaurant::pluck('name', 'id');
        return view('admin.rating.edit', compact('rating', 'customers', 'restaurants'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'restaurant_id' => 'required',
            'customer_id' => 'required',
            'value' => 'required',
            // Remove 'order_id' if it's not required
        ]);
    
        $rating = Rating::findOrFail($id);
        $rating->restaurant_id = $request->restaurant_id;
        $rating->customer_id = $request->customer_id;
        $rating->value = $request->value;
        $rating->status = $request->status;
    
        $rating->save();
    
        return redirect()->route('admin.rating')->with('success', 'Rating updated successfully.');
    }



    public function destroy($id)
    {
        $Rating = Rating::findOrFail($id);
        $Rating->delete();

        return redirect()->route('admin.rating')->with('success', 'Rating deleted successfully.');
    }    
    
     
    public function invoice(){
     $Rating = Rating::with('restaurant', 'users', 'driver','Rating_items')->where('id',1)->first();
     return view('email_template.Rating_invoice', compact('Rating'));
    
    }
    
}