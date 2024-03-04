<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
     protected $table = 'notification';
    
    protected $fillable = [
        'sender_id',
        'role',
        'title',
        'description',
        'status',
        ];
        
 
}