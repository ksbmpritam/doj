<?php

namespace App\Http\Controllers\Admin;
use App\Models\FoodPromoCodes;
use App\Models\FoodUsersPromo;
use App\Models\Restaurant;
use App\Models\FoodRestaurantPromo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Customer;
use Illuminate\Validation\Rule;
use App\Models\Order;
use App\Models\Foods;
use App\Models\FoodProductPromo;
class FoodPromoCode extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $FoodPromoCodes = FoodPromoCodes::orderBy('id', 'desc')->get();
        return view('admin.food_promocode.index',compact('FoodPromoCodes'));
    }
    

    public function create()
    {
        return view('admin.food_promocode.create');
    }
    

    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'promo_code_name' => 'required|string|max:255',
            'promo_images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            'discount_type' => 'required',
            'discount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'date|after:start_date',
            'max_price' => 'required',
            'min_price' => 'required',
            'coupon_type' => 'required',
            'doj_percentage' => 'required',
            'res_percentage' => 'required',
            'coupon_usage' => 'required',
            'limited_usage' => ($request->input('coupon_usage') == 'limited') ? 'required' : '',
            'message' => 'required|string',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $promoImage = null; 
    
        if ($request->hasFile('promo_images')) {
            $image = $request->file('promo_images');
            $promoImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/promo'), $promoImage);
        }
         
        $promo_code = $this->generateUniquePromoCode();
        
        $promo = FoodPromoCodes::create([
            'promo_code_name' => $request->input('promo_code_name'),
            'promo_code' => $promo_code,
            'image' => $promoImage, 
            'discount_type' => $request->input('discount_type'),
            'discount' => $request->input('discount'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'coupon_usage' => $request->input('coupon_usage'),
            'limited_usage' => ($request->input('coupon_usage') == 'limited') ? $request->input('limited_usage') : "",
            'res_percentage' => $request->input('res_percentage'),
            'doj_percentage' => $request->input('doj_percentage'),
            'max_price' => $request->input('max_price'),
            'min_price' => $request->input('min_price'),
            'coupon_type' => $request->input('coupon_type'),
            'message' => $request->input('message'),
            'status' => $request->input('status') ? 1 : 0,
        ]);
    
        if ($promo->id) {
            return redirect()->route('admin.foodpromoCode')->with('success', 'Promo code inserted successfully.');
        }
        
        return redirect()->route('admin.foodpromoCode')->with('error', 'Something Wants to Wrong.');
    }


    
    public function edit($id)
    {
       $promo_code = FoodPromoCodes::findOrFail($id);
       return view('admin.food_promocode.edit', compact('promo_code'));
    }
    

    
    public function update(Request $request, $id)
    {
        $promo_code = FoodPromoCodes::find($id);
    
        if (!$promo_code) {
            return redirect()->back()->with('error', 'Promo code not found.');
        }
    
        $validationRules = [
            'promo_code_name' => 'required',
            'promo_images' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount_type' => 'required',
            'discount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_price' => 'required',
            'min_price' => 'required',
            'coupon_type' => 'required',
            'doj_percentage' => 'required',
            'res_percentage' => 'required',
            'coupon_usage' => 'required',
            'message' => 'required|string',
            'distance_km' => 'array',
            'discount_type_km' => 'array',
            'value' => 'array',
        ];
    
        if ($request->input('coupon_usage') == 'limited') {
            $validationRules['limited_usage'] = 'required';
        }
    
        $validation = Validator::make($request->all(), $validationRules);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    

        if ($request->hasFile('promo_images')) {
            $image = $request->file('promo_images');
            $promoImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/promo'), $promoImage);
    
            if ($promo_code->image && file_exists(public_path('images/promo/' . $promo_code->image))) {
                unlink(public_path('images/promo/' . $promo_code->image));
            }
    
            $promo_code->image = $promoImage;
        }
        

        $promo_code->promo_code_name = $request->input('promo_code_name');
        $promo_code->discount_type = $request->input('discount_type');
        $promo_code->discount = $request->input('discount');
        $promo_code->start_date = $request->input('start_date');
        $promo_code->end_date = $request->input('end_date');
        $promo_code->max_price = $request->input('max_price');
        $promo_code->min_price = $request->input('min_price');
        $promo_code->coupon_type = $request->input('coupon_type');
        $promo_code->coupon_usage = $request->input('coupon_usage');
        $promo_code->limited_usage = ($request->input('coupon_usage') == 'limited') ? $request->input('limited_usage') : null;
        $promo_code->res_percentage = $request->input('res_percentage');
        $promo_code->doj_percentage = $request->input('doj_percentage');
        $promo_code->status = $request->input('status') ? 1 : 0;
        $promo_code->message = $request->input('message');
       
        $promo_code->save();
        
        
    
        if($promo_code->id){
            return redirect()->route('admin.foodpromoCode')->with('success', 'Promo code updated successfully.');
        }
    
        return redirect()->route('admin.foodpromoCode')->with('error', 'Something wants to wrong.');
    }

    private function generateUniquePromoCode()
    {
        do {
            $promo_code = strtoupper(Str::random(8));
        } while (FoodPromoCodes::where('promo_code', $promo_code)->exists());

        return $promo_code;
    }


    public function destroy($id)
    {
        $promoCode = FoodPromoCodes::findOrFail($id);
        $promoCode->delete();

        return redirect()->route('admin.foodpromoCode')->with('success', 'promoCode deleted successfully.');
    }
    
    public function restaurant($id)
    {
        $promo_code = FoodPromoCodes::findOrFail($id);
        $restaurants = Restaurant::where('restaurant_status',1)->get();
        $RestaurantPromo = FoodRestaurantPromo::where('food_promocode_id',$id)->get();
        return view('admin.food_promocode.restaurant', compact('restaurants','promo_code','RestaurantPromo','id'));
    }
    
    public function getRestaurant(Request $request) {
        $id = $request->input('id');
      
        $selectedUserIds = FoodRestaurantPromo::where('food_promocode_id', $id)->where('status',1)->pluck('restaurant_id')->toArray();
        $restaurantData = Restaurant::where('restaurant_status', 1)->get();
        $categorizedRestaurants = $restaurantData->map(function ($restaurant) use ($selectedUserIds) {
            $isSelected = in_array($restaurant->id, $selectedUserIds);
            return [
                'selected' => $isSelected,
                'restaurant' => $restaurant,  
            ];
        });
        
        return response()->json($categorizedRestaurants);
    }
    
    public function searchRestaurant(Request $request) {
        $id = $request->input('id');
        $search = $request->input('search');
        $selectedUserIds = FoodRestaurantPromo::where('food_promocode_id', $id)->where('status',1)->pluck('restaurant_id')->toArray();
    
        $restaurants = Restaurant::where('restaurant_status', 1);
        if (!empty($search)) {
            $restaurants->where('name', 'LIKE', "%$search%");
        }
    
        $restaurantData = $restaurants->get();
    
        $categorizedRestaurants = $restaurantData->map(function ($restaurant) use ($selectedUserIds) {
            $isSelected = in_array($restaurant->id, $selectedUserIds);
            return [
                'selected' => $isSelected,
                'restaurant' => $restaurant, 
            ];
        });
        return response()->json($categorizedRestaurants);
    }




    
    public function store_restaurant(Request $request, $id)
    {
        $rules = [
            'restaurant_id' => 'required|array',
            'restaurant_id.*' => 'integer',
        ];
    
        $customMessages = [
            'restaurant_id.required' => 'Please select at least one restaurant.',
            'restaurant_id.*.integer' => 'Invalid restaurant ID.',
        ];
    
        $validation = Validator::make($request->all(), $rules);
    
        $validation->setCustomMessages($customMessages);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $selectedValues = $request->input('restaurant_id');
    
        FoodRestaurantPromo::where('food_promocode_id', $id)
            ->whereNotIn('restaurant_id', $selectedValues)
            ->update(['status' => 0]);
    
        foreach ($selectedValues as $value) {
            if ($value === "checkAll") {
                continue;
            }
    
            $existingRecord = FoodRestaurantPromo::where('food_promocode_id', $id)
                ->where('restaurant_id', $value)
                ->first();
    
            if ($existingRecord) {
                $existingRecord->update(['status' => 1]);
            } else {
                FoodRestaurantPromo::create([
                    'food_promocode_id' => $id,
                    'restaurant_id' => $value,
                    'status' => 1,
                ]);
            }
        }
    
        return redirect()->route('admin.foodpromoCode')->with('success', 'Promo code Apply successfully.');
    }


    
    public function users($id)
    {
        $promo_code = FoodPromoCodes::findOrFail($id);
        $users = Customer::where('status',1)->get();
        
        $categorizedUsers = $users->map(function ($user) {
            $hasOrders = Order::where('user_id', $user->id)->exists();
    
            $category = $hasOrders ? 'old_user' : 'new_user';
    
            return [
                'user' => $user,
                'category' => $category,
            ];
        });

        $userPromo = FoodUsersPromo::where('food_promocode_id',$id)->get();
        return view('admin.food_promocode.users', compact('users','promo_code','userPromo','categorizedUsers','id'));
    }
    
    
    public function getUsers(Request $request) {
        $category = $request->input('category');
        $id = $request->input('id');
        
        $selectedUserIds = FoodUsersPromo::where('food_promocode_id', $id)->pluck('user_id')->toArray();

        $users = Customer::where('status', 1)->get();
    
        $categorizedUsers = $users->map(function ($user) use ($selectedUserIds) {
            $hasOrders = Order::where('user_id', $user->id)->exists();
            $category = $hasOrders ? 'old_user' : 'new_user';
    
            $userIsSelected = in_array($user->id, $selectedUserIds);
    
            return [
                'user' => $user,
                'category' => $category,
                'selected' => $userIsSelected,
            ];
        });
    
        if ($category === 'all_user') {
            return response()->json($categorizedUsers);
        } elseif ($category === 'new_user') {
            $newUsers = $categorizedUsers->filter(function ($item) {
                return $item['category'] === 'new_user';
            });
            return response()->json($newUsers);
        } elseif ($category === 'old_user') {
            $oldUsers = $categorizedUsers->filter(function ($item) {
                return $item['category'] === 'old_user';
            });
            return response()->json($oldUsers);
        }
    }

    
    public function search_users(Request $request) {
        $category = $request->input('category');
        $id = $request->input('id');
        $search = $request->input('search');
    
        $selectedUserIds = FoodUsersPromo::where('food_promocode_id', $id)->pluck('user_id')->toArray();

        $users = Customer::where('status', 1);
    
        if (!empty($search)) {
            $users->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            });
        }
    
        $users = $users->get();
    
        $categorizedUsers = $users->map(function ($user) use ($selectedUserIds) {
            $hasOrders = Order::where('user_id', $user->id)->exists();
            $category = $hasOrders ? 'old_user' : 'new_user';
            $userIsSelected = in_array($user->id, $selectedUserIds);
    
            return [
                'user' => $user,
                'category' => $category,
                'selected' => $userIsSelected,
            ];
        });
    
        if ($category === 'all_user') {
            return response()->json($categorizedUsers);
        } elseif ($category === 'new_user') {
            $newUsers = $categorizedUsers->filter(function ($item) {
                return $item['category'] === 'new_user';
            });
            return response()->json($newUsers);
        } elseif ($category === 'old_user') {
            $oldUsers = $categorizedUsers->filter(function ($item) {
                return $item['category'] === 'old_user';
            });
            return response()->json($oldUsers);
        }
    }


    
    public function store_users(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'user_id' =>'required',
                
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation, 'user_association_errors')
                ->withInput();
        }
    
        $selectedValues = $request->input('user_id');
    
        // FoodUsersPromo::where('food_promocode_id', $id)->delete();  
        FoodUsersPromo::where('food_promocode_id', $id)->whereNotIn('user_id', $selectedValues)
            ->update(['status' => 0]);
            
        foreach ($selectedValues as $value) {
            if ($value === "checkAll") {
                continue;
            }
            
            $existingRecord = FoodUsersPromo::where('food_promocode_id', $id)
                ->where('user_id', $value)
                ->first();
    
            if ($existingRecord) {
                $existingRecord->update(['status' => 1]);
            } else {
                FoodUsersPromo::create([
                    'food_promocode_id' => $id,
                    'user_id' => $value,
                    'status' => 1,
                ]);
            }
            
            
        }
    
        return redirect()->route('admin.foodpromoCode')->with('success', 'Promo code applied successfully.');
    }
    
    function restaurant_list() {
      $FoodPromoCodes = FoodRestaurantPromo::with('restaurant', 'promo_code')
            ->latest('id') 
            ->get();
        return view('admin.food_promocode.restaurant_promo', compact('FoodPromoCodes'));
    }
    
    public function promoCodeView($id)
    {
        $promo_code = FoodPromoCodes::findOrFail($id);
        return view('admin.food_promocode.promo_code_view', compact('promo_code'));
    }
    
    function users_list() {
      $FoodPromoCodes = FoodUsersPromo::with('users', 'promo_code')
            ->latest('id') 
            ->get();
        return view('admin.food_promocode.users_promo', compact('FoodPromoCodes'));
    }
    
    public function delete($id)
    {
        $promoCode = FoodPromoCodes::findOrFail($id);
        $promoCode->delete();
    
        FoodRestaurantPromo::where('food_promocode_id', $id)->delete();
        FoodUsersPromo::where('food_promocode_id', $id)->delete();
    
        return redirect()->route('admin.foodpromoCode')->with('success', 'promoCode deleted successfully.');
    }
    
    public function restaurantDelete($id)
    {
        $FoodRestaurantPromo = FoodRestaurantPromo::findOrFail($id);
        $FoodRestaurantPromo->delete();
    
        return redirect()->route('admin.foodpromoCode.restaurant_list')->with('success', 'Restaurant deleted successfully.');
    }

    public function product($id)
    {
        $promo_code = FoodPromoCodes::findOrFail($id);
        $product = Foods::where('publish',1)->get();
        $ProductPromo = FoodProductPromo::where('food_promocode_id',$id)->get();
        return view('admin.food_promocode.product', compact('product','promo_code','ProductPromo','id'));
    }
    
    
    public function getProduct(Request $request) {
        $id = $request->input('id');
        $selectedProductIds = FoodProductPromo::where('food_promocode_id', $id)->where('status',1)->pluck('product_id')->toArray();
        $productData = Foods::where('publish', 1)->get();
        $categorizedProduct = $productData->map(function ($product) use ($selectedProductIds) {
            $isSelected = in_array($product->id, $selectedProductIds);
            return [
                'selected' => $isSelected,
                'product' => $product,  
            ];
        });
        
        return response()->json($categorizedProduct);
    }

    
    public function search_product(Request $request) {
        $id = $request->input('id');
        $search = $request->input('search');
        $selectedProductIds = FoodProductPromo::where('food_promocode_id', $id)->where('status',1)->pluck('product_id')->toArray();
    
        $products = Foods::where('publish', 1);
        if (!empty($search)) {
            $products->where('name', 'LIKE', "%$search%");
        }
    
        $productData = $products->get();
    
        $categorizedProduct = $productData->map(function ($product) use ($selectedProductIds) {
            $isSelected = in_array($product->id, $selectedProductIds);
            return [
                'selected' => $isSelected,
                'product' => $product, 
            ];
        });
        
        return response()->json($categorizedProduct);
    }


    
    public function store_product(Request $request, $id)
    {
        $rules = [
            'product_id' => 'required|array',
            'product_id.*' => 'integer|exists:foods,id',
        ];
    
        $customMessages = [
            'product_id.required' => 'Please select at least one Product.',
            'product_id.*.integer' => 'Invalid Product ID.',
            'product_id.*.exists' => 'Invalid Product selected.',
        ];
    
        $validation = Validator::make($request->all(), $rules, $customMessages);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $selectedValues = $request->input('product_id');
    
        FoodProductPromo::where('food_promocode_id', $id)
            ->whereNotIn('product_id', $selectedValues)
            ->update(['status' => 0]);
    
        foreach ($selectedValues as $value) {
            if ($value === "checkAll") {
                continue;
            }
    
            $existingRecord = FoodProductPromo::where('food_promocode_id', $id)
                ->where('product_id', $value)
                ->first();
    
            if ($existingRecord) {
                $existingRecord->update(['status' => 1]);
            } else {
                FoodProductPromo::create([
                    'food_promocode_id' => $id,
                    'product_id' => $value,
                    'status' => 1,
                ]);
            }
        }
    
        return redirect()->route('admin.foodpromoCode')->with('success', 'Promo code applied successfully to selected products.');
    }



}

