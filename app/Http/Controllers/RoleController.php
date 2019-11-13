<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('Sistema.role.index');
    }


    public function listaRoles() {
        return Role::latest()->paginate(5);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rule = [
            'name' => 'required|unique:roles,name|max:191|string',
        ];

        $messages = [
            'required' => '* Campo Obligatorio',
            'unique' => 'Nombre en Uso',
            'max' => 'Longitud no mayor a :max.',
            'string' => 'Debe ser cadena'
        ];

        $this->validate($request,$rule,$messages);

        $role = Role::firstOrCreate([ 'name' =>  $request->name ]);

        return response()->json([
            'role' => $role,
            'mensaje' => 'Rol registrado Satisfactoriamente']);
    }

    public function show(Request $request)
    {
        return Role::select('id','name','guard_name')
                    ->where('id',$request->id)->first();
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        $rule = [
            'name' => 'required|max:191|string',
        ];

        $messages = [
            'required' => '* Campo Obligatorio',
            'max' => 'Longitud no mayor a :max.',
            'string' => 'Debe ser cadena'
        ];

        $this->validate($request,$rule,$messages);

        $role = Role::findOrFail($request->id);

        $role->name = $request->name;
        $role->save();

        return response()->json([
            'role' => $role,
            'mensaje' => 'Rol modificado Satisfactoriamente']);
    }

    public function destroy(Request $request)
    {
        $role = Role::where('id',$request->id)->first();
        $role->delete();

        return response()->json(['mensaje' => 'Rol Eliminado Satisfactoriamente']);
    }

    public function buscar(Request $request)
    {
        return Role::where('name','like','%'.$request->busqueda.'%')->paginate(5);
    }

    public function filtro()
    {
        return Role::select('id','name')->orderBy('id','asc')->get();
    }
}
