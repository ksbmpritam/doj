<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantPromo extends Model
{
    use HasFactory;
    
    protected $table = 'restaurant_promo';
    
    protected $fillable = [
        'promo_code_id',
        'restaurant_id',
        'status',
        'accept_by',
        'cancel_reason',
        'accepted_reject_date',
       ];
       
    public function promo_code()
    {
        return $this->belongsTo(PromoCodes::class, 'promo_code_id');
    }
    
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}