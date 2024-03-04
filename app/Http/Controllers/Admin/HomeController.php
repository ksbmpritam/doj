<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Category;
use App\Models\Foods;
use App\Models\RestaurantAdmin;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     
    public function index()
    {
        
        $customer = Customer::all();
        $count = count($customer);
        $driver = Driver::all();
        $countd = count($driver);
        $order = Order::all();
        $countOrder = count($order);
        $restaurant_admin = Restaurant::all();
        $rcount = count($restaurant_admin);
        $food = count(Foods::all());
        
        $users = Customer::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("MONTH(created_at)"), 'created_at')
                ->pluck('count', 'month_name');

 
        $todayOrders = Order::with('restaurant','order_items')->where('date', now()->toDateString())->get();

        $labels = $users->keys();
        $data = $users->values();
        
        //chart pie
        $chart_options = [
            'chart_title' => 'Customer by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Customer',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'pie',
        ];
        
        $chart1 = new LaravelChart($chart_options);
        
        //chart line
        $chart_options1 = [
            'chart_title' => 'Revenue Report by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',
        ];
        $chart2 = new LaravelChart($chart_options1);
        
        
        
    	return view('admin.home',compact('customer','count','countd','countOrder','rcount','food','labels','data','chart1','chart2','todayOrders'));
        
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        return view('dashboard');
    }    
    
    public function users()
    {
        return view('users');
    }
    
}
