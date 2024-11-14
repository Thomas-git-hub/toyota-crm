<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ApplicationController;



//LOGIN
Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name("login.user");
Route::post('/logout', [LoginController::class, 'logout'])->name("logout");

//DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//LEADS
Route::get('/leads', [LeadController::class, 'index'])->name('leads');;
Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
Route::get('/leads/list', [LeadController::class, 'list'])->name('leads.list');
Route::post('/leads/processing', [LeadController::class, 'processing'])->name('leads.processing');
Route::delete('/leads/destroy', [LeadController::class, 'destroy'])->name('leads.destroy');
Route::get('/getProvince', [LeadController::class, 'getProvince'])->name('leads.getProvince');
Route::get('/getUnit', [LeadController::class, 'getUnit'])->name('leads.getUnit');
Route::get('/leads/get-variants-and-colors', [LeadController::class, 'getVariantsAndColors'])->name('leads.getVariantsAndColors');
// EDIT LEADS


// APPLICATION
Route::get('/application', [ApplicationController::class, 'index'])->name('application');
