<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            NavbarsTableSeeder::class,
            SidebarsTableSeeder::class,
            BrandlogosTableSeeder::class,
            MenusTableSeeder::class,
            TipoDocumentosTableSeeder::class
        ]);
    }
}
