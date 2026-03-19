<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Получаем роли
        $admin = Role::where('name', 'admin')->first();
        $moderator = Role::where('name', 'moderator')->first();

        // Все permissions
        $allPermissions = Permission::all();

        // =========================
        // Admin получает всё
        // =========================
        $admin->permissions()->sync($allPermissions->pluck('id'));

        // =========================
        // Moderator получает всё кроме управления пользователями
        // =========================
        $moderatorPermissions = $allPermissions->filter(function($permission) {
            return !str_starts_with($permission->name, 'user_'); // убираем все user_*
        });

        $moderator->permissions()->sync($moderatorPermissions->pluck('id'));
    }
}
