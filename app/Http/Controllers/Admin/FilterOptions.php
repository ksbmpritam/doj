<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Filter;
use App\Models\FilterOption;

class FilterOptions extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
    {
        $filters = Filter::all();
        return view("admin.FilterOption.index",compact('filters'));
    }
    
    public function create(){
        return view("admin.FilterOption.create");
    }
    
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:filter',
        ]);

        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $slug = Str::slug($request->title);
         
        $data = Filter::create([
            'title' => $request->title,
            'slug' => $slug,
            'status' => $request->has('status') ? 1 : 0,

        ]);
    
        if (!$data->id) {
            return redirect()->back()->with('error', 'Error creating Filter admin.')->withInput();
        }
        
        if($data->id){
            if($request->option_title){
                foreach ($request->option_title as $key => $value) {
                    FilterOption::create([
                        'filter_id' => $data->id,
                        'title' => $value,
                    ]);
                }
            }
        }
    
     
        return redirect()->route('admin.filter')->with('success', 'Filter added successfully.');
    }

  
    public function edit($id)
    {
       
        $filter = Filter::with('filter_option')->findOrFail($id);
        
        return view('admin.FilterOption.edit', compact('filter'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:filter,title,' . $id, 
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $slug = Str::slug($request->title);
        $filter = Filter::findOrFail($id);
        
        $filter->title = $request->input('title');
        $filter->slug = $slug;
        $filter->status = $request->input('status') ? 1 : 0;
        $filter->save();
    
        // Delete existing FilterOptions and recreate them
        $filter->filter_option()->delete();
        if($request->input('option_title')){
            foreach ($request->input('option_title') as $key => $value) {
                FilterOption::create([
                    'filter_id' => $filter->id,
                    'title' => $value,
                ]);
            }
        }
    
        return redirect()->route('admin.filter')->with('success', 'Filter updated successfully.');
    }


    public function delete($id)
    {
        $filter = Filter::findOrFail($id);
    
        // Delete associated FilterOptions
        $filter->filter_option()->delete();
    
        // Delete the Filter
        $filter->delete();
    
        return redirect()->route('admin.filter')->with('success', 'Filter deleted successfully.');
    }


}
