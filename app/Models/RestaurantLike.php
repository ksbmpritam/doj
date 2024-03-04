<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantLike extends Model
{
    use HasFactory;
    
    protected $table = 'restaurant_like';
    
    protected $fillable = [
        'customer_id',
        'restaurant_id',
        'status',
       ];
       
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}