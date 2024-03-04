<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferCategories extends Model
{
    use HasFactory;
    
    protected $table = 'offer_category';
    
    protected $fillable = [
        'title',
        'status',
       
       ];
}