<?php

namespace Ilma\Ecosystem\Services\SubscribeService;

use Ilma\Ecosystem\Services\HttpService\ServiceInterface as HttpService;
use Illuminate\Contracts\Container\BindingResolutionException;

class Service implements ServiceInterface
{
    /**
     * @throws BindingResolutionException
     */
    public function subscribe(): void
    {
        $data =  [
            'name'=>config('app.name'),
            'vhost'=>config('queue.connections.rabbitmq.hosts')[0]['vhost']
        ];

        $this->getHttpService()
            ->setApiToken(config('ecosystem.service_token'))
            ->post(
            config('ecosystem.url.internal.auth').'/api/subscribers',
            $data
        );
    }

    /**
     * @return HttpService
     * @throws BindingResolutionException
     */
    private function getHttpService(): HttpService
    {
        return app()->make(HttpService::class);
    }
}
