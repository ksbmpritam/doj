<?php
/**
 * File name: RestaurantController.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\GiftCards;
use App\Models\GiftCardImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class GiftCard extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
    {
        $gifts = GiftCards::all();
        return view("admin.giftCard.index",compact('gifts'));
    }
    
    public function create(){
        return view("admin.giftCard.create");
    }
    
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            // 'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $card = GiftCards::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0,
        ]);
        

        if (!$card->id) {
            return redirect()->back()->with('error', 'Error creating Gift Cards.')->withInput();
        }
    
        // Save gallery images if provided
        if ($request->hasFile('image_path')) {
            $image_paths = [];
    
            foreach ($request->file('image_path') as $image) {
                try {
                    $originalName = $image->getClientOriginalName();
                    $image_name = time() . '_' . str_replace(' ', '_', $originalName);
                    $image->move(public_path('images/giftImage'), $image_name);
                    $image_paths[] = $image_name;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error uploading one or more images.')->withInput();
                }
            }
    
            // Using a bulk insert for better performance
            $imagesToInsert = [];
            foreach ($image_paths as $image) {
                $imagesToInsert[] = [
                    'gift_cards_id' => $card->id,
                    'image_path' => $image,
                ];
            }
            GiftCardImage::insert($imagesToInsert);
        }
    
        return redirect()->route('admin.gift_card')->with('success', 'Restaurant added successfully.');
    }
    
    public function edit($id)
    {
        $gift = GiftCards::findOrFail($id);
        $galleryImages = GiftCardImage::where('gift_cards_id', $id)->get();
        return view('admin.giftCard.edit', compact('gift','galleryImages'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $card = GiftCards::findOrFail($id);
        $card->title = $request->title;
        $card->description = $request->description;
        $card->status = $request->has('status') ? 1 : 0;
        $card->save();
    
        // Update gallery images if provided
        if ($request->hasFile('image_path')) {
            $image_paths = [];
    
            foreach ($request->file('image_path') as $image) {
                try {
                    $originalName = $image->getClientOriginalName();
                    $image_name = time() . '_' . str_replace(' ', '_', $originalName);
                    $image->move(public_path('images/giftImage'), $image_name);
                    $image_paths[] = $image_name;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error uploading one or more images.')->withInput();
                }
            }
    
            // Unlink and delete old images associated with the gift card
            $existingImages = GiftCardImage::where('gift_cards_id', $id)->get();
            foreach ($existingImages as $existingImage) {
                $imagePath = public_path('images/giftImage') . '/' . $existingImage->image_path;
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Unlink (delete) the image file
                }
            }
    
            // Delete existing image records from the database
            GiftCardImage::where('gift_cards_id', $id)->delete();
    
            // Using a bulk insert for better performance
            $imagesToInsert = [];
            foreach ($image_paths as $image) {
                $imagesToInsert[] = [
                    'gift_cards_id' => $card->id,
                    'image_path' => $image,
                ];
            }
            GiftCardImage::insert($imagesToInsert);
        }
    
        return redirect()->route('admin.gift_card')->with('success', 'Restaurant updated successfully.');
    }

    public function delete($id)
    {
        $card = GiftCards::findOrFail($id);
    
        $images = GiftCardImage::where('gift_cards_id', $id)->get();
        foreach ($images as $image) {
            $imagePath = public_path('images/giftImage') . '/' . $image->image_path;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        GiftCardImage::where('gift_cards_id', $id)->delete();
    
        // Delete the gift card entry
        $card->delete();
    
        return redirect()->route('admin.gift_card')->with('success', 'Restaurant deleted successfully.');
    }

    
   

}