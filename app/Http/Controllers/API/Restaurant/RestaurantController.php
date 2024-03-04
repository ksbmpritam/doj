<?php

namespace App\Http\Controllers\API\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\RestaurantAdmin;
use App\Models\Restaurant;
use App\Models\GalleryImage;
use App\Models\Restaurant_otp;
use App\Models\RestaurantDine;
use App\Models\DinnerBook;
use App\Models\Rating;
use App\Models\FoodRating;
use App\Models\RestaurantOffer;
use App\Models\RestaurantLike;
use App\Models\RestaurantWorkingHour;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\RestaurantRating;
use App\Models\RestaurantPhoto;
use App\Models\FoodLike;
use App\Models\Foods;
use App\Models\CustomerCover;
use App\Models\Notifications;
use App\Models\CoverImage;
use App\Models\Customer;
use App\Models\Order;

class RestaurantController extends Controller
{

    public function searchRestaurant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $search = $request->input('search');
        $type = $request->input('type');
    
        $restaurantsQuery = Restaurant::select('*')
            ->where('restaurant_status', 1);
    
        if (!empty($type) && $type == 1) {
            $restaurantsQuery->where('self_pickup', $type);
        }
    
        if (!empty($search)) {
            $restaurantsQuery->where('name', 'LIKE', '%' . $search . '%');
        }
    
        $restaurants = $restaurantsQuery->get(); // Remove the orderBy('distance') method call
    
        $restaurants->transform(function ($restaurant) {
            $restaurant->restaurant_image = asset('images/restaurants/' . $restaurant->image);
            return $restaurant;
        });
    
