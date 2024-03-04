<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCardPurchase extends Model
{
    use HasFactory;
    protected $table = 'gift_cards_purchase';

    protected $fillable = ['card_code', 'card_value', 'expiration_date','cutoff_type','cutoff_value','date_issued','date_redeemed','customer_id','image_id','recipient_name','recipient_email','message','is_redeemed','redeemed_order_id','is_active','transactionId'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
