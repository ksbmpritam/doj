<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantService extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'service_name',
        // Add other fields as needed
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
