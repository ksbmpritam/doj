<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersOffer extends Model
{
    use HasFactory;
    
    protected $table = 'users_offer';
    
    protected $fillable = [
        'restaurant_id',
        'day_of_week',
        'title',
        'status',
        'image',
        'opening_date',
        'opening_time',
        'closing_date',
        'closing_time',
        'discount_type',
        'discount',
       ];
}
