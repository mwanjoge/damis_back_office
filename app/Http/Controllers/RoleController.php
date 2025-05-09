<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role as ContractsRole;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    
    public function createRole(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Role::create(['name' => $request->name, 'guard_name' => 'web']);
        session()->flash('success', 'Role created successfully!');
        return redirect()->back();
    }

    public function updateRole(Role $role, Request $request)
    {
        $role->update(['name' => $request->name]);
        session()->flash('success', 'Role updated successfully!');
        return redirect()->back();
    }

    public function deleteRole(Role $role)
    {
        $role->delete();
        session()->flash('success', 'Role deleted successfully!');
        return redirect()->back();
    }

    public function rolesIndex()
    {
        $roles = Role::query()->with('permissions')->get();
        return view('authentication.roles.index', compact('roles'));
    }

    public function show($id)
    {
        $role = Role::findOrFail($id); // fetch single role
        $groupedPermissions = Permission::query()->get()->groupBy('group');

        return view('authentication.roles.show', compact('role', 'groupedPermissions'));
    }

public function authenticationIndex()
{
    $users = User::with('roles')->get(); // Eager load roles
    $permissions = Permission::all();
    $roles = Role::all();

    return view('authentication.authentication_home', compact('permissions', 'roles', 'users'));
}


    public function updatePermissions(Request $request, $roleId)
    {

        $role = Role::findOrFail($roleId);
        $permissions = $request->input('permissions', []);

        $role->syncPermissions($permissions);

        session()->flash('success', 'Permissions updated successfully!');
        return redirect()->route('roles.show', $roleId)->with('success', 'Permissions updated successfully.');
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'role_id' => 'required',
        ]);

        $user = User::findOrFail($request->user_id);
        $role = Role::findById($request->role_id);

        $user->syncRoles([$role->name]);

        return redirect()->back()->with('success', 'Role assigned successfully.');
    }
}
