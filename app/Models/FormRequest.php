<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRequest extends Model
{
    use HasFactory;
    
    protected $table = 'form_requests';

    protected $fillable = [
        'title',
        'user_id',
        'description',
        'status',
        'role_type',
    ];
}