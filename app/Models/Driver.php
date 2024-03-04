<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    
    protected $table = 'driver';
    
    protected $fillable = [
        'team_approvel',
        'team_id',
        'employee_id',
        'franchies_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'father_name',
        'pancart_image',
        'pan_card_no',
        'aadhar_verification_status',
        'aadhar_image',
        'aadhar_no',
        'work_area',
        'vehicle',
        'language',
        'fcm_token',
        'address',
        'state',
        'city',
        'pincode',
        'latitude',
        'longitude',
        'profile_image',
        'order_transaction',
        'order_total',
        'wallet_history',
        'wallet',
        'bank_name',
        'branch_name',
        'holder_name',
        'account_number',
        'ifsc_code',
        'other_information',
        'avaiable',
        'car_number',
        'car_name',
        'car_image',
        'status',
        'available',
        'is_login',
    ];
    
    public function order()
    {
        return $this->hasMany(Order::class,'drivers_id');
    }
    
     
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
