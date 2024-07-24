<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('role-permission.permission.index', compact('permissions'));
    }
    public function create(){
        return view('role-permission.permission.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'unique:permissions,name',
            ],
        ]);

        Permission::create([
            'name' => $request->name,
        ]);

        return redirect()->route('permissions.index')->with('status', 'Новое разрешение создано!');
    }
    public function edit(Permission $item){
        return view('role-permission.permission.edit', compact('item'));
    }
    public function update(Request $request, Permission $item){
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'unique:permissions,name',
            ],
        ]);

        $permission = Permission::find($item->id);

        $permission->name = $data['name'];
        $permission->save();

        return redirect()->route('permissions.index')->with('status', 'Изменение сохранено!');
    }
    public function destroy(Permission $item){
        $item->delete();
        return redirect()->route('permissions.index')->with('status', 'Разрешение было удалено!');
    }
}
