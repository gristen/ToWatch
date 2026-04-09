<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Services\DashboardService;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardPage extends Component
{
    use WithPagination;

    public array $DashboardData;
    protected DashboardService $dashboardService;

    public function boot(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }


    public function mount()
    {
        $this->DashboardData = $this->dashboardService->getDashboardData();
        debugbar()->info($this->DashboardData);
    }

    public function render()
    {

        return view('livewire.admin.dashboard-page', [
            'users' => User::paginate(5),
            'DashboardData' => $this->DashboardData,
        ]);
    }
}
