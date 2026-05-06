<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::where('role','!=','admin')->get();
        return view("users",compact('users'));
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
            'password'    => 'required|min:6',
            'role'        => 'required|string',
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
        ]);

        return redirect()->back()->with('success', 'User created successfully!');
}
}
