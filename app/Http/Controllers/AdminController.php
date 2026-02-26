<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\DashboardService;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    private DashboardService $dashboardService;
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = new DashboardService();
    }

    public function index()
    {
        $this->dashboardService->countForPeriod(User::class,'year');
        return view('admin.index');
    }
}
