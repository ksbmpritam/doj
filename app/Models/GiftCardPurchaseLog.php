<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCardPurchaseLog extends Model
{
    use HasFactory;
    protected $table = 'gift_card_purchase_logs';

    protected $fillable = ['gift_card_purchase_id', 'data','customer_id'];

   
}