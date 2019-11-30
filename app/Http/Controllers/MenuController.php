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

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:191'
        ]);

        $menu = new menu();
        $menu->name = $request->name;
        $menu->save();

        return response()->json(['mensaje' => 'Permiso Registrado Satisfactoriamente']);
    }

    public function padres()
    {
        return Menu::where('padre_id',0)
                    ->select('id','descripcion')
                    ->orderBy('orden','ASC')->get();
    }

    public function show(Menu $menu)
    {
        //
    }

    public function edit(Menu $menu)
    {
        //
    }

    public function update(Request $request, Menu $menu)
    {
        //
    }

    public function destroy(Menu $menu)
    {
        //
    }
}
