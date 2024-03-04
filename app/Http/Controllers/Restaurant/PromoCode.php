<?php

namespace App\Http\Controllers\Restaurant;
use App\Models\PromoCodes;
use App\Models\UsersPromo;
use App\Models\Restaurant;
use App\Models\RestaurantPromo;
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
use App\Models\PromoCodeDistance;
use Carbon\Carbon;

class PromoCode extends Controller
{   

    
    public function index(Request $request)
    {
        $user = $request->session()->get('user');
        if (!$user) {
            return redirect()->route('restaurant'); 
        }
        
        $promoCodes = RestaurantPromo::with('promo_code')
        
            ->where('restaurant_id', $user->id)
            ->where('status', 1)
            ->get();
            // print_r("$promoCodes"); die();
            // dd($promoCodes);
            
            return view('restaurant_admin.promo_code.index', compact('promoCodes'));
    }

    public function view($id)
    {
// print("ndbv cq vsxc");die();
       $promo_code = PromoCodes::findOrFail($id);
      
       $promo_code_distance = PromoCodeDistance::where('promo_code_id',$id)->get();
      
       return view('restaurant_admin.promo_code.view', compact('promo_code','promo_code_distance'));
    }

    public function create()
    {
        return view('restaurant_admin.promo_code.create');
    }
    

    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'promo_code' => 'required|string|max:255',
            'promo_images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount_type' => 'required',
            'discount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'date|after:start_date',
            'active_dates' => 'required',
            'coupon_usage' => 'required',
            'limited_usage' => ($request->input('coupon_usage') == 'limited') ? 'required' : '',
            'message' => 'required|string',
            'distance_km' => 'array',
            'discount_type_km' => 'array',
            'value' => 'array',
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
        
        
        $promo = PromoCodes::create([
            'promo_code' => $request->input('promo_code'),
            'image' => $promoImage, 
            'discount_type' => $request->input('discount_type'),
            'discount' => $request->input('discount'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'active_dates' => $request->input('active_dates'),
            'coupon_usage' => $request->input('coupon_usage'),
            'limited_usage' => ($request->input('coupon_usage') == 'limited') ? $request->input('limited_usage') : "",
            'res_percentage' => $request->input('res_percentage'),
            'doj_percentage' => $request->input('doj_percentage'),
            'message' => $request->input('message'),
            'status' => $request->input('status') ? 1 : 0,
        ]);
    
        if ($promo->id) {
            $distanceKm = $request->input('distance_km');
            $discountTypeKm = $request->input('discount_type_km');
            $values = $request->input('value');
    
            if (!empty($distanceKm) && is_array($distanceKm)) {
                $count = count($distanceKm);
                for ($i = 0; $i < $count; $i++) {
                    PromoCodeDistance ::create([
                        'promo_code_id' => $promo->id,
                        'distance_km' => $distanceKm[$i],
                        'discount_type_km' => $discountTypeKm[$i],
                        'value' => $values[$i],
                    ]);
                }
            }
        }
        
        return redirect()->route('admin.promoCode')->with('success', 'Promo code inserted successfully.');
    }


    
    public function edit($id)
    {
       $promo_code = RestaurantPromo::findOrFail($id);
       return view('restaurant_admin.promo_code.edit', compact('promo_code'));
    }
    
  
    
    public function update(Request $request, $id)
    {

        $promo_code = RestaurantPromo::find($id);
    
        if (!$promo_code) {
            return redirect()->back()->with('error', 'Promo code not found.');
        }
    
        $validationRules = [
            'accept_by' => 'required',
        ];
    
        if ($request->input('accept_by') == -1) {
            $validationRules['cancel_reason'] = 'required';
        }
    
        $validation = Validator::make($request->all(), $validationRules);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        if ($request->input('accept_by') == -1) {
            $cancel_reason = $request->input('cancel_reason');
        } else {
            $cancel_reason = '';
        }
    
        $promo_code->accept_by = $request->input('accept_by');
        $promo_code->cancel_reason = $cancel_reason;
    
        $promo_code->save();
        return redirect()->route('restaurant.promoCode')->with('success', 'Promo code updated successfully.');
    }




