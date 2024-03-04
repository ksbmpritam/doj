<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UsersPromo;

class PromoCodes extends Model
{
    use HasFactory;
    
    protected $table = 'promo_code';
    
    protected $fillable = [
        'promo_code',
        'promo_code_name',
        'image',
        'minimum',
        'maximum',
        'coupon_type',
        'discount_type',
        'up_topercentage_price',
        'discount',
        'start_date',
        'end_date',
        'active_dates',
        'coupon_usage',
        'limited_usage',
        'res_percentage',
        'doj_percentage',
        'message',
        'status',
       ];
       
    public function restaurant_promos()
    {
        return $this->hasMany(RestaurantPromo::class, 'promo_code_id');
    }
    
    public function users_promo()
    {
       return $this->hasMany(UsersPromo::class, 'promo_code_id');
    }
 
}