<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use SoftDeletes;

    protected $fillable =['id','tipo_documento_id','numero_documento','nombres','apellido_paterno',
                            'apellido_materno','sexo','direccion','telefono',
                            'fecha_nacimiento','foto'
                        ];

    public function TipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }
}
