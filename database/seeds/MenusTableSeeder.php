<?php

use App\Menu;
use App\User;
use App\Navbar;
use App\Sidebar;
use App\Brandlogo;
use App\ThemeUser;

use Illuminate\Support\Facades\Hash;
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
        $menu1 = Menu::firstOrCreate(['descripcion' => 'Inicio' , 'enlace' => 'home','imagen' => 'fas fa-home',
                             'orden' => Menu::maximoPadreId()])
        ;
        $menu2 = Menu::firstOrCreate(['descripcion' => 'Sistema' , 'enlace' => 'sistema','imagen' => 'fab fa-windows',
                             'orden' => Menu::maximoPadreId()])
        ;
        $menu3 = Menu::firstOrCreate(['descripcion' => 'Configuración' , 'enlace' => 'configuracion','imagen' => 'fab fa-windows',
                             'orden' => Menu::maximoPadreId()])
        ;

        $user1 = User::firstOrCreate([
            'name' => 'admin',
            'nombres' => 'Usuario',
            'apellidos' => 'Sistema',
            'dni' => '10000001',
            'email' => 'admin@me.com',
            'password' => Hash::make('123456789')
        ])
        ;

        $user2 = User::firstOrCreate([
            'name' => 'master',
            'nombres' => 'Master',
            'apellidos' => 'Sistema',
            'dni' => '10000002',
            'email' => 'master@me.com',
            'password' => Hash::make('987654321')
        ]);

        $role1 = Role::where('name','super-usuario')->first();
        $role2 = Role::where('name','usuario')->first();

        $role1->menus()->sync([$menu1->id,$menu2->id,$menu3->id]);
        $role2->menus()->sync([$menu1->id,$menu2->id,$menu3->id]);

        $user1->roles()->sync([$role2->id]);
        $user2->roles()->sync([$role1->id]);

        $navbar =  Navbar::where('nombre' ,'Navbar Master')->first();
        $sidebar = Sidebar::where('clase','sidebar-dark-primary')->first();
        $brandlogo = Brandlogo::where('clase','navbar-dark')->first();

        $thema1 = ThemeUser::firstOrCreate([
            'user_id' => $user1->id,
            'navbar_id' => $navbar->id,
            'sidebar_id' =>$sidebar->id,
            'brandlogo_id' => $brandlogo->id
        ]);
        $thema2 = ThemeUser::firstOrCreate([
            'user_id' => $user2->id,
            'navbar_id' => $navbar->id,
            'sidebar_id' =>$sidebar->id,
            'brandlogo_id' => $brandlogo->id
        ]);
    }
}
