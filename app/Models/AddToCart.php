<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddToCart extends Model
{
    use HasFactory;
    
    protected $table = 'add_cart';

    protected $fillable = ['user_id','type','restaurant_id' ,'food_id', 'foodName','foodImage','quantity','price','discount','size'];

    public function food()
    {
        return $this->belongsTo(Foods::class);
    }
    
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

}
