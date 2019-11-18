<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function index()
    {
        return view('Sistema.permission.index');
    }

    public function lista()
    {
        return Permission::paginate(5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:191'
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();

        return response()->json(['mensaje' => 'Permiso Registrado Satisfactoriamente']);
    }

    public function show(Request $request)
    {
        return Permission::where('id',$request->id)
                            ->select('id','name','slug','description')
                            ->first();

    }


    public function edit(Permission $permission)
    {
        //
    }

     public function update(Request $request, Permission $permission)
    {
        //
    }


    public function destroy(Request $request)
    {
        $permiso = Permission::findOrFail($request->id);
        $permiso->delete();

        return response()->json(['mensaje' => 'Permiso Registrado Satisfactoriamente']);
    }

    public function filtro()
    {
        return Permission::select('id','name','slug','description')->orderBy('id','asc')->get();
    }
}
