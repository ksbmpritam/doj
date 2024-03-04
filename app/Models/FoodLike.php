<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodLike extends Model
{
    use HasFactory;
    
    protected $table = 'food_likes';
    
    protected $fillable = [
        'customer_id',
        'food_id',
        'status',
    ];
    
    public function food()
    {
        return $this->belongsTo(Foods::class,'food_id');
    }
}