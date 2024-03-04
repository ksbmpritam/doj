<?php

namespace App\Http\Controllers\Admin;
use App\Models\PrmoCodekilometer;

use App\Models\PrmocodeKilometerUser;
use App\Models\PrmocodeKilometerRestaurant;
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
class PromoCodeKm extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $promoCodes = PrmoCodekilometer::orderBy('id', 'desc')->get();

        return view('admin.promocode_kilometer.index',compact('promoCodes'));
        
    }
    
    
        public function create()
    {
        return view('admin.promocode_kilometer.create');
    }
    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'promo_code_name' => 'required|string|max:255',
            'promo_images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
       
            'minimum' => 'required|numeric|min:1', // Minimum value of 1
            'maximum' => 'required|numeric|gt:minimum', // Greater than "minimum"
            'discount_type' => 'required',
            'discount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'date|after:start_date',
          
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
            $image->move(public_path('images/kmpromo'), $promoImage);
        }
        
        $promo_code = $this->generateUniquePromoCode(); 
        
        $promo = PrmoCodekilometer::create([
             'promo_code' => $promo_code, 
            'promo_code_name' => $request->input('promo_code_name'),
            'image' => $promoImage, 
            'minimum' => $request->input('minimum'),
            'maximum' => $request->input('maximum'),
            
             'coupon_type' => $request->input('coupon_type'),
            'kilometter' => $request->input('kilometter'),
            'distance_km' => $request->input('discount'),
            'discount_type' => $request->input('discount_type'),
            'discount' => $request->input('discount'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'coupon_usage' => $request->input('coupon_usage'),
            'limited_usage' => ($request->input('coupon_usage') == 'limited') ? $request->input('limited_usage') : "",
            'res_percentage' => $request->input('res_percentage'),
            'doj_percentage' => $request->input('doj_percentage'),
             'message' => $request->input('message'),
            'status' => $request->input('status') ? 1 : 0,
        ]);

         
        if ($promo->id) {
            
        return redirect()->route('admin.kilometer')->with('success', 'Promo kilometer code inserted successfully.');
        }
        
        return redirect()->route('admin.kilometer')->with('ERROR', 'Promo kilometer  not inserted .');
    }
     public function edit($id)
    {
       $promo_code = PrmoCodekilometer::findOrFail($id);
    //   dd($promo_code);
       $promo_code_distance = PromoCodeDistance::where('promo_code_id',$id)->get();
    //   dd($promo_code);
       return view('admin.promocode_kilometer.edit', compact('promo_code','promo_code_distance'));
    }
    
     
    
    
   
    public function update(Request $request, $id)
    {
        $promo_code = PrmoCodekilometer::find($id);
       
    
        // if (!$promo_code) {
        //     return redirect()->back()->with('error', 'Promo code not found.');
        // }
    
        $validationRules = [
            'promo_code_name' => 'required|string|max:255',
            'promo_images' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
             'minimum' => 'required|numeric|min:1', // Minimum value of 1
            'maximum' => 'required|numeric|gt:minimum', // Greater than "minimum"
            'discount_type' => 'required',
            'discount_type' => 'required',
            'discount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
         
            'coupon_usage' => 'required',
          
          
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
            $image->move(public_path('images/kmpromo'), $promoImage);
    
            if ($promo_code->image && file_exists(public_path('images/kmpromo/' . $promo_code->image))) {
                unlink(public_path('images/kmpromo/' . $promo_code->image));
            }
    
            $promo_code->image = $promoImage;
        }
        
        $promo_code->promo_code_name = $request->input('promo_code_name');
        $promo_code->discount_type = $request->input('discount_type');
        $promo_code->discount = $request->input('discount');
        $promo_code->start_date = $request->input('start_date');
        $promo_code->end_date = $request->input('end_date');
        $promo_code->minimum = $request->input('minimum');
        $promo_code->maximum = $request->input('maximum');
        $promo_code->kilometter = $request->input('kilometter');
        $promo_code->coupon_type = $request->input('coupon_type');
        $promo_code->message = $request->input('message');
        
        $promo_code->coupon_usage = $request->input('coupon_usage');
        $promo_code->limited_usage = ($request->input('coupon_usage') == 'limited') ? $request->input('limited_usage') : null;
        $promo_code->res_percentage = $request->input('res_percentage');
        $promo_code->doj_percentage = $request->input('doj_percentage');
        $promo_code->status = $request->input('status') ? 1 : 0;
     
       
        $promo_code->save();
        
        $distanceKm = $request->input('distance_km');
        $discountTypeKm = $request->input('discount_type_km');
        $values = $request->input('value');
    
        
        return redirect()->route('admin.kilometer')->with('success', 'kilometer  Promo code updated successfully.');
    }
    
    private function generateUniquePromoCode()
    {
        do {
            $promo_code = strtoupper(Str::random(8));
        } while (PrmoCodekilometer::where('promo_code', $promo_code)->exists());

        return $promo_code;
    }
    // // //CODE 
    //     public function delete($id)
    // {
    //     $promoCode = FoodPromoCodes::findOrFail($id);
    //     $promoCode->delete();
    
    //     PrmocodeKilometerRestaurant::where('promo_code_kilometers_id', $id)->delete();
    //     PrmocodeKilometerUser::where('promo_code_kilometers_id', $id)->delete();
    
    //     return redirect()->route('admin.foodpromoCode')->with('success', 'promoCode deleted successfully.');
    // }
    
    // /////END 
     public function destroy($id)
    {
        
        $promoCode = PrmoCodekilometer::findOrFail($id);
        $promoCode->delete();
        PrmocodeKilometerRestaurant::where('promo_code_kilometers_id', $id)->delete();
        PrmocodeKilometerUser::where('promo_code_kilometers_id', $id)->delete();
        return redirect()->route('admin.kilometer')->with('success', 'PrmoCodekilometer deleted successfully.');
    }
    
        public function getRestaurant($id)
    {
        $promo_code = PrmoCodekilometer::findOrFail($id);
        $restaurants = PrmocodeKilometerRestaurant::where('status',1)->get();
        
       
       
        return view('admin.promocode_kilometer.restaurant', compact('restaurants','promo_code','id'));
    }
         public function kilometerstorerestaurant(Request $request, $id)
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
    
        // Deactivate records that are not in the selected values
        PrmocodeKilometerRestaurant::where('promo_code_kilometers_id', $id)
            ->whereNotIn('restaurant_id', $selectedValues)
            ->update(['status' => 0]);
    
        foreach ($selectedValues as $value) {
            if ($value === "checkAll") {
                continue;
            }
    
            $existingRecord = PrmocodeKilometerRestaurant::where('promo_code_kilometers_id', $id)
                ->where('restaurant_id', $value)
                ->first();
    
            if ($existingRecord) {
                $existingRecord->update(['status' => 1]);
            } else {
                PrmocodeKilometerRestaurant::create([
                    'promo_code_kilometers_id' => $id,
                    'restaurant_id' => $value,
                    'status' => 1,
                ]);
            }
        }
    
        return redirect()->route('admin.kilometer')->with('success', 'kilomeeter   code Apply successfully.');
    }
    public function searchRestaurant(Request $request) {
        $id = $request->input('id');
        $search = $request->input('search');             
        $selectedUserIds = PrmocodeKilometerRestaurant::where('promo_code_kilometers_id', $id)->where('status',1)->pluck('restaurant_id')->toArray();
          
        $restaurants = Restaurant::where('status', 1);
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
     public function kmget_restaurant(Request $request) {
        $id = $request->input('id');
      
        $selectedUserIds = PrmocodeKilometerRestaurant::where('promo_code_kilometers_id', $id)->where('status',1)->pluck('restaurant_id')->toArray();
        $restaurantData = Restaurant::where('status', 1)->get();
        // dd($restaurantData);
        $categorizedRestaurants = $restaurantData->map(function ($restaurant) use ($selectedUserIds) {
            $isSelected = in_array($restaurant->id, $selectedUserIds);
            return [
                'selected' => $isSelected,
                'restaurant' => $restaurant,  
            ];
        });
        return response()->json($categorizedRestaurants);
    }
    

        
    public function kmgetuser($id)
    {
         $promo_code = PrmoCodekilometer::findOrFail($id);
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

        return view('admin.promocode_kilometer.kmuser', compact('users','promo_code','categorizedUsers','id'));
    }
     public function searchusers(Request $request) {
        $category = $request->input('category');
        $id = $request->input('id');
        $search = $request->input('search');
    
        $selectedUserIds = PrmoCodekilometeruser::where('promo_code_kilometers_id', $id)->pluck('user_id')->toArray();

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
       
    public function getUsers(Request $request) {
        $category = $request->input('category');
        $id = $request->input('id');
        
        $selectedUserIds = PrmoCodekilometeruser::where('promo_code_kilometers_id', $id)->pluck('user_id')->toArray();

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


    public function kmstoreuser(Request $request, $id)
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
    
        PrmoCodekilometeruser::where('promo_code_kilometers_id', $id)->delete();
    
        foreach ($selectedValues as $value) {
            if ($value === "checkAll") {
                continue;
            }
            
            PrmoCodekilometeruser::create([
                'promo_code_kilometers_id' => $id,
                'user_id' => $value,
                'status' => 1,
            ]);
        }
    
        return redirect()->route('admin.kilometer')->with('success', ' kilo meter  user updated successfully.');
    }
   
    public function restaurantList() {
        $foodPromoCodes = PrmocodeKilometerRestaurant::with('restaurant', 'promoCode')->latest('id')->get();
        // dd($foodPromoCodes);
        return view('admin.promocode_kilometer.restaurantlist', compact('foodPromoCodes'));
    }
       public function promoCodeView($promo_code_kilometers_id)
    {
        $promo_code = PrmoCodekilometer ::findOrFail($promo_code_kilometers_id);
        // dd($promo_code);
    
        return view('admin.promocode_kilometer.viewrestaurant', compact('promo_code'));
    }
    

  public function restaurantDelete($id)
    {
        $FoodRestaurantPromo = PrmocodeKilometerRestaurant ::findOrFail($id);
        $FoodRestaurantPromo->delete();
    
        return redirect()->route('admin.kilometer.restaurant_list')->with('success', 'Restaurant deleted successfully.');
    }  
function users_list() {
    $FoodPromoCodes = PrmocodeKilometerUser::with('users', 'promo_code')
          ->latest('id') 
          ->get();
        //   dd($FoodPromoCodes);
      return view('admin.promocode_kilometer.userlist', compact('FoodPromoCodes'));
  }
  
       public function usersdelete($promo_code_kilometers_id)
    {
        $PrmocodeKilometerUser = PrmocodeKilometerUser ::findOrFail($promo_code_kilometers_id);
            // dd($FoodRestaurantPromo);
        $PrmocodeKilometerUser->delete();
    
    
        return redirect()->route('admin.kilometer.users_list')->with('success', 'user deleted successfully.');
    }
    
    
   
   
    
    
    
}