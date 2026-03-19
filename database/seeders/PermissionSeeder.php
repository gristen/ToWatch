<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{


    private $permissions = [

        'movie.view',
        'movie.create',
        'movie.edit',
        'movie.delete',
        'movie.publish',

        'user.view',
        'user.create',
        'user.edit',
        'user.delete',
        'user.ban',

        'role.view',
        'role.create',
        'role.edit',
        'role.delete',
        'role.assign_permissions',

        'task.view',
        'task.create',
        'task.edit',
        'task.delete',
        'task.assign',
        'task.complete',

    ];

    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);

        }
    }
}
