<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use App\Navbar;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,HasRoles,SoftDeletes;

    protected $fillable = [
        'name','nombres','apellidos','dni', 'email', 'password','foto','estado'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ThemeUser()
    {
        return $this->hasOne(ThemeUser::class);
    }

    public static function navbarByUser($user_id)
    {
        return ThemeUser::with('navbar')->where('user_id',$user_id)->first();
    }

    public static function sidebarByUser($user_id)
    {
        return ThemeUser::with('sidebar')->where('user_id',$user_id)->first();
    }

    public static function brandlogoByUser($user_id)
    {
        return ThemeUser::with('brandlogo')->where('user_id',$user_id)->first();
    }
}
