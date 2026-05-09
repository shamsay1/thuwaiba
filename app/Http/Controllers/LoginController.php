<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Equipment;
use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function dashboard(){
         $deviceStats = DB::table('equipment')
    ->select('equipment_name', 'quantity_available')
    ->where('equipment.department_id',Auth::user()->department_id)->get();
        $total_hod = User::where("role","hod")->count();
        $total_request = UserRequest::all();
        $total_teachers = User::where("role","teacher")->count();
        $teachers = User::where("role","teacher")->take(5)->where('department_id',Auth::user()->department_id)->get();
        $total_equipment = Equipment::all();
        $equipments = Equipment::all();
        $equipmentNames = $equipments->pluck('equipment_name');
        $equipmentQuantity = $equipments->pluck('quantity_available');
        $app_req = UserRequest::where('overall_status','approved')->count();
        $pen_req = UserRequest::where('overall_status','pending_hod')->count();
        return view("dashboard",compact('pen_req','app_req','equipmentNames','equipmentQuantity','teachers','total_hod','total_request','total_teachers','total_equipment','deviceStats'));
    }
}
