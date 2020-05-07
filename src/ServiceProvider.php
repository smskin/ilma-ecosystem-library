<?php

namespace Ilma\Ecosystem;

use Ilma\Ecosystem\Services\HttpService\Provider as HttpServiceProvider;
use Illuminate\Support\ServiceProvider as Provider;
use Ilma\Ecosystem\Services\JwtService\Provider as JwtServiceProvider;
use Ilma\Ecosystem\Services\SubscribeService\Provider as SubscribeServiceProvider;
use Ilma\Ecosystem\Services\UserService\Provider as UserServiceProvider;

class ServiceProvider extends Provider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(HttpServiceProvider::class);
        $this->app->register(JwtServiceProvider::class);
        $this->app->register(SubscribeServiceProvider::class);
        $this->app->register(UserServiceProvider::class);

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
        $this->mergeConfigFrom(dirname(__FILE__) . '/config/ecosystem.php', 'ecosystem');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                dirname(__FILE__) . '/config/ecosystem.php' => config_path('ecosystem.php')
            ], 'config');
        }
    }
}
