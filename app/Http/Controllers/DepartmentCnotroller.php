<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentCnotroller extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return view('departments', compact('departments'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required'
        ]);

        Department::create([
            'department_name' => $request->department_name
        ]);

        return redirect()->back()->with('success', 'Department added successfully');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'department_name' => 'required'
        ]);

        $department = Department::findOrFail($id);

        $department->update([
            'department_name' => $request->department_name
        ]);

        return redirect()->back()->with('success', 'Department updated successfully');
    }
}
