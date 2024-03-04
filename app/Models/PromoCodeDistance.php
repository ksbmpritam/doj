<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCodeDistance extends Model
{
    use HasFactory;
    
    protected $table = 'prom_distance';
    
    protected $fillable = [
        'promo_code_id',
        'distance_km',
        'discount_type_km',
        'value',
        
       ];
 
}