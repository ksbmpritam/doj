<?php

namespace App\Http\Controllers\Restaurant;
use App\Models\Driver;
use App\Models\Category;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\DriverWithdrawalRequest;

class DriverController extends Controller
{   

   	public function index()
    {
        $driver = Driver::all();
        return view("restaurant_admin.drivers.index",compact('driver'));
    }
    public function create()
    {
        return view('restaurant_admin.drivers.create');
    }
    
    // public function insert(Request $request)
    // {
    //     $request->validate([
    //         'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
    //         'car_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);
        
    //     $profile = $request->file('profile_image');
    //         $profile_image = time() . '.' . $profile->getClientOriginalExtension();
    //         $profile->move(public_path('images/driver/profile/'), $profile_image);
            
    //     $car = $request->file('car_image');
    //     $car_image = time() . '.'. $car->getClientOriginalExtension();
    //     $car->move(public_path('images/driver'),$car_image);
            
        
    //     $driver = Driver::create([
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         'phone' => $request->phone,
    //         'address' => $request->address,
    //         'state' => $request->state,
    //         'city' => $request->city,
    //         'pincode' => $request->pincode,
    //         'latitude' => $request->latitude,
    //         'longitude' => $request->longitude,
    //         'profile_image' => $profile_image,
    //         'avaiable' => $request->available,
    //         'car_number' => $request->car_number,
    //         'car_name' => $request->car_name,
    //         'car_image' => $car_image,
    //         'status' => $request->status,
    //         ]);
      
       
    //     $driver->save();

    //   return redirect()->route('restaurant.drivers')->with('success', 'Driver insert successfully.');
    // }
    
    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:driver,email',
            'phone' => 'required|unique:driver,phone',
            'address' => 'required',
            'aadhar_no' => 'required',
            'pan_card_no' => 'required',
            'aadhar_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pancart_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'car_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
    
        $profile_image = null;
        if ($request->hasFile('profile_image')) {
            $profile = $request->file('profile_image');
            $profile_image = time() . '.' . $profile->getClientOriginalExtension();
            $profile->move(public_path('images/driver/profile/'), $profile_image);
        }
    
        $car_image = null;
        if ($request->hasFile('car_image')) {
            $car = $request->file('car_image');
            $car_image = time() . '.' . $car->getClientOriginalExtension();
            $car->move(public_path('images/driver/car_image/'), $car_image);
        }
        
