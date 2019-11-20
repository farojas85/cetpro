<?php

use App\Navbar;
use Illuminate\Database\Seeder;

class NavbarsTableSeeder extends Seeder
{

    public function run()
    {
        Navbar::firstOrCreate(['nombre' => 'Navbar Primary','clase' => 'navbar-dark navbar-primary']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Secondary','clase' => 'navbar-dark navbar-secondary']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Info','clase' => 'navbar-dark navbar-info']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Success','clase' => 'navbar-dark navbar-success']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Danger','clase' => 'navbar-dark navbar-danger']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Indigo','clase' => 'navbar-dark navbar-indigo']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Purple','clase' => 'navbar-dark navbar-purple']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Pink','clase' => 'navbar-dark navbar-pink']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Teal','clase' => 'navbar-dark navbar-teal']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Cyan','clase' => 'navbar-dark navbar-cyan']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Dark','clase' => 'navbar-dark']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Gray-dark','clase' => 'navbar-dark navbar-gray-dark']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Gray','clase' => 'navbar-dark navbar-gray']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Light','clase' => 'navbar-light']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Warning','clase' => 'navbar-light navbar-warning']);
        Navbar::firstOrCreate(['nombre' => 'Navbar White','clase' => 'navbar-light navbar-white']);
        Navbar::firstOrCreate(['nombre' => 'Navbar Orange','clase' => 'navbar-light navbar-orange']);
    }
}
