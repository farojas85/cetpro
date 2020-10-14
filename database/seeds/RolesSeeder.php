<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::firstOrCreate(['name' => 'super-usuario']);
        $role = Role::firstOrCreate(['name' => 'administrador']);
        $role = Role::firstOrCreate(['name' => 'docente']);
        $role = Role::firstOrCreate(['name' => 'alumno']);
        $role = Role::firstOrCreate(['name' => 'usuario']);
    }
}
