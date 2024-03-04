<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpWithUs extends Model
{
    use HasFactory;

    protected $table = 'helpWithUs';

    protected $fillable = [
        'user_id',
        'help_us',
        'name',
        'email',
        'mobile_no',
        'message',
    ];

    public $timestamps = true;

}
