<?php


namespace Ilma\Ecosystem\Services\HttpService;

use Illuminate\Support\ServiceProvider;

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
        //
    }
}
