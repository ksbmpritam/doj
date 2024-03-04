<?php

namespace App\Http\Controllers\API\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\FoodAttribute;
use App\Models\Foods;
use App\Models\Filter;
use App\Models\FilterOption;
use App\Models\AddToCart;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Driver;
use App\Models\Restaurant;
use App\Models\FoodAddons;
use App\Models\FoodSpecification;
use App\Models\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\Helpers\Config;

class Product extends Controller
{
    public function get_attribute()
    {
        $attribute = FoodAttribute::where('status', '1')->get();
        
        return response()->json($attribute, Response::HTTP_OK);    
    }
    
    
    public function add_food(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'category_id' => 'required',
            'item_quantity' => 'required',
            'food_attribute_id' => 'required',
            'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'required',
            'publish' => 'required',
            'non_veg' => 'required',
            'takeway_option' => 'required',
            'calories' => 'required',
            'grams' => 'required',
            'fats' => 'required',
            'proteins' => 'required',
            // 'food_addons' => 'required',
            // 'food_specification' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
     
        $data = [
            'restaurant_id' => $request->restaurant_id,
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
            $data['images'] = $imageName;
           
        }
    
        $food = Foods::create($data);
        if (!$food) {
            return response()->json([
                'message' => 'Failed to create Food record'
            ], 500);
        }

        if($food->id){
            if ($request->food_addons) { 
                $unescapedJsonString = stripcslashes($request->food_addons);

                $addons = json_decode($unescapedJsonString, true);
                if (is_array($addons)) {
                    foreach ($addons as $addon_data) {
                        $foodId = $food->id; 
                        $title = $addon_data['title'];
                        $price = $addon_data['price']; 
                        FoodAddons::create([
                            'food_id' => $foodId,
                            'title' => $title,
                            'price' => $price,
                        ]);
                    }
                 }
            }
            if ($request->food_specification) { 
                $unescapedJsonString = stripcslashes($request->food_specification);

                $addons = json_decode($unescapedJsonString, true);
                if (is_array($addons)) {
                    foreach ($addons as $addon_data) {
                        $foodId = $food->id; 
                        $label = $addon_data['label'];
                        $value = $addon_data['value']; 
                        FoodSpecification::create([
                            'food_id' => $foodId,
                            'label' => $label,
                            'value' => $value,
                        ]);
                    }
                 }
            }
    
        }

    
        return response()->json([
            'message' => 'Food Created Successfully'
        ], 200);
    }

    public function delete_food_id(Request $request){
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
            'food_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $restaurantId = $request->input('restaurant_id');
        $food_id = $request->input('food_id');
    
        $food = Foods::where('restaurant_id', $restaurantId)
                         ->where('id', $food_id)
                         ->first();
    
        if ($food) {
            $food->foodAddons()->delete();
            $food->foodSpecifications()->delete();
            $food->delete();
            return response()->json(['status' => true, 'message' => 'Item deleted from cart successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Item not found in cart']);
        }
    }


