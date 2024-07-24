<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('role-permission.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role-permission.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'unique:roles,name',
            ],
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('role.index')->with('status', 'Новая роль создана!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $item)
    {
        return view('role-permission.role.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $item)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'unique:permissions,name',
            ],
        ]);

        $role = Role::find($item->id);

        $role->name = $data['name'];
        $role->save();

        return redirect()->route('role.index')->with('status', 'Изменение сохранено!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $item)
    {
        $item->delete();
        return redirect()->route('role.index')->with('status', 'Роль была удалена!');
    }

    public function addPermissionToRole(Role $item){
        $permissions = Permission::all();
        $role = Role::findOrFail($item->id);

        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_id', $item->id)
            ->pluck('permission_id', 'permission_id')
            ->all();

//        $rolePermissions = Role::query()
//            ->where('role_id', $item->id)
//            ->pluck('permission_id', 'permission_id')
//            ->all();
//        dd($rolePermissions);

        return view('role-permission.role.add-permission', compact('role', 'permissions', 'rolePermissions'));
    }

    public function givePermissionToRole(Request $request, $item){
        $request->validate([
            'permission' => 'required',
        ]);

        $role = Role::findOrFail($item);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('status', 'Изменения сохранены');
    }
}
