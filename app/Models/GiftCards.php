<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCards extends Model
{
    use HasFactory;
     protected $table = 'gift_cards';
    
    protected $fillable = [
        'title',
        'description',
        'status',
        ];
        
    public function images()
    {
        return $this->hasMany(GiftCardImage::class, 'gift_cards_id');
    }
}