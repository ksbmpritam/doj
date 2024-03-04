<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    use HasFactory;
    
    protected $table = 'sliders';

    protected $fillable = [
        'type',
        'type_id',
        'image',
        'status'
    ];
    


}