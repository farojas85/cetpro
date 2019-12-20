<?php

use App\TipoDocumento;
use Illuminate\Database\Seeder;

class TipoDocumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumento::firstOrCreate([
            'tipo' => '01','longitud' => 8,
            'nombre_corto' => 'L.E/D.N.I','nombre_largo' => 'Documento Nacional de Identidad'
        ]);
        TipoDocumento::firstOrCreate([
            'tipo' => '04','longitud' => 12,
            'nombre_corto' => 'CARNET EXT.','nombre_largo' => 'Carnet de Extranjeria'
        ]);
        TipoDocumento::firstOrCreate([
            'tipo' => '06','longitud' => 11,
            'nombre_corto' => 'R.U.C','nombre_largo' => 'Régimen Único de Contribuyentes'
        ]);
        TipoDocumento::firstOrCreate([
            'tipo' => '07','longitud' => 12,
            'nombre_corto' => 'PASAPORTE','nombre_largo' => 'PASAPORTE'
        ]);
        TipoDocumento::firstOrCreate([
            'tipo' => '11','longitud' => 15,
            'nombre_corto' => 'P. NAC','nombre_largo' => 'Partida de Nacimiento - Identidad'
        ]);
        TipoDocumento::firstOrCreate([
            'tipo' => '00','longitud' => 15,
            'nombre_corto' => 'OTROS','nombre_largo' => 'OTROS'
        ]);
    }
}
