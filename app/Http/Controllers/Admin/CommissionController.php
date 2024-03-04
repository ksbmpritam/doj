<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Commission;
use App\Models\Restaurant;

class CommissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $commission = Commission::with('restaurant')->orderBy('id', 'desc')->get();
        return view('admin.commission.index', compact('commission'));
    }
    
    // public function create()
    // {
    //     return view('admin.commission.create');
    // }
    public function create()
    {
        $restaurants = Restaurant::all(); // Replace 'wher' with 'all' or any other condition you need
        return view('admin.commission.create', compact('restaurants'));
    }

    
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'restaurant_id' => 'required',
            'commission_price' => 'required',
            // 'status' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $status = $request->has('status') ? 1 : 0;
    
        $title = Commission::create([
            'title' => $request->title,
            'restaurant_id' => $request->restaurant_id,
            'commission_price' => $request->commission_price,
            'status' => $status,
        ]);
        
        if ($title) {
            return redirect()->route('admin.commission')->with('success', 'commission inserted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to insert commission. Please try again.')->withInput();
        }
    }


    public function edit($id)
    {
        $commission = Commission::with('restaurant')->findOrFail($id);
        $restaurants = Restaurant::all();
        return view('admin.commission.edit', compact('commission','restaurants'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'restaurant_id' => 'required',
            'commission_price' => 'required',
            // 'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $commission = Commission::findOrFail($id);
        $commission->title = $request->title;
        $commission->restaurant_id = $request->restaurant_id;
        $commission->commission_price = $request->commission_price;
        $commission->status = $request->has('status') ? 1 : 0;
        $commission->save();
        return redirect()->route('admin.commission')->with('success', 'commission updated successfully.');
    }

    public function destory($id)
    {
        $commission = Commission::findOrFail($id);
        $commission->delete();

        return redirect()->route('admin.commission')->with('success', 'commission deleted successfully.');
    }
}
