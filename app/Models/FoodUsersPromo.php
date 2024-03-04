<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodUsersPromo extends Model
{
    use HasFactory;
    
    protected $table = 'food_users_promo';
    
    protected $fillable = [
        'food_promocode_id',
        'user_id',
        'status',
        'accept_by',
        'cancel_reason',
        'accepted_reject_date',
       ];
       
    public function promo_code()
    {
        return $this->belongsTo(FoodPromoCodes::class, 'food_promocode_id');
    }
    
    public function users()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }
}