    public function destroy($id)
    {
        $promoCode = PromoCodes::findOrFail($id);
        $promoCode->delete();

        return redirect()->route('restaurant_admin.promoCode')->with('success', 'promoCode deleted successfully.');
    }
    
    public function restaurant($id)
    {
        $promo_code = PromoCodes::findOrFail($id);
        $restaurants = Restaurant::where('restaurant_status',1)->get();
        $RestaurantPromo = RestaurantPromo::where('promo_code_id',$id)->get();
        return view('restaurant_admin.promo_code.restaurant', compact('restaurants','promo_code','RestaurantPromo','id'));
    }
    
    public function getRestaurant(Request $request) {
        $id = $request->input('id');
      
        $selectedUserIds = RestaurantPromo::where('promo_code_id', $id)->pluck('restaurant_id')->toArray();
        $restaurantData = Restaurant::where('restaurant_status', 1)->get();
        $categorizedRestaurants = $restaurantData->map(function ($restaurant) use ($selectedUserIds) {
            $isSelected = in_array($restaurant->id, $selectedUserIds);
            return [
                'selected' => $isSelected,
                'name' => $restaurant->name, 
            ];
        });
        return response()->json($categorizedRestaurants);
    }
    
    public function searchRestaurant(Request $request) {
        $id = $request->input('id');
        $search = $request->input('search');
        $selectedUserIds = RestaurantPromo::where('promo_code_id', $id)->pluck('restaurant_id')->toArray();
        $restaurants = Restaurant::where('restaurant_status', 1);
        if (!empty($search)) {
            $restaurants->where('name', 'LIKE', "%$search%");
        }
    
        $restaurantData = $restaurants->get();
    
        $categorizedRestaurants = $restaurantData->map(function ($restaurant) use ($selectedUserIds) {
            $isSelected = in_array($restaurant->id, $selectedUserIds);
            return [
                'selected' => $isSelected,
                'name' => $restaurant->name, 
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
        // RestaurantPromo::where('promo_code_id', $id)->delete();
       
        foreach ($selectedValues as $value) {
            if ($value === "checkAll") {
                continue;
            }
    
    
            $existingRecord = RestaurantPromo::where('promo_code_id', $id)->where('restaurant_id', $value)->first(); 
            
            if ($existingRecord) {
                $existingRecord->update(['status' => 0]);
            } else {
                // If it doesn't exist, create a new record
                RestaurantPromo::create([
                    'promo_code_id' => $id,
                    'restaurant_id' => $value,
                    'status' => 0,
                ]);
            }
            
            // RestaurantPromo::create([
            //     'promo_code_id' => $id,
            //     'restaurant_id' => $value,
            //     'status' => 1,
            // ]);
        }
    
        return redirect()->route('admin.promoCode')->with('success', 'Promo code Apply successfully.');
    }

    
    public function users($id)
    {
        $promo_code = PromoCodes::findOrFail($id);
        $users = Customer::where('status',1)->get();
        
        $categorizedUsers = $users->map(function ($user) {
            $hasOrders = Order::where('user_id', $user->id)->exists();
    
            $category = $hasOrders ? 'old_user' : 'new_user';
    
            return [
                'user' => $user,
                'category' => $category,
            ];
        });

        $userPromo = UsersPromo::where('promo_code_id',$id)->get();
        return view('admin.promo_code.users', compact('users','promo_code','userPromo','categorizedUsers','id'));
    }
    
    
    public function getUsers(Request $request) {
        $category = $request->input('category');
        $id = $request->input('id');
        
        $selectedUserIds = UsersPromo::where('promo_code_id', $id)->pluck('user_id')->toArray();
        // Assuming 'promo_code_id' and 'user_id' are the column names in your PromoCodeUser model
    
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
    
        $selectedUserIds = UsersPromo::where('promo_code_id', $id)->pluck('user_id')->toArray();

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
    
        UsersPromo::where('promo_code_id', $id)->delete();
    
        foreach ($selectedValues as $value) {
            if ($value === "checkAll") {
                continue;
            }
            
            UsersPromo::create([
                'promo_code_id' => $id,
                'user_id' => $value,
                'status' => 1,
            ]);
        }
    
        return redirect()->route('admin.promoCode')->with('success', 'Promo code applied successfully.');
    }
    
   
 
}


