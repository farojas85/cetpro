<?php

use App\Brandlogo;
use Illuminate\Database\Seeder;

class BrandlogosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Primary','clase' => 'navbar-dark navbar-primary']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Secondary','clase' => 'navbar-dark navbar-secondary']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Info','clase' => 'navbar-dark navbar-info']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Success','clase' => 'navbar-dark navbar-success']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Danger','clase' => 'navbar-dark navbar-danger']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Indigo','clase' => 'navbar-dark navbar-indigo']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Purple','clase' => 'navbar-dark navbar-purple']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Pink','clase' => 'navbar-dark navbar-pink']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Teal','clase' => 'navbar-dark navbar-teal']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Cyan','clase' => 'navbar-dark navbar-cyan']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Dark','clase' => 'navbar-dark']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Gray-dark','clase' => 'navbar-dark navbar-gray-dark']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Gray','clase' => 'navbar-dark navbar-gray']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Light','clase' => 'navbar-light']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Warning','clase' => 'navbar-light navbar-warning']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar White','clase' => 'navbar-light navbar-white']);
        Brandlogo::firstOrCreate(['nombre' => 'Brandlogo Navbar Orange','clase' => 'navbar-light navbar-orange']);
    }
}
