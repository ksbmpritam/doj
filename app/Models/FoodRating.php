<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodRating extends Model
{
    use HasFactory;
    protected $table = 'food_rating';

    protected $fillable = [
        'food_id',
        'customer_id',
        'value',
        'order_id',
        'status',
    ];
}