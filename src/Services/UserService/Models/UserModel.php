<?php

namespace Ilma\Ecosystem\Services\UserService\Models;

use Ilma\Ecosystem\Services\UserService\DBContext\DBContextUser;
use stdClass;

/**
 * Class UserModel
 * @package Ilma\Ecosystem\Services\UserService\Models
 */
class UserModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $uid;

    /**
     * @var string
     */
    public $mobilePhone;

    /**
     * @var string
     */
    public $rememberToken;

    /**
     * @var string
     */
    public $role;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $surname;

    /**
     * @var string
     */
    public $patronymic;

    /**
     * @var string
     */
    public $dateOfBirth;

    /**
     * @var string
     */
    public $email;

    /**
     * @var ImageModel
     */
    public $avatar;

    /**
     * @var int
     */
    public $testScenario;

    /**
     * @var PublicKeyModel
     */
    public $publicKey;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $createdAt;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $updatedAt;

    public function fill(DBContextUser $user): UserModel
    {
        $this->id = $user->id;
        $this->uid = $user->uid;
        $this->mobilePhone = $user->mobile_phone;
        $this->role = $user->role;
        $this->rememberToken = $user->remember_token;
        $this->name = $user->name;
        $this->surname = $user->surname;
        $this->patronymic = $user->patronymic;
        $this->dateOfBirth = null;
        if ($user->date_of_birth){
            $this->dateOfBirth = $user->date_of_birth->toString();
        }
        $this->email = $user->email;

        if ($user->avatar_x1){
            $avatar = new ImageModel();
            $avatar->x1 = $user->avatar_x1;
            $avatar->x2 = $user->avatar_x2;
            $this->avatar = $avatar;
        }

        $this->testScenario = $user->test_scenario;

        if ($user->public_key_x509){
            $publicKey = new PublicKeyModel();
            $publicKey->x509 = $user->public_key_x509;
            $publicKey->validFrom = $user->public_key_valid_from;
            $publicKey->validTo = $user->public_key_valid_to;
            $this->publicKey = $publicKey;
        }

        $this->createdAt = $user->created_at->toString();
        $this->updatedAt = $user->updated_at->toString();
        return $this;
    }

    public function unSerialize(stdClass $obj){
        $this->id = $obj->id;
        $this->uid = $obj->uid;
        $this->mobilePhone = $obj->mobilePhone;
        $this->role = $obj->role;
        $this->rememberToken = $obj->rememberToken;
        $this->name = $obj->name;
        $this->surname = $obj->surname;
        $this->patronymic = $obj->patronymic;
        $this->dateOfBirth = $obj->dateOfBirth;
        $this->email = $obj->email;
        if ($obj->avatar){
            $avatar = new ImageModel();
            $avatar->x1 = $obj->avatar->x1;
            $avatar->x2 = $obj->avatar->x2;
            $this->avatar = $avatar;
        }
        $this->testScenario = $obj->testScenario;
        if ($obj->publicKey){
            $publicKey = new PublicKeyModel();
            $publicKey->x509 = $obj->publicKey->x509;
            $publicKey->validFrom = $obj->publicKey->validFrom;
            $publicKey->validTo = $obj->publicKey->validTo;
            $this->publicKey = $publicKey;
        }
        $this->createdAt = $obj->createdAt;
        $this->updatedAt = $obj->createdAt;
        return $this;
    }
}
