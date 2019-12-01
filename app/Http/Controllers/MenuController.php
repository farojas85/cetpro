<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function index()
    {
        //
    }

    public function lista()
    {
        return Menu::with('padre')->paginate(10);
    }

    public function mostrarEliminados() {
        return Menu::with('padre')->onlyTrashed()->paginate(10);
    }

    public function mostrarTodos() {
        return Menu::with('padre')->withTrashed()->paginate(10);
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion'  => 'required|string|max:191'
        ]);

        $menu = new menu();
        $menu->descripcion = $request->descripcion;
        $menu->enlace = $request->enlace;
        $menu->imagen = $request->imagen;
        $menu->padre_id =  ($request->padre_id == '') ? 0 : $request->padre_id;
        //Obtenemos el Orden del Menú
        $menu->orden =  ($menu->padre_id == 0) ? Menu::maximoPadreId() : Menu::maximoHijoId($menu->padre_id);
        $menu->save();

        return response()->json(['mensaje' => 'Menú Registrado Satisfactoriamente']);
    }

    public function padres()
    {
        return Menu::where('padre_id',0)
                    ->select('id','descripcion')
                    ->orderBy('orden','ASC')->get();
    }

    public function show(Request $request)
    {
        return Menu::withTrashed()->with('padre')->where('id',$request->id)->first();
    }

    public function edit(Menu $menu)
    {
        //
    }

    public function update(Request $request)
    {
        $menu = Menu::findOrFail($request->id);

        $menu->descripcion = $request->descripcion;
        $menu->enlace = $request->enlace;
        $menu->imagen = $request->imagen;
        $menu->estado = $request->estado;

        if($menu->padre_id  != $request->padre_id)
        {
            $menu->orden =  ($request->padre_id == '') ? Menu::maximoPadreId() : Menu::maximoHijoId($request->padre_id);
        }
        $menu->padre_id = ($request->padre_id == '') ? 0 : $request->padre_id;
        $menu->save();

        return response()->json(['mensaje' => 'Menú Actualizado Satisfactoriamente']);
    }

    public function destroy(Request $request)
    {
        $menu = Menu::findOrFail($request->id);

        $menu->delete();

        return response()->json(['mensaje' => 'Menú Eliminado Satisfactoriamente']);
    }

    public function restaurar(Request $request)
    {
        $menu = Menu::onlyTrashed()->findOrFail($request->id);

        $menu->restore();

        return response()->json(['mensaje' => 'Menú Restaurado Satisfactoriamente']);
    }


}
