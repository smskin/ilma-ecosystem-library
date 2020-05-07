<?php

namespace Ilma\Ecosystem\Services\UserService;

use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\File;

class Provider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ServiceInterface::class,
            Service::class
        );

        $this->app->singleton(Service::class,function(){
            return new Service();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/auth.php', 'auth');
        $this->mergeConfigFrom(__DIR__ . '/config/jwt.php', 'jwt');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/auth.php' => config_path('auth.php'),
                __DIR__ . '/config/jwt.php' => config_path('jwt.php')
            ], 'config');
            $this->publishes([
                __DIR__ . '/migrations/2014_10_12_000001_create_users_table.php' => base_path('database/migrations/2014_10_12_000001_create_users_table.php'),
            ]);

            if (!File::exists(app_path('DBContext'))){
                File::makeDirectory(app_path('DBContext'));
            }

            if (!File::exists(app_path('DBContext/DBContextUser.php'))){
                File::copy(__DIR__.'/stubs/DBContextUser', app_path('DBContext/DBContextUser.php'));
            }
        }
    }
}
