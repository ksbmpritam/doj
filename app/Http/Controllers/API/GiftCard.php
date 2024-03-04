<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\GiftCards;
use App\Models\GiftCardImage;
use App\Models\GiftCardAmounts;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class GiftCard extends Controller
{
    public function get_gift()
    {
        $gifts = GiftCards::with('images')->where('status',1)->get();
        $gifts_amount = GiftCardAmounts::where('status',1)->get();
        $baseImageUrl = asset('images/giftImage/');
        
       
         $gifts->transform(function ($gift) use ($baseImageUrl) {
            $gift->images->transform(function ($image) use ($baseImageUrl) {
                $image->image_path = $baseImageUrl . '/' . $image->image_path;
                return $image;
            });
            return $gift;
        });

        $data=[
            'gift_cart'=>$gifts,
            'amount'=>$gifts_amount,
            ];
        return response()->json(['data'=>$data,'status'=>true], Response::HTTP_OK);    
    }
}