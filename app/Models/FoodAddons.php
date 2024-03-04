<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodAddons extends Model
{
    use HasFactory;
    protected $table = 'food_addons';
    
    protected $fillable = [
        'food_id',
        'title',
        'price',
       ];
       
    public function food()
    {
        return $this->belongsTo(Foods::class, 'food_id');
    }

}
