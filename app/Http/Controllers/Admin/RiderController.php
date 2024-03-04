<?php

namespace App\Http\Controllers\Admin;

use App\Models\Driver;

use App\Models\Category;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Customer;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Session;

class RiderController extends Controller
{

    // public function __construct()
    // {

    //     $this->middleware('auth');
    // }

    public function index()
    {
        $user = Session::get('user');
 
        if (!$user || empty($user->id)) {
            return redirect('/team');
        }
        
        $userId = Session::get('user')->id;
        $driver = Driver::where('team_id',$userId)->orderBy('id', 'desc')->get();
        return view("team.drivers.index", compact('driver'));
    }
    public function create()
    {
        return view('team.drivers.create');
    }
    
    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'account_number' => 'nullable|digits:12',
            'ifsc_code' => 'nullable|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:driver,email',
            'phone' => 'required|regex:/^\d{10}$/|unique:driver,phone',
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
    
        $user = Session::get('user');
 
        if (!$user || empty($user->id)) {
            return redirect('/team');
        }
        
        $userId = Session::get('user')->id;
        $driverData = [
            'team_id' => $userId,
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
            
            
            'bank_name' => $request->input('bank_name'),
            'branch_name' => $request->input('branch_name'),
            'account_number' => $request->input('account_number'),
            'holder_name' => $request->input('holder_name'),
            'ifsc_code' => $request->input('ifsc_code'),
            'other_information' => $request->input('other_information'),
            'team_approvel' => 0,
        ];
    
        $driver = Driver::create($driverData);
    
