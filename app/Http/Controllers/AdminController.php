<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\DashboardService;
use DebugBar\DebugBar;
use Illuminate\Http\Request;


class AdminController extends Controller
{

    public function __construct(private DashboardService $dashboardService)
    {}

    public function index()
    {
       $DashboardData = $this->dashboardService->getDashboardData();
       $users = User::query()->paginate('5');
       debug($DashboardData,$users);
       return view('admin.index', compact('DashboardData','users'));
    }
}
