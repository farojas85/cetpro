<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{

    public function index()
    {
        return view('Sistema.permission_role.index');
    }

    public function listarPermissionRoles(Request $request)
    {
        return Role::with('permissions')->where('roles.id',$request->id)->get();
    }

    public function store(Request $request)
    {
        $role = Role::where('id',$request->role_id)->first();

        $role->syncPermissions($request->permission_name);

        return response()->json(['mensaje' => 'Permisos asignados al Rol, Satisfactoriamente']);
    }
}
