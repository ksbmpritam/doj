<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    
    protected $table = 'team';

     protected $fillable = [
        'name',
        'franchies_id',
        'zone_id',
        'employee_id',
        'department_id',
        'admin_approval',
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
        'role_type',
        'employee_role_id',
        'franchies_role_id',
        'password',
        'pwd',
        'add_zone',
        'add_restaurant',
        'add_rider',
        'add_order',
        'add_product',
    ];
    
    public function role()
    {
        return $this->belongsTo(Roles::class, 'employee_role_id');
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
  
}