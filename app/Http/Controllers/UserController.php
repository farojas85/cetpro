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
        return User::with('roles')->latest()->paginate(5);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:191',
            'email'     => 'required|string|email|max:191|unique:users',
            'password'  => 'required|string|min:8',
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->roles()->sync($request->role_id);

        return response()->json(['mensaje' => 'Usuario registrado Satisfactoriamente']);
    }

     public function show(Request $request)
    {
        return User::with('roles')->select('id','name','email','foto','estado')
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
        $usuario->email = $request->email;
        $usuario->foto = $request->foto;
        $usuario->estado = $request->estado;
        $usuario->save();

        $usuario->roles()->sync($request->role_id);

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
