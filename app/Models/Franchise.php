<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    use HasFactory;

    protected $table = 'franchises';
    
    protected $fillable = [
        'department_id',
        'franchies_name',
        'franchies_tag_line',
        'franchies_permanent_address',
        'franchies_same',
        'franchies_communication_address',
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
        'zone_id',
    ];
    
 
}
