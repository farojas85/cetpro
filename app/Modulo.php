<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use SoftDeletes;

    protected $fillable = ['id','nombre','especialidad_id','estado'];

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}
