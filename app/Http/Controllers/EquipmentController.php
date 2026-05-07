<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{
     public function index()
    {
        $equipments = Equipment::with('department')->get();
        $departments = Department::all();

        return view('equipment', compact('equipments', 'departments'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'equipment_name' => 'required',
            'quantity_available' => 'required|integer',
        ]);

        Equipment::create([
            'equipment_name' => $request->equipment_name,
            'quantity_available' => $request->quantity_available,
            'department_id' => Auth::user()->department_id,
        ]);

        return redirect()->back()->with('success', 'Equipment added successfully');
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'equipment_name' => 'required',
            'quantity_available' => 'required|integer',
            'department_id' => 'required'
        ]);

        $equipment = Equipment::findOrFail($id);

        $equipment->update([
            'equipment_name' => $request->equipment_name,
            'quantity_available' => $request->quantity_available,
            'department_id' => $request->department_id,
        ]);

        return redirect()->back()->with('success', 'Equipment updated successfully');
    }
}