        return redirect()->route('team.riders')->with('success', 'Driver inserted successfully.');
    }


    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        return view('team.drivers.edit', compact('driver'))->with('id', $id);
    }
    
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'account_number' => 'nullable|digits:12',
            'ifsc_code' => 'nullable|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:driver,email,' . $id,
            'phone' => 'required|regex:/^\d{10}$/|unique:driver,phone,' . $id,
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
        $user = Session::get('user');
 
        if (!$user || empty($user->id)) {
            return redirect('/team');
        }
        
        $userId = Session::get('user')->id;
        
        $driver->team_id = $userId;
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
        $driver->branch_name = $request->input('branch_name');
        $driver->account_number = $request->input('account_number');
        $driver->holder_name = $request->input('holder_name');
        $driver->ifsc_code = $request->input('ifsc_code');
        $driver->other_information = $request->input('other_information');
    
        $driver->save();
    
        return redirect()->route('team.riders')->with('success', 'Driver updated successfully.');
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

    public function view($id)
    {
        $team_id=$id;
        $orderCount = Order::where('drivers_id', $id)->count();
        $driver = Driver::findOrFail($id);
        return view('team.drivers.view', compact('driver','orderCount','team_id'))->with('id', $id);
    }

    public function orders($id = '')
    {
        $orders = Order::with('restaurant', 'users', 'driver')->where('drivers_id', $id)->orderByDesc('id')->get();
        return view('team.drivers.orders', compact('orders', 'id'));
    }

    public function edit_order($id = '')
    {
        $orders = Order::with('restaurant', 'users', 'driver')->where('id', $id)->first();
        return view('team.drivers.order_edit', compact('orders', 'id'));
    }
    
    public function downloadPDF($id)
    {
        
        $order = Order::where('id', $id)->first();
        $customer = Customer::where('id',$order->user_id)->first();
        $orderItems = OrderItems::where('order_id',$order->id)->get();
        $restaurant = Restaurant::where('id',$order->restaurant_id)->first();
        
        $dateTime = Carbon::parse($order->date);

        $formattedDate = $dateTime->format('D M j Y g:i:s A');

        $orderArray = [];
        foreach ($orderItems as $o) {
            $orderArray[] = [
                'Image' => $o->foodImage,
                'Itms' => $o->foodName,
                'Price' => $o->amount,
                'QTY' => $o->quantity,
                'Size' => $o->size,
                'Total' => $o->amount,
                // Add more fields as needed
            ];
        }
        
        
        
        $data = [
            'order_id' => $order->order_id,
            'order_date' => $formattedDate, 
            'CustomerName' => $customer->name,
            'CustomerAddress' => $customer->address,
            'CustomerEmail' => $customer->email,
            'CustomerPhone' => $customer->mobile_number,
            'orderArray' => $orderArray,
            'RestaurantName' => $restaurant->first_name,
            'RestaurantPhone' => $restaurant->mobile_no,
            'RestaurantAddress' => $restaurant->address,
            'RestaurantEmail' => $restaurant->email,
        ];
    
        $pdf = PDF::loadView('team.pdf.pdf_template', $data);
    
        $fileName = 'orders.pdf'; // Set the desired filename
        return $pdf->download($fileName);
    }
      
    public function delete($id)
    {
        $driver = Driver::findOrFail($id); 

         $driver->delete();
    
        return redirect()->route('team.riders')->with('success', 'Driver deleted successfully.');
    }
    
    public function balanceHistory($id = ''){
        $orders = Order::with('restaurant', 'users', 'driver')->where('id', $id)->first();
        echo "coming soon...Work in progress"; die;
        return view('team.drivers.balance_history', compact('orders', 'id'));
    }
    
    
    
    public function riderList($id)
    {
        $team_ids = $id;

        $drivers = Driver::where('team_id', $id)->orderBy('id', 'desc')->first();
        $driver = Driver::where('team_id', $id)->orderBy('id', 'desc')->get();
        return view('admin.franchies.detail.franchies.rider_list', compact('drivers', 'driver','team_ids'));
    }

    public function riderDetail($id)
    {
        try {
            $driver = Driver::findOrFail($id);
            $team_ids = $driver->team_id;
            return view('admin.franchies.detail.franchies.rider_detail', compact('driver','team_ids'))->with('id', $id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
        }
    }
    
    public function riderList2($id)
    {
        $team_ids = $id;

        $drivers = Driver::where('team_id', $id)->orderBy('id', 'desc')->first();
        $driver = Driver::where('team_id', $id)->orderBy('id', 'desc')->get();
        return view('admin.employee.detail.employee.rider_list', compact('drivers', 'driver','team_ids'));
    }

    public function riderDetail2($id)
    {
        try {
            $team_ids = $id;
            $driver = Driver::findOrFail($id);
            $team_ids = $driver->team_id;
            return view('admin.employee.detail.employee.rider_detail', compact('driver','team_ids'))->with('id', $id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
        }
    }
    
    public function approvalEdit($id){
        $team_id = $id;
        $driver = Driver::findOrFail($id);
        return view('franchies.team.detail.update_rider_status', compact('driver','team_id'));
    }
    public function approvalUpdate($id, Request $request){
        $driver = Driver::findOrFail($id);
    
        $newStatus = $request->input('team_approvel');
    
        $driver->update(['team_approvel' => $newStatus]); 
    
        return redirect()->route('franchies.team.rider', ['id' => $driver->team_id])->with('success', 'Rider status updated successfully.');
    }
    
     public function showRider($id)
    {
        $driver = Driver::findOrFail($id);
        return view('employee.team.drivers.approved', compact('driver'));
    }
    
         public function riderEdit($id)
        {
             $driver = Driver::findOrFail($id);
            return view('admin.franchies.detail.franchies.editteamrider', compact('driver'))->with('id', $id);
           
        }
   public function riderUpdate(Request $request, $id)
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
    //   dd($driver);
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
    
        $driver->save();
    
     return redirect()->route('admin.franchies.team.rider', ['id' => $driver->team_id])->with('success', 'Department updated successfully.');
        // return redirect()->route('admin.franchies.team.rider ')->with('success', 'franchies updated successfully.');
    }  
     public function ridersEdit($id)
    {
        try {
            $team_ids = $id;
            $driver = Driver::findOrFail($id);
            $team_ids = $driver->team_id;
            return view('admin.employee.detail.employee.rider_edit', compact('driver','team_ids'))->with('id', $id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
        }
    }
    
    
    
}