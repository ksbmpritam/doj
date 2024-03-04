<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'custom_reviews';
    
    protected $fillable = ['product_id', 'order_id', 'customer_id', 'product_rating','comment','driver_id','driver_rating'];

    public function product()
    {
        return $this->belongsTo(Foods::class);
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    
    public function user()
    {
        return $this->belongsTo(Customer::class);
    }
}
