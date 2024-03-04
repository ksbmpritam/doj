<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'category';

    protected $fillable = [
        'restaurants_id',
        'name',
        'description',
        'images',
        'status'
    ];
    
    public function foods()
    {
        return $this->hasMany(Foods::class);
    }
    
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class,'restaurants_id');
    }

}
