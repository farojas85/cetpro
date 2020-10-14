<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permi1 = Permission::firstOrCreate(['name' =>'inicio.index']);
        $permi2 = Permission::firstOrCreate(['name' => 'sistema.index']);
        $permi3 = Permission::firstOrCreate(['name' =>'configuracion.index']);
        $permi5 = Permission::firstOrCreate(['name' => 'roles.index']);
        $permi4 = Permission::firstOrCreate(['name' => 'roles.create']);
        $permi6 = Permission::firstOrCreate(['name' => 'roles.show']);
        $permi7 = Permission::firstOrCreate(['name' => 'roles.edit']);
        $permi8 = Permission::firstOrCreate(['name' => 'roles.destroy']);
        $permi9 = Permission::firstOrCreate(['name' => 'usuarios.index']);
        $permi10 = Permission::firstOrCreate(['name' =>'usuarios.create']);
        $permi11 = Permission::firstOrCreate(['name' => 'usuarios.show']);
        $permi12 = Permission::firstOrCreate(['name' => 'usuarios.edit']);
        $permi13 = Permission::firstOrCreate(['name' => 'usuarios.destroy']);
        $permi14 = Permission::firstOrCreate(['name' => 'permisos.index']);
        $permi15 = Permission::firstOrCreate(['name' => 'permisos.create']);
        $permi16 = Permission::firstOrCreate(['name' => 'permisos.show']);
        $permi17 = Permission::firstOrCreate(['name' =>'permisos.edit']);
        $permi18 = Permission::firstOrCreate(['name' =>'permisos.destroy']);
        $permi19 = Permission::firstOrCreate(['name' => 'permiso-role.index']);
        $permi20 = Permission::firstOrCreate(['name' =>'permiso-role.create']);
        $permi21 = Permission::firstOrCreate(['name' => 'menus.index']);
        $permi22 = Permission::firstOrCreate(['name' => 'menus.create']);
        $permi23 = Permission::firstOrCreate(['name' => 'menus.show']);
        $permi24 = Permission::firstOrCreate(['name' => 'menus.edit']);
        $permi25 = Permission::firstOrCreate(['name' => 'menus.destroy']);
        $permi26 = Permission::firstOrCreate(['name' => 'menus.restore']);
        $permi27 = Permission::firstOrCreate(['name' => 'menu-role.index']);
        $permi28 = Permission::firstOrCreate(['name' => 'menu-role.create']);

        //PERMISOS PARA SUPER USUARIOS
        $role1 = Role::where('name','super-usuario')->first();
        $role1->syncPermissions([
            $permi1->name,$permi2->name,$permi3->name,$permi4->name,$permi5->name,
            $permi6->name,$permi7->name,$permi8->name,$permi9->name,$permi10->name,
            $permi11->name,$permi12->name,$permi13->name,$permi14->name,$permi15->name,
            $permi16->name,$permi17->name,$permi18->name,$permi19->name,$permi20->name,
            $permi21->name,$permi22->name,$permi23->name,$permi24->name,$permi25->name,
            $permi26->name,$permi27->name,$permi28->name
        ]);
        //PERMISOS PARA USUARIOs
        $role2 =Role::where('name','usuario')->first();
        $role2->syncPermissions([
            $permi1->name,$permi2->name,$permi3->name,$permi4->name,$permi5->name,
            $permi6->name,$permi7->name,$permi9->name,$permi10->name,
            $permi11->name,$permi12->name,$permi14->name,$permi15->name,
            $permi16->name,$permi17->name,$permi19->name,
            $permi21->name,$permi22->name,$permi23->name,$permi24->name,$permi27->name
        ]);

        //PERMISO PARA DOCENTES
        $role3 =Role::where('name','docente')->first();
        $role3->syncPermissions([
            $permi1->name
        ]);

        //PERMISO PARA ALUMNOS
        $role4 =Role::where('name','alumno')->first();
        $role4->syncPermissions([
            $permi1->name
        ]);
    }
}
