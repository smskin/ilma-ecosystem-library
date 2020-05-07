<?php


namespace Ilma\Ecosystem\Services\SubscribeService;

use Ilma\Ecosystem\Services\SubscribeService\Commands\SubscribeCommand;
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

        $this->app->singleton(
            'command.subscribe-service.subscribe',
            function () {
                return new SubscribeCommand();
            }
        );

        $this->commands(
            'command.subscribe-service.subscribe'
        );
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
