<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class DashboardService
{

    public function __construct(protected ActivityService $activityService)
    {}

    public function getDashboardData()
    {
        return  [
            'totalUsers' => User::query()->count(),
            'year' => $this->countForPeriod(User::class,'year'),
            'monthlyRegistration' => $this->getMonthlyRegistrations(),
            'activities' => $this->activityService->getActivity(),
            ];
    }

    public function countForPeriod(string $model, string $period)
    {
       $now = Carbon::now();
       $dates = match ($period) {
            "year" => [
                $now->copy()->startOfYear(),
                $now->copy()->endOfYear(),
            ],
            "month" => [
                $now->copy()->startOfMonth(),
                $now->copy()->endOfMonth(),
            ],
            "week" => [
                $now->copy()->startOfWeek(),
                $now->copy()->endOfWeek(),
            ],
            "day" => [
                $now->copy()->startOfDay(),
                $now->copy()->endOfDay(),
            ],
            default => 0
        };

       $result = $model::whereBetween('created_at', $dates)->count();
        return $result;
    }



    public function getMonthlyRegistrations():array
    {

        $currentYear = Carbon::now()->year;

        $months = [
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь'
        ];

        $stats = [];

        foreach ($months as $monthNumber => $monthName) {
            $count = User::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $monthNumber)
                ->count();


            $stats[$monthName] = $count;
        }
        return $stats;
    }

}
