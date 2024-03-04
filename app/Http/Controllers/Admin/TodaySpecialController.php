<?php

namespace App\Http\Controllers\Admin;
use App\Models\TodaySpecial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Foods;
use Carbon\Carbon;

class TodaySpecialController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {   
        
        $specials = TodaySpecial::all();
        return view('admin.dashboardSetting.today_special.index',compact('specials'));
    }
    

    public function create()
    {
        $foods = Foods::where('publish',1)->get();
        return view('admin.dashboardSetting.today_special.create',compact('foods'));
    }
    

    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required|in:0,1',
            'food_id' => 'required|array|min:1', 
            'food_id.*' => 'exists:foods,id',
        ]);
    
        try {
            if($request->status==1){
             TodaySpecial::where('status', 1)->update(['status' => 0]);
            }
            $foodIds = implode(',', $request->food_id);

            $todaySpecial = new TodaySpecial();
            $todaySpecial->title = $request->title;
            $todaySpecial->status = $request->status;
            $todaySpecial->created_date = now()->format('Y-m-d');
            $todaySpecial->food_id = $foodIds;
            $todaySpecial->save();
            
           
            return redirect()->route('admin.today.special')->with('success', 'Today Special created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating Today Special.')->withErrors($e->getMessage());
        }
      
    }
    
    public function edit($id)
    {
        $todaySpecial = TodaySpecial::findOrFail($id);
        $foods = Foods::where('publish',1)->get();
        return view('admin.dashboardSetting.today_special.edit', compact('todaySpecial','foods'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required|in:0,1',
            'food_id' => 'required|array|min:1', 
            'food_id.*' => 'exists:foods,id',
        ]);
    
        try {
            $todaySpecial = TodaySpecial::find($id);
    
            if (!$todaySpecial) {
                return redirect()->back()->with('error', 'Today Special not found.');
            }
    
            if ($request->status == 1) {
                TodaySpecial::where('status', 1)->where('id', '!=', $id)->update(['status' => 0]);
            }
    
            $foodIds = implode(',', $request->food_id);
    
            $todaySpecial->title = $request->title;
            $todaySpecial->status = $request->status;
            $todaySpecial->created_date = now()->format('Y-m-d');
            $todaySpecial->food_id = $foodIds;
            $todaySpecial->save();
    
            return redirect()->route('admin.today.special')->with('success', 'Today Special updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating Today Special.')->withErrors($e->getMessage());
        }
    }





    public function destroy($id)
    {
        $TodaySpecial = TodaySpecial::findOrFail($id);
        $TodaySpecial->delete();

        return redirect()->route('admin.today.special')->with('success', 'Today Special updated successfully.');
    }

}