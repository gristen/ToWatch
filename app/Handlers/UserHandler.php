<?php

namespace App\Handlers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class UserHandler
{
    public static function query()
    {
        return User::query();
    }

    public static function model(): string
    {
        return User::class;
    }

    public static function table(): string
    {

        $model = static::model();

        return (new $model)->getTable();
    }

    public static function find($id)
    {
        return User::query()->findOrFail($id);
    }

    public static function delete($id)
    {

        Gate::authorize('user-action', 'user.delete');
        $user = self::find($id);
        debugbar()->info($user);
        $user->delete();
        Log::info('delete user id: ' . $id);

    }

    public static function update($id, array $data): void
    {
        Gate::authorize('user-action', 'user.edit');
        Log::info('update user id: ' . $id);
        $user = self::find($id);

        $user->update($data);
    }

}
