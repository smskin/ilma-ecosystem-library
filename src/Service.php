<?php

namespace Ilma\Ecosystem;

use Ilma\Ecosystem\Services\HttpService\ServiceInterface as HttpService;
use Ilma\Ecosystem\Services\JwtService\ServiceInterface as JwtService;
use Ilma\Ecosystem\Services\UserService\ServiceInterface as UserService;
use Ilma\Ecosystem\Services\SubscribeService\ServiceInterface as SubscribeService;
use Illuminate\Contracts\Container\BindingResolutionException;

class Service implements ServiceInterface
{
    /**
     * @var HttpService
     */
    protected $httpService;

    /**
     * @var JwtService
     */
    protected $jwtService;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var SubscribeService
     */
    protected $subscribeService;

    /**
     * Service constructor.
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->httpService = app()->make(HttpService::class);
        $this->jwtService = app()->make(JwtService::class);
        $this->userService = app()->make(UserService::class);
        $this->subscribeService = app()->make(SubscribeService::class);
    }

    /**
     * @return HttpService
     */
    public function getHttpService(): HttpService
    {
        return $this->httpService;
    }

    /**
     * @return JwtService
     */
    public function getJwtService(): JwtService
    {
        return $this->jwtService;
    }

    /**
     * @return UserService
     */
    public function getUserService(): UserService
    {
        return $this->userService;
    }

    /**
     * @return SubscribeService
     */
    public function getSubscribeService(): SubscribeService
    {
        return $this->subscribeService;
    }
}
