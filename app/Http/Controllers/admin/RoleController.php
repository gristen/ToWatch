<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use DebugBar\DebugBar;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }
    public function edit(Role $role)
    {
        $permissions = Permission::all()
            ->groupBy(fn($permission) => explode('.', $permission->getRawOriginal('name'))[0]);

        debug($permissions);
        return view('admin.roles.update', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);

        $role->update(['name' => $request->name]);


        $role->permissions()->sync($request->permissions ?? []);

        return redirect()->route('admin.roles.index')->with('success', 'Роль обновлена');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('success', 'Роль удалена');
    }
}
