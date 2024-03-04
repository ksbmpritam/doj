<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodRestaurantPromo extends Model
{
    use HasFactory;
    
    protected $table = 'food_restaurant_promo';
    
    protected $fillable = [
        'food_promocode_id',
        'restaurant_id',
        'status',
        'accept_by',
        'cancel_reason',
        'accepted_reject_date',
       ];
       
    public function promo_code()
    {
        return $this->belongsTo(FoodPromoCodes::class, 'food_promocode_id');
    }
    
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}