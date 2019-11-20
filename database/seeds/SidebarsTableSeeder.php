<?php

use App\Sidebar;
use Illuminate\Database\Seeder;

class SidebarsTableSeeder extends Seeder
{

    public function run()
    {
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Primary','clase' => 'sidebar-dark-primary']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Warning','clase' =>'sidebar-dark-warning']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Info','clase' =>'sidebar-dark-info']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Danger','clase' =>'sidebar-dark-danger']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Success','clase' =>'sidebar-dark-success']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Indigo','clase' =>'sidebar-dark-indigo']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Navy','clase' =>'sidebar-dark-navy']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Purple','clase' =>'sidebar-dark-purple']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Fuchsia','clase' =>'sidebar-dark-fuchsia']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Pink','clase' =>'sidebar-dark-pink']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Maroon','clase' =>'sidebar-dark-maroon']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Orange','clase' =>'sidebar-dark-orange']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Lime','clase' =>'sidebar-dark-lime']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Teal','clase' =>'sidebar-dark-teal']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Dark Olive','clase' =>'sidebar-dark-olive']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Primary','clase' =>'sidebar-light-primary']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Warning','clase' =>'sidebar-light-warning']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Info','clase' =>'sidebar-light-info']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Danger','clase' =>'sidebar-light-danger']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Success','clase' =>'sidebar-light-success']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Indigo','clase' =>'sidebar-light-indigo']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Navy','clase' =>'sidebar-light-navy']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Purple','clase' =>'sidebar-light-purple']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Fuchsia','clase' =>'sidebar-light-fuchsia']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Pink','clase' =>'sidebar-light-pink']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Maroon','clase' =>'sidebar-light-maroon']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Orange','clase' =>'sidebar-light-orange']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Lime','clase' =>'sidebar-light-lime']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Teal','clase' =>'sidebar-light-teal']);
        Sidebar::firstOrCreate(['nombre' => 'Sidebar Light Olive','clase' =>'sidebar-light-olive']);
    }
}
