<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsOffers extends Model
{
    use HasFactory;
    
    protected $table = 'products_offer';

    protected $fillable = [
        'title',
        'discount',
        'status'
    ];
    


}