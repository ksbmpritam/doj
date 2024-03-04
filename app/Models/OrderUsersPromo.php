<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderUsersPromo extends Model
{
    use HasFactory;
    
    protected $table = 'order_users_promo';
    
    protected $fillable = [
        'order_wise_promocode_id',
        'user_id',
        'status',
        'accept_by',
        'cancel_reason',
        'accepted_reject_date',
       ];
       
    public function promo_code()
    {
        return $this->belongsTo(OrderWisePromoCodes::class, 'order_wise_promocode_id');
    }
    
    public function users()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }
}