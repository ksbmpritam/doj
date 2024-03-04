<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmoCodekilometer extends Model
{
    use HasFactory;
    protected $table = 'promo_code_kilometers';
        protected $fillable = [
        'promo_code',
         'promo_code_name',
        'image',
        'kilometter',
        'active_dates',
      
        'discount_type',
        'discount',
        'start_date',
        'end_date',
        'active_dates',
        'coupon_usage',
        'limited_usage',
        'res_percentage',
        'doj_percentage',
        'maximum',
        'minimum',
        'coupon_type',
        	
        'status',
        
        'message'
       
       ];
       
    public function restaurantPromoCodes()
    {
        return $this->hasMany(PrmocodeKilometerRestaurant::class, 'promo_code_kilometers_id');
    }

}
