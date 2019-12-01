<?php

namespace App\Http\Controllers;

use App\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function todos()
    {
        return Modulo::with('especialidad')->withTrashed()->paginate(5);
    }

    public function habilitados()
    {
        return Modulo::with('especialidad')->paginate(5);
    }

    public function eliminados()
    {
        return Modulo::with('especialidad')->onlyTrashed()->paginate(5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'especialidad_id' => 'required',
            'nombre' => 'required|string|max:191'
        ]);

        $modulo = Modulo::create([
            'especialidad_id' => $request->especialidad_id,
            'nombre' => $request->nombre
        ]);

        return response()->json([
            'Modulo' => $modulo,
            'mensaje' => 'Módulo Agregado Satisfactoriamente'
        ]);
    }

    public function show(Request $request)
    {
        return Modulo::with('especialidad')->withTrashed()->findOrFail($request->id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'especialidad_id' => 'required',
            'nombre' => 'required|string|max:191'
        ]);

        $modulo = Modulo::where('id',$request->id)
                        ->update([
                            'especialidad_id' => $request->especialidad_id,
                            'nombre' => $request->nombre,
                            'estado' => $request->estado
                        ]);

        return response()->json([
            'Modulo' => $modulo,
            'mensaje' => 'Módulo Actualizado Satisfactoriamente'
        ]);
    }

    public function destroyTemporal(Request $request)
    {
        $Modulo = Modulo::withTrashed()
                                    ->where('id',$request->id)->first()->delete();

        return response()->json([
            'Modulo' => $Modulo,
            'mensaje' => 'Módulo ha sido enviado a Papelera de Reciclaje'
        ]);
    }

    public function destroyPermanente(Request $request)
    {
        $modulo = Modulo::withTrashed()
                                    ->where('id',$request->id)->first()->forceDelete();

        return response()->json([
            'Modulo' => $modulo,
            'mensaje' => 'Módulo ha sido eliminado Satisfactoriamente'
        ]);
    }

    public function restaurar(Request $request) {
        $modulo = Modulo::onlyTrashed()
                        ->where('id',$request->id)->first()->restore();

        return response()->json([
            'especialidad' => $modulo,
            'mensaje' => 'Módulo ha sido restaurado Satisfactoriamente'
        ]);
    }
}
