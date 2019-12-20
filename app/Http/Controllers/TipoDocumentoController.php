<?php

namespace App\Http\Controllers;

use App\TipoDocumento;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    public function filtro()
    {
        return TipoDocumento::select('id','nombre_corto')->get();
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(TipoDocumento $tipoDocumento)
    {
        //
    }

    public function edit(TipoDocumento $tipoDocumento)
    {
        //
    }

    public function update(Request $request, TipoDocumento $tipoDocumento)
    {
        //
    }

    public function destroy(TipoDocumento $tipoDocumento)
    {
        //
    }
}