    public function update_food(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
            'food_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $restaurantId = $request->input('restaurant_id');
        $foodId = $request->input('food_id');
    
        $food = Foods::where('restaurant_id', $restaurantId)
                         ->where('id', $foodId)
                         ->first();
    
        if (!$food) {
            return response()->json([
                'message' => 'Food not found'
            ], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'category_id' => 'required',
            'item_quantity' => 'required',
            'food_attribute_id' => 'required',
            'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'publish' => 'required',
            'non_veg' => 'required',
            'takeway_option' => 'required',
            'calories' => 'required',
            'grams' => 'required',
            'fats' => 'required',
            'proteins' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $data = [
            'restaurant_id' => $request->restaurant_id,
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
            $data['images'] = $imageName;
        }
    
        $food->update($data);
    
        // Update food addons
        if ($request->food_addons) {
            $addons = json_decode($request->food_addons, true);
            if (is_array($addons)) {
                FoodAddons::where('food_id', $foodId)->delete();
                foreach ($addons as $addon_data) {
                    $title = $addon_data['title'];
                    $price = $addon_data['price'];
                    FoodAddons::create([
                        'food_id' => $foodId,
                        'title' => $title,
                        'price' => $price,
                    ]);
                }
            }
        }
    
        // Update food specifications
        if ($request->food_specification) {
            $specifications = json_decode($request->food_specification, true);
            if (is_array($specifications)) {
                FoodSpecification::where('food_id', $foodId)->delete();
                foreach ($specifications as $spec_data) {
                    $label = $spec_data['label'];
                    $value = $spec_data['value'];
                    FoodSpecification::create([
                        'food_id' => $foodId,
                        'label' => $label,
                        'value' => $value,
                    ]);
                }
            }
        }
    
        return response()->json([
            'message' => 'Food Updated Successfully'
        ], 200);
    }



    public function get_product(Request $request){
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        
         $foods = Foods::with('foodAddons', 'foodSpecifications','restaurant')
                  ->where('restaurant_id', $request->restaurant_id)
                  ->get();
        
        if($foods){
            foreach ($foods as $food) {
                $food->food_image = $food->images ? asset('images/foods/' . $food->images) : '';
                $food->category_name = $food->category ? $food->category->name : null;
                $food->attribute_name = $food->foodAttribute ? $food->foodAttribute->name : null;
            }
            
            return response()->json($foods, Response::HTTP_OK);    
        }

    }
    
    public function changeFoodStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'food_id' => 'required|exists:foods,id',
            'status' => 'required|in:0,1',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $foodId = $request->input('food_id');
        $status = $request->input('status');
        $food = Foods::findOrFail($foodId);
    
        if ($status === "1") {
            $food->status = $status;
            $food->save();
            return response()->json(['message' => 'Food Activated successfully','status'=>true]);
        } elseif ($status === "0") {
            $food->status = $status;
            $food->save();
            return response()->json(['message' => 'Food Status Disable','status'=>true]);
        }
    
        return response()->json(['message' => 'Invalid status provided','status'=>false], 400);
    }
    
    public function get_product_user(Request $request){
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $foods=Foods::where('restaurant_id',$request->restaurant_id)->where('publish',1)->get();
        if($foods){
            foreach ($foods as $food) {
                $food->food_image = $food->images ? asset('images/foods/' . $food->images) : '';
                $food->category_name = $food->category ? $food->category->name : null;
                $food->attribute_name = $food->foodAttribute ? $food->foodAttribute->name : null;
            }
            
            return response()->json($foods, Response::HTTP_OK);    
        }

    }
    
    public function product_details_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'food_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $food = Foods::where('id', $request->food_id)->where('publish', 1)->first();
    
        if ($food) {
            $food->food_image = $food->images ? asset('images/foods/' . $food->images) : '';
            $food->category_name = $food->category ? $food->category->name : null;
            $food->attribute_name = $food->foodAttribute ? $food->foodAttribute->name : null;
    
            return response()->json($food, Response::HTTP_OK);
        }
        
        return response()->json(['message' => 'Food not found'], Response::HTTP_NOT_FOUND);
    }

    
    
    
    public function add_cart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'user_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
    
