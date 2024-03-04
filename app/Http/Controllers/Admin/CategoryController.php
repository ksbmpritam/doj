<?php

namespace App\Http\Controllers\Admin;
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

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        // $categories = Category::withCount('foods')->orderBy('id', 'desc')->get();
        $categories = Category::with(['foods', 'restaurant'])->orderBy('id', 'desc')->get();
        
        $searchTerm = $request->input('search'); 
        
        return view('admin.categories.index', compact('categories', 'searchTerm'));
    }



    public function create()
    {
        $restaurant = Restaurant::all();
        return view('admin.categories.create',compact('restaurant'));
    }
    

    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'categories_name' => 'required|string|max:255',
            'restaurants_id' => 'required',
            'descriptions' => 'required|string',
            'category_images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        if ($request->hasFile('category_images')) {
            $image = $request->file('category_images');
            $categoriesImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $categoriesImage);
        } else {
            return redirect()->back()->with('error', 'Image file missing.');
        }
    
        $categories = Category::create([
            'name' => $request->input('categories_name'),
            'restaurants_id' => $request->input('restaurants_id'),
            'description' => $request->input('descriptions'),
            'images' => $categoriesImage,
            'homepage' => $request->input('show_in_homepage'),
            'status' => $request->input('status'),
        ]);
    
        return redirect()->route('admin.categories')->with('success', 'Categories inserted successfully.');
    }
    
    public function edit($id)
    {
        $restaurant = Restaurant::all();
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category','restaurant'));
    }
    
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'categories_name' => 'required|string|max:255',
            'restaurants_id' => 'required',
            'descriptions' => 'required|string',
            'category_images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $category = Category::find($id);
        
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }
    
        if ($request->hasFile('category_images')) {
            $image = $request->file('category_images');
            $categoriesImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $categoriesImage);
    
            // Delete old image file if exists
            if ($category->images && file_exists(public_path('images/categories/' . $category->images))) {
                unlink(public_path('images/categories/' . $category->images));
            }
    
            $category->images = $categoriesImage;
        }
    
        $category->name = $request->input('categories_name');
        $category->restaurants_id = $request->input('restaurants_id');
        $category->description = $request->input('descriptions');
        $category->homepage = $request->input('show_in_homepage');
        $category->status = $request->input('status');
        $category->save();
    
        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $banner = Category::findOrFail($id);
        $banner->delete();

        return redirect()->route('admin.categories')->with('success', 'Categories deleted successfully.');
    }

}


