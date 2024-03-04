<?php

namespace App\Http\Controllers\Admin;
use App\Models\Offers;
use App\Models\OfferCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class OfferController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {   
        
        $offers = Offers::all();
        return view('admin.offers.index',compact('offers'));
    }
    

    public function create()
    {
        $offer_category=OfferCategories::all();
        return view('admin.offers.create',compact('offer_category'));
    }
    

    public function insert(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'offer_images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $image = $request->file('offer_images');
        $offer = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/offer'), $offer);
    
        Offers::create([
            'type_id' => $request->type_id,
            'status' => $request->status,
            'image' => $offer,
        ]);
    
        return redirect()->route('admin.offer')->with('success', 'Offer inserted successfully.');
    }
    
    public function edit($id)
    {
        $offers = Offers::findOrFail($id);
         $offer_category = OfferCategories::all();
        return view('admin.offers.edit', compact('offers','offer_category'));
    }
    
   public function update(Request $request, $id)
    {
        $request->validate([
            'type_id' => 'required',
            'offer_images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $offer = Offers::findOrFail($id);
    
        $offer->type_id = $request->type_id;
    
        if ($request->hasFile('offer_images')) {
            $image = $request->file('offer_images');
            $newOfferImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/offer'), $newOfferImage);
            
            if ($offer->image) {
                $oldImagePath = public_path('images/offer/') . $offer->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $offer->image = $newOfferImage;
        }
    
        $offer->status = $request->status; 
        $offer->save();
    
        return redirect()->route('admin.offer')->with('success', 'Offer updated successfully.');
    }




    public function destroy($id)
    {
        $offer = Offers::findOrFail($id);
        $offer->delete();

        return redirect()->route('admin.offer')->with('success', 'Offer deleted successfully.');
    }

}


