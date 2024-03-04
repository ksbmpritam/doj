<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmocodeKilometerRestaurant extends Model
{
    use HasFactory;
    
    protected $table = 'km_restaurant_promo';
    
    protected $fillable = [
        'promo_code_kilometers_id',
        'restaurant_id',
        'accept_by',
        'cancel_reason',
        'accepted_reject_date',
        'status',
    ];

    public function promoCode()
    {
        return $this->belongsTo(PrmoCodekilometer::class, 'promo_code_kilometers_id');
    }


    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
