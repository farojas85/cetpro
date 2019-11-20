<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThemeUser extends Model
{
    protected $fillable = ['id','user_id','navbar_id','sidebar_id','brandlogo_id'];

    public function navbar()
    {
        return $this->belongsTo(Navbar::class);
    }

    public function sidebar()
    {
        return $this->belongsTo(Sidebar::class);
    }

    public function brandlogo()
    {
        return $this->belongsTo(Brandlogo::class);
    }
}
