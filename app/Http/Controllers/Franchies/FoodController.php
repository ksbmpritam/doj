<?php

namespace App\Http\Controllers\Franchies;
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
use Session;

class FoodController extends Controller
{
   
    public function index(Request $request)
    {
        
        $user = Session::get('user');
 
        if (!$user || empty($user->id)) {
            return redirect('/team');
        }
        
        $userId = Session::get('user')->id;
        
        $selectedCategory = $request->input('category');
        $restaur_fil = $request->input('restaurants');
        
        $categories = Category::all();
        $restaurants = Restaurant::where('team_id',$userId)->get();
        
        $foodsQuery = Foods::with(['category', 'restaurant'])->where('team_id',$userId)->orderBy('id', 'desc');
    
       
        if ($restaur_fil) {
            $foodsQuery->where('restaurant_id', $restaur_fil); 
        }
    
        if ($selectedCategory) {
            $foodsQuery->where('category_id', $selectedCategory);
        }
    
        $foods = $foodsQuery->get();
    
        return view('team.products.index', compact('foods', 'categories','restaurants', 'selectedCategory','restaur_fil'));
    }

    
    // public function index(Request $request)
    // {   
    //     $category = Category::all();
    //     $foods = Foods::with(['category', 'restaurant'])->orderBy('id', 'desc')->get();
    //     return view('team.products.index', compact('foods','category'));
    // }
    
    public function create($id= '')
    {
        $category = Category::all();
        $userId = Session::get('user')->id;
        $restaurant = Restaurant::where('team_id',$userId)->get();
        return view('team.products.create', compact('category','restaurant'))->with('id',$id);
    }
    
    public function insert(Request $request){
        $validation = Validator::make($request->all(), [
            'restaurant_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'category_id' => 'required',
            'item_quantity' => 'required',
            // 'food_attribute_id' => 'required',
            'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'required',
            // 'publish' => 'required',
            // 'non_veg' => 'required',
            // 'takeway_option' => 'required',
            'calories' => 'required',
            'grams' => 'required',
            'fats' => 'required',
            'proteins' => 'required',
           
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $user = Session::get('user');
 
        if (!$user || empty($user->id)) {
            return redirect('/team');
        }
        
        $userId = Session::get('user')->id;
     
        $data = [
            'team_id' => $userId,
            'restaurant_id' => $request->restaurant_id,
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
            'item_quantity' => $request->item_quantity,
            // 'food_attribute_id' => $request->food_attribute_id,
            'description' => $request->description,
            'publish' => $request->has('publish')? 1 : 0,
            'non_veg' => $request->non_veg,
            'takeway_option' => $request->takeway_option,
            'calories' => $request->calories,
            'grams' => $request->grams,
            'fats' => $request->fats,
            'proteins' => $request->proteins,
            'team_approvel' => 0,
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
    
        
        
         return redirect()->route('team.products')->with('success', 'foods insert successfully.');

    }
    
    public function insert_old(Request $request)
    {
        
        $image = $request->file('food_images');
            $foods_images = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/foods'), $foods_images);
            
        if($request->foods_publish == 'on')
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }
        
        $user = Session::get('user');
 
        if (!$user || empty($user->id)) {
            return redirect('/team');
        }
        
        $userId = Session::get('user')->id;  
        
        $foods = Foods::create([
            'team_id' => $userId,
            'name' => $request->foods_name,
            'price' => $request->foods_price,
            'discount' => $request->foods_discount,
            'restaurant' => $request->foods_restaurant,
            'category' => $request->foods_category,
            'item_quantity' => $request->item_quantity,
            'food_attribute' => $request->food_attribute,
            'images' => $foods_images,
            'description' => $request->foods_description,
            'publish' => $request->foods_publish,
            'non_veg' => $request->foods_nonveg,
            'takeway_option' => $request->foods_take_option,
            'calories' => $request->calories,
            'grams' => $request->grams,
            'fats' => $request->fats,
            'proteins' => $request->protenis,
            'addons_title' => $request->addons_title,
            'addons_price' => $request->addons_price,
            'food_lable' => $request->foods_lable,
            'food_value' => $request->foods_value,
            'status' => $status,
            ]);
      
       
            
        
        $foods->save();

       return redirect()->route('team.products')->with('success', 'foods insert successfully.');
    }

    
    public function edit($id)
    {
        $food = Foods::with(['category', 'restaurant', 'foodAddons', 'foodSpecifications'])->findOrFail($id);
        $categories = Category::all();
        $userId = Session::get('user')->id;
        
        $restaurants = Restaurant::where('team_id',$userId)->get();
        return view('team.products.edit', compact('food', 'categories', 'restaurants'));
    }

    
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'restaurant_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'category_id' => 'required',
            // 'item_quantity' => 'required',
            // 'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'required',
            // 'publish' => 'required',
            // 'non_veg' => 'required',
            // 'takeway_option' => 'required',
            // 'calories' => 'required',
            // 'grams' => 'required',
            // 'fats' => 'required',
            // 'proteins' => 'required',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $food = Foods::findOrFail($id);
        
        $user = Session::get('user');
 
        if (!$user || empty($user->id)) {
            return redirect('/team');
        }
        
        $userId = Session::get('user')->id;

        $data = [
            'team_id' => $userId,
            'restaurant_id' => $request->restaurant_id,
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
            'item_quantity' => $request->item_quantity,
            'food_attribute_id' => $request->food_attribute_id,
            'description' => $request->description,
            'publish' => $request->has('publish')?1:0,
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
    
      
       
        return redirect()->route('team.products')->with('success', 'Food updated successfully.');
    }


    public function destroy($id)
    {
        $banner = Foods::findOrFail($id);
        $banner->delete();

        return redirect()->route('team.products')->with('success', 'Foods deleted successfully.');
    }
    
    public function productList(Request $request,$id)
    {
        $team_id = $id;
        $selectedCategory = $request->input('category');
        $restaur_fil = $request->input('restaurants');
        
        $categories = Category::all();
        $restaurants = Restaurant::where('team_id',$id)->get();
        
        $foodsQuery = Foods::with(['category', 'restaurant'])->where('team_id',$id)->orderBy('id', 'desc');
    
        if ($restaur_fil) {
            $foodsQuery->where('restaurant_id', $restaur_fil); 
        }
    
        if ($selectedCategory) {
            $foodsQuery->where('category_id', $selectedCategory);
        }
    
        $foods = $foodsQuery->get();
    
        return view('franchies.team.detail.product_list', compact('foods', 'categories','restaurants', 'selectedCategory','restaur_fil','team_id'));
    }
    // product_detail
    public function productDetail($id)
    {
        $food = Foods::with(['category', 'restaurant', 'foodAddons', 'foodSpecifications'])->findOrFail($id);
        $categories = Category::all();
        $team_id = $food->team_id;
        
        $restaurants = Restaurant::where('team_id',$id)->get();
        return view('franchies.team.detail.product_detail', compact('food', 'categories', 'restaurants','team_id'));
    }
    
    public function approvalEdit($id){
        $team_id = $id;
        $product = Foods::findOrFail($id);
        return view('franchies.team.detail.update_product_status', compact('product','team_id'));
    }
    
    public function approvalUpdate($id, Request $request){
        $product = Foods::findOrFail($id);
    
        $newStatus = $request->input('team_approvel');
    
        $product->update(['team_approvel' => $newStatus]); 
    
        return redirect()->route('franchies.team.product', ['id' => $product->team_id])->with('success', 'Product status updated successfully.');
    }
}
