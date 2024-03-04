<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PromoCodes;

class UsersPromo extends Model
{
    use HasFactory;
    
    protected $table = 'users_promo';
    
    protected $fillable = [
        'promo_code_id',
        'user_id',
        'status',
        'count_used'
       ];
       
      public function promo_code()
    {
        return $this->belongsTo(PromoCodes::class, 'promo_code_id');
    }
}