<?php

namespace App\Providers;

use App\Menu;
use App\User;
use App\Navbar;
use App\Sidebar;
use App\Brandlogo;
use Illuminate\Support\Facades\Auth;
//use Caffeinated\Shinobi\Models\Role;
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

    public function boot()
    {
        Schema::defaultStringLength(191);


        View()->composer("layouts.navbar",function($view){
            $view->with(['navbar_user' => User::navbarByUser(Auth::user()->id)]);
        });

        View()->composer("layouts.sidebar",function($view){
            $view->with(['sidebar_user' => User::sidebarByUser(Auth::user()->id)]);
        });

        View()->composer("layouts.sidebar",function($view){
            $view->with(['brandlogo_user' => User::brandlogoByUser(Auth::user()->id)]);
        });

        View()->composer('layouts.right-sidebar',function($view){
            $view->with([
                'navbar_color' => Navbar::bgColor(),
                'sidebar_dark_color' => Sidebar::darkBgColor(),
                'sidebar_light_color' => Sidebar::lightBgColor(),
                'brandlogo_color' => Brandlogo::bgColor()
             ]);
        });
    }
}
