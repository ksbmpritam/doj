<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWithdrawalRequest extends Model
{
    use HasFactory;
    
    protected $table = 'user_withdrawal_requests';
    
    protected $fillable = ['id', 'customer_id', 'amount', 'image','status','date','created_at','updated_by'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
