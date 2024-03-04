<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAmount extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'gender',
        'dob',
        'fcm_token',
        'profile_image',
        'facebook_id',
        'google_id',
        'status',
        'add_wallet',
        'total_wallet',
        'transactionId',
        // Add any other fields you have in the customers table
    ];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}