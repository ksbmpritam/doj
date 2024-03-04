<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class RestaurantAdmin extends Model
{
    use HasApiTokens, HasFactory;

    
    protected $table = 'restaurant_admin';
    
    protected $fillable = [
        'team_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'image',
        'aadhar_image',
        'pancard_image',
        'status',
        'fcm_token',
        'pan_card',
        'aadhar',
        'other_details',
        'permanent_address',
        'address_same',
        'communication_address'
        ];
        
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
