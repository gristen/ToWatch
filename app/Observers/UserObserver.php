<?php

namespace App\Observers;

use App\Models\User;
use App\Services\ActivityService;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    public function __construct(protected ActivityService $activityService)
    {
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $this->activityService->log('register', $user, $user);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        Log::info("Пользователь удален с ID: {$user->id}");
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
