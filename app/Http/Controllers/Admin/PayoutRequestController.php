<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class PayoutRequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id = '')
    {
        return view("admin.payoutRequests.drivers.index")->with('id',$id);
    }

    public function restaurant($id = '')
    {
        return view("admin.payoutRequests.restaurants.index")->with('id',$id);
    }

}
