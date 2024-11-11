<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LeadController;


//LOGIN
Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name("login.user");
Route::post('/logout', [LoginController::class, 'logout'])->name("logout");

//DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//LEADS
Route::get('/leads', [LeadController::class, 'index'])->name('leads');;


