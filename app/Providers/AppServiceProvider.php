<?php

namespace App\Providers;

use App\Menu;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

       /* View()->composer("layouts.sidebar",function($view){
            $menus= Menu::getMenu(true);
            $view->with('menus',$menus);
        });*/

        View()->composer("dashboards.admin-dashboard",function($view){
            $view->with('role_count',Role::count('id'));
        });
    }
}
