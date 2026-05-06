<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin(){
        return view("login");
    }
    public function login(Request $request){
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        $credentials = $request->only("email","password");
        if(Auth::attempt($credentials)){
            return redirect()->route("dashboard");

        }
        else{
            return back()->with("error","Invlaid credential email/password");
        }
    }
    public function dashboard(){
        return view("dashboard");
    }
}
