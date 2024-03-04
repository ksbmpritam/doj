<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'customer_id',
        'rating',
        'status',
    ];
    
    public function driver()
    {
        return $this->belongsTo(Restaurant::class, 'driver_id');
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}