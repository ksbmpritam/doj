<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\RestaurantAdmin;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\GalleryImage;
use App\Models\DineGallery;
use App\Models\RestaurantOffer;
use App\Models\RestaurantWorkingHour;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Session;
use Carbon\Carbon;
use App\Models\Driver;
use App\Models\Foods;
use App\Models\FoodAddons;
use App\Models\FoodSpecification;
use App\Models\Franchise;
use App\Models\Employee;
use App\Models\Team;

class RequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
    {
        $restaurant = Restaurant::with(['team'])
            ->whereHas('team', function ($query) {
                $query->whereNotNull('team_id');
            })
            ->orderBy('id', 'desc')
            ->get();
    
        $franchiseNames = $restaurant->map(function ($r) {
            return $r->team ? $r->team->franchies_id : 'N/A';
        });
    
        $employeeNames = $restaurant->map(function ($r) {
            return $r->team ? $r->team->employee_id : 'N/A';
        });
    
        return view("admin.request.restaurants.index", compact('restaurant', 'franchiseNames', 'employeeNames'));
    }

 
  
    public function view($id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id);
            $restaurant_admin = RestaurantAdmin::findOrFail($restaurant->restaurants_admin_id);
            $categories = Category::all(); // Assuming you have a Category model
    
            // Retrieve working hours for each day
            $days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
            $workingHours = [];
            foreach ($days as $day) {
                $workingHours[$day] = RestaurantWorkingHour::where('restaurant_id', $id)->where('day_of_week', $day)->get();
            }
    
            // Retrieve special offers for each day
            $specialOffers = [];
            foreach ($days as $day) {
                $specialOffers[$day] = RestaurantOffer::where('restaurant_id', $id)->where('day_of_week', $day)->get();
            }
    
            // Retrieve gallery images
            $galleryImages = GalleryImage::where('restaurant_id', $id)->get();
            $dineImages = DineGallery::where('resturant_id', $id)->get();
    
            // Pass all the data to the view
            return view('admin.request.restaurants.view', compact('restaurant', 'categories', 'restaurant_admin', 'workingHours', 'specialOffers', 'galleryImages','dineImages','days'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Handle the case when either the restaurant or the restaurant admin is not found.
            // For example, return an error response or redirect back with an error message.
            // Example: return redirect()->back()->withErrors(['message' => 'Restaurant or Admin not found']);
        }
    }

    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('admin.request.restaurants.model', compact('restaurant'));
    }

   

    
    public function edit($id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id);
            $team_ids = $restaurant->team_id;
            $restaurant_admin = RestaurantAdmin::findOrFail($restaurant->restaurants_admin_id);
            $categories = Category::all();
            $days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
            $workingHours = [];
            foreach ($days as $day) {
                $workingHours[$day] = RestaurantWorkingHour::where('restaurant_id', $id)->where('day_of_week', $day)->get();
            }
    
            $specialOffers = [];
            foreach ($days as $day) {
                $specialOffers[$day] = RestaurantOffer::where('restaurant_id', $id)->where('day_of_week', $day)->get();
            }
    
            $galleryImages = GalleryImage::where('restaurant_id', $id)->get();
            $dineImages = DineGallery::where('resturant_id', $id)->get();

            return view('admin.request.restaurants.edit', compact('restaurant','team_ids', 'categories', 'restaurant_admin', 'workingHours', 'specialOffers', 'galleryImages','dineImages','days'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
        }
    }
    
    public function Update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'team_approvel' => 'required',
        ]);
    
        if ($request->input('team_approvel') == -1) {
            $validator->sometimes('cancel_reason', 'required', function ($input) {
                return $input->team_approvel == -1;
            });
        }
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $admin = Restaurant::find($id);
    
        if (!$admin) {
            return redirect()->back()->with('error', 'Restaurant not found.')->withInput();
        }
        
        if($request->input('team_approvel') == -1){
            $cancel_reason=$request->cancel_reason;
        }else{
            $cancel_reason='';
        }
        
        $admin->team_approvel = $request->team_approvel;
        $admin->approved_by = "super-admin";
        $admin->approved_by_name = auth()->user()->name;
        $admin->approved_by_id = auth()->user()->id;
        $admin->approved_date = Carbon::now()->format('Y/m/d');
        $admin->cancel_reason = $cancel_reason;
        $admin->save();
    
        return redirect()->route('admin.restaurants.request')->with('success', 'Restaurant updated successfully.');
    }

    
    public function riderList()
    {
        $drivers = Driver::with(['team'])
            ->whereHas('team', function ($query) {
                $query->whereNotNull('team_id');
            })
            ->orderBy('id', 'desc')
            ->get();
        
        $franchiseNames = $drivers->map(function ($driver) {
            return $driver->team ? $driver->team->franchies_id : 'N/A';
        });
        
        $employeeNames = $drivers->map(function ($driver) {
            return $driver->team ? $driver->team->employee_id : 'N/A';
        });
        
        return view('admin.request.drivers.index', compact('drivers', 'franchiseNames', 'employeeNames'));
    }


    public function riderDetail($id)
    {
        $driver = Driver::findOrFail($id);
        return view('admin.request.drivers.view', compact('driver'))->with('id', $id);
    }


    public function riderEdit($id){
        $driver = Driver::findOrFail($id);
        return view('admin.request.drivers.edit', compact('driver'));
    }
    
    
    public function approvalUpdate($id, Request $request){
        $validator = Validator::make($request->all(), [
            'team_approvel' => 'required',
        ]);
    
        if ($request->input('team_approvel') == -1) {
            $validator->sometimes('cancel_reason', 'required', function ($input) {
                return $input->team_approvel == -1;
            });
        }
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $Driver = Driver::find($id);
    
        if (!$Driver) {
            return redirect()->back()->with('error', 'Restaurant not found.')->withInput();
        }
        
        if($request->input('team_approvel') == -1){
            $cancel_reason=$request->cancel_reason;
        }else{
            $cancel_reason='';
        }
        
        $Driver->team_approvel = $request->team_approvel;
        $Driver->approved_by = "super-admin";
        $Driver->approved_by_name = auth()->user()->name;
        $Driver->approved_by_id = auth()->user()->id;
        $Driver->approved_date = Carbon::now()->format('Y/m/d');
        $Driver->cancel_reason = $cancel_reason;
        $Driver->save();
    
        return redirect()->route('admin.rider.request')->with('success', 'Rider updated successfully.');
    }

    public function showRider($id)
    {
        $driver = Driver::findOrFail($id);
        return view('admin.request.drivers.model', compact('driver'));
    }

    public function updateRider(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:driver,email,' . $id,
            'phone' => 'required|unique:driver,phone,' . $id,
            'address' => 'required',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'car_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'aadhar_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pancart_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'email.unique' => 'The email address is already taken.',
            'phone.unique' => 'The phone number is already taken.',
            'profile_image.image' => 'The profile image must be a valid image file.',
            'profile_image.max' => 'The profile image size should not exceed 2MB.',
            'car_image.image' => 'The car image must be a valid image file.',
            'car_image.max' => 'The car image size should not exceed 2MB.',
            'aadhar_image.image' => 'The Aadhar image must be a valid image file.',
            'aadhar_image.max' => 'The Aadhar image size should not exceed 2MB.',
            'pancart_image.image' => 'The PAN card image must be a valid image file.',
            'pancart_image.max' => 'The PAN card image size should not exceed 2MB.',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        $driver = Driver::findOrFail($id);
    
        if ($request->hasFile('profile_image')) {
            if ($driver->profile_image) {
                $this->unlinkImage('images/driver/profile/', $driver->profile_image);
            }
            $profile = $request->file('profile_image');
            $profile_image = time() . '.' . $profile->getClientOriginalExtension();
            $profile->move(public_path('images/driver/profile/'), $profile_image);
            $driver->profile_image = $profile_image;
        }
    
        if ($request->hasFile('car_image')) {
            if ($driver->car_image) {
                $this->unlinkImage('images/driver/car_image/', $driver->car_image);
            }
            $car = $request->file('car_image');
            $car_image = time() . '.' . $car->getClientOriginalExtension();
            $car->move(public_path('images/driver/car_image/'), $car_image);
            $driver->car_image = $car_image;
        }
    
    
        $aadhar_image = $this->uploadImage($request, 'aadhar_image', 'images/driver/document');
        if ($aadhar_image) {
            if ($driver->aadhar_image) {
                $this->unlinkImage(public_path('images/driver/document/') , $driver->aadhar_image);
            }
            $driver->aadhar_image = $aadhar_image;
        }
    
        $pancart_image = $this->uploadImage($request, 'pancart_image', 'images/driver/document');
        if ($pancart_image) {
            if ($driver->pancart_image) {
                $this->unlinkImage(public_path('images/driver/document/') , $driver->pancart_image);
            }
            $driver->pancart_image = $pancart_image;
        }
    
        $driver->first_name = $request->input('first_name');
        $driver->last_name = $request->input('last_name');
        $driver->father_name = $request->input('father_name');
        $driver->language = $request->input('language');
        $driver->vehicle = $request->input('vehicle');
        $driver->work_area = $request->input('work_area');
        $driver->email = $request->input('email');
        $driver->phone = $request->input('phone');
        $driver->address = $request->input('address');
        $driver->state = $request->input('state');
        $driver->city = $request->input('city');
        $driver->pincode = $request->input('pincode');
        $driver->latitude = $request->input('latitude');
        $driver->longitude = $request->input('longitude');
        $driver->available = $request->boolean('available');
        $driver->car_number = $request->input('car_number');
        $driver->car_name = $request->input('car_name');
        $driver->status = $request->boolean('status');
        $driver->aadhar_no = $request->input('aadhar_no');
        $driver->pan_card_no = $request->input('pan_card_no');
        $driver->bank_name = $request->input('bank_name');
        $driver->account_number = $request->input('account_number');
        $driver->branch_name = $request->input('branch_name');
        $driver->holder_name = $request->input('holder_name');
        $driver->ifsc_code = $request->input('ifsc_code');
        $driver->other_information = $request->input('other_information');
        $driver->save();
    
        return redirect()->route('admin.rider.request')->with('success', 'Driver updated successfully.');
    }
    
    private function unlinkImage($path, $filename)
    {
        $imagePath = public_path($path . $filename);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    private function uploadImage($request, $fieldName, $folder)
    {
        if ($request->hasFile($fieldName)) {
            $image = $request->file($fieldName);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            $image->move(public_path($folder), $imageName);
    
            return $imageName;
        }
    
        return null;
    }


    public function productList()
    {
       
        $categories = Category::all();

        $foodsQuery = Foods::with(['category', 'restaurant', 'team'])
            ->whereHas('team', function ($query) {
                $query->whereNotNull('team_id');
            })
            ->orderBy('id', 'desc');
        $foods = $foodsQuery->get();


        $franchiseNames = $foods->map(function ($food) {
            return $food->team ? $food->team->franchies_id : 'N/A';
        });
        
        $employeeNames = $foods->map(function ($food) {
            return $food->team ? $food->team->employee_id : 'N/A';
        });
    
        return view('admin.request.product.index', compact('foods', 'categories','franchiseNames','employeeNames'));
    }
    
    public function productDetail($id)
    {
        $food = Foods::with(['category', 'restaurant', 'foodAddons', 'foodSpecifications'])->findOrFail($id);
        $categories = Category::all();
        
        $restaurants = Restaurant::get();
        return view('admin.request.product.view', compact('food', 'categories', 'restaurants'));
    }
    
    
    public function showProduct($id)
    {
        $foods = Foods::findOrFail($id);
        return view('admin.request.product.model', compact('foods'));
    }

    public function updateProduct(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'restaurant_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'category_id' => 'required',
        ]);
    
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $food = Foods::findOrFail($id);
        
        
        $data = [
            'restaurant_id' => $request->restaurant_id,
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
            'item_quantity' => $request->item_quantity,
            'food_attribute_id' => $request->food_attribute_id,
            'description' => $request->description,
            'publish' => $request->has('publish')?1:0,
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
        
        // Update food Addons
        if ($request->has('addons_title') && $request->has('addons_price')) {
            $addons_titles = $request->addons_title;
            $addons_prices = $request->addons_price;
    
            FoodAddons::where('food_id', $food->id)->delete();
    
            foreach ($addons_titles as $index => $title) {
                $price = $addons_prices[$index];
                FoodAddons::create([
                    'food_id' => $food->id,
                    'title' => $title,
                    'price' => $price,
                ]);
            }
        }
    
        // Update food specifications
        if ($request->has('specifications_label') && $request->has('specifications_value')) {
            $specifications_labels = $request->specifications_label;
            $specifications_values = $request->specifications_value;
    
            FoodSpecification::where('food_id', $food->id)->delete();
    
            foreach ($specifications_labels as $index => $label) {
                $value = $specifications_values[$index];
                FoodSpecification::create([
                    'food_id' => $food->id,
                    'label' => $label,
                    'value' => $value,
                ]);
            }
        }
    
        return redirect()->route('admin.product.request')->with('success', 'Food updated successfully.');
    }


    public function productEdit($id){
        $foods = Foods::findOrFail($id);
        return view('admin.request.product.edit', compact('foods'));
    }
    
    
    public function approvalProduct($id, Request $request){
        $validator = Validator::make($request->all(), [
            'team_approvel' => 'required',
        ]);
    
        if ($request->input('team_approvel') == -1) {
            $validator->sometimes('cancel_reason', 'required', function ($input) {
                return $input->team_approvel == -1;
            });
        }
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $Foods = Foods::find($id);
    
        if (!$Foods) {
            return redirect()->back()->with('error', 'Restaurant not found.')->withInput();
        }
        
        if($request->input('team_approvel') == -1){
            $cancel_reason=$request->cancel_reason;
        }else{
            $cancel_reason='';
        }
        
        $Foods->team_approvel = $request->team_approvel;
        $Foods->approved_by = "super-admin";
        $Foods->approved_by_name = auth()->user()->name;
        $Foods->approved_by_id = auth()->user()->id;
        $Foods->approved_date = Carbon::now()->format('Y/m/d');
        $Foods->cancel_reason = $cancel_reason;
        $Foods->save();
    
        return redirect()->route('admin.product.request')->with('success', 'Product updated successfully.');
    }


    public function showFranchiesDetails($id)
    {
        $franchise = Franchise::findOrFail($id);
        return view('admin.request.fsc_model', compact('franchise'));
    }
    
    public function showEmployeeDetails($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.request.emp_model', compact('employee'));
    }
    
    public function showTeamDetails($id)
    {
        $team = Team::findOrFail($id);
        return view('admin.request.team_model', compact('team'));
    }










}