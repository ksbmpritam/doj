<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResturantWithdrawalRequest extends Model
{
    use HasFactory;
    
    protected $table = 'resturant_withdrawal_requests';
    
    protected $fillable = ['id', 'resturant_id', 'amount', 'image','status','date','created_at','updated_by'];

    public function resturant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    
}
