<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductsOffers;
use App\Models\Foods;
use App\Models\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\TodaySpecial;
use App\Models\Rating;
use App\Models\UsersOffer;
use Carbon\Carbon;


class DashboardController extends Controller
{
   public function get_product_offer()
    {
        try {
            $offer = ProductsOffers::where('status', 1)->first();
            $foods = Foods::where('publish', 1)->get();
    
            if ($foods->isEmpty()) {
                return response()->json(['offer' => []], JsonResponse::HTTP_OK);
            }
    
            $matchingFoods = $foods->filter(function ($food) use ($offer) {
                $food->discounted_price_percentage = $this->calculateDiscountedPrice($food->price, $food->discount);
                return $food->discounted_price_percentage == $offer->discount;
            });
    
            // Extract the matching foods into a plain array and re-index the array
            $matchingFoodsArray = $matchingFoods->values()->toArray();
    
            return response()->json(['offer' => $matchingFoodsArray], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching products.'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
    private function calculateDiscountedPrice($originalPrice, $discountPercentage)
    {
        $discountedPrice = ($originalPrice - $discountPercentage) / $originalPrice;
        return round($discountedPrice * 100);
    }
    
    
    public function emptyStocksProduct(Request $request) {
        $validator = validator($request->all(), [
            'restaurant_id' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        try {
            $restaurant_id = $request->input('restaurant_id');
    
            $emptyStockFoods = Foods::where('publish', 1)
                ->where('restaurant_id', $restaurant_id)
                ->where('item_quantity', '<', 1)
                ->get();
    
            $emptyStockCount = $emptyStockFoods->count();
    
    
             $lowStockFoods = Foods::where('publish', 1)
                ->where('restaurant_id', $restaurant_id)
                ->where('item_quantity', '<', 10)
                ->where('item_quantity', '>', 0)
                ->get();
                
            $lowStockCount = $lowStockFoods->count();

            return response()->json([
                'empty_stock_count' => $lowStockCount,
                'empty_stock_foods' => $lowStockFoods,
                'low_stock_count' => $lowStockCount,
                'low_stock_foods' => $lowStockFoods,
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching products.'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function getTotalEarning(Request $request)
    {
        $validator = validator($request->all(), [
            'restaurant_id' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        try {
            $restaurant = Restaurant::find($request->restaurant_id);
    
            if (!$restaurant) {
                return response()->json(['restaurant' => []], JsonResponse::HTTP_OK);
            }
    
            $todayOrders = Order::where('restaurant_id', $request->restaurant_id)
                ->where('date', now()->toDateString())
                ->where('code', 'PAYMENT_SUCCESS')
                ->get();
    
            $historyOrders = Order::where('restaurant_id', $request->restaurant_id)
                ->where('code', 'PAYMENT_SUCCESS')
                ->get();
    
            $totalAmount = $todayOrders->sum('amount');
    
            $res = [
                'today_earning' => $todayOrders,
                'history_earning' => $historyOrders,
                'today_earning_sum' => $totalAmount,
                'wallet_amount' => ($restaurant->wallet_amount ?? 0),
            ];
    
            return response()->json(['data' => $res], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching restaurant.'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    
    
    public function nearestRestaurant(Request $request)
    {
        $validator = validator($request->all(), [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        $query = Restaurant::query();
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $user_id = $request->user_id;
    
        $query->where('restaurant_status', 1);
    
        if ($request->has('latitude') && $request->has('longitude')) {
            $query->selectRaw("
                *, 6371 * acos(
                    cos(radians($latitude)) * cos(radians(latitude))
                    * cos(radians(longitude) - radians($longitude))
                    + sin(radians($latitude)) * sin(radians(latitude))
                ) AS distance
            ");
            $query->where('restaurant_status', 1);
            $query->orderBy('distance');
        }
    
        $restaurants = $query->distinct()->get();
    
        $restaurants->transform(function ($restaurant) {
            $restaurant->restaurant_image = asset('images/restaurants/' . $restaurant->image);
            return $restaurant;
        });
    
        return response()->json(['status' => true, 'data' => $restaurants]);
    }

     
    public function getTodaySpecial(){
        $todaySpecial = TodaySpecial::where('status', 1)->whereDate('created_date', now()->format('Y-m-d'))->first();
    
        if ($todaySpecial && $todaySpecial->food_id) {
            $food_ids = explode(',', $todaySpecial->food_id);
    
            $foods = Foods::whereIn('id', $food_ids)
                ->where('publish', 1)
                ->get();
    
            $foods->transform(function ($food) {
                $food->food_image = asset('images/foods/' . $food->images);
                $food->non_veg = $food->non_veg??0;
                return $food;
            });
            
        
            
            if($foods){
                $todaySpecial->food=$foods;
            }
            
            return response()->json(['status' => true, 'data' => $todaySpecial]);
        } else {
            return response()->json(['status' => false, 'data' => '']);
        }
    }

  
    public function getRestaurantByRating()
    {
        $restaurants = Rating::select('restaurant_id', DB::raw('SUM(value) as total_rating'))
            ->groupBy('restaurant_id')
            ->orderByDesc('total_rating')
            ->get();
    
        $restaurantIds = $restaurants->pluck('restaurant_id');
    
        $orderedRestaurants = Restaurant::whereIn('id', $restaurantIds)
            ->where('restaurant_status', 1)
            ->select('name', 'id', 'image')
            ->orderByDesc(function ($query) use ($restaurantIds) {
                $query->whereIn('id', $restaurantIds)
                    ->select(DB::raw('SUM(value) as total_rating'))
                    ->from('ratings')
                    ->whereColumn('restaurant_id', 'restaurant.id')
                    ->groupBy('restaurant_id');
            })
            ->get();
    
        // Transform the result to include the full image path and ratings
        $orderedRestaurants->transform(function ($restaurant) use ($restaurantIds) {
            $restaurant->restaurant_image = asset('images/restaurants/' . $restaurant->image);
            $restaurant->total_rating = $this->getAverageRating($restaurant->id, $restaurantIds);
            return $restaurant;
        });
    
        // Check if there are any restaurants
        if ($orderedRestaurants->isNotEmpty()) {
            return response()->json(['status' => true, 'data' => $orderedRestaurants]);
        } else {
            return response()->json(['status' => false, 'data' => '']);
        }
    }
    
    // Helper function to get total rating for a restaurant
    private function getAverageRating($restaurantId, $restaurantIds)
    {
        $totalRating = Rating::whereIn('restaurant_id', $restaurantIds)
            ->where('restaurant_id', $restaurantId)
            ->sum('value');
    
        $numberOfRatings = Rating::whereIn('restaurant_id', $restaurantIds)
            ->where('restaurant_id', $restaurantId)
            ->count();
    
        if ($numberOfRatings > 0) {
            return $totalRating / $numberOfRatings;
        } else {
            return 0;
        }
    }


    public function getPopularProduct()
    {
        $restaurants = Rating::select('restaurant_id', DB::raw('SUM(value) as total_rating'))
            ->groupBy('restaurant_id')
            ->orderByDesc('total_rating')
            ->get();
    

        $restaurantIds = $restaurants->pluck('restaurant_id');
        
        $orderedRestaurants = Restaurant::whereIn('id', $restaurantIds)
            ->where('restaurant_status',1)
            ->select('name','id','image')
            ->get();
    
    
        $orderedRestaurants->transform(function ($restaurant) {
            $restaurant->restaurant_image = asset('images/restaurants/' . $restaurant->image);
            return $restaurant;
        });
        
        if ($orderedRestaurants->isNotEmpty()) {
            return response()->json(['status' => true, 'data' => $orderedRestaurants]);
        } else {
            return response()->json(['status' => false, 'data' => '']);
        }
    }
    
    
    public function getOfferForYou(Request $request)
    {
        $validator = validator($request->all(), [
            'user_id' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user_id = $request->user_id;
        
        $rusersOffers = UsersOffer::where('status', 1)->where('user_id',$user_id)->select('id', 'title', 'image', 'user_id','food_id','status','opening_date','opening_time','closing_date','closing_time')->get();
    
        $rusersOffers->transform(function ($offers) {
            $offers->image = asset('images/user_offer/' . $offers->image);
            
            
            $offers->foods = Foods::whereIn('id', explode(',', $offers->food_id))
            ->where('status', 1)
            ->get();

            $offers->foods->transform(function ($food) {
                $food->images = asset('images/foods/' . $food->images);
                return $food;
            });
            
            
            return $offers;
        });
            
    
        if ($rusersOffers->isNotEmpty()) {
            return response()->json(['status' => true, 'data' => $rusersOffers]);
        } else {
            return response()->json(['status' => false, 'data' => '']);
        }
    }


    public function mostSoldProductLast7Days()
    {
        $sevenDaysAgo = Carbon::now()->subDays(7);
    
        $result = DB::table('order_item')
            ->join('orders', 'order_item.order_id', '=', 'orders.id')
            ->where('orders.created_at', '>=', $sevenDaysAgo)
            ->groupBy('order_item.food_id')
            ->selectRaw('SUM(order_item.quantity) as total_quantity, order_item.food_id')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();
        
        if ($result->isNotEmpty()) {
            $foods = [];
            $j = 1;
            foreach ($result as $res) {
                if ($res->food_id) {
                    $food = Foods::where('id', $res->food_id)
                        ->select('id','name', 'price', 'discount', 'category_id', 'images', 'non_veg')
                        ->first();
    
                    if ($food) {
                         
                        $foodData = [
                            'total_quantity' => $res->total_quantity,
                            'food' => $food,
                            'id_inc' => $j++,
                        ];
    
                        $foodData['food']->images = asset('images/foods/' . $food->images);
                        $foodData['food']->non_veg = $food->non_veg??0;;
    
                        $foods[] = $foodData;
                    }
                }
            }
    
            return response()->json(['status' => true, 'data' => $foods]);
        } else {
            return response()->json(['status' => false, 'data' => []]);
        }
    }


    public function orderTransactions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user_id = $request->user_id;

        $orders = Order::with(['driver', 'users','restaurant'])->where('user_id', $user_id)->get();

        $orders->transform(function ($order) {
            $order->invoice_pdf = asset('orders/invoice/' . $order->invoice_pdf);
            return $order;
        });

        if ($orders->isNotEmpty()) {
            return response()->json(['status' => true, 'data' => $orders]);
        } else {
            return response()->json(['status' => false, 'data' => []]);
        }
    }
    
    
    public function restaurantOrderTransactions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $restaurant_id = $request->restaurant_id;

        $orders = Order::with(['driver', 'users','restaurant'])->where('restaurant_id', $restaurant_id)->get();

        $orders->transform(function ($order) {
            $order->invoice_pdf = asset('orders/invoice/' . $order->invoice_pdf);
            return $order;
        });

        if ($orders->isNotEmpty()) {
            return response()->json(['status' => true, 'data' => $orders]);
        } else {
            return response()->json(['status' => false, 'data' => []]);
        }
    }


    
    
}