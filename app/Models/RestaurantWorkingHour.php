<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantWorkingHour extends Model
{
    use HasFactory;
      
    protected $table = 'restaurant_working_hours';
    
    protected $fillable = ['restaurant_id', 'day_of_week', 'start_time', 'end_time'];

}
