<?php

namespace Ilma\Ecosystem\Services\JwtService;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\Token;

class Service implements ServiceInterface
{
    /**
     * @param string $token
     * @throws BindingResolutionException
     * @throws JWTException
     */
    public function invalidateToken(string $token): void
    {
        $this->getJwt()->manager()->invalidate(
            (new Token($token))
        );
    }

    /**
     * @return JWT
     * @throws BindingResolutionException
     */
    private function getJwt(): JWT
    {
        return app()->make(JWT::class);
    }
}
