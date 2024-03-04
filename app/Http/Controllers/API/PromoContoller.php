<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Carbon\Carbon;
DB::enableQueryLog();
use App\Models\PrmoCodekilometer;
use App\Models\PrmocodeKilometerUser;
use App\Models\PrmocodeKilometerRestaurant;
use App\Models\PromoCodes;
use App\Models\UsersPromo;
use App\Models\Restaurant;
use App\Models\RestaurantPromo;

class PromoContoller extends Controller
{
    public function promo_codes(Request $request){
        
       $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'resturant_id' => 'required',
            'product_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
        $resturant_id = $request->input('resturant_id');
        $customer_id = $request->input('customer_id');
        $product_id = $request->input('product_id');
        
        $currentDate = Carbon::now();
        
            $customer = DB::table('customer')
                                ->where('id', $customer_id)
                                ->select('latitude', 'longitude')
                                ->first();
                           
            $restaurant = DB::table('restaurant')
                                ->where('id', $resturant_id)
                                ->select('latitude', 'longitude')
                                ->first();
                                
            // dd($restaurant);
            $latitude1 = $customer->latitude ?? ''; // Latitude of point 1
            $longitude1 = $customer->longitude ?? '' ; // Longitude of point 1
            $latitude2 = $restaurant->latitude ?? '' ; // Latitude of point 2
            $longitude2 = $restaurant->longitude ?? '' ; // Longitude of point 2
            // echo $latitude1.'--'.$longitude1.'----'.$latitude2.'--'.$longitude2; die;
            //   $distance = DB::select(DB::raw('
            //         SELECT 
            //             (6371 * acos(cos(radians('.$latitude1.')) 
            //             * cos(radians('.$latitude2.')) 
            //             * cos(radians('.$longitude2.') 
            //             - radians('.$longitude1.')) 
            //             + sin(radians('.$latitude1.')) 
            //             * sin(radians('.$latitude2.')))) AS distance
            //     '));
               
            //     dd($distance);
            $distance = DB::select(DB::raw('
                SELECT 
                    (6371 * acos(cos(radians(?)) 
                    * cos(radians(?)) 
                    * cos(radians(?)
                    - radians(?)) 
                    + sin(radians(?)) 
                    * sin(radians(?)))) AS distance
            '), [$latitude1, $latitude2, $longitude2, $longitude1, $latitude1, $latitude2]);
            
            // dd($distance);

            $PromoCodes = DB::table('promo_code')
              ->where('promo_code.status', '1')
              ->where('restaurant_promo.accept_by', '1')
              ->where('restaurant_promo.status', '1')
              ->where('restaurant_promo.restaurant_id', $resturant_id)
              ->where('users_promo.user_id', $customer_id)
              ->whereDate('promo_code.start_date', '<=', $currentDate)
              ->join('users_promo', 'promo_code.id', '=', 'users_promo.promo_code_id')
              ->join('restaurant_promo', 'promo_code.id', '=', 'restaurant_promo.promo_code_id')
              ->select('promo_code.*', 'users_promo.count_used' )
              ->get();
              
              $collection_PromoCode = [];
              
                 foreach($PromoCodes as $PromoCode){
                   
                  if( $PromoCode->end_date >= $currentDate && $PromoCode->active_dates != 'always_active' ){
                      if($PromoCode->limited_usage > $PromoCode->count_used && $PromoCode->coupon_usage != 'unlimited' ){
                          $collection_PromoCode[] = $PromoCode;
                      }elseif($PromoCode->coupon_usage == 'unlimited'){
                          $collection_PromoCode[] = $PromoCode;
                      }
                      
                  }elseif( $PromoCode->active_dates == 'always_active' ){
                       if($PromoCode->limited_usage > $PromoCode->count_used && $PromoCode->coupon_usage != 'unlimited' ){
                          $collection_PromoCode[] = $PromoCode;
                      }elseif($PromoCode->coupon_usage == 'unlimited'){
                          $collection_PromoCode[] = $PromoCode;
                      }
                  }
              }
            
             // dd($distance[0]->distance);
            
           $promo_code_kilometers = DB::table('promo_code_kilometers')
                                    ->join('km_users_promo', 'promo_code_kilometers.id', '=', 'km_users_promo.promo_code_kilometers_id')
                                    ->join('km_restaurant_promo', 'promo_code_kilometers.id', '=', 'km_restaurant_promo.promo_code_kilometers_id')
                                    ->where('promo_code_kilometers.status', '1')
                                    ->where('km_restaurant_promo.accept_by', '1')
                                    ->where('km_restaurant_promo.status', '1')
                                    ->where('promo_code_kilometers.kilometter', '>=', $distance[0]->distance)
                                    ->where('km_restaurant_promo.restaurant_id', $resturant_id)
                                    ->where('km_users_promo.user_id', $customer_id)
                                    ->whereDate('promo_code_kilometers.start_date', '<=', $currentDate)
                                    ->whereDate('promo_code_kilometers.end_date', '>=', $currentDate)
                                    ->select('promo_code_kilometers.*', 'km_users_promo.count_used')
                                    ->get();

            $collection_promo_code_kilometers = [];
              
                 foreach($promo_code_kilometers as $promo_code_kilometer){
                      if($promo_code_kilometer->limited_usage > $promo_code_kilometer->count_used && $promo_code_kilometer->coupon_usage != 'unlimited' ){
                          $collection_promo_code_kilometers[] = $promo_code_kilometer;
                      }elseif($promo_code_kilometer->coupon_usage == 'unlimited'){
                          $collection_promo_code_kilometers[] = $promo_code_kilometer;
                      }
              }
              
            //   dd($collection_promo_code_kilometers);
            
             $food_promocodes = DB::table('food_promocode')
             ->where('food_promocode.status', '1')
             ->where('food_restaurant_promo.accept_by', '1')
             ->where('food_restaurant_promo.status', '1')
             ->where('food_restaurant_promo.restaurant_id', $resturant_id)
             ->where('food_users_promo.user_id', $customer_id)
             ->where('food_product_promo.product_id', $product_id)
             ->whereDate('food_promocode.end_date', '>=', $currentDate)
             ->whereDate('food_promocode.start_date', '<=', $currentDate)
             ->join('food_users_promo', 'food_promocode.id', '=', 'food_users_promo.food_promocode_id')
             ->join('food_restaurant_promo', 'food_promocode.id', '=', 'food_restaurant_promo.food_promocode_id')
             ->join('food_product_promo', 'food_promocode.id', '=', 'food_product_promo.food_promocode_id')
             ->select('food_promocode.*', 'food_users_promo.count_used')
             ->get();
             
             
            
              $collection_food_promocode = [];
              
                 foreach($food_promocodes as $food_promocode){
                      if($food_promocode->limited_usage > $food_promocode->count_used && $food_promocode->coupon_usage != 'unlimited' ){
                          $collection_food_promocode[] = $food_promocode;
                      }elseif($food_promocode->coupon_usage == 'unlimited'){
                          $collection_food_promocode[] = $food_promocode;
                      }
              }
              
            // dd($collection_food_promocode);
            // dd($customer_id);
            
             $order_wise_promocodes = DB::table('order_wise_promocode')
             ->where('order_wise_promocode.status', '1')
             ->where('order_users_promo.user_id', $customer_id)
             ->whereDate('order_wise_promocode.end_date', '>=', $currentDate)
             ->whereDate('order_wise_promocode.start_date', '<=', $currentDate)
             ->join('order_users_promo', 'order_wise_promocode.id', '=', 'order_users_promo.order_wise_promocode_id')
             ->select('order_wise_promocode.*','order_users_promo.count_used')
             ->get();
 
 
                  $collection_order_wise_promocode = [];
              
                 foreach($order_wise_promocodes as $order_wise_promocode){
                      if($order_wise_promocode->limited_usage > $order_wise_promocode->count_used && $order_wise_promocode->coupon_usage != 'unlimited' ){
                          $collection_order_wise_promocode[] = $order_wise_promocode;
                      }elseif($order_wise_promocode->coupon_usage == 'unlimited'){
                          $collection_order_wise_promocode[] = $order_wise_promocode;
                      }
                     }
              
        // dd($collection_order_wise_promocode);
      
        // $data = array(
        //     'collection_PromoCode' => $collection_PromoCode,
        //     'collection_promo_code_kilometers' => $collection_promo_code_kilometers,
        //     'collection_food_promocode' => $collection_food_promocode,
        //     'collection_order_wise_promocode' => $collection_order_wise_promocode,
        //     );
        
        // return response()->json($data, Response::HTTP_OK);
        
        $data = [
            'mergedCollection' => array_merge(
                $collection_PromoCode,
                $collection_promo_code_kilometers,
                $collection_food_promocode,
                $collection_order_wise_promocode
            ),
        ];
        
        return response()->json($data, Response::HTTP_OK);


    }
    
    
    //*********************************Start Code for Promo Code ******************************************//
    
    
    // public function user_promo_code(Request $request)
    // {
    //     $user_id = '';
    //      $validator = Validator::make($request->all(), [
    //         'user_id' => 'required',
    //         'promo_code'=>'required|string',
    //         'promo_type'=>'required'
    //     ]);
        
    //     if ($validator->fails()) {
    //         return response(['errors' => $validator->errors()->all()], 422);
    //     };
        
    //     $currentDate = Carbon::now();
        
    //     $user_id = $request->input('user_id');
    //     $promo_code = $request->input('promo_code');
    //     $promo_type = $request->input('promo_type');
    //     $latitude = $request->input('latitude');
    //     $longitude = $request->input('longitude');
        
        
    //     $user_id = Customer::where('id', $user_id)->select('id')->get();
    //     $user_lat = $user->latitude;
    //     $user_long = $user->longitude;
        
 
        
    //     $promo_id = '';
    //     $promo_code_kilometer_id = '';
         
    //     if($promo_code)
    //     {
    //     $promo_code_id = PromoCodes::where('promo_code', $promo_code)->first();
    //     $promo_id = $promo_code_id->id;
    //     }
        
    //     if($promo_type == 'promocode' )
        
    //     {
    //         $promoCodes = PromoCodes::whereHas('users_promo', function ($query) use ($user_id) {
    //             $query->where('user_id', $user_id);})->where('id', $promo_id)->where('status', '1')->whereDate('start_date', '<=', $currentDate)
    //         ->get();
    //     }
    //     elseif($promo_type == 'kilometerpromocode')
    //     {

    //       $kilometerpromo = PrmoCodekilometer::where('promo_code', $promo_code)->first();
    //       $promo_code_kilometers_id = $kilometerpromo->id;
           
    //       $kmPromoCodes = PrmoCodekilometer::where('id',$promo_code_kilometers_id)
    //                       ->where('status','1')->whereDate('start_date', '<=', $currentDate)->get();
           
    //     }
    //     elseif($promo_type == 'foodpromocode')
    //     {
    //         $foodPromoCodes == '';
    //     }
    //     elseif($promo_type == 'orderpromocode')
    //     {
    //         $orderPromoCode = '';
    //     }
        
        
        
    //      $data = array(
    //         'PromoCode' => $promoCodes,
    //         'KmPromoCode'=>$kmPromoCodes,
    //         'FoodPromoCode'=>$foodPromoCodes,
    //         'OrderPromoCode'=>'$orderPromoCode'
    //         );
        
    //     return response()->json($data, Response::HTTP_OK);
           
    // }
    
    
    public function promo_code_list(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'resturant_id' => 'required',
            'product_id' => 'required',
            'latitude'=>'required',
            'longitude'=>'required'
        ]);
        
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        };
        
