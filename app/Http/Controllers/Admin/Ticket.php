<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tickets;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Ticket extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $tickets = Tickets::orderBy('id', 'desc')->with('users', 'ticketType')->get();
        return view('admin.tickets.index', compact('tickets'));
    }
    
    public function create()
    {
        return view('admin.tickets.create');
    }
    
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ticket_type' => 'required',
            'user_id' => 'required',
            'subject' => 'required',
            'email' => 'required',
            'descreption' => 'required',
            'status' => 'required',
            'created_date' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $status = $request->has('status') ? 1 : 0;
    
        $ticket_type = Tickets::create([
            'title' => $request->ticket_type,
            'user_id' => $request->user_id,
            'subject' => $request->subject,
            'email' => $request->email,
            'descreption' => $request->descreption,
            'status' => $status,
            'created_date' => $request->created_date,
        ]);
        
        if ($ticket_type) {
            return redirect()->route('admin.ticket')->with('success', 'Ticket inserted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to insert Ticket. Please try again.')->withInput();
        }
    }


    public function edit($id)
    {
        $ticket = Tickets::with('users', 'ticketType')->findOrFail($id);
        return view('admin.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
            'ticket_type' => 'required',
            'user_id' => 'required',
            'subject' => 'required',
            'email' => 'required',
            'descreption' => 'required',
            'status' => 'required',
            'created_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ticket = Tickets::findOrFail($id);
        $ticket->ticket_type = $request->ticket_type;
        $ticket->user_id = $request->user_id;
        $ticket->subject = $request->subject;
        $ticket->email = $request->email;
        $ticket->descreption = $request->descreption;
        $ticket->status = $request->has('status') ? 1 : 0;
        $ticket->created_date = $request->created_date;
        $ticket->save();
        return redirect()->route('admin.ticket')->with('success', 'Ticket updated successfully.');
    }

    public function destory($id)
    {
        $ticket = Tickets::findOrFail($id);
        $ticket->delete();

        return redirect()->route('admin.ticket')->with('success', 'Ticket deleted successfully.');
    }
}