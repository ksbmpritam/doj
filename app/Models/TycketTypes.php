<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TycketTypes extends Model
{
    use HasFactory;
    
    protected $table = 'ticket_type';
    
    protected $fillable = [
        'title',
        'status',
       
       ];
}