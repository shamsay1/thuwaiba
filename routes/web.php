<?php

use App\Http\Controllers\DepartmentCnotroller;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/',[LoginController::class,"showLogin"]);
Route::post('/login',[LoginController::class,"login"])->name('login');
Route::resource('/users',UserController::class);
Route::get('/dashboard',[LoginController::class,"dashboard"])->name("dashboard");
Route::resource('/departments',DepartmentCnotroller::class);
Route::resource('/equipment',EquipmentController::class);
Route::resource('/requests',UserRequestController::class);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
