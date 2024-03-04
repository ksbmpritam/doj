<?php

namespace App\Http\Controllers\franchies;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $user = Session::get('user');

        if (!$user || empty($user->id) || $user->role !== "franchies") {
            return redirect('/franchies');
        }

        $departments = Department::where('franchies_id', $user->id)->orderBy('id', 'desc')->get();

        return view('franchies.department.index', compact('departments'));
    }

    public function create()
    {
        return view('franchies.department.create');
    }

    public function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $user = Session::get('user');

        if (!$user) {
            return redirect('franchies');
        }

        Department::create([
            'name' => $request->input('name'),
            'franchies_id' => $user->id,
            'type' => "franchies",
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('franchies.department')->with('success', 'Department inserted successfully.');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('franchies.department.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $user = Session::get('user');
        //   dd($user);
        if (!$user) {
            return redirect('franchies');
        }

        $department = Department::find($id);

        if (!$department) {
            return redirect()->back()->with('error', 'Department not found.');
        }

        $department->name = $request->input('name');
        $department->franchies_id = $user->id;
        $department->type = "franchies";
        $department->status = $request->has('status') ? 1 : 0;
        $department->save();

        return redirect()->route('franchies.department')->with('success', 'Department updated successfully.');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('franchies.department')->with('success', 'Department deleted successfully.');
    }
}
