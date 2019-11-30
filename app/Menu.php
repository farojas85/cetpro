<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
class Menu extends Model
{
    use SoftDeletes;

    protected $fillable = ['id','descripcion','enlace','imagen','parent'];

    public function roles()
    {
        return $this->belongsToMany('Spatie\Permission\Models\Role')->withTimestamps();
    }

    public function padre()
    {
        return $this->belongsTo(Menu::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class,'padre_id');
    }

    public static function maximoPadreId()
    {
        $countfilas = Menu::where('padre_id','=',0)->count();
        return ($countfilas ==0) ? 0 : (Menu::where('padre_id','=',0)->max('orden')+1);
    }
    public static function maximoHijoId($padre_id)
    {
        $countfilas= Menu::where('padre_id','=',$padre_id)->count();
        return ($countfilas == 0) ? 0 : Menu::where('padre_id','=',$padre_id)->max('orden') + 1 ;
    }

    public static function menusPadres($front){
        //Obtenemos el Id del Rol del usuario Autenticado
        if($front) {
            return Menu::whereHas('roles', function ($query) {
                $role_id=0;
                $roles = Auth::user()->roles;
                foreach($roles as $role) {
                    $role_id = $role['id'];
                }
                $query->where('role_id',$role_id)->orderby('padre_id');
            })->where('padre_id',0)->orderby('orden')->get()->toArray();
        } else {
            return $this->orderby('padre_id')->orderby('orden')->get()->toArray();
        }
    }
    public function menusHijos($padres)
    {
        $children = [];
        foreach ($padres as $line1) {
            $hijos = Menu::whereHas('roles', function ($query) {
                        $role_id=0;
                        $roles = Auth::user()->roles;
                        foreach($roles as $role) {
                            $role_id = $role['id'];
                        }
                        $query->where('role_id',$role_id)->orderby('padre_id');
                    })->where('padre_id',$line1['id'])->orderby('orden')->get()->toArray();

            $children = array_merge($children, [array_merge($line1, ['submenu' => $hijos ])]);
        }
        return $children;
    }

    public static function getMenu($front = false)
    {
        $menus = new Menu();
        $padres = $menus->menusPadres($front);
        return $menus->menusHijos($padres);
    }
    public static function menusHijosxPadres($padre_id){
        return Menu::where('padre_id','=',$padre_id)->orderBy('orden')->get();
    }
}
