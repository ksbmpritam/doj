<?php

namespace App\Http\Controllers\Restaurant\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
   

    use AuthenticatesUsers;

  
    public function index()
    {
        //print_r('asnd');die;
        return view('restaurant_admin.auth.login');
    }  
      

   
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
       
        $credentials = $request->only('email', 'password');
        $data = Restaurant::where('email', $credentials['email'])->first();

        if ($data && $credentials['password']==$data->password) {
            // print_r($data);die;
            $request->session()->put('user', $data);
            return redirect()->route('restaurant.dashboard')->with('success', 'Signed in successfully');
            //return redirect()->intended('restaurant/dashboard')->with('success', 'Signed in successfully');
        }

        return redirect("/restaurant/")->with('error', 'Login details are not valid');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flash('success', 'Logged out successfully');

        return redirect('/restaurant/')->with('success', 'Logged out successfully');
    }

}
