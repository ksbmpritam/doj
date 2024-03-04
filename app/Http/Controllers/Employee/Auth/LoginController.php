<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
   

    use AuthenticatesUsers;

  
    public function index()
    {
        //print_r('asnd');die;
        return view('employee.auth.login');
    }  
      
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
       
        $credentials = $request->only('email', 'password');
        $data = Employee::where('email', $credentials['email'])->first();
        
        if (!$data) {
            return redirect("/employee/")->with('error', 'UserName & Password not found');
        } elseif (!Hash::check($credentials['password'], $data->password)) {
            return redirect("/employee/")->with('error', 'Password not matched');
        } elseif ($data->status != 1) {
            return redirect("/employee/")->with('error', 'Account is not active');
        } else {
            $request->session()->put('user', $data);
            return redirect()->route('employee.dashboard')->with('success', 'Signed in successfully');
        }
    
        return redirect("/employee/")->with('error', 'Login details are not valid or account is not active');
    }
   
    

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flash('success', 'Logged out successfully');

        return redirect('/employee/')->with('success', 'Logged out successfully');
    }

}
