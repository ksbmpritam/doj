<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    
    protected $table = 'order_item'; 
    
    protected $fillable = [
        'order_id',
        'restaurant_id',
        'user_id',
        'drivers_id',
        'date',
        'amount',
        'order_type',
        'order_status',
        'address',
        'latitude',
        'longitute',
        'food_id',
        'quantity',
        'foodName',
        'foodImage',
        'size',
        'payment_type',
        ];
    
    public function food()
    {
        return $this->belongsTo(Foods::class);
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }


}
