<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantDine extends Model
{
    use HasFactory;
    protected $table = 'restaurant_dine';
    
    protected $fillable = [
        'restaurant_id',
        'open_time',
        'close_time',
        'cost_price',
        'image',
       ];
}
