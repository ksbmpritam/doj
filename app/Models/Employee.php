<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    
    protected $fillable = [
        'name',
        'email',
        'mobile_no',
        'permanent_address',
        'address_same',
        'communication_address',
        'image',
        'status',
        'aadhar_no',
        'pan_card_no',
        'referral_code',
        'role',
        'password',
        'pwd',
        'add_attandance',
        'add_department',
        'add_team',
        'add_zone',
        'manage_fsc',
        'zone_id',
    ];


}
