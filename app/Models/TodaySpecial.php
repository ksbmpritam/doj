<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodaySpecial extends Model
{
    use HasFactory;
    
    protected $table = 'today_special';

    protected $fillable = [
        'title',
        'food_id',
        'status',
        'created_date'
    ];
    
   public function foods()
    {
        return $this->belongsToMany(Foods::class);
    }

}