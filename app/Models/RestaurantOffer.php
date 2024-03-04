<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantOffer extends Model
{
    use HasFactory;
    
    protected $table = 'restaurant_offer';
    
    protected $fillable = [
        'restaurant_id',
        'day_of_week',
        'opening_time',
        'closing_time',
        'discount',
        'discount_sign',
        'discount_type',
       ];
}
