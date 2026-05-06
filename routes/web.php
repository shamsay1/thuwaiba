<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[LoginController::class,"showLogin"]);
Route::post('/login',[LoginController::class,"login"])->name('login');
Route::resource('/users',UserController::class);
Route::get('/dashboard',[LoginController::class,"dashboard"])->name("dashboard");
