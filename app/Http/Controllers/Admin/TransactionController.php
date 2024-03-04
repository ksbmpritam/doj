<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    
    public function __construct()
    {
       $this->middleware('auth');
    }

 
    /*public function index()
    {
        return view('transactions.index');
    }*/
    public function index($id='')
    {
        return view("transactions.index")->with('id',$id);
    }
}
