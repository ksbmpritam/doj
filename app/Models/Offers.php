<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    use HasFactory;
    
    protected $table = 'offers';

    protected $fillable = [
        'type',
        'type_id',
        'image',
        'status'
    ];
    


}