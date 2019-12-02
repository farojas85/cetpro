<?php

namespace App\Http\Controllers;

use App\Asignatura;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    public function filtro()
    {
        return Asignatura::select('id','nombre')->get();
    }

    public function todos()
    {
        return Asignatura::with(['modulo','modulo.especialidad'])->withTrashed()->paginate(5);
    }

    public function habilitados()
    {
        return Asignatura::with(['modulo','modulo.especialidad'])->paginate(5);
    }

    public function eliminados()
    {
        return Asignatura::with(['modulo','modulo.especialidad'])->onlyTrashed()->paginate(5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'modulo_id' => 'required',
            'nombre' => 'required|string|max:191'
        ]);

        $asignatura = Asignatura::create([
            'modulo_id' => $request->modulo_id,
            'nombre' => $request->nombre
        ]);

        return response()->json([
            'asignatura' => $asignatura,
            'mensaje' => 'La Asignatura ha sido agregada Satisfactoriamente'
        ]);
    }

    public function show(Request $request)
    {
        return Asignatura::with(['modulo','modulo.especialidad'])->withTrashed()->findOrFail($request->id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'modulo_id' => 'required',
            'nombre' => 'required|string|max:191'
        ]);

       $asignatura = Asignatura::where('id',$request->id)
                        ->update([
                            'modulo_id' => $request->modulo_id,
                            'nombre' => $request->nombre,
                            'estado' => $request->estado
                        ]);

        return response()->json([
            'asignatura' =>$asignatura,
            'mensaje' => 'La Asignatura ha sido actualizada Satisfactoriamente'
        ]);
    }

    public function destroyTemporal(Request $request)
    {
       $asignatura = Asignatura::withTrashed()
                                    ->where('id',$request->id)->first()->delete();

        return response()->json([
            'asignatura' =>$asignatura,
            'mensaje' => 'La Asignatura ha sido enviada a Papelera de Reciclaje'
        ]);
    }

    public function destroyPermanente(Request $request)
    {
       $asignatura = Asignatura::withTrashed()
                                    ->where('id',$request->id)->first()->forceDelete();

        return response()->json([
            'asignatura' =>$asignatura,
            'mensaje' => 'La Asignatura ha sido eliminada Satisfactoriamente'
        ]);
    }

    public function restaurar(Request $request) {
       $asignatura = Asignatura::onlyTrashed()
                        ->where('id',$request->id)->first()->restore();

        return response()->json([
            'asignatura' =>$asignatura,
            'mensaje' => 'La Asignatura ha sido restaurada Satisfactoriamente'
        ]);
    }
}
