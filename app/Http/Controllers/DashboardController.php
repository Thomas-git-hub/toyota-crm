<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        if(Auth::check()){
            return view('dashboard');
        }else{
            return view('index');
        }

    }

    public function releaseStats()
    {
        // Fetch data for Release Stats
        // $data = ReleaseStats::all();
        return view('dashboard.release-stats', compact('data'));
    }

    public function inquiryAnalysis()
    {
        // Fetch data for Inquiry Analysis
        // $data = Inquiry::all();
        return view('dashboard.inquiry-analysis', compact('data'));
    }

    public function salesFunnel()
    {
        // Fetch data for Sales Funnel
        // $data = SalesFunnel::all();
        return view('dashboard.sales-funnel', compact('data'));
    }

    public function profitability()
    {
        // Fetch data for Profitability
        // $data = Profitability::all();
        return view('dashboard.profitability', compact('data'));
    }

    public function vehicleToSales()
    {
        // Fetch data for Vehicle to Sales
        // $data = VehicleToSales::all();
        return view('dashboard.vehicle-to-sales', compact('data'));
    }

    public function ranking()
    {
        // Fetch data for Ranking
        // $data = Ranking::all();
        return view('dashboard.ranking', compact('data'));
    }
}
