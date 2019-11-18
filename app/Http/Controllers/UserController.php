<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('Sistema.usuario.index');
    }

    public function listaUsuario() {
        return User::with('roles')->paginate(5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:191',
            'nombres'   => 'required|string|max:191',
            'apellidos' => 'required|string|max:191',
            'email'     => 'required|string|email|max:191|unique:users',
            'dni'       => 'required|digits:8|max:8',
            'password'  => 'required|string|min:8',
            'role_id'   => 'required'
        ]);


        $user = new User();
        $user->nombres = $request->nombres;
        $user->apellidos = $request->apellidos;
        $user->name = $request->name;
        $user->dni = $request->dni;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        $user->assignRole($request->role_id);

        return response()->json(['mensaje' => 'Usuario registrado Satisfactoriamente']);
    }

    public function show(Request $request)
    {
        return User::with('roles')->select('id','name','nombres','apellidos','dni','email','foto','estado')
                        ->where('id',$request->id)
                        ->first();
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:191',
            'email'     => 'required|string|email|max:191',
        ]);

        $usuario = User::findOrFail($request->id);

        $usuario->name = $request->name;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->name = $request->name;
        $usuario->dni = $request->dni;

        if($request->password != ''){
            $usuario->password = Hash::make($request->password);
        }

        $usuario->email = $request->email;
        $usuario->save();

        $usuario->syncRoles($request->role_id);

        return response()->json(['mensaje' => 'Datos Usuario modificado Satisfactoriamente']);
    }

    public function destroy(Request $request)
    {
        $usuario = User::where('id',$request->id)->first();

        $usuario->roles()->detach();

        $usuario->delete();

        return response()->json(['mensaje' => 'Usuario Eliminado Satisfactoriamente']);
    }
}
