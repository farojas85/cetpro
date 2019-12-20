<?php

namespace App\Http\Controllers;

use App\Estudiante;
use Peru\Http\ContextClient;
use Peru\Jne\{Dni, DniParser};
use DB;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        return view('estudiante.index');
    }

    public function filtro()
    {
        return Estudiante::select('id','nombres','apellidos')->get();
    }

    public function todos()
    {
        return Estudiante::withTrashed()->paginate(10);
    }

    public function habilitados()
    {
        return Estudiante::paginate(10);
    }

    public function eliminados()
    {
        return Estudiante::onlyTrashed()->paginate(10);
    }

    public function buscarDni(Request $request)
    {
        $rules = [
            'numero_documento' => 'required|min:8'
        ];

        $mensaje=[
            'required' =>"*Campo Obligatorio",
            'min' => 'Ingrese 8 Dígitos'
        ];

        $this->validate($request,$rules,$mensaje);

        $cs = new Dni(new ContextClient(), new DniParser());

        $person = $cs->get($request->numero_documento);

        return json_encode($person);
    }

    public function buscarEstudiante(Request $request)
    {
        if($request->texto ==null || $request->texto == '')
        {
            return Estudiante::paginate(10);
        }

        return Estudiante::withTrashed()
                        ->where(DB::Raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombres)"),'LIKE',"%".mb_strtoupper($request->texto)."%")
                        ->paginate(10);
    }

    public function store(Request $request)
    {
        $rules = [
            'tipo_documento_id' => 'required',
            'numero_documento' => 'required|min:8',
            'nombres' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'sexo' => 'required'
        ];

        $mensaje=[
            'required' =>"*Campo Obligatorio",
            'min' => 'Ingrese 8 Dígitos'
        ];

        $this->validate($request,$rules,$mensaje);

        $request->foto = ($request->sexo == "M") ? 'images/user-male.png' : 'images/user-female.png';

        $estudiante = Estudiante::create([
            'tipo_documento_id' => $request->tipo_documento_id,
            'numero_documento' => $request->numero_documento,
            'nombres' => mb_strtoupper($request->nombres),
            'apellido_paterno' => mb_strtoupper($request->apellido_paterno),
            'apellido_materno' => mb_strtoupper($request->apellido_materno),
            'sexo' => $request->sexo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'foto' => $request->foto
        ]);


        return response()->json([
            'estudiante' => $estudiante,
            'mensaje' => 'Estudiante Registrado Satisfactoriamente'
        ]);
    }

    public function show(Estudiante $estudiante)
    {
        //
    }

    public function edit(Estudiante $estudiante)
    {
        //
    }

    public function update(Request $request, Estudiante $estudiante)
    {
        //
    }

    public function destroy(Estudiante $estudiante)
    {
        //
    }
}
