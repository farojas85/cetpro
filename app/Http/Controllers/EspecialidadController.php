<?php

namespace App\Http\Controllers;

use App\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{

    public function todos()
    {
        return Especialidad::withTrashed()->paginate(5);
    }

    public function habilitados()
    {
        return Especialidad::paginate(5);
    }

    public function eliminados()
    {
        return Especialidad::onlyTrashed()->paginate(5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:191'
        ]);

        $especialidad = Especialidad::create(['nombre' => $request->nombre]);

        return response()->json([
            'especialidad' => $especialidad,
            'mensaje' => 'Especialidad Agregada Satisfactoriamente'
        ]);
    }

    public function show(Request $request)
    {
        return Especialidad::withTrashed()->findOrFail($request->id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:191'
        ]);


        $especialidad = Especialidad::where('id',$request->id)
                        ->update([
                            'nombre' => $request->nombre,
                            'estado' => $request->estado
                        ]);

        return response()->json([
            'especialidad' => $especialidad,
            'mensaje' => 'Especialidad Actualizada Satisfactoriamente'
        ]);
    }

    public function destroyTemporal(Request $request)
    {
        $especialidad = Especialidad::withTrashed()
                                    ->where('id',$request->id)->first()->delete();

        return response()->json([
            'especialidad' => $especialidad,
            'mensaje' => 'Especialidad ha sido enviada a Papelera de Reciclaje'
        ]);
    }

    public function destroyPermanente(Request $request)
    {
        $especialidad = Especialidad::withTrashed()
                                    ->where('id',$request->id)->first()->forceDelete();

        return response()->json([
            'especialidad' => $especialidad,
            'mensaje' => 'Especialidad ha sido eliminada Satisfactoriamente'
        ]);
    }

    public function restaurar(Request $request) {
        $especialidad = Especialidad::onlyTrashed()
                                    ->where('id',$request->id)->first()->restore();

        return response()->json([
            'especialidad' => $especialidad,
            'mensaje' => 'Especialidad ha sido restaurada Satisfactoriamente'
        ]);
    }
}
