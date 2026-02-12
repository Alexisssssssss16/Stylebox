<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles_list')->only('index');
        $this->middleware('permission:roles_create')->only(['create', 'store']);
        $this->middleware('permission:roles_edit')->only(['edit', 'update']);
        $this->middleware('permission:roles_delete')->only('destroy');
    }

    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($item) {
            return explode('_', $item->name)[0];
        });
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array'
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
    }

    public function edit(Role $role)
    {
        if ($role->name === 'admin') {
            return redirect()->route('roles.index')->with('error', 'El rol Admin no se puede editar.');
        }

        $permissions = Permission::all()->groupBy(function ($item) {
            return explode('_', $item->name)[0];
        });

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        if ($role->name === 'admin') {
            return redirect()->route('roles.index')->with('error', 'El rol Admin no se puede editar.');
        }

        $request->validate([
            'name' => ['required', Rule::unique('roles', 'name')->ignore($role->id)],
            'permissions' => 'required|array'
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'admin') {
            return back()->with('error', 'No se puede eliminar el rol Admin.');
        }

        if ($role->users()->count() > 0) {
            return back()->with('error', 'No se puede eliminar un rol con usuarios asignados.');
        }

        $role->delete();
        return back()->with('success', 'Rol eliminado correctamente.');
    }
}
