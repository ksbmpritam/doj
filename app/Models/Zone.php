<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'role_type',
        'name',
        'city_full_address',
        'city',
        'state',
        'city_latitude',
        'city_longitude',
        'zone_center_latitude',
        'zone_center_longitude',
        'map_polygon',
        'from_latitude',
        'from_longitude',
        'from_city',
        'from_state',
        'from_state_short',
        'from_pincode',
        'from_loc_transporter',
    ];


}
