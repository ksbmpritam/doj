<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\OfferCategories;
use Illuminate\Support\Facades\Validator;

class OfferCategory extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $offer_category = OfferCategories::orderBy('id', 'desc')->get();

        return view('admin.offer_category.index', compact('offer_category'));
    }
    
    public function create()
    {
        return view('admin.offer_category.create');
    }
    
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:offer_category,title',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $status = $request->has('status') ? 1 : 0;
    
        $offer_category = OfferCategories::create([
            'title' => $request->title,
            'status' => $status,
        ]);
        if ($offer_category) {
            return redirect()->route('admin.offer_category')->with('success', 'Offer Category inserted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to insert Offer Category. Please try again.')->withInput();
        }
    }


    public function edit($id)
    {
        $offer_category = OfferCategories::findOrFail($id);
        return view('admin.offer_category.edit', compact('offer_category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:offer_category,title,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $offer_category = OfferCategories::findOrFail($id);
        $offer_category->title = $request->title;
        $offer_category->status = $request->has('status') ? 1 : 0;
        $offer_category->save();
        return redirect()->route('admin.offer_category')->with('success', 'offer Category updated successfully.');
    }

    public function destroy($id)
    {
        $offer_category = OfferCategories::findOrFail($id);
        $offer_category->delete();

        return redirect()->route('admin.offer_category')->with('success', 'Offer Category deleted successfully.');
    }
}