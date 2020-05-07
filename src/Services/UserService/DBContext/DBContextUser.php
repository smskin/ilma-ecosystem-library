<?php

namespace Ilma\Ecosystem\Services\UserService\DBContext;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Ilma\Ecosystem\Services\UserService\DBContext\Traits\UserMethodTrait;
use Ilma\Ecosystem\Services\UserService\DBContext\Traits\UserSystemTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ilma\Ecosystem\Services\UserService\ServiceInterface as UserService;
use Tymon\JWTAuth\Contracts\JWTSubject;

class DBContextUser extends Authenticatable implements JWTSubject
{
    use Notifiable, UserSystemTrait, UserMethodTrait;

    public const ROLE_USER = 'user';
    public const ROLE_ADMINISTRATOR = 'administrator';
    public const ROLE_SERVICE = 'service';
    public const ROLES = [
        self::ROLE_USER,
        self::ROLE_ADMINISTRATOR,
        self::ROLE_SERVICE
    ];

    public $incrementing = false;

    protected $table = 'users';

    public $forceSave = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'mobile_phone', 'role', 'name', 'surname', 'patronymic', 'date_of_birth', 'email', 'avatar_x1', 'avatar_x2', 'test_scenario', 'public_key_x509', 'public_key_valid_from', 'public_key_valid_to', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'date_of_birth','public_key_valid_from','public_key_valid_to'];

    /**
     * @param array $options
     * @return bool
     * @throws Exception
     */
    public function save(array $options = [])
    {
        if ($this->forceSave){
            return parent::save($options);
        }

        $globalFields = $this->getUserService()->getGlobalDatabaseFields();
        $attributes = $this->getDirty();
        $globalData = [];
        foreach ($attributes as $field => $value){
            if (in_array($field, $globalFields)){
                $globalData[$field] = $value;
            }
        }

        if (!count($globalData)){
            return parent::save($options);
        }

        throw new Exception('You trying save global user data. Use user service for updating data. Global data: '. implode(', ',array_keys($globalData)));
    }

    /**
     * @return UserService
     * @throws BindingResolutionException
     */
    private function getUserService(): UserService
    {
        return app()->make(UserService::class);
    }

    /**
     * @param bool $forceSave
     * @return self
     */
    public function setForceSave(bool $forceSave): self
    {
        $this->forceSave = $forceSave;
        return $this;
    }
}
