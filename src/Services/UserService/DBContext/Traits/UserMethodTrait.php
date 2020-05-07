<?php

namespace Ilma\Ecosystem\Services\UserService\DBContext\Traits;

trait UserMethodTrait
{
    /**
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return $this->role === self::ROLE_ADMINISTRATOR;
    }

    /**
     * @return bool
     */
    public function isService(): bool
    {
        return $this->role === self::ROLE_SERVICE;
    }
}
