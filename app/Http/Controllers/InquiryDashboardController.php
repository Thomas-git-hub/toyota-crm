<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banks;
use App\Models\Status;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InquiryDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.inquiry_dashboard');
    }
}
