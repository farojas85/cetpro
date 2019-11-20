<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    protected $fillable =['id','nombre','clase'];

    public function ThemeUser()
    {
        return $this->hasOne(ThemeUser::class);
    }

    public static function darkBgColor()
    {
        return [
            ['color' => 'bg-primary','id' => 1],
            ['color' => 'bg-warning','id' => 2],
            ['color' => 'bg-info','id' => 3],
            ['color' => 'bg-danger','id' => 4],
            ['color' => 'bg-success','id' => 5],
            ['color' => 'bg-indigo','id' => 6],
            ['color' => 'bg-navy','id' => 7],
            ['color' => 'bg-purple','id' => 8],
            ['color' => 'bg-fuchsia','id' =>9],
            ['color' => 'bg-pink','id' => 10],
            ['color' => 'bg-maroon','id' => 11],
            ['color' => 'bg-orange','id' => 12],
            ['color' => 'bg-lime','id' => 13],
            ['color' => 'bg-teal','id' => 14],
            ['color' => 'bg-olive','id' => 15]
        ];
    }

    public static function lightBgColor()
    {
        return [
            ['color' => 'bg-primary','id' => 16],
            ['color' => 'bg-warning','id' => 17],
            ['color' => 'bg-info','id' => 18],
            ['color' => 'bg-danger','id' => 19],
            ['color' => 'bg-success','id' => 20],
            ['color' => 'bg-indigo','id' => 21],
            ['color' => 'bg-navy','id' => 22],
            ['color' => 'bg-purple','id' => 23],
            ['color' => 'bg-fuchsia','id' =>24],
            ['color' => 'bg-pink','id' => 25],
            ['color' => 'bg-maroon','id' => 26],
            ['color' => 'bg-orange','id' => 27],
            ['color' => 'bg-lime','id' => 28],
            ['color' => 'bg-teal','id' => 29],
            ['color' => 'bg-olive','id' => 30]
        ];
    }
}
