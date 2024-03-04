<?php

namespace App\Http\Controllers\Admin;

use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Order;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();
        return view('admin.voucher.index', compact('vouchers'));
    }
    
    public function create()
    {
        return view('admin.voucher.create');
    }
    
    public function insert(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'discount' => 'required',
        ]);
    
        $voucher = voucher::create([
            'amount' => $request->amount,
            'discount' => $request->discount,
            'status' => $request->status ?? 0,
        ]);
    
        return redirect()->route('admin.voucher')->with('success', 'voucher inserted successfully.');
    }

   
    
    public function edit($id)
    {
        $voucher = voucher::findOrFail($id);
        return view('admin.voucher.edit', compact('voucher'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'discount' => 'required',
        ]);
    
        $voucher = voucher::findOrFail($id);
        $voucher->amount = $request->amount;
        $voucher->discount = $request->discount;
        $voucher->status = $request->status;
        $voucher->save();
    
        return redirect()->route('admin.voucher')->with('success', 'voucher updated successfully.');
    }


    public function destroy($id)
    {
        $voucher = voucher::findOrFail($id);
        $voucher->delete();

        return redirect()->route('admin.voucher')->with('success', 'voucher deleted successfully.');
    }    
    
    
}