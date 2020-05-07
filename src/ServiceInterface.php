<?php

namespace Ilma\Ecosystem;

use Ilma\Ecosystem\Services\HttpService\ServiceInterface as HttpService;
use Ilma\Ecosystem\Services\JwtService\ServiceInterface as JwtService;
use Ilma\Ecosystem\Services\SubscribeService\ServiceInterface as SubscribeService;
use Ilma\Ecosystem\Services\UserService\ServiceInterface as UserService;

interface ServiceInterface
{
    public function getHttpService(): HttpService;
    public function getJwtService(): JwtService;
    public function getUserService(): UserService;
    public function getSubscribeService(): SubscribeService;
}
