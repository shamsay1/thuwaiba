<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Equipment;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRequestController extends Controller
{
     public function index()
    {
        $requests = UserRequest::with(['teacher','department','equipment'])->get();

        $departments = Department::all();
        $equipments = Equipment::all();

        return view('request', compact('requests','departments','equipments'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required',
            'quantity' => 'required|integer',
            'reason' => 'required',
            'request_date' => 'required'
        ]);

        UserRequest::create([
            'user_id' => Auth::user()->id,
            'department_id' => Auth::user()->department_id,
            'equipment_id' => $request->equipment_id,
            'quantity' => $request->quantity,
            'reason' => $request->reason,
            'request_date' => $request->request_date,
            'overall_status' => 'pending_hod'
        ]);

        return redirect()->back()->with('success','Request submitted');
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $req = UserRequest::findOrFail($id);

        $req->update([
            'quantity' => $request->quantity,
            'reason' => $request->reason,
            'overall_status' => $request->overall_status
        ]);

        return redirect()->back()->with('success','Updated successfully');
    }
}
