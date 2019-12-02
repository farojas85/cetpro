<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use SoftDeletes;

    protected $fillable = ['id','nombre','modulo_id','estado'];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
}
