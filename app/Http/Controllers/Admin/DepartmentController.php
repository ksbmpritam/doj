<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
 use App\Models\Franchise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;



class DepartmentController extends Controller
{
    
    public function departmentList($id)
    {
        $team_id = $id;
        $departments = Department::where('franchies_id', $id)->where('type', 'franchies')->get();
        return view('admin.franchies.detail.franchies.department_list', compact('departments', 'team_id'))->with('id', $id);
    }
    
    public function departmentList2($id)
    {
        $team_id = $id;
        $departments = Department::where('employee_id', $id)->where('type', 'employee')->get();
      
        return view('admin.employee.detail.employee.department_list', compact('departments', 'team_id'))->with('id', $id);
    }

    
    public function departmentDetail($id)
    {
        $department = Department::findOrFail($id);
        $team_id = $department->franchies_id;
        return view('admin.franchies.detail.franchies.department_detail', compact('department', 'team_id'));
    }
    
    public function departmentDetail2($id)
    {
        $department = Department::findOrFail($id);
        $team_id = $department->employee_id;
        return view('admin.employee.detail.employee.department_detail', compact('department', 'team_id'));
    }
  public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.franchies.departmentedit', compact('department'));
    }
    
    
 

public function departmentupdate(Request $request, $id)
{
    // Validate the input data
    $validation = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'status' => 'boolean',
    ]);

    if ($validation->fails()) {
        return redirect()->back()->withErrors($validation)->withInput();
    }

    $department = Department::find($id);
    
    // dd($department);

    if (!$department) {
        return redirect()->route('admin.department')->with('error', 'Department not found.');
    }

    $department->update([
        'name' => $request->input('name'),
        'department' => $request->id, 
        'employee' => $request->input('employee'), 
        'status' => $request->has('status') ? 1 : 0,
    ]);


    return redirect()->route('admin.employee.department.departmentlist', ['id' => $department->employee_id])->with('success', 'Department updated successfully.');
}

  public function departmentEdit($id)
    {
        $department = Department::findOrFail($id);
        $team_id = $department->employee_id;
        return view('admin.employee.detail.employee.editdepartment', compact('department', 'team_id'));
    }



}
