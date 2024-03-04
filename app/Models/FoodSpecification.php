<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodSpecification extends Model
{
    use HasFactory;
     protected $table = 'food_specification';
    
    protected $fillable = [
        'food_id',
        'label',
        'value',
       
       ];
       
    public function food()
    {
        return $this->belongsTo(Foods::class, 'food_id');
    }
}