        $aadhar_image = $this->uploadImage($request, 'aadhar_image', 'images/driver/document');
        $pancart_image = $this->uploadImage($request, 'pancart_image', 'images/driver/document');
    
        
        $driverData = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'father_name' => $request->input('father_name'),
            'language' => $request->input('language'),
            'vehicle' => $request->input('vehicle'),
            'work_area' => $request->input('work_area'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'pincode' => $request->input('pincode'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'available' => $request->boolean('available'),
            'profile_image' => $profile_image,
            'car_number' => $request->input('car_number'),
            'car_name' => $request->input('car_name'),
            'car_image' => $car_image,
            'status' => $request->boolean('status'),
            'aadhar_no' => $request->input('aadhar_no'),
            'aadhar_image' => $aadhar_image,
            'pan_card_no' => $request->input('pan_card_no'),
            'pancart_image' => $pancart_image,
        ];
    
        $driver = Driver::create($driverData);
    
        return redirect()->route('restaurant.drivers')->with('success', 'Driver insert successfully.'); 
    }
    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
    	return view('restaurant_admin.drivers.edit',compact('driver'))->with('id', $id);
    }
    
    public function update(Request $request, $id)
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
            $this->unlinkImage('images/driver/profile/', $driver->profile_image);
            $profile = $request->file('profile_image');
            $profile_image = time() . '.' . $profile->getClientOriginalExtension();
            $profile->move(public_path('images/driver/profile/'), $profile_image);
            $driver->profile_image = $profile_image;
        }
    
        if ($request->hasFile('car_image')) {
            $this->unlinkImage('images/driver/car_image/', $driver->car_image);
            $car = $request->file('car_image');
            $car_image = time() . '.' . $car->getClientOriginalExtension();
            $car->move(public_path('images/driver/car_image/'), $car_image);
            $driver->car_image = $car_image;
        }
    
        
        $aadhar_image = $this->uploadImage($request, 'aadhar_image', 'images/driver/document');
        
        if ($aadhar_image) {
            if ($driver->aadhar_image) {
                $this->unlinkImage('images/driver/document/' , $driver->aadhar_image);
            }
            $driver->aadhar_image = $aadhar_image;
        }
    
        $pancart_image = $this->uploadImage($request, 'pancart_image', 'images/driver/document');
        if ($pancart_image) {
            if ($driver->pancart_image) {
                $this->unlinkImage('images/driver/document/' , $driver->pancart_image);
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
    
        $driver->save();
    
         return redirect()->route('restaurant.drivers')->with('success', 'Driver insert successfully.');
    }
    
    public function unlinkImage($path, $filename)
    {
        $imagePath = public_path($path . $filename);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
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
    
    // public function update(Request $request,$id)
    // {
        
    //     $driver = Driver::findOrFail($id);
        
       
    //     if($request->profile_image)
    //     {
    //         $profile = $request->file('profile_image');
    //         $profile_image = time() . '.' . $profile->getClientOriginalExtension();
    //         $profile->move(public_path('images/driver/profile/'), $profile_image);
            
    //         if ($driver->profile_image && file_exists(public_path('images/driver/profile/' . $driver->profile_image))) {
    //             unlink(public_path('images/driver/profile/' . $driver->profile_image));
    //         }
            
    //         $driver->profile_image = $profile_image;
            
    //     } else if($request->car_image)
    //     {
    //         $car = $request->file('car_image');
    //         $car_image = time() . '.'. $car->getClientOriginalExtension();
    //         $car->move(public_path('images/driver/profile/'),$car_image);
            
    //         if ($driver->car_image && file_exists(public_path('images/driver/' . $driver->car_image))) {
    //             unlink(public_path('images/driver/' . $driver->car_image));
    //         }
            
    //         $driver->car_image = $car_image;
            
    //     }
       
        
    //     $driver->first_name = $request->first_name;
    //     $driver->last_name = $request->last_name;
    //     $driver->email = $request->email;
    //     $driver->phone = $request->phone;
    //     $driver->address = $request->address;
    //     $driver->state = $request->state;
    //     $driver->city = $request->city;
    //     $driver->pincode = $request->pincode;
    //     $driver->latitude = $request->latitude;
    //     $driver->longitude = $request->longitude;
    //     $driver->car_number = $request->car_number;
    //     $driver->car_name = $request->car_name;
    //     $driver->status = $request->status;
    //     $driver->bank_name = $request->bank_name;
    //     $driver->branch_name = $request->branch_name;
    //     $driver->holder_name = $request->holder_name;
    //     $driver->account_number = $request->account_number;
    //     $driver->other_information = $request->other_information;
      
    //     $driver->save();

    //   return redirect()->route('restaurant.drivers')->with('success', 'Driver Update successfully.');
    // }
    
    public function view($id)
    {
        
        $driver = Driver::findOrFail($id);
        return view('restaurant_admin.drivers.view',compact('driver'))->with('id', $id);
    }
    
     public function driver_order_list($id)
    {
        
        $order = Order::where('drivers_id', $id)->get();
        return view("restaurant_admin.drivers.ordersHistory",compact('order'))->with('id',$id);
    }
    public function driver_balance_list($id)
    {
        $order = Order::with('users','driver')->where('drivers_id', $id)->get();
        // dd($order); 
        return view("restaurant_admin.drivers.balanceHistory",compact('order'))->with('id',$id);
    }
    
    public function history($id)
    {
        $driver = DriverWithdrawalRequest::with('driver')->where('driver_id',$id)->get();
        // dd($driver);
        return view("restaurant_admin.drivers.history_tran",compact('driver'))->with('id',$id);
    }
}


