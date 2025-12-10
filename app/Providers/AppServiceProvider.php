<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     //
    // //Resource::withoutWrapping();
    
    // }

    public function boot(Dispatcher $events)
    {
        // $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
        //     $event->menu->add('MAIN NAVIGATION');
        //     $event->menu->add([
        //         'text' => 'Blog',
        //         'url' => 'admin/blog',
        //     ]);
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
