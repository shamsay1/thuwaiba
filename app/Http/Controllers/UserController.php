<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        if(Auth::user()->role=="admin"){
             
        $users = User::where('role','!=','admin')->get();
        }elseif(Auth::user()->role=="hod"){
        $users = User::where('role','teacher')->where('department_id',Auth::user()->department_id)->get();

        }
        $departmnets = Department::all();
        return view("users",compact('users','departmnets'));
    }
    public function store(Request $request)
    {
        // VALIDATION
        $request->validate([
            'firstname'   => 'required|string|max:255',
            'middlename'  => 'nullable|string|max:255',
            'lastname'    => 'required|string|max:255',
            'gender'      => 'required|string',
            'email'       => 'required|email|unique:users,email',
            'mobile'      => 'required|string|max:20',
            'password'    => 'required|min:4',
            'role'        => 'required|string',
            'department'        => 'required',
        ]);
        User::create([
            'firstname'  => $request->firstname,
            'middlename' => $request->middlename,
            'lastname'   => $request->lastname,
            'gender'     => $request->gender,
            'email'      => $request->email,
            'mobile'     => $request->mobile,
            'password'   => Hash::make($request->password),
            'role'       => $request->role,
            'department_id'       => $request->department,
        ]);

        return redirect()->back()->with('success', 'User created successfully!');
}
        public function update(Request $request, $id)
{
    $request->validate([
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|email',
        'mobile' => 'required',
        'gender' => 'required',
        'role' => 'required',
    ]);

    $user = User::findOrFail($id);

    $user->update([
        'firstname' => $request->firstname,
        'middlename' => $request->middlename,
        'lastname' => $request->lastname,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'gender' => $request->gender,
        'role' => $request->role,
    ]);

    return redirect()->back()->with('success', 'User updated successfully');
}
}
