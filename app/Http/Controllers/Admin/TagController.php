<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tags;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
       
        $searchTerm = $request->input('search');
        $tags = Tags::query();

        if ($searchTerm) {
            $tags->where('title', 'like', $searchTerm . '%');
        }
    
        $tags = $tags->orderBy('id', 'desc')->get();
                                 

        return view('admin.tags.index', compact('tags','searchTerm'));
    }
    
    public function create()
    {
        return view('admin.tags.create');
    }
    
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:tags,title',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $status = $request->has('status') ? 1 : 0;
    
        $tags = Tags::create([
            'title' => $request->title,
            'status' => $status,
        ]);
        if ($tags) {
            return redirect()->route('admin.tags')->with('success', 'Tags inserted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to insert Tags. Please try again.')->withInput();
        }
    }


    public function edit($id)
    {
        $tags = Tags::findOrFail($id);
        return view('admin.tags.edit', compact('tags'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:tags,title,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tags = Tags::findOrFail($id);
        $tags->title = $request->title;
        $tags->status = $request->has('status') ? 1 : 0;
        $tags->save();
        return redirect()->route('admin.tags')->with('success', 'Tags updated successfully.');
    }

    public function destroy($id)
    {
        $tags = Tags::findOrFail($id);
        $tags->delete();

        return redirect()->route('admin.tags')->with('success', 'Tags deleted successfully.');
    }
}