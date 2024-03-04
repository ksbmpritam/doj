<?php

namespace App\Http\Controllers\Restaurant;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{   

    
	public function index(Request $request)
    {
        
        $this->user = $request->session()->get('user');

        $categoriesQuery = Category::where('restaurants_id', $this->user->id); 
      
        $category = $categoriesQuery->withCount('foods')->orderBy('id', 'desc')->get();
        $totalFoodsCount = $category->sum('foods_count');
        
        return view('restaurant_admin.categories.index', compact('category', 'totalFoodsCount'));

    }
    
    public function create()
    {
        return view('restaurant_admin.categories.create');
    }
    
    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'categories_name' => 'required|string|max:255|unique:category,name',
            'descriptions' => 'required|string',
            'category_images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        
         $this->user = $request->session()->get('user');
         $restaurant_id = $this->user->id;
         
        if ($request->hasFile('category_images')) {
            $image = $request->file('category_images');
            $categoriesImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $categoriesImage);
        } else {
            return redirect()->back()->with('error', 'Image file missing.');
        }
    
        $categories = Category::create([
            'name' => $request->input('categories_name'),
            'restaurants_id' => $restaurant_id,
            'description' => $request->input('descriptions'),
            'images' => $categoriesImage,
            'status' => $request->input('status'),
        ]);
    
        return redirect()->route('restaurant.category')->with('success', 'Categories inserted successfully.');
    }
    
    
    // public function insert(Request $request)
    // {
       
    //     $validator = Validator::make($request->all(), [
    //         'categories_name' => 'required|unique:category,name',
    //         'descriptions' => 'required', 
    //         'category_images' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
        
    //      dd($request);
        
    //     $this->user = $request->session()->get('user');
    //     $restaurant_id = $this->user->id;
        
    //     if($request->category_images == null)
    //     {
    //         return redirect()->route('restaurant.category.create')->with('danger', 'Please Insert Image...');
    //     }else{
    //         $image = $request->file('category_images');
    //         $categories = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('images/categories'), $categories);
    //     }
        
    //     $category = Category::create([
    //         'name' => $request->categories_name,
    //         'description' => $request->descriptions,
    //         'images' => $categories,
    //         'restaurants_id' => $restaurant_id,
    //         'status' => $request->has('status') ? 1 : 0,
    //     ]);
        
    //     $category->save();
    
    //     return redirect()->route('restaurant.category')->with('success', 'Category inserted successfully.');
    // }


    
    public function edit($id)
    {
        $restaurant = Restaurant::all();
        $category = Category::findOrFail($id);
        return view('restaurant_admin.categories.edit', compact('category','restaurant'));
    }
    
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'categories_name' => 'required|string|max:255|unique:category,name,' . $id,
            'descriptions' => 'required|string',
            'category_images' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $category = Category::find($id);
    
        if (!$category) {
            return redirect()->route('restaurant.category.index')->with('error', 'Category not found.');
        }
    
        $category->name = $request->input('categories_name');
        $category->description = $request->input('descriptions');
        $category->status = $request->input('status');
    
        if ($request->hasFile('category_images')) {
            $image = $request->file('category_images');
            $categoriesImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $categoriesImage);
            $category->images = $categoriesImage;
        }
    
        $category->save();
    
        return redirect()->route('restaurant.category')->with('success', 'Category updated successfully.');
    }

 
    public function search(Request $request)
    {
        $this->user = $request->session()->get('user');
        $searchTerm = $request->input('search');
        
        $categoriesQuery = Category::where('restaurants_id', $this->user->id); 
        
        if ($searchTerm) {
            $categoriesQuery->where('name', 'like', $searchTerm . '%');
        }
        
        $category = $categoriesQuery->withCount('foods')
                                    ->orderBy('id', 'desc')
                                    ->get();
        
        $totalFoodsCount = $category->sum('foods_count');
    
        return view('restaurant_admin.categories.index', compact('category', 'totalFoodsCount'));
    }

    public function destroy($id)
    {
        $banner = Category::findOrFail($id);
        $banner->delete();

        return redirect()->route('restaurant.category')->with('success', 'Categories deleted successfully.');
    }

}


