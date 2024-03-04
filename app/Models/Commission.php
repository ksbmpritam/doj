<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    
    protected $table = 'commissions';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'title','restaurant_id','commission_price','status','created_at','updated_at'  
    ];
    
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
