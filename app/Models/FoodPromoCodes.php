<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodPromoCodes extends Model
{
    use HasFactory;
    
    protected $table = 'food_promocode';
    
    protected $fillable = [
        'promo_code_name',
        'promo_code',
        'image',
        'discount_type',
        'discount',
        'start_date',
        'end_date',
        'coupon_usage',
        'limited_usage',
        'res_percentage',
        'doj_percentage',
        'max_price',
        'min_price',
        'coupon_type',
        'message',
        'status',
       
       ];
       
    public function restaurant_promos()
    {
        return $this->hasMany(RestaurantPromo::class, 'promo_code_id');
    }
 
}