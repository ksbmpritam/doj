<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    use HasFactory;
    
    protected $table = 'foods';
    
    protected $fillable = [
        'team_approvel',
        'name',
        'price',
        'discount',
        'restaurant_id',
        'category_id',
        'item_quantity',
        'food_attribute_id',
        'images',
        'description',
        'publish',
        'non_veg',
        'takeway_option',
        'calories',
        'grams',
        'fats',
        'proteins',
        'addons_title',
        'addons_price',
        'food_lable',
        'food_value',
        'status',
        'team_id',
        'employee_id',
        'franchies_id',
        ];
        
        
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function foodAttribute()
    {
        return $this->belongsTo(FoodAttribute::class, 'food_attribute_id');
    }
    
    public function foodAddons()
    {
        return $this->hasMany(FoodAddons::class, 'food_id');
    }

    public function foodSpecifications()
    {
        return $this->hasMany(FoodSpecification::class, 'food_id');
    }
    public function foods()
    {
        return $this->hasMany(FoodAddons::class,'food_id');
    }
    
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
