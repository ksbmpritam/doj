<?php

namespace App\Http\Controllers\Franchies\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Franchise;

 
class LoginController extends Controller
{
   
    use AuthenticatesUsers;

    public function index()
    {
        return view('franchies.auth.login');
    }  
      

   
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
       
        $credentials = $request->only('email', 'password');
        $data = Franchise::where('email', $credentials['email'])->first();
        if (!$data) {
            return redirect("/franchies/")->with('error', 'Email not found');
        } elseif (!Hash::check($credentials['password'], $data->password)) {
            return redirect("/franchies/")->with('error', 'Password not matched');
        } elseif ($data->status != 1) {
            return redirect("/franchies/")->with('error', 'Account is not active');
        } else {
            $request->session()->put('user', $data);
            return redirect()->route('franchies.dashboard')->with('success', 'Signed in successfully');
        }
    
        return redirect("/franchies/")->with('error', 'Login details are not valid or account is not active');
    }
    
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flash('success', 'Logged out successfully');

        return redirect('/franchies/')->with('success', 'Logged out successfully');
    }

}
