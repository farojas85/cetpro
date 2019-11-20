<?php

namespace App\Http\Controllers;

use App\ThemeUser;
use Illuminate\Http\Request;

class ThemeUserController extends Controller
{
    public function actualizarNavbar(Request $request)
    {
        $themeuser = ThemeUser::where('user_id',$request->user_id)->first();

        if($request->navbar_id != $themeuser->navbar_id)
        {
            $themeuser->navbar_id = $request->navbar_id;
        }
        $themeuser->save();

        return $themeuser;
    }

    public function actualizarSidebar(Request $request)
    {
        $themeuser = ThemeUser::where('user_id',$request->user_id)->first();

        if($request->sidebar_id != $themeuser->sidebar_id)
        {
            $themeuser->sidebar_id = $request->sidebar_id;
        }
        $themeuser->save();

        return $themeuser;
    }

    public function actualizarBrandlogo(Request $request)
    {
        $themeuser = ThemeUser::where('user_id',$request->user_id)->first();

        if($request->brandlogo_id != $themeuser->brandlogo_id)
        {
            $themeuser->brandlogo_id = $request->brandlogo_id;
        }
        $themeuser->save();

        return $themeuser;
    }
}
