<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmocodeKilometerUser extends Model
{
    use HasFactory;
      protected $table = 'km_users_promo';
      
    
    protected $fillable = [
        'promo_code_kilometers_id',
        'user_id',
        'status',
        'accept_by',
        'cancel_reason',
        'accepted_reject_date',
       ];
         public function promo_code()
    {
        return $this->belongsTo(PrmoCodekilometer::class, 'promo_code_kilometers_id');
    }
    
    public function users()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }
}
