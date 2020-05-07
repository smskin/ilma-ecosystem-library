<?php

namespace Ilma\Ecosystem\Services\UserService;

use Exception;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Http\UploadedFile;
use Ilma\Ecosystem\Services\UserService\DBContext\DBContextUser;
use Ilma\Ecosystem\Services\UserService\Models\ImageStoreResponse;
use Ilma\Ecosystem\Services\UserService\Models\UserModel;

interface ServiceInterface
{
    /**
     * @param array $fillable
     * @throws Exception
     */
    public function validateRequestFields(array $fillable): void;

    /**
     * @param string $mobilePhone
     * @param string $role
     * @param string[] $fillable
     * @return DBContextUser
     */
    public function create(string $mobilePhone, string $role, array $fillable = []): DBContextUser;
    /**
     * @param DBContextUser|AuthenticatableContract $user
     * @param string[] $fillable
     * @return DBContextUser
     * @throws Exception
     */
    public function update(DBContextUser $user, array $fillable): DBContextUser;

    /**
     * @param string $imageType
     * @param UploadedFile $file
     * @return ImageStoreResponse
     * @throws Exception
     */
    public function uploadImage(string $imageType, UploadedFile $file): ImageStoreResponse;

    public function getRequestFields(): array;

    public function getGlobalDatabaseFields(): array;

    public function createFromModel(UserModel $model): DBContextUser;

    public function updateFromModel(UserModel $model): DBContextUser;
}
