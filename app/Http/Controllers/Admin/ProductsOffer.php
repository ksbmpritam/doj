<?php
namespace App\Http\Controllers\Admin;
use App\Models\ProductsOffers;
use App\Models\Foods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductsOffer extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {   
        $settings = ProductsOffers::all();
        return view('admin.dashboardSetting.product_offer.index',compact('settings'));
    }
    

    public function create()
    {
        $offer_category = ProductsOffers::all();
        return view('admin.dashboardSetting.product_offer.create',compact('offer_category'));
    }
    

    public function insert(Request $request)
    {
        $request->validate([
           'title' => 'required|string|max:255',
            'discount' => 'required|numeric|min:0|max:100',
        ]);
    
        if($request->has('status')){
            ProductsOffers::where('status', 1)->update(['status' => 0]);
        }
        
        ProductsOffers::create([
            'title' => $request->title,
            'discount' => $request->discount,
            'status' => $request->has('status')?1:0,
        ]);
    
        return redirect()->route('admin.products.offer')->with('success', 'Offer inserted successfully.');
    }
    
    public function edit($id)
    {
        $setting = ProductsOffers::findOrFail($id);
        return view('admin.dashboardSetting.product_offer.edit', compact('setting'));
    }
    
   public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'discount' => 'required',
        ]);
    
        $offer = ProductsOffers::findOrFail($id);
        
        if($request->has('status')){
            ProductsOffers::where('status', 1)->update(['status' => 0]);
        }
        
        $offer->update([
            'title' => $request->title,
            'discount' => $request->discount,
            'status' => $request->has('status') ? 1 : 0,
        ]);
    
        return redirect()->route('admin.products.offer')->with('success', 'Offer updated successfully.');
    }




    public function destroy($id)
    {
        $offer = ProductsOffers::findOrFail($id);
        $offer->delete();

        return redirect()->route('admin.products.offer')->with('success', 'Offer deleted successfully.');
    }

        
    public function get_product($id)
    {
        $offer = ProductsOffers::findOrFail($id);
        $foods = Foods::where('status', 1)->get();

        if($foods->isEmpty()) {
            return response()->json(['error' => 'No product found.'], JsonResponse::HTTP_NOT_FOUND);
        }

        $products = $foods->filter(function ($food) use ($offer) {
            $food->discounted_price_percentage = $this->calculateDiscountedPrice($food->price, $food->discount);
            return $food->discounted_price_percentage == $offer->discount;
        });
        
        return view('admin.dashboardSetting.product_offer.list_product', compact('products'));
    }

    private function calculateDiscountedPrice($originalPrice, $discountPercentage)
    {
        $discountedPrice = ($originalPrice - $discountPercentage) / $originalPrice;
        return round($discountedPrice * 100);
    }

}
