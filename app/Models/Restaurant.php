<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    
    protected $table = 'restaurant';
    
    protected $fillable = [
        'team_approvel',
        'approved_by',
        'approved_by_name',
        'approved_by_id',
        'team_id',
        'employee_id',
        'franchies_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'mobile_no',
        'profile_image',
        'fcm_token',
        'name',
        'category',
        'category_id',
        'phone',
        'address',
        'latitude',
        'longitude',
        'image',
        'description',
        'gallery',
        
        'charge_within_km', 
        'charges_per_km',
        'charges_km_min',
        'restaurant_status',
        'charge_km',
        'charges',
        'restaurants_admin',
        'enable_self_pickup_date',
        'enable_self_pickup_time',
        'self_pickup',
        'non_veg',
        'restaurants_admin_id',
        'charges_km_min',
        'services',
        'enable_dine',
        'dine_open_time',
        'dine_close_time',
        'dine_cost_price',
        'dine_image',
        'bank_name',
        'branch_name',
        'holder_name',
        'account_number',
        'ifsc_code',
        'other_information',
        'pan_card',
        'aadhar',
        'other_details',
        'permanent_address',
        'address_same',
        'communication_address',
        'approved_date',
        'cancel_reason'
        ];
        
    public function services()
    {
        return $this->hasMany(RestaurantService::class);
    }
    
    public function dineGallery()
    {
        return $this->hasMany(DineGallery::class,'resturant_id');
    }
    
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
    
    public function promoCodes() {
        return $this->hasMany(RestaurantPromo::class, 'restaurant_id');
    }
    
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'restaurant_id');
    }
}
