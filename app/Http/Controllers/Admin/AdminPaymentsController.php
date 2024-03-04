<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


class AdminPaymentsController extends Controller
{  

   public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
    {
       return view("admin.payments.index");
    }
    
    public function driverIndex()
 	{
    	return view("payments.driver_index");
 	}
    
}
