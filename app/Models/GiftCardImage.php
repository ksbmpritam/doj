<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCardImage extends Model
{
    use HasFactory;
     protected $table = 'gift_card_images';
    
    protected $fillable = [
        'gift_cards_id',
        'image_path',
        ];
}