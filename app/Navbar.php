<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    protected $fillable =['id','nombre','clase'];

    public function ThemeUser()
    {
        return $this->hasOne(ThemeUser::class);
    }

    public static function bgColor()
    {
        return [
            ['color' => 'bg-primary','id' => 1],
            ['color' => 'bg-secondary','id' => 2],
            ['color' => 'bg-info','id' => 3],
            ['color' => 'bg-success','id' => 4],
            ['color' => 'bg-danger','id' => 5],
            ['color' => 'bg-indigo','id' => 6],
            ['color' => 'bg-purple','id' => 7],
            ['color' => 'bg-pink','id' => 8],
            ['color' => 'bg-teal','id' => 9],
            ['color' => 'bg-cyan','id' => 10],
            ['color' => 'bg-dark','id' => 11],
            ['color' => 'bg-gray-dark','id' => 12],
            ['color' => 'bg-gray','id' => 13],
            ['color' => 'bg-light','id' => 14],
            ['color' => 'bg-warning','id' => 15],
            ['color' => 'bg-white','id' => 16],
            ['color' => 'bg-orange','id' => 17]
        ];
    }
}
