<?php

use App\Menu;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::firstOrCreate(['descripcion' => 'Inicio' , 'enlace' => 'home','imagen' => 'fas fa-home',
                             'orden' => Menu::maximoPadreId()]);
        Menu::firstOrCreate(['descripcion' => 'Sistema' , 'enlace' => 'sistema','imagen' => 'fab fa-windows',
                             'orden' => Menu::maximoPadreId()]);

        $role1 = Role::with('menus')->where('name','Administrador')->first();
        $role1->menus()->sync([1,2]);
    }
}
