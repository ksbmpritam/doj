<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderCategories extends Model
{
    use HasFactory;
    
    protected $table = 'slider_category';
    
    protected $fillable = [
        'title',
        'status',
       
       ];
}