<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCardAmounts extends Model
{
    use HasFactory;
     protected $table = 'gift_cart_amount';
    
    protected $fillable = [
        'amount',
        'status',
        ];
}