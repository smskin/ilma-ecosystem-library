<?php

namespace Ilma\Ecosystem\Services\UserService\Models;

/**
 * Class PublicKeyModel
 * @package Ilma\Ecosystem\Services\UserService\Models
 */
class PublicKeyModel
{
    /**
     * @var string
     */
    public $x509;

    /**
     * @var string
     */
    public $validFrom;

    /**
     * @var string
     */
    public $validTo;
}