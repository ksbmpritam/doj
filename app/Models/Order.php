<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $table = 'orders';
    
    protected $fillable = [
        'transactionId',
        'merchantId',
        'merchantTransactionId',
        'state',
        'responseCode',
        'type',
        'upiTransactionId',
        'accountType',
        'code',
        'payment_response',
        'team_id',
        'order_id',
        'restaurant_id',
        'user_id',
        'drivers_id',
        'date',
        'amount',
        'order_type',
        'keep_time',
        'order_status',
        'address',
        'latitude',
        'longitude',
        'food_id',
        'quantity',
        'foodName',
        'foodImage',
        'size',
        'payment_type',
        'driver_status',
        'cancle_driver',
        'qr_code_content',
        ];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
    
    public function users()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }
    
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'drivers_id');
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class,'order_id');
    }
    
    public function foodreviews()
    {
        return $this->hasMany(FoodRating::class,'order_id');
    }
    
    public function resturantreviews()
    {
        return $this->hasMany(Rating::class,'order_id');
    }
    
    public function order_items()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
  

}
