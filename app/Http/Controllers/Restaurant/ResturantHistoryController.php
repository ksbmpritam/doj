<?php

namespace App\Http\Controllers\Restaurant;

use App\Models\ResturantWithdrawalRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Restaurant;

class ResturantHistoryController extends Controller
{

	public function index(Request $request)
    {
        $this->user = $request->session()->get('user');
        $restaurant = ResturantWithdrawalRequest::with('resturant')->where('resturant_id',$this->user->id)->get();
        // dd($restaurant);
        return view("restaurant_admin.restaurant_request.index",compact('restaurant'));
    }
    
}
