<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodAttribute extends Model
{
    use HasFactory;
    
    protected $table = 'food_attribute';
    
    protected $fillable = [
        'name',
        'status',
       
       ];
}
