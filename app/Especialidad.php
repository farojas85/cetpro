<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use SoftDeletes;

    protected $fillable=['id','nombre','estado'];
}
