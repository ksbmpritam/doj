<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
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
        'address',
        'latitude',
        'longitude',
        'cover_image',
        // Add any other fields you have in the customers table
    ];
    
    public function cover_image(){
        return $this->belongsTo(CoverImage::class, 'cover_image', 'id');
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function orders_t()
    {
        return $this->hasMany(Order::class,'user_id');
    }
    
    public function wallet()
    {
        return $this->hasMany(WalletHistory::class,'customer_id');
    }
    
    
    
}
