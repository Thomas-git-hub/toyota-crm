<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SFMDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.sales_funnel_management_dashboard');
    }
}
