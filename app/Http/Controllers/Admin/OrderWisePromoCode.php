<?php

namespace App\Http\Controllers\Admin;
use App\Models\OrderWisePromoCodes;
use App\Models\OrderUsersPromo;
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

class OrderWisePromoCode extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $OrderWisePromoCodes = OrderWisePromoCodes::orderBy('id', 'desc')->get();
        return view('admin.order_wise_promocode.index',compact('OrderWisePromoCodes'));
    }
    

    public function create()
    {
        return view('admin.order_wise_promocode.create');
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
            'count_order' => 'required',
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
        
        $promo = OrderWisePromoCodes::create([
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
            'count_order' => $request->input('count_order'),
            'message' => $request->input('message'),
            'status' => $request->input('status') ? 1 : 0,
        ]);
    
        if ($promo->id) {
            return redirect()->route('admin.orderPromoCode')->with('success', 'Promo code inserted successfully.');
        }
        
        return redirect()->route('admin.orderPromoCode')->with('error', 'Something Wants to Wrong.');
    }


    
    public function edit($id)
    {
       $promo_code = OrderWisePromoCodes::findOrFail($id);
       return view('admin.order_wise_promocode.edit', compact('promo_code'));
    }
    

    
    public function update(Request $request, $id)
    {
        $promo_code = OrderWisePromoCodes::find($id);
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
            'count_order' => 'required',
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
        $promo_code->count_order = $request->input('count_order');
        $promo_code->status = $request->input('status') ? 1 : 0;
        $promo_code->message = $request->input('message');
       
        $promo_code->save();
        
        
    
        if($promo_code->id){
            return redirect()->route('admin.orderPromoCode')->with('success', 'Promo code updated successfully.');
        }
    
        return redirect()->route('admin.orderPromoCode')->with('error', 'Something wants to wrong.');
    }

    private function generateUniquePromoCode()
    {
        do {
            $promo_code = strtoupper(Str::random(8));
        } while (OrderWisePromoCodes::where('promo_code', $promo_code)->exists());

        return $promo_code;
    }


    public function delete($id)
    {
        $promoCode = OrderWisePromoCodes::findOrFail($id);
        $promoCode->delete();
    
        OrderUsersPromo::where('order_wise_promocode_id', $id)->delete();
    
        return redirect()->route('admin.orderPromoCode')->with('success', 'promoCode deleted successfully.');
    }
    
    public function users($id)
    {
        $promo_code = OrderWisePromoCodes::findOrFail($id);
        $users = Customer::where('status', 1)->get();
        $categorizedUsers = [];
        foreach ($users as $user) {
            $hasOrders = Order::where('user_id', $user->id)->count();
            if ($hasOrders === $promo_code->count_order) {
                $categorizedUsers[] = [
                    'user' => $user,
                    'hasOrder' => $hasOrders
                ];
            }
        }
        $userPromo = OrderUsersPromo::where('order_wise_promocode_id', $id)->get();
        return view('admin.order_wise_promocode.users', compact('users', 'promo_code', 'userPromo', 'categorizedUsers', 'id'));
    }

  
    public function getUsers(Request $request) {
        $id = $request->input('id');
    
        $selectedUserIds = OrderUsersPromo::where('order_wise_promocode_id', $id)->where('status', 1)->pluck('user_id')->toArray();
        $promo_code = OrderWisePromoCodes::findOrFail($id);
        $users = Customer::where('status', 1)->get();
    
        $categorizedUsers = $users->map(function ($user) use ($selectedUserIds, $promo_code) {
            $hasOrders = Order::where('user_id', $user->id)->count();
            $userIsSelected = in_array($user->id, $selectedUserIds);
            
            return [
                'user' => $user,
                'hasOrder' => $hasOrders,
                'selected' => $userIsSelected,
                'promo_order'=>$promo_code->count_order
            ];
            
        });
    
        return response()->json($categorizedUsers);
    }


    
    public function search_users(Request $request) {
        $id = $request->input('id');
        $search = $request->input('search');
    
        $promo_code = OrderWisePromoCodes::findOrFail($id);
        $selectedUserIds = OrderUsersPromo::where('order_wise_promocode_id', $id)->where('status', 1)->pluck('user_id')->toArray();
    
        $users = Customer::where('status', 1);
    
        if (!empty($search)) {
            $users->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            });
        }
    
        $users = $users->get();
    
        $categorizedUsers = $users->map(function ($user) use ($selectedUserIds, $promo_code) {
            $hasOrders = Order::where('user_id', $user->id)->count();
            $userIsSelected = in_array($user->id, $selectedUserIds);
    
            return [
                'user' => $user,
                'selected' => $userIsSelected,
                'promo_order' => $promo_code->count_order,
                'hasOrder' => $hasOrders,
            ];
        });
    
        return response()->json($categorizedUsers);
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
    
        // OrderUsersPromo::where('order_wise_promocode_id', $id)->delete();  
        OrderUsersPromo::where('order_wise_promocode_id', $id)->whereNotIn('user_id', $selectedValues)
            ->update(['status' => 0]);
            
        foreach ($selectedValues as $value) {
            if ($value === "checkAll") {
                continue;
            }
            
            $existingRecord = OrderUsersPromo::where('order_wise_promocode_id', $id)
                ->where('user_id', $value)
                ->first();
    
            if ($existingRecord) {
                $existingRecord->update(['status' => 1]);
            } else {
                OrderUsersPromo::create([
                    'order_wise_promocode_id' => $id,
                    'user_id' => $value,
                    'status' => 1,
                ]);
            }
            
            
        }
    
        return redirect()->route('admin.orderPromoCode')->with('success', 'Promo code applied successfully.');
    }
    
   
    public function promoCodeView($id)
    {
        $promo_code = OrderWisePromoCodes::findOrFail($id);
        return view('admin.order_wise_promocode.promo_code_view', compact('promo_code'));
    }
    
    function users_list() {
      $OrderWisePromoCodes = OrderUsersPromo::with('users', 'promo_code')
            ->latest('id') 
            ->get();
        return view('admin.order_wise_promocode.users_promo', compact('OrderWisePromoCodes'));
    }
    

    public function userDelete($id)
    {
        $promoCode = OrderUsersPromo::findOrFail($id);
        if($promoCode){
            $promoCode->delete();
            return redirect()->route('admin.orderPromoCode.users_list')->with('success', 'promoCode deleted successfully.');
        }else{
            return redirect()->route('admin.orderPromoCode.users_list')->with('error', 'Something wants to wrong.');
            
        }
    }
    
 

    public function product($id)
    {
        $promo_code = OrderWisePromoCodes::findOrFail($id);
        $product = Foods::where('publish',1)->get();
        $ProductPromo = FoodProductPromo::where('order_wise_promocode_id',$id)->get();
        return view('admin.order_wise_promocode.product', compact('product','promo_code','ProductPromo','id'));
    }
    
    
    public function getProduct(Request $request) {
        $id = $request->input('id');
        $selectedProductIds = FoodProductPromo::where('order_wise_promocode_id', $id)->where('status',1)->pluck('product_id')->toArray();
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
        $selectedProductIds = FoodProductPromo::where('order_wise_promocode_id', $id)->where('status',1)->pluck('product_id')->toArray();
    
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
    
        FoodProductPromo::where('order_wise_promocode_id', $id)
            ->whereNotIn('product_id', $selectedValues)
            ->update(['status' => 0]);
    
        foreach ($selectedValues as $value) {
            if ($value === "checkAll") {
                continue;
            }
    
            $existingRecord = FoodProductPromo::where('order_wise_promocode_id', $id)
                ->where('product_id', $value)
                ->first();
    
            if ($existingRecord) {
                $existingRecord->update(['status' => 1]);
            } else {
                FoodProductPromo::create([
                    'order_wise_promocode_id' => $id,
                    'product_id' => $value,
                    'status' => 1,
                ]);
            }
        }
    
        return redirect()->route('admin.orderPromoCode')->with('success', 'Promo code applied successfully to selected products.');
    }

}
