<?php

namespace Ilma\Ecosystem\Services\UserService\DBContext\Traits;

trait UserSystemTrait
{
    /**
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'mobile_phone';
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return string
     */
    public function getJWTIdentifier()
    {
        return $this->mobile_phone;
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [
            'id' => $this->id,
            'uid'=> $this->uid,
            'mobile_phone' => $this->mobile_phone
        ];
    }
}
