<?php
namespace App\Http\Controllers\Admin;
use App\Models\UsersOffer;
use App\Models\Foods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Restaurant;
use App\Models\Customer;

class UserOffers extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {   
        $offers = UsersOffer::all();
        return view('admin.dashboardSetting.user_offer.index',compact('offers'));
    }
    

    public function create()
    {
        $users = Customer::where('status',1)->get();
        $foods = Foods::where('status',1)->get();
        return view('admin.dashboardSetting.user_offer.create',compact('users','foods'));
    }
    
    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required|in:1,0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'opening_date' => 'required|date',
            'closing_date' => 'required|date',
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i',
            'discount_type' => 'required|in:percentage,amount',
            'discount' => 'required|numeric|min:0',
            'user_id' => 'required', 
            'food_id' => 'required|array|min:1', 
            'food_id.*' => 'exists:foods,id',
        ]);
    
        $image = null; 
    
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $image = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('images/user_offer'), $image);
        }
        
        $offer = new UsersOffer;
        $foodIds = implode(',', $request->food_id);
        $offer->title = $request->input('title');
        $offer->status = $request->input('status');
        $offer->image = $image ? basename($image) : null;
        $offer->opening_date = $request->input('opening_date');
        $offer->closing_date = $request->input('closing_date');
        $offer->opening_time = $request->input('opening_time');
        $offer->closing_time = $request->input('closing_time');
        $offer->discount_type = $request->input('discount_type');
        $offer->discount = $request->input('discount');
        $offer->user_id = $request->input('user_id');
        $offer->food_id = $foodIds;
        
        $offer->save();
      
        return redirect()->route('admin.users.offer')->with('success', 'Restaurant offer created successfully');
    }


    
    public function edit($id)
    {
        $users = Customer::where('status',1)->get();
        $offer = UsersOffer::where('id',$id)->first();
        $foods = Foods::where('status',1)->get();
        return view('admin.dashboardSetting.user_offer.edit', compact('offer','users','foods'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required|in:1,0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'opening_date' => 'required|date',
            'closing_date' => 'required|date',
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i',
            'discount_type' => 'required|in:percentage,amount',
            'discount' => 'required|numeric|min:0',
            'user_id' => 'required',
            'food_id' => 'required|array|min:1', 
            'food_id.*' => 'exists:foods,id',
        ]);
    
        $offer = UsersOffer::findOrFail($id);
        $foodIds = implode(',', $request->food_id);
        
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $newImage = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('images/user_offer'), $newImage);
    
            if ($offer->image) {
                unlink(public_path('images/user_offer/' . $offer->image));
            }
    
            $offer->image = $newImage;
        }
    
        $offer->title = $request->input('title');
        $offer->status = $request->input('status');
        $offer->opening_date = $request->input('opening_date');
        $offer->closing_date = $request->input('closing_date');
        $offer->opening_time = $request->input('opening_time');
        $offer->closing_time = $request->input('closing_time');
        $offer->discount_type = $request->input('discount_type');
        $offer->discount = $request->input('discount');
        $offer->user_id = $request->input('user_id');
        $offer->food_id = $foodIds;
        $offer->save();
    
        return redirect()->route('admin.users.offer')->with('success', 'Restaurant offer updated successfully');
    }





    public function destroy($id)
    {
        $offer = UsersOffer::findOrFail($id);
        $offer->delete();

        return redirect()->route('admin.users.offer')->with('success', 'Offer deleted successfully.');
    }



}