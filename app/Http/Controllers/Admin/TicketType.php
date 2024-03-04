<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\TycketTypes;
use Illuminate\Support\Facades\Validator;

class TicketType extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $ticket_type = TycketTypes::orderBy('id', 'desc')->get();

        return view('admin.ticket_type.index', compact('ticket_type'));
    }
    
    public function create()
    {
        return view('admin.ticket_type.create');
    }
    
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:ticket_type,title',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $status = $request->has('status') ? 1 : 0;
    
        $ticket_type = TycketTypes::create([
            'title' => $request->title,
            'status' => $status,
        ]);
        if ($ticket_type) {
            return redirect()->route('admin.ticket_type')->with('success', 'Ticket Type inserted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to insert Ticket Type. Please try again.')->withInput();
        }
    }


    public function edit($id)
    {
        $ticket_type = TycketTypes::findOrFail($id);
        return view('admin.ticket_type.edit', compact('ticket_type'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:ticket_type,title,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ticket_type = TycketTypes::findOrFail($id);
        $ticket_type->title = $request->title;
        $ticket_type->status = $request->has('status') ? 1 : 0;
        $ticket_type->save();
        return redirect()->route('admin.ticket_type')->with('success', 'Ticket Type updated successfully.');
    }

    public function destroy($id)
    {
        $ticket_type = TycketTypes::findOrFail($id);
        $ticket_type->delete();

        return redirect()->route('admin.ticket_type')->with('success', 'Ticket Type deleted successfully.');
    }
}