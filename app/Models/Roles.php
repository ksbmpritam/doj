<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    
    protected $table = 'roles';
    
    protected $fillable = [
        'title',
        'status',
        'slug',
        'employee_id',
        'franchies_id'
       ];
       public function role()
    {
        return $this->hasMany(Team::class);
    }
}