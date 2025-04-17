<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Usertype;

use Illuminate\Http\Request;

class InventoryBacklogsController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return view('upload_backlogs.inventory_backlogs');
        }else{
            return view('index');
        }
    }
}