        if ($request->item) {
            $unescapedJsonString = stripcslashes($request->item);
            $items = json_decode($unescapedJsonString, true);
            $userId = $request->user_id;
            if (is_array($items)) {
                foreach ($items as $item) {
                    AddToCart::create([
                        'food_id' => $item['id'],
                        'restaurant_id' => $item['restaurant_id'], 
                        'user_id' => $userId,
                        'foodName' => $item['foodName'],
                        'price' => $item['price'],
                        'foodImage' => $item['foodImage'],
                        'discount' => $item['discount'],
                        'quantity' => $item['itemCount'],
                        'size' => $item['size'],
                    ]);
                }
        
                return response()->json(['message' => 'Items added to cart successfully','status'=>true]);
            } else {
                return response()->json(['message' => 'Invalid Item data format', 'status'=>false], 422);
            }
        }
    }
    
    
    public function getCartList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $user_id = $request->user_id;

        $cartItems = AddToCart::with('food')->where('user_id', $user_id)->get();

        return response()->json([
            'status' => true,
            'data' => $cartItems,
        ]);
    }
    
    public function add_cart_new(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'user_id' => 'required',
            'type' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        if ($request->item) {
            $unescapedJsonString = stripslashes($request->item);
            $items = json_decode($unescapedJsonString, true);
            $userId = $request->user_id;
            $type = $request->type;
    
            if (is_array($items)) {
                foreach ($items as $item) {
                    $existingCartItem = AddToCart::where([
                        'food_id' => $item['id'],
                        'restaurant_id' => $item['restaurant_id'],
                        'user_id' => $userId,
                        'type' => $type,
                    ])->first();
    
                    if ($existingCartItem) {
                        $existingCartItem->update([
                            'food_id' => $item['id'],
                            'restaurant_id' => $item['restaurant_id'],
                            'user_id' => $userId,
                            'foodName' => $item['foodName'],
                            'price' => $item['price'],
                            'foodImage' => $item['foodImage'],
                            'discount' => $item['discount'],
                            'quantity' => $item['itemCount'],
                            'size' => $item['size'],
                            'type' => $type,
                        ]);
                    } else {
                       
                        AddToCart::create([
                            'food_id' => $item['id'],
                            'restaurant_id' => $item['restaurant_id'],
                            'user_id' => $userId,
                            'foodName' => $item['foodName'],
                            'price' => $item['price'],
                            'foodImage' => $item['foodImage'],
                            'discount' => $item['discount'],
                            'quantity' => $item['itemCount'],
                            'size' => $item['size'],
                            'type' => $type,
                        ]);
                    }
                }
    
                return response()->json(['message' => 'Items added to cart successfully', 'status' => true]);
            } else {
                return response()->json(['message' => 'Invalid Item data format', 'status' => false], 422);
            }
        }
    }

    
    public function add_cart_new_test(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'user_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
    
        if ($request->item) {
            $unescapedJsonString = stripcslashes($request->item);
            $items = json_decode($unescapedJsonString, true);
            $userId = $request->user_id;
            if (is_array($items)) {
                foreach ($items as $item) {
                    AddToCart::create([
                        'food_id' => $item['id'],
                        'restaurant_id' => $item['restaurant_id'], 
                        'user_id' => $userId,
                        'foodName' => $item['foodName'],
                        'price' => $item['price'],
                        'foodImage' => $item['foodImage'],
                        'discount' => $item['discount'],
                        'quantity' => $item['itemCount'],
                        'size' => $item['size'],
                    ]);
                }
        
                return response()->json(['message' => 'Items added to cart successfully','status'=>true]);
            } else {
                return response()->json(['message' => 'Invalid Item data format', 'status'=>false], 422);
            }
        }
    }


    public function getCartList_new(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $user_id = $request->user_id;
    
        $cartItems = AddToCart::with('food','restaurant')->where('user_id', $user_id)->get()->groupBy('restaurant_id');
    
        return response()->json([
            'status' => true,
            'data' => $cartItems,
        ]);
    }

    public function delete_all_cart(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:customer,id',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $user_id = $request->user_id;
        $type = $request->type;
        
        AddToCart::where('user_id',$user_id)->where('type',$type)->delete();
        
        return response()->json(['status' => true,'message' => 'delete all items form cart successfylly',]);
    }
    
    
    
    public function delete_cart_by_id(Request $request){
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
            'item_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $restaurantId = $request->input('restaurant_id');
        $itemId = $request->input('item_id');
    
        $item = AddToCart::where('restaurant_id', $restaurantId)
                         ->where('id', $itemId)
                         ->first();
    
        if ($item) {
            $item->delete();
            return response()->json(['status' => true, 'message' => 'Item deleted from cart successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Item not found in cart']);
        }
    }

    public function delete_cart_by_restaurant_id(Request $request){
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $restaurantId = $request->input('restaurant_id');
    
        $items = AddToCart::where('restaurant_id', $restaurantId)->get();
    
        foreach ($items as $item) {
            $item->delete();
        }
    
        return response()->json(['status' => true, 'message' => 'Items deleted from cart successfully']);
    }

    public function update_item(Request $request){
        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
            'quantity' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $itemId = $request->input('item_id');
        $quantity = $request->input('quantity');
        $item = AddToCart::find($itemId);
    
        if ($item) {
            if ($quantity == 0) {
                $item->delete();
                return response()->json(['status' => true, 'message' => 'Item deleted from cart']);
            }
            
            $item->quantity = $quantity;
            $item->save();
    
            return response()->json(['status' => true, 'message' => 'Item quantity updated successfully','item'=>$item]);
        } else {
            return response()->json(['status' => false, 'message' => 'Item not found in cart']);
        }
    }

    
    public function getOrderList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $restaurantId = $request->input('restaurant_id');  
        
        $arr = [];
        $old_order = Order::with('restaurant', 'users','order_items')->where('restaurant_id', $restaurantId)->orderBy('id', 'desc')->get(); 
        
        
        
        foreach($old_order as $list){
            if($list->driver_status == 1){
                $orders = Order::with('restaurant', 'users','order_items','driver')->where('restaurant_id', $list->restaurant_id)->orderBy('id', 'desc')->first(); 
                $list->driver = $orders->driver;
            }else{
                $list->driver = null;
            }
            
            $arr[] = $list;
        }
        
        return response()->json(['status'=>true,'orders' => $arr]);

    }
   
    
    public function changeOrderStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'action' => 'required|in:-1,0,1,2,4', 
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $orderId = $request->input('order_id');
        $action = $request->input('action');
        $keep_time_hour = $request->input('keep_time_hour');
        $keep_time_minute = $request->input('keep_time_minute');
        
        
        
       
        $order = Order::findOrFail($orderId); 
        
        if($order->order_type==0){
            if ($action === "-1") {
                $order->order_status = $action;
                $order->keep_time_hour = 0;
                $order->keep_time_minute = 0;
                $order->save();
                $this->updateOrderFirebase($orderId,$action);
                $message = array(
                        "url" => "Order Cancle successfully",
                        "title" => "Order Cancle successfully",
                        "sub_title" => "Order Cancle successfully",
                        "type" => "order_cancle",
                        "image" => "",
                    );
                if(!empty($restaurant_fcm)){
                    $res_data = $this->sendNotification($message, $restaurant_fcm);
                }
                
                if(!empty($customer_fcm)){
                    $res_data = $this->sendNotification($message, $customer_fcm);
                }
                 
                return response()->json(['message' => 'Order Cancle successfully','status'=>true]);
            }elseif ($action === "1") {
                $order->order_status = $action;
                $order->keep_time_hour = $keep_time_hour == null ? '0' : sprintf("%02d:00:00", $keep_time_hour);
                $order->keep_time_minute = $keep_time_minute == null ? '0' : sprintf("00:%02d:00", $keep_time_minute);
                $order->save();
                // $this->assignDriverToOrder($orderId);
                $this->updateOrderFirebase($orderId,$action);
                 
                $message = array(
                    "url" => "Order Accepted Success",
                    "title" => "Order Accepted Success",
                    "sub_title" => "Order Accepted Success",
                    "type" => "order_accept",
                    "image" => "",
                );
                if(!empty($restaurant_fcm)){
                    $res_data = $this->sendNotification($message, $restaurant_fcm);
                }
                
                if(!empty($customer_fcm)){
                    $res_data = $this->sendNotification($message, $customer_fcm);
                }
                
                return response()->json(['message' => 'Order Accepted Successfully','status'=>true]);
            }elseif ($action === "4") {
                $order->order_status = $action;
                $order->save();
                // $this->assignDriverToOrder($orderId);
                $this->updateOrderFirebase($orderId,$action);
                 
                $message = array(
                    "url" => "Order Completed Success",
                    "title" => "Order Completed Success",
                    "sub_title" => "Order Completed Success",
                    "type" => "order_completed",
                    "image" => "",
                );
                if(!empty($restaurant_fcm)){
                    $res_data = $this->sendNotification($message, $restaurant_fcm);
                }
                
                if(!empty($customer_fcm)){
                    $res_data = $this->sendNotification($message, $customer_fcm);
                }
                
                return response()->json(['message' => 'Order Accepted Successfully','status'=>true]);
            }
            
        }else{
           
            if(!empty($order->restaurant_id)){
                // $restaurant_fcm = DB::table('restaurant_admin')->where('id', $order->restaurant_id)->first()->fcm_token;
                 $restaurantAdmin = DB::table('restaurant_admin')->where('id', $order->restaurant_id)->first();

                if ($restaurantAdmin && isset($restaurantAdmin->fcm_token)) {
                    $restaurant_fcm = $restaurantAdmin->fcm_token;
                } else {
                    $restaurant_fcm = null;
                }
             }
             
             if(!empty($order->user_id)){
                $customer_fcm = DB::table('customer')->where('id', $order->user_id)->first()->fcm_token;
             }
             
             if(!empty($order->drivers_id)){
                $driver_fcm = DB::table('driver')->where('id', $order->drivers_id)->first()->fcm_token;
             }
             
            if ($action === "-1") {
                $order->order_status = $action;
                $order->save();
                $this->updateOrderFirebase($orderId,$action);
                $message = array(
                        "url" => "Order Cancle successfully",
                        "title" => "Order Cancle successfully",
                        "sub_title" => "Order Cancle successfully",
                        "type" => "order_cancle",
                        "image" => "",
                    );
                if(!empty($restaurant_fcm)){
                    $res_data = $this->sendNotification($message, $restaurant_fcm);
                }
                
                if(!empty($customer_fcm)){
                    $res_data = $this->sendNotification($message, $customer_fcm);
                }
                 
                return response()->json(['message' => 'Order Cancle successfully','status'=>true]);
            } elseif ($action === "1") {
                $order->order_status = $action;
                $order->save();
                $this->assignDriverToOrder($orderId);
                $this->updateOrderFirebase($orderId,$action);
                 
                $message = array(
                    "url" => "Order Accepted Success",
                    "title" => "Order Accepted Success",
                    "sub_title" => "Order Accepted Success",
                    "type" => "order_accept",
                    "image" => "",
                );
                if(!empty($restaurant_fcm)){
                    $res_data = $this->sendNotification($message, $restaurant_fcm);
                }
                
                if(!empty($customer_fcm)){
                    $res_data = $this->sendNotification($message, $customer_fcm);
                }
                
                return response()->json(['message' => 'Order Accepted Successfully','status'=>true]);
            }elseif($action === "2"){
                $order->order_status = $action;
                $order->save();
                $this->updateOrderFirebase($orderId,$action);
                $message = array(
                    "url" => "Order Assign to driver Success",
                    "title" => "Order Assign to driver Success",
                    "sub_title" => "Order Assign to driver Success",
                    "type" => "order_dispatched",
                    "image" => "",
                );
                
                if(!empty($restaurant_fcm)){
                    $res_data = $this->sendNotification($message, $restaurant_fcm);
                }
                
                if(!empty($customer_fcm)){
                    $res_data = $this->sendNotification($message, $customer_fcm);
                }
                
                if(!empty($driver_fcm)){
                    $res_data = $this->sendNotification($message, $driver_fcm);
                }
                 
                return response()->json(['message' => 'Order Dispatch Successfully','status'=>true]);
            }
        }
        return response()->json(['message' => 'Invalid action provided','status'=>false], 400);

    }
    
    public function updateOrderFirebase($orderId,$status){
        $factory = (new Factory())->withDatabaseUri(Config::getFirebaseDatabaseUrl());
        $database = $factory->createDatabase();
        $database->getReference('orders/'.$orderId)->update(['order_status' => $status]);
    }
    
   
    // public function updateOrderFirebase($orderId, $status)
    // {
    //     $firebaseDatabaseUrl = Config::getFirebaseDatabaseUrl();
    //     $factory = (new Factory())->withDatabaseUri($firebaseDatabaseUrl);
    //     $database = $factory->createDatabase();
    //     $database->getReference('orders/' . $orderId)->update(['order_status' => $status]);

    //     // Additional code...
    // }
    

    public function assignDriverToOrder($order_id)
    {
        $order = Order::findOrFail($order_id);
    
        $factory = (new Factory())->withDatabaseUri(Config::getFirebaseDatabaseUrl());
        $database = $factory->createDatabase();
    
        // Get the drivers who are available and not assigned to other orders
        
        $availableDrivers = Driver::where('available', 1)->where('status', 1)->get();
        
        if ($availableDrivers->isEmpty()) {
            return response()->json(['message' => 'No available drivers.'], 404);
        }
    
        // Fetch driver locations from Firebase
        $driverLocations = [];
        foreach ($availableDrivers as $driver) {
            $driverLocation = $database->getReference('driver/' . $driver->id)->getValue();
            if ($driverLocation) {
                $driverLocations[$driver->id] = $driverLocation;
            }
        }
        
        // Calculate distances for each driver and the order's destination
        foreach ($availableDrivers as $driver) {
            if (isset($driverLocations[$driver->id])) {
                $distance =$this->calculateDistance($driverLocations[$driver->id]['latitude'],$driverLocations[$driver->id]['longitude'],$order->longitude,$order->latitude);
                $driver->distance = $distance;
            }
        }
        
        // Find the driver with the shortest distance
        $nearestDriver = $availableDrivers->sortBy('distance')->first();

        // Assign the order to the nearest driver
        $order->drivers_id = $nearestDriver->id;
        $order->save();
        
      return response()->json(['message' => 'Order assigned to nearest driver.'], 200);
    }

   
    public function search_product(Request $request) {
        $validator = Validator::make($request->all(), [
            'search' => 'required|min:3',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all(),'status'=>false], 422);
        }
    
        $searchTerm = $request->search;
    
        $foods = Foods::where('publish',1)->where('name', 'like',  $searchTerm . '%')->get();
        $restaurants = Restaurant::where('restaurant_status',1)->where('name', 'like', $searchTerm . '%')->get();
    
        $combinedResults = [];
    
        if (!$foods->isEmpty()) {
            $foods->transform(function ($food) {
                $food->food_img = asset('images/foods/' . $food->images);
                $food->type = 'food';
                return $food;
            });
            $combinedResults = $foods->toArray();
        }
    
        if (!$restaurants->isEmpty()) {
            $restaurants->transform(function ($restaurant) {
                $restaurant->restaurant_img = asset('images/restaurants/' . $restaurant->image);
                $restaurant->type = 'restaurant';
                return $restaurant;
            });
    
            $combinedResults = array_merge($combinedResults, $restaurants->toArray());
        }
    
        return response()->json(['status' => true, 'data' => $combinedResults]);
    }
    
    public function search_dine(Request $request) {
        $validator = Validator::make($request->all(), [
            'search' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all(), 'status' => false], 422);
        }
    
        $searchTerm = $request->input('search'); // Use input() method to retrieve input data
    
        $restaurants = Restaurant::where('restaurant_status', 1)->where('enable_dine', 1)
                                 ->where('name', 'like', $searchTerm . '%')
                                 ->get();
    
        if (!$restaurants->isEmpty()) {
            $restaurants->transform(function ($restaurant) {
                $restaurant->restaurant_img = asset('images/restaurants/' . $restaurant->image);

                return $restaurant; 
            });
    
            return response()->json(['status' => true, 'data' => $restaurants]);
        }
    
        return response()->json(['status' => false, 'message' => 'Record not found']);
    }
    
    public function get_nearest_dine(Request $request) {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all(), 'status' => false], 422);
        }
    
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
    
        $restaurants = Restaurant::where('restaurant_status', 1)
                                 ->where('enable_dine', 1)
                                 ->get();
    
        $restaurants->transform(function ($restaurant) use ($latitude, $longitude) {
            $earthRadius = 6371; // in kilometers
    
            $latDiff = deg2rad($restaurant->latitude - $latitude);
            $lonDiff = deg2rad($restaurant->longitude - $longitude);
    
            $a = sin($latDiff / 2) * sin($latDiff / 2) +
                 cos(deg2rad($latitude)) * cos(deg2rad($restaurant->latitude)) *
                 sin($lonDiff / 2) * sin($lonDiff / 2);
    
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
            $distance = $earthRadius * $c;
    
            $restaurant->distance = $distance;
            $restaurant->restaurant_img = asset('images/restaurants/' . $restaurant->image);
    
            $restaurant->load('dineGallery'); 

            $restaurant->dineGallery->transform(function ($galleryImage) {
                $galleryImage->image_url = asset('images/restaurants/dine/' . $galleryImage->dine_images); 
                return $galleryImage;
            });
    
    
            return $restaurant;
        });
    
        // Sort the restaurants by distance
        $restaurants = $restaurants->sortBy('distance');
    
        if ($restaurants->isNotEmpty()) {
            return response()->json(['status' => true, 'data' => $restaurants->values()]);
        }
    
        return response()->json(['status' => false, 'message' => 'Record not found']);
    }
    
    public function get_product_by_restaurant_id_category_id(Request $request) {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'type' => 'required|in:food,restaurant',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all(),'status'=>false], 422);
        }
    
        $category_id = $request->category_id;
        $type = $request->type;
    
        if ($type === 'food') {
            $foodsQuery = Foods::where('publish', 1)->where('category_id', $category_id);
    
            $foods = $foodsQuery->get();
    
            if (!$foods->isEmpty()) {
                $foods->transform(function ($food) {
                    $food->banner_photo_url = asset('images/foods/' . $food->images);
                    return $food;
                });
    
              
                $restaurantIds = $foods->pluck('restaurant_id')->unique();
                
                $restaurants = Restaurant::whereIn('id', $restaurantIds)->get();
                
                $result = $foods->groupBy('restaurant_id')->map(function ($foodGroup, $restaurantId) use ($restaurants) {
                    $restaurant = $restaurants->where('id', $restaurantId)->first();
                    
                    return [
                        'restaurant' => $restaurant,
                        'foods' => $foodGroup,
                    ];
                });
                
                return response()->json(['status' => true, 'data' => $result]);
            }
        }elseif ($type === 'restaurant') {
            $restaurant_id = $request->restaurant_id;
            $foods = Foods::where('publish', 1)->where('restaurant_id',$restaurant_id)->where('category_id',$category_id)->get();
        
            if (!$foods->isEmpty()) {
                $foods->transform(function ($food) {
                    $food->banner_photo_url = asset('images/foods/' . $food->images);
                    return $food;
                });
                return response()->json(['status' => true, 'data' => $foods]);
            }  
        }
    
        return response()->json(['status' => false, 'msg' => 'food not found']);
    }

    
    public function get_product_by_restaurant_id_category_id_old(Request $request) {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'type' => 'required|in:food,restaurant',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all(),'status'=>false], 422);
        }
    
        $category_id = $request->category_id;
        $type = $request->type;
    
        if ($type === 'food') {
            $restaurant_id = $request->restaurant_id; 
            $foodsQuery = Foods::where('publish', 1)->where('category_id', $category_id);
    
            if (!empty($restaurant_id)) {
                $foodsQuery->where('restaurant_id', $restaurant_id);
            }
    
            $foods = $foodsQuery->get();
    
            if (!$foods->isEmpty()) {
                $foods->transform(function ($food) {
                    $food->banner_photo_url = asset('images/foods/' . $food->images);
                    return $food;
                });
                return response()->json(['status' => true, 'data' => $foods]);
            }
            
        } elseif ($type === 'restaurant') {
            $foods = Foods::where('publish', 1)->where('restaurant_id',$restaurant_id)->where('category_id',$category_id)->get();
        
            if (!$foods->isEmpty()) {
                $foods->transform(function ($food) {
                    $food->banner_photo_url = asset('images/foods/' . $food->images);
                    return $food;
                });
                return response()->json(['status' => true, 'data' => $foods]);
            }  
        }
    
        return response()->json(['status' => false, 'msg' =>'food not found']);
    }

    
    public function filter(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all(),'status'=>false], 422);
        }
        
        $filter = Filter::with('filter_option')->where('status',1)->get();
        
        if ($filter->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'No filters available.']);
        }
        
        return response()->json(['status' => true, 'data' => $filter]);
        
    
    }

    function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radius of the Earth in kilometers
    
        $lat1Rad = deg2rad($lat1);
        $lon1Rad = deg2rad($lon1);
        $lat2Rad = deg2rad($lat2);
        $lon2Rad = deg2rad($lon2);
    
        $deltaLat = $lat2Rad - $lat1Rad;
        $deltaLon = $lon2Rad - $lon1Rad;
    
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($lat1Rad) * cos($lat2Rad) * sin($deltaLon / 2) * sin($deltaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        $distance = $earthRadius * $c;
    
        return $distance; // Distance in kilometers
    }

    protected function sendNotification($message, $fcm_token)
    {

        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            "to" => $fcm_token,
            "collapse_key" => "type_a",
            "notification" => array(
                "body" => $message['url'],
                "title" => $message['title'],
                "sub_title" => $message['sub_title'],
                "type" => $message['type'],
                "image" => $message['image'] . "?format=jpg&crop=4560,2565,x790,y784,safe&fit=crop",
                "action" => json_encode(array("view")),
            ),
            "data" => array(
                "body" => $message['url'],
                "title" => $message['title'],
                "sub_title" => $message['sub_title'],
                "type" => $message['type'],
                "action" =>json_encode(array("view")),
            ),
        );

        $fields = json_encode($fields, true);
        
        $headers = array('Authorization: key=' . env('FCM_SERVER_KEY'), 'Content-Type:  application/json');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }

}