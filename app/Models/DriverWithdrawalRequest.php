<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverWithdrawalRequest extends Model
{
    use HasFactory;
    
    protected $table = 'driver_withdrawal_requests';
    
    protected $fillable = ['id', 'driver_id', 'amount', 'image','status','date','created_at','updated_by'];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}