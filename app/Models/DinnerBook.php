<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DinnerBook extends Model
{
    use HasFactory;
    
    protected $table = 'dinner_book';
    
    protected $fillable = [
        'restaurant_id',
        'customer_id',
        'booking_date',
        'booking_time',
        'number_of_guests',
        'total_amount',
        'status',
    ];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    
    public function users()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    
    public function relatedCustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
