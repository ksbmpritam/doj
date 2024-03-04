<?php

namespace App\Http\Controllers\Restaurant\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Register;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
   
    use RegistersUsers;

  
    public function index(){
        return view('restaurant_admin.auth.register');
    }
     
    public function register(Request $request)
    {  
 
        $data = $request->all();
        
        $check = $this->create($data);
        $request->session()->put('user', $data);
        return redirect("dashboard")->withSuccess('You have signed-in');
    }
     
    public function create(array $data)
    {
        return Register::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
  
}
