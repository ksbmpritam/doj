<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\GiftCardAmounts;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class GiftCardAmount extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
    {
        $gifts = GiftCardAmounts::orderBy('id', 'desc')->get();
        return view("admin.giftCardAmount.index",compact('gifts'));
    }
    
    public function create(){
        return view("admin.giftCardAmount.create");
    }
    
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $card = GiftCardAmounts::create([
            'amount' => $request->amount,
            'status' => $request->has('status') ? 1 : 0,
        ]);
        
        return redirect()->route('admin.gift_card_amount')->with('success', 'Gift Cart added successfully.');
    }
    
    public function edit($id)
    {
        $gift = GiftCardAmounts::findOrFail($id);
        return view('admin.giftCardAmount.edit', compact('gift'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $card = GiftCardAmounts::findOrFail($id);
        $card->amount = $request->amount;
        $card->status = $request->has('status') ? 1 : 0;
        $card->save();
    
        return redirect()->route('admin.gift_card_amount')->with('success', 'Gift Cart updated successfully.');
    }

    public function delete($id)
    {
        $card = GiftCardAmounts::findOrFail($id);
    
        $card->delete();
    
        return redirect()->route('admin.gift_card_amount')->with('success', 'Gift Cart  deleted successfully.');
    }

    
   

}