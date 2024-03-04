<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Foods;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function get_category()
    {
        $categories = Category::where('status',1)->get();
        $categories->transform(function ($category) {
            $category->category_photo_url = asset('images/categories/' . $category->images);
            return $category;
        });

        return response()->json($categories, Response::HTTP_OK);
    }
    
    public function get_subcategory()
    {
        $subCategories = Foods::join('category', 'foods.category_id', '=', 'category.id')
            ->where('foods.status', 1)
            ->select('foods.*', 'category.name as category_name')
            ->get();
    
        $subCategories->transform(function ($subCategory) {
            $subCategory->sub_category_photo_url = asset('images/foods/' . $subCategory->images);
            return $subCategory;
        });
    
        return response()->json($subCategories, Response::HTTP_OK);
    }

}
