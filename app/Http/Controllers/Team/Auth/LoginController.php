<?php

namespace App\Http\Controllers\Team\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\Team;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
   

    use AuthenticatesUsers;

  
    public function index()
    {
        //print_r('asnd');die;
        return view('team.auth.login');
    }  
     
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
       
        $credentials = $request->only('email', 'password');
        $data = Team::where('email', $credentials['email'])->first();
        
        
        if (!$data) {
            return redirect("/team/")->with('error', 'UserName & Password not found');
        } elseif (!Hash::check($credentials['password'], $data->password)) {
            return redirect("/team/")->with('error', 'Password not matched');
        } elseif ($data->status != 1) {
            return redirect("/team/")->with('error', 'Account is not active');
        } else {
            $request->session()->put('user', $data);
            
            return redirect("/team/dashboard")->with('success', 'Signed in successfully');
        }
    
        return redirect("/team/")->with('error', 'Login details are not valid or account is not active');
    }
   
    

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flash('success', 'Logged out successfully');

        return redirect('/team/')->with('success', 'Logged out successfully');
    }

}
