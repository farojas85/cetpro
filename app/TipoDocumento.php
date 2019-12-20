<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use SoftDeletes;

    protected $fillable = ['id','nombre_corto','nombre_largo','tipo'];

    public function estudiantes()
    {
        return $this->hasOne(Estudiante::class);
    }
}
