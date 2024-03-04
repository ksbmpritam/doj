<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DineGallery extends Model
{
    use HasFactory;
     protected $table = 'dine_gallery';
    
    protected $fillable = [
        'resturant_id',
        'dine_images',
        ];
        
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}