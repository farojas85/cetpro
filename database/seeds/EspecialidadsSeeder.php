<?php

use Illuminate\Database\Seeder;
use App\Especialidad;
use App\Modulo;
use App\Asignatura;

class EspecialidadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $esp1 = Especialidad::firstOrCreate(['nombre' =>'COMPUTACION']);
        $esp2 = Especialidad::firstOrCreate(['nombre' =>'SECRETARIADO']);
        $esp3 = Especialidad::firstOrCreate(['nombre' =>'FINANZA Y NEGOCIOS']);
        $esp4 = Especialidad::firstOrCreate(['nombre' =>'PELUQUERIA Y COSMETOLOGIA']);
        $esp5 = Especialidad::firstOrCreate(['nombre' =>'CONFECCION TEXTIL Y TEJIDO']);

        $mod1 = Modulo::firstOrCreate(['especialidad_id'=>$esp1->id,'nombre' => 'OFIMATICA']);
        $mod2 = Modulo::firstOrCreate(['especialidad_id'=>$esp1->id,'nombre' => 'HERRAMIENTAS DE INTERNET']);
        $mod3 = Modulo::firstOrCreate(['especialidad_id'=>$esp1->id,'nombre' => 'EDICION DE PUBLICIDAD VISUAL']);
        $mod4 = Modulo::firstOrCreate(['especialidad_id'=>$esp1->id,'nombre' => 'EDICION DE MENSAJES VISUALES']);

        $asig1 = Asignatura::firstOrCreate(['modulo_id'=>$mod1->id,'nombre'=> 'WINDOWS']);
        $asig2 = Asignatura::firstOrCreate(['modulo_id'=>$mod1->id,'nombre'=> 'OFFICE WORD']);
        $asig3 = Asignatura::firstOrCreate(['modulo_id'=>$mod1->id,'nombre'=> 'OFFICE EXCEL']);
        $asig4 = Asignatura::firstOrCreate(['modulo_id'=>$mod1->id,'nombre'=> 'OFFICE POWER POINT']);

    }
}
