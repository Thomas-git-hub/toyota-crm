<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RankingDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.ranking_dashboard');
    }
}