        return response()->json([
            'status' => true,
            'error' => false,
            'restaurant' => $restaurants,
        ]);
    }


    public function findNearestRestaurant(Request $request)
    {
        $query = Restaurant::query();
        
        $query->where('restaurant.restaurant_status', 1);
        
        if ($request->has('pure_veg')) {
            $query->where('restaurant.non_veg', $request->pure_veg);
        }
        
        $type = $request->input('type');
        
        if (!empty($type) && $type==1) {
            $query->where('restaurant.self_pickup', $type);
        }
    
        if ($request->has('latitude') && $request->has('longitude')) {
            $latitude = $request->latitude;
            $longitude = $request->longitude;
        
            $query->selectRaw("
                *, 
                6371 * acos(
                    cos(radians($latitude)) * cos(radians(latitude))
                    * cos(radians(longitude) - radians($longitude))
                    + sin(radians($latitude)) * sin(radians(latitude))
                ) AS distance
            ");
            $query->where('restaurant_status', 1);
        }
        
        if ($request->has('rating')) {
            $query->leftJoin('ratings', 'restaurant.id', '=', 'ratings.restaurant_id')
                ->select('restaurant.*', 'ratings.value as restaurant_rating')
                ->where('ratings.value', '>=', 4.1);
            $query->orderBy('ratings.value', 'desc');
        } elseif ($request->has('sort_by') && $request->sort_by === 'rating_high_to_low') {
            $query->leftJoin('ratings', 'restaurant.id', '=', 'ratings.restaurant_id')
                ->select('restaurant.*', 'ratings.value as restaurant_rating');
            $query->orderBy('ratings.value', 'desc');
        }
        
        // Order the results
        if ($request->has('latitude') && $request->has('longitude')) {
            $query->orderBy('distance');
        } elseif ($request->has('rating') || ($request->has('sort_by') && $request->sort_by === 'rating_high_to_low')) {
            $query->orderBy('restaurant_rating', 'desc');
        }

   
        

        
        if ($request->has('sort_by')) {
            $sortBy = $request->sort_by;
    
            if ($sortBy === 'cost_high_to_low') {
                $query->leftJoin('foods', 'restaurant.id', '=', 'foods.restaurant_id')
                    ->where('foods.status', 1)
                    ->select('restaurant.*')
                    ->orderBy('foods.price', 'desc');
            } elseif ($sortBy === 'cost_low_to_high') {
                $query->leftJoin('foods', 'restaurant.id', '=', 'foods.restaurant_id')
                    ->where('foods.status', 1)
                    ->select('restaurant.*')
                    ->orderBy('foods.price', 'asc');
            }
        }
        
        $restaurants = $query->distinct()->get();
        
        $restaurants->transform(function ($restaurant) {
                $restaurant->restaurant_image = asset('images/restaurants/' . $restaurant->image);
                $restaurant->restaurant_rating = round($restaurant->ratings->avg('value'), 2) ?? 0;
                unset($restaurant->ratings);
                return $restaurant;
            });
       
        return response()->json(['status' => true, 'data' => $restaurants]);
    }
    
   
    
    
    public function findNearestRestaurant_old(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',         
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $latitude = $request->latitude;
        $longitude = $request->longitude;
    
        $type = $request->input('type'); 
        $restaurantsQuery = Restaurant::select('*')
            ->selectRaw("6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude))) AS distance")
            ->where('restaurant_status', 1);
    
        if (!empty($type) && $type==1) {
            $restaurantsQuery->where('self_pickup', $type);
        }

        $restaurants = $restaurantsQuery->orderBy('distance')->get();
            
        $restaurants->transform(function ($restaurant) {
            $restaurant->restaurant_image = asset('images/restaurants/' . $restaurant->image);
            return $restaurant;
        });
    
        return response()->json([
            'status' => true,
            'error' => false,
            'nearestRestaurant' => $restaurants,
        ]);
    }

    public function book_dinner_list(Request $request) {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $restaurantId = $request->input('restaurant_id');
    
        $bookings = DinnerBook::with(['restaurant', 'users'])
            ->where('restaurant_id', $restaurantId)
            ->get();
    
        if ($bookings->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'No dinner bookings found for the restaurant']);
        }
    
        return response()->json(['status' => true, 'data' => $bookings]);
    }
    
    public function book_dinner_cancle_list(Request $request) {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $restaurantId = $request->input('restaurant_id');
    
        $bookings = DinnerBook::with(['restaurant', 'users'])
            ->where('status', -1)
            ->orwhere('status', 2)
            ->where('restaurant_id', $restaurantId)
            ->get();
    
        if ($bookings->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'No dinner bookings found for the restaurant']);
        }
    
        return response()->json(['status' => true, 'data' => $bookings]);
    }
    
    // public function book_dinner_cancle_list(Request $request) {
    //     $validator = Validator::make($request->all(), [
    //         'restaurant_id' => 'required',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response(['errors' => $validator->errors()->all()], 422);
    //     }
    
    //     $restaurantId = $request->input('restaurant_id');
    
    //     $bookings = DinnerBook::with(['restaurant', 'users'])
    //         ->where('status', -1)
    //         ->orwhere('status', 2)
    //         ->where('restaurant_id', $restaurantId)
    //         ->get();
    
    //     if ($bookings->isEmpty()) {
    //         return response()->json(['status' => false, 'message' => 'No dinner bookings found for the restaurant']);
    //     }
    
    //     return response()->json(['status' => true, 'data' => $bookings]);
    // }
    
    public function restaurant_like(Request $request){
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'restaurant_id' => 'required',
            'status' => 'required', 
        ]);
      
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $customer_id = $request->input('customer_id');
        $restaurant_id = $request->input('restaurant_id');
        $status = $request->input('status');
    
        $like = RestaurantLike::where('customer_id', $customer_id)
                     ->where('restaurant_id', $restaurant_id)
                     ->first();
    
        if (!$like) {
            $like = new RestaurantLike();
            $like->customer_id = $customer_id;
            $like->restaurant_id = $restaurant_id;
        }
    
        $like->status = $status;
        $like->save();

        return response(['message' => 'Restaurant liked successfully','status'=>true]);
    }
    
    public function restaurant_unlike(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'restaurant_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $customer_id = $request->input('customer_id');
        $restaurant_id = $request->input('restaurant_id');
    
        // Find and delete the like record if it exists
        $like = RestaurantLike::where('customer_id', $customer_id)
                         ->where('restaurant_id', $restaurant_id)
                         ->first();
    
        if ($like) {
            $like->delete();
            return response(['message' => 'Restaurant unliked successfully', 'status' => true]);
        } else {
            return response(['message' => 'Restaurant was not previously liked', 'status' => false]);
        }
    }

    public function accept_reject(Request $request) {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'status' => 'required|in:-1,1', 
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $bookingId = $request->input('booking_id');
        $newStatus = $request->input('status');
        $keep_time_hour = $request->input('keep_time_hour');
        $keep_time_minute = $request->input('keep_time_minute');
    
        $booking = DinnerBook::find($bookingId);
    
        if (!$booking) {
            return response()->json(['status' => false, 'message' => 'Booking not found']);
        }
    
        $booking->status = ($newStatus == 1) ? '1' : '-1';
        $booking->keep_time_hour =$keep_time_hour;
        $booking->keep_time_minute =$keep_time_minute;
        
        if ($booking->save()) {
            $message = [
                "url" => ($newStatus == 1) ? "Booking accepted" : "Booking Cancelled",
                "title" =>($newStatus == 1) ? "Booking accepted" : "Booking Cancelled",
                "sub_title" => ($newStatus == 1) ? "Booking accepted" : "Booking Cancelled",
                "type" => "dinner_booking",
                "image" => "",
            ];
            
            if (!empty($booking->restaurant_id)) {
                $restaurant_fcm = DB::table('restaurant_admin')->where('id', $booking->restaurant_id)->value('fcm_token');
                
                if (!empty($restaurant_fcm)) {
                    $res_data = $this->sendNotification($message, $restaurant_fcm);
                }
            }
            
            if (!empty($booking->user_id)) {
                $customer_fcm = DB::table('customer')->where('id', $booking->user_id)->value('fcm_token');
                
                if (!empty($customer_fcm)) {
                    $res_data = $this->sendNotification($message, $customer_fcm);
                }
            }
    
            $responseMessage = ($newStatus == 1) ? 'Booking accepted' : 'Booking cancelled';
    
            return response()->json(['status' => true, 'message' => $responseMessage]);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }

    public function update_self_pickup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'self_pickup' => 'required',
            'enable_date' => 'nullable|date',
            'enable_time' => 'nullable|date_format:H:i',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all(),'status'=>false], 422);
        }
        
        $newStatus = $request->input('self_pickup');
        $enable_date = $request->input('enable_date');
        $enable_time = $request->input('enable_time');
        
        $update = Restaurant::find($request->id);
        
        if (!$update) {
            return response()->json(['status' => false, 'message' => 'Restaurant not found']);
        }
        
        if ($newStatus == 1) {
            $update->self_pickup = 1;
            $update->enable_self_pickup_date = null;
            $update->enable_self_pickup_time = null;
        } else {
            
            $update->self_pickup = 0;
        
            if (!empty($enable_date)) {
                $update->enable_self_pickup_date = $enable_date;
            }
            
            if (!empty($enable_time)) {
                $update->enable_self_pickup_time = $enable_time;
            }
        }
        
        if ($update->save()) {
            return response()->json(['status' => true, 'message' => 'Self Pickup updated successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    
    public function update_dine(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'enable_dine' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all(),'status'=>false], 422);
        }
    
        $restaurant = Restaurant::find($request->id);
    
        if ($restaurant) {
            $restaurant->enable_dine = $request->enable_dine;
         
            $restaurant->save();
    
            return response([
                'message' => 'update successfully',
                'status'=>true,
                'data'=>$restaurant,
            ]);
        } else {
            return response(['message' => 'User with the given ID not found','status'=>false]);
        }
    }
   
    public function update_restaurant_status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
            'restaurant_status' => 'required|in:0,1',
            'enable_date' => 'nullable|date',
            'enable_time' => 'nullable|date_format:H:i',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $restaurant_id = $request->input('restaurant_id');
        $newStatus = $request->input('restaurant_status');
        $enable_date = $request->input('enable_date');
        $enable_time = $request->input('enable_time');
    
        $update = Restaurant::find($restaurant_id);
    
        if (!$update) {
            return response()->json(['status' => false, 'message' => 'Restaurant not found']);
        }
    
        if ($newStatus == 1) {
            $update->restaurant_status = 1;
            $update->restaurant_enable_date = null;
            $update->resturant_enable_time = null;
        } else {
            
            $update->restaurant_status = 0;
        
            if (!empty($enable_date)) {
                $update->restaurant_enable_date = $enable_date;
            }
            
            if (!empty($enable_time)) {
                $update->resturant_enable_time = $enable_time;
            }
          
        }
    
        if ($update->save()) {
            return response()->json(['status' => true, 'message' => 'Restaurant updated successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }


    public function restaurant_rating(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'restaurant_id' => 'required',
            'value' => 'required',
            'order_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $customer_id = $request->input('customer_id');
        $restaurant_id = $request->input('restaurant_id');
        $value = $request->input('value');
        $order_id = $request->input('order_id');
        
        $existingRating = Rating ::where('customer_id', $customer_id)
                            ->where('restaurant_id', $restaurant_id)
                            ->where('order_id', $order_id)
                            ->first();
        
        if ($existingRating) {
            $existingRating->value = $value;
            $existingRating->status = 1;
            $existingRating->save();
            return response(['message' => 'Restaurant rating updated  successfully', 'status' => true]);
        } else {
            Rating::create([
                'customer_id' => $customer_id,
                'restaurant_id' => $restaurant_id,
                'value' => $value,
                'order_id' => $order_id,
                'status' => 1,
            ]);
            
            return response(['message' => 'Restaurant rating added successfully', 'status' => true]);
        }
    }

   
    public function food_rating(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'food_id' => 'required',
            'value' => 'required',
            'order_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $customer_id = $request->input('customer_id');
        $food_id = $request->input('food_id');
        $value = $request->input('value');
        $order_id = $request->input('order_id');
        
        $existingRating = FoodRating ::where('customer_id', $customer_id)
                            ->where('food_id', $food_id)
                             ->where('order_id', $order_id)
                            ->first();
    
        if ($existingRating) {
            $existingRating->value = $value;
            $existingRating->status = 1;
            $existingRating->save();
            return response(['message' => 'Food rating updated  successfully', 'status' => true]);
        } else {
            
            FoodRating::create([
                'customer_id' => $customer_id,
                'food_id' => $food_id,
                'value' => $value,
                'order_id' => $order_id,
                'status' => 1,
            ]);
    
            return response(['message' => 'Food rating added successfully', 'status' => true]);
        }
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
                "action" => json_encode(array("view")),
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
    
    
    
    public function restaurantRating(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'restaurant_id' => 'required',
            'value' => 'required',
            'select_review' => 'required',
            // 'image' => 'nullable',
            'image' => 'required|array', // Define 'value' as an array
            'image.*' => 'required|string',
            'mark' => 'required',
            'review_description' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $customer_id = $request->input('customer_id');
        $restaurant_id = $request->input('restaurant_id');
        $value = $request->input('value');
        $mark = $request->input('mark');
        $select_review = $request->input('select_review');
        $review_description = $request->input('review_description');
        // $image = $request->input('image');
        $image = json_encode($request->input('image'));
        
        $existingRating = RestaurantRating::where('customer_id', $customer_id)
                            ->where('restaurant_id', $restaurant_id)
                            ->first();
        
        if ($existingRating) {
            $existingRating->value = $value;
            $existingRating->mark = $mark;
            $existingRating->image = $image ?? '';
            $existingRating->select_review = $select_review;
            $existingRating->review_description = $review_description;
            $existingRating->status = 1;
            $existingRating->save();
            return response(['message' => 'Restaurant rating updated  successfully', 'status' => true]);
        } else {
            RestaurantRating::create([
                'customer_id' => $customer_id,
                'restaurant_id' => $restaurant_id,
                'value' => $value,
                'select_review' => $select_review,
                'mark' => $mark,
                'image' => $image ?? '',
                'review_description' => $review_description,
                'status' => 1,
            ]);
            
            return response(['message' => 'Restaurant rating added successfully', 'status' => true]);
        }
    }
    
    // public function restaurantRatingList(Request $request) {
    //     $validator = Validator::make($request->all(), [
    //         'customer_id' => 'required',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()->all()], 422);
    //     }
    
    //     $list = RestaurantRating::where('customer_id', $request->customer_id)->get();
        
    //     // if ($list->isEmpty()) {
    //     //     return response()->json([
    //     //         'status' => false,
    //     //         'message' => 'Customer not found.'
    //     //     ], 404);
    //     // } else {
    //         return response()->json([
    //             'status' => true,
    //             'restaurant_lists' => $list,
    //         ], 200);
    //     // }
    // }
    public function restaurantRatingList(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
    
        $list = RestaurantRating::where('customer_id', $request->customer_id)->get();
    
        // Decode the JSON string in the 'image' attribute
        $list->transform(function ($item, $key) {
            $item->image = json_decode($item->image);
            return $item;
        });
    
        return response()->json([
            'status' => true,
            'restaurant_lists' => $list,
        ], 200);
    }

    
    public function restaurantRatingDelete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
    
        $rating = RestaurantRating::find($request->id);
    
        if (!$rating) {
            return response()->json([
                'status' => false,
                'message' => 'Restaurant Rating not found.'
            ], 404);
        } else {
            $rating->delete();
            return response()->json([
                'status' => true,
                'message' => 'Restaurant Rating deleted successfully.',
            ], 200);
        }
    }
    
    # Photo Review Start
    public function restaurantRatingPhoto(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'restaurant_id' => 'required',
            'image' => 'required|array',
            'image.*' => 'required|string',
            'caption' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $customer_id = $request->input('customer_id');
        $restaurant_id = $request->input('restaurant_id');;
        $caption = $request->input('caption');
        $image = json_encode($request->input('image'));
        
        $existingRating = RestaurantPhoto::where('customer_id', $customer_id)
                            ->where('restaurant_id', $restaurant_id)
                            ->first();
        
        if ($existingRating) {
            $existingRating->image = $image ?? '';
            $existingRating->caption = $caption;
            $existingRating->status = 1;
            $existingRating->save();
            return response(['message' => 'Restaurant photo updated  successfully', 'status' => true]);
        } else {
            RestaurantPhoto::create([
                'customer_id' => $customer_id,
                'restaurant_id' => $restaurant_id,
                'image' => $image ?? '',
                'caption' => $caption,
                'status' => 1,
            ]);
            
            return response(['message' => 'Restaurant photo added successfully', 'status' => true]);
        }
    }
    
    // public function restaurantRatingListPhoto(Request $request) {
    //     $validator = Validator::make($request->all(), [
    //         'customer_id' => 'required',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()->all()], 422);
    //     }
        
    //     $list = RestaurantPhoto::where('customer_id', $request->customer_id)->get();
    //     return response()->json([
    //         'status' => true,
    //         'restaurant_photo' => $list,
    //     ], 200);
    // }
    public function restaurantRatingListPhoto(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
        
        $list = RestaurantPhoto::where('customer_id', $request->customer_id)->get();
    
        // Decode the JSON string in the 'image' attribute
        $list->transform(function ($item, $key) {
            $item->image = json_decode($item->image);
            return $item;
        });
    
        return response()->json([
            'status' => true,
            'restaurant_photo' => $list,
        ], 200);
    }

    
    public function restaurantRatingDeletePhoto(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
    
        $rating = RestaurantPhoto::find($request->id);
    
        if (!$rating) {
            return response()->json([
                'status' => false,
                'message' => 'Restaurant Photo not found.'
            ], 404);
        } else {
            $rating->delete();
            return response()->json([
                'status' => true,
                'message' => 'Restaurant Photo deleted successfully.',
            ], 200);
        }
    }
    
    
    # Liked Food List
    public function food_like(Request $request){
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'food_id' => 'required',
            'status' => 'required', 
        ]);
      
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $customer_id = $request->input('customer_id');
        $food_id = $request->input('food_id');
        $status = $request->input('status');
    
        $like = FoodLike::where('customer_id', $customer_id)
                     ->where('food_id', $food_id)
                     ->first();
    
        if (!$like) {
            $like = new FoodLike();
            $like->customer_id = $customer_id;
            $like->food_id = $food_id;
        }
    
        $like->status = $status;
        $like->save();

        return response(['message' => 'Food liked successfully','status'=>true]);
    }
    
    public function food_unlike(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'food_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $customer_id = $request->input('customer_id');
        $food_id = $request->input('food_id');
    
        // Find and delete the like record if it exists
        $like = FoodLike::where('customer_id', $customer_id)
                         ->where('food_id', $food_id)
                         ->first();
    
        if ($like) {
            $like->delete();
            return response(['message' => 'Food unliked successfully', 'status' => true]);
        } else {
            return response(['message' => 'Food was not previously liked', 'status' => false]);
        }
    }
    
    public function get_food_like(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|integer',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        $customer_id = $request->input('customer_id'); 
        $userLikes = FoodLike::with('food')->where('customer_id', $customer_id)->get();
        
        $status = $userLikes->isEmpty() ? false : true;

        return response()->json(['userLikes' => $userLikes,'status'=>$status]);
    }
    
    
    # Covver Image
    public function coverCreateUpdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'cover_image' => 'required', 
        ]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
    
        $customer_id = $request->input('customer_id');
        $image = $request->input('cover_image');
        $existingRating = Customer::find($customer_id);
        // $existingRating = CustomerCover::where('customer_id', $customer_id)->first();
        if ($existingRating) {
            $existingRating->cover_image = $image ?? '';
            $existingRating->save();
            return response(['message' => 'Customer Cover image Updated  successfully', 'status' => true]);
        } else {
            // CustomerCover::create([
            //     'customer_id' => $customer_id,
            //     'cover_image' => $image ?? '',
            // ]);
            return response(['message' => 'Customer not found', 'status' => false]);
            // return response(['message' => 'Customer Cover image Create successfully', 'status' => true]);
        }
    }
    
    public function coverlist(Request $request) {
        $list = CoverImage::where('status', 1)->get();
        $list->transform(function ($list) {
            $list->cover_photo_url = asset('images/cover_image/' . $list->banner_photo);
            return $list;
        });
        return response()->json([
            'status' => true,
            'customer_cover' => $list,
        ], 200);
    }

    public function coverDelete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
        $rating = CustomerCover::find($request->id);
        if (!$rating) {
            return response()->json([
                'status' => false,
                'message' => 'Customer cover image not found.'
            ], 404);
        } else {
            $rating->delete();
            return response()->json([
                'status' => true,
                'message' => 'Customer cover image deleted successfully.',
            ], 200);
        }
    }
    
    # Notification Customer
    public function get_customer_notification(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
        $notification = Notifications::where(function($query) use ($request) {
        $query->where('sender_id', $request->customer_id)
              ->orWhere('sender_id', 0);
    })
    ->where('role', 'customer')
    ->get();

        return response()->json([
            'status' => true,
            'notification' => $notification,
        ], 200);
    }
    
}
