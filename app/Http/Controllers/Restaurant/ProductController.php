<?php

namespace App\Http\Controllers\Restaurant;
use App\Models\Foods;
use App\Models\Category;
use App\Models\FoodAddons;
use App\Models\FoodSpecification;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
 
    public function index(Request $request)
    {
        $this->user = $request->session()->get('user');
        $products = Foods::with(['category', 'restaurant'])->where('restaurant_id',$this->user->id)->orderBy('id', 'desc')->get();
        return view('restaurant_admin.products.index', compact('products'));
    }
    
    // public function create($id= '',Request $request)
    // {
    //     $this->user = $request->session()->get('user');
    //     $category = Category::where('restaurants_id', $this->user->id)->orWhere('restaurants_id', 0)->where('status', 1)->get();
        
    //     $restaurant = Restaurant::all();
    //     return view('restaurant_admin.products.create', compact('category','restaurant'))->with('id',$id);
    // }
    public function create(Request $request)
    {
        $this->user = $request->session()->get('user');
        $category = Category::where('restaurants_id', $this->user->id)->where('status', 1)->get();
        
        $restaurant = Restaurant::all();
        return view('restaurant_admin.products.create', compact('category','restaurant'));
    }
    
    public function insert(Request $request){
        
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'category_id' => 'required',
            'item_quantity' => 'required',
            'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'required',
            'calories' => 'required',
            'grams' => 'required',
            'fats' => 'required',
            'proteins' => 'required',
           
        ]);
        
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
       
        $this->user = $request->session()->get('user');

        $ab = Restaurant::where('id', $this->user->id)->first();
        $data = [
            'restaurant_id' =>$ab->id,
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
            'item_quantity' => $request->item_quantity,
            'description' => $request->description,
            'publish' => $request->publish,
            'non_veg' => $request->non_veg,
            'takeway_option' => $request->takeway_option,
            'calories' => $request->calories,
            'grams' => $request->grams,
            'fats' => $request->fats,
            'proteins' => $request->proteins,
        ];
        
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/foods'), $imageName);
            $data['images'] = $imageName;
           
        }
        
        $food = Foods::create($data);
      

         // Update food Addons
            if ($request->has('addons_title') && $request->has('addons_price')) {
                $addons_titles = $request->addons_title;
                $addons_prices = $request->addons_price;
        
                FoodAddons::where('food_id', $food->id)->delete();
        
                foreach ($addons_titles as $index => $title) {
                    $price = $addons_prices[$index];
                    FoodAddons::create([
                        'food_id' => $food->id,
                        'title' => $title,
                        'price' => $price,
                    ]);
                }
            }
        
            // Update food specifications
            if ($request->has('specifications_label') && $request->has('specifications_value')) {
                $specifications_labels = $request->specifications_label;
                $specifications_values = $request->specifications_value;
        
                FoodSpecification::where('food_id', $food->id)->delete();
        
                foreach ($specifications_labels as $index => $label) {
                    $value = $specifications_values[$index];
                    FoodSpecification::create([
                        'food_id' => $food->id,
                        'label' => $label,
                        'value' => $value,
                    ]);
                }
            }
    
         return redirect()->route('restaurant.products')->with('success', 'products insert successfully.');

    }
    
   
    public function edit($id,Request $request)
    {
        $this->user = $request->session()->get('user');
        $categories = Category::where('restaurants_id', $this->user->id)->where('status', 1)->get();
        $food = Foods::with(['category', 'restaurant', 'foodAddons', 'foodSpecifications'])->findOrFail($id);
        $restaurants = Restaurant::all();
        return view('restaurant_admin.products.edit', compact('food', 'categories', 'restaurants'));
    }

    
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'category_id' => 'required',
            'item_quantity' => 'required',
            'description' => 'required',
           
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $food = Foods::findOrFail($id);
        
        $this->user = $request->session()->get('user');
        
        $ab = Restaurant::where('id', $this->user->id)->first();

        $data = [
            'restaurant_id' => $ab->id,
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
            'item_quantity' => $request->item_quantity,
            'food_attribute_id' => $request->food_attribute_id,
            'description' => $request->description,
            'publish' => $request->publish,
            'non_veg' => $request->non_veg,
            'takeway_option' => $request->takeway_option,
            'calories' => $request->calories,
            'grams' => $request->grams,
            'fats' => $request->fats,
            'proteins' => $request->proteins,
        ];
        
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/foods'), $imageName);
            
             if ($ab->images && file_exists(public_path('images/foods' . $ab->images))) {
                unlink(public_path('images/foods' . $ab->images));
            }
            
            $data['images'] = $imageName;
        }
    
        $food->update($data);
        
        // Update food Addons
        if ($request->has('addons_title') && $request->has('addons_price')) {
            $addons_titles = $request->addons_title;
            $addons_prices = $request->addons_price;
    
            FoodAddons::where('food_id', $food->id)->delete();
    
            foreach ($addons_titles as $index => $title) {
                $price = $addons_prices[$index];
                FoodAddons::create([
                    'food_id' => $food->id,
                    'title' => $title,
                    'price' => $price,
                ]);
            }
        }
    
        // Update food specifications
        if ($request->has('specifications_label') && $request->has('specifications_value')) {
            $specifications_labels = $request->specifications_label;
            $specifications_values = $request->specifications_value;
    
            FoodSpecification::where('food_id', $food->id)->delete();
    
            foreach ($specifications_labels as $index => $label) {
                $value = $specifications_values[$index];
                FoodSpecification::create([
                    'food_id' => $food->id,
                    'label' => $label,
                    'value' => $value,
                ]);
            }
        }
    
      
       
        return redirect()->route('restaurant.products')->with('success', 'Food updated successfully.');
    }
    
    public function search(Request $request)
    {
        $this->user = $request->session()->get('user');
        $searchTerm = $request->input('search');
        
        
        $selectedSearch = $request->input('selected_search'); 
        
        $categoriesQuery = Foods::with(['category', 'restaurant'])
                                ->where('restaurant_id', $this->user->id)
                                ->orderBy('id', 'desc');
        
        if ($searchTerm) {
            if ($selectedSearch === 'name') {
                $categoriesQuery->where('name', 'like', $searchTerm . '%');
            } elseif ($selectedSearch === 'restaurant') {
                $categoriesQuery->whereHas('restaurant', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', $searchTerm . '%');
                });
            } elseif ($selectedSearch === 'category') {
                    $categoriesQuery->whereHas('category', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', $searchTerm . '%');
                    });

            }
        }
        
        $products = $categoriesQuery->withCount('foods')
                                    ->orderBy('id', 'desc')
                                    ->get();
        
        $totalFoodsCount = $products->sum('foods_count');
        
        return view('restaurant_admin.products.index', compact('products', 'totalFoodsCount'));
    }


    public function destroy($id)
    {
        $banner = Foods::findOrFail($id);
        $banner->delete();

        return redirect()->route('restaurant.products')->with('success', 'Foods deleted successfully.');
    }

}
