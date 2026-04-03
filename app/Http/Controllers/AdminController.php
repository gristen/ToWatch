<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\DashboardService;
use DebugBar\DebugBar;
use Illuminate\Http\Request;


class AdminController extends Controller
{



    public function index()
    {

       return view('admin.index');
    }
}
