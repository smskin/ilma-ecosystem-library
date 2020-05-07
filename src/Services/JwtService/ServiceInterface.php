<?php

namespace Ilma\Ecosystem\Services\JwtService;

interface ServiceInterface
{
    public function invalidateToken(string $token): void;
}
