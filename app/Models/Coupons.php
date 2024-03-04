<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Coupons extends Model
{
    use HasFactory;
    
    protected $table = 'coupons';
    
    protected $fillable = [
        'code',
        'discount_type',
        'discount',
        'expire_at',
        'restaurant_id',
        'description',
        'image',
        'enabled',
        
        ];
}
