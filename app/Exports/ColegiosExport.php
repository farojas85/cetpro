<?php

namespace App\Exports;

use App\Colegio;
use Maatwebsite\Excel\Concerns\FromCollection;

class ColegiosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Colegio::select('codigo_modular','nombre','nivel_modalidad',
                                'gestion_dependencia','ubigeo','departamento',
                                'provincia','distrito')->get();
    }
}