            $user_id = $request->input('user_id');
            $resturant_id = $request->input('resturant_id');
            $product_id = $request->input('product_id');
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
        
            // echo $resturant_id;
            // die();
        
          $current_date =  Carbon::now();   
            $promo_code=[];
          if($user_id)
          {
              $user_data = PrmocodeKilometerUser::where('user_id', $user_id)->get();
              foreach($user_data as $promo_data){
                  
                  $promo_code = PrmoCodekilometer::where('id',$promo_data->promo_code_kilometers_id)->first();
                  $promo_code=[
                      'km_promo'=>$promo_code
                    
                    ];
              }
          }
          
        //   if($resturant_id)
        //   {
        //       $resturant_data = PrmocodeKilometerRestaurant::where('restaurant_id', $resturant_id)->get();
        //   }
        
        //   $distance = Restaurant::select(
        //             DB::raw("6371 * acos(cos(radians(" . $latitude . ")) 
        //             * cos(radians(restaurant.latitude)) 
        //             * cos(radians(restaurant.longitude) - radians(" . $longitude . ")) 
        //             + sin(radians(" .$latitude. ")) 
        //             * sin(radians(restaurant.latitude))) AS distance"))
        //             ->where('restaurant.id', $restaurant->id)
        //             ->first();
                    
        //  $total_distance = number_format($distance->distance, 2);  
  
        //  $kilo_meter_promo_codes = PrmoCodekilometer::select('promo_code_kilometers.*')
        // ->whereDate('promo_code_kilometers.start_date', '<=', $current_date)
        // ->where('promo_code_kilometers.status', '1')
        // ->where('promo_code_kilometers.kilometter', '<=', $total_distance)
        // ->join('km_restaurant_promo', 'km_restaurant_promo.promo_code_kilometers_id', '=', 'promo_code_kilometers.id')
        // ->where('km_restaurant_promo.restaurant_id', $resturant_id)
        // ->where('km_restaurant_promo.accept_by', 1)
        // ->join('km_users_promo', 'km_users_promo.promo_code_kilometers_id', '=', 'promo_code_kilometers.id')
        // ->where('km_users_promo.user_id', $user_id)
        // ->get();                
                    
                return response()->json($promo_code, Response::HTTP_OK);

      
      }
    
    
   
    
     //*********************************End Code here for Promo Code ******************************************//
}
