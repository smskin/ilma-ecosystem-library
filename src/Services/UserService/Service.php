<?php

namespace Ilma\Ecosystem\Services\UserService;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Ilma\Ecosystem\Services\UserService\DBContext\DBContextUser;
use Ilma\Ecosystem\Services\UserService\Models\ImageStoreResponse;
use Ilma\Ecosystem\Services\UserService\Models\UserModel;
use \Ilma\Ecosystem\Services\HttpService\ServiceInterface as HttpService;

class Service implements ServiceInterface
{
    public const IMAGE_TYPE_AVATAR = 'avatar';
    public const IMAGE_TYPES = [
        self::IMAGE_TYPE_AVATAR
    ];

    /**
     * @param string $mobilePhone
     * @param string $role
     * @param string[] $fillable
     * @return DBContextUser
     * @throws Exception
     */
    public function create(string $mobilePhone, string $role, array $fillable = []): DBContextUser
    {
        $this->validateRequestFields($fillable);
        $response = $this->getHttpService()
            ->setApiToken(config('ecosystem.service_token'))
            ->post(
                config('ecosystem.url.internal.auth').'/api/users',
                array_merge([
                    'mobile_phone'=>$mobilePhone,
                    'role'=>$role
                ],$fillable)
            );

        $model = (new UserModel())->unSerialize(json_decode($response));
        return $this->createFromModel($model);
    }

    /**
     * @param DBContextUser $user
     * @param string[] $fillable
     * @return DBContextUser
     * @throws Exception
     */
    public function update(DBContextUser $user, array $fillable): DBContextUser
    {
        $this->validateRequestFields($fillable);
        $response = $this->getHttpService()
            ->setApiToken(config('ecosystem.service_token'))
            ->post(
                config('ecosystem.url.internal.auth').'/api/users/'.$user->uid,
                array_merge([
                    '_method'=>'PUT'
                ],$fillable)
            );

        $model = (new UserModel())->unSerialize(json_decode($response));
        return $this->updateFromModel($model);
    }

    /**
     * @param array $fillable
     * @throws Exception
     */
    public function validateRequestFields(array $fillable): void
    {
        $columns = $this->getRequestFields();
        foreach ($fillable as $field => $value){
            if (!in_array($field, $columns)){
                throw new Exception('Bad field: '.$field);
            }
        }
    }

    /**
     * @param string $imageType
     * @param UploadedFile $file
     * @return ImageStoreResponse
     * @throws Exception
     */
    public function uploadImage(string $imageType, UploadedFile $file): ImageStoreResponse
    {
        if (!in_array($imageType, self::IMAGE_TYPES)){
            throw new Exception('Invalid image type');
        }

        $response = $this->getHttpService()
            ->setApiToken(config('ecosystem.service_token'))
            ->multipartPost(
                config('ecosystem.url.internal.auth').'/api/users/upload-image',
                [
                    [
                        'name'     => 'image',
                        'contents' => file_get_contents($file->getRealPath()),
                        'filename' => $file->getClientOriginalName()
                    ],
                    [
                        'name'     => 'type',
                        'contents' => $imageType
                    ]
                ]
            );
        return (new ImageStoreResponse)->unSerialize(json_decode($response));
    }

    public function getRequestFields(): array
    {
        return [
            'mobile_phone',
            'role',
            'name',
            'surname',
            'patronymic',
            'date_of_birth',
            'email',
            'test_scenario',
            'public_key_x509',
            'public_key_valid_from',
            'public_key_valid_to',
            'created_at',
            'updated_at',
            'avatar_x1',
            'avatar_x2',
            // synthetic
            'avatar'
        ];
    }

    /**
     * @return string[]
     */
    public function getGlobalDatabaseFields(): array
    {
        return [
            'id',
            'uid',
            'mobile_phone',
            'role',
            'name',
            'surname',
            'patronymic',
            'date_of_birth',
            'email',
            'avatar_x1',
            'avatar_x2',
            'test_scenario',
            'public_key_x509',
            'public_key_valid_from',
            'public_key_valid_to',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @param UserModel $model
     * @return DBContextUser
     * @throws Exception
     */
    public function createFromModel(UserModel $model): DBContextUser
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $context = DBContextUser::where('uid',$model->uid)->first();
        if ($context){
            return $this->updateFromModel($model);
        }

        $context = new DBContextUser();
        $this->fillContext($context, $model);
        $context->save();
        return $context;
    }

    /**
     * @param UserModel $model
     * @return DBContextUser|Model
     * @throws Exception
     */
    public function updateFromModel(UserModel $model): DBContextUser
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $context = DBContextUser::where('uid',$model->uid)->first();
        if (!$context){
            return $this->createFromModel($model);
        }

        $this->fillContext($context, $model);
        /** @noinspection PhpUndefinedMethodInspection */
        $context->save();
        return $context;
    }

    protected function fillContext(DBContextUser $context, UserModel $model): DBContextUser
    {
        $context->forceSave = true;
        $context->id = $model->id;
        $context->uid = $model->uid;
        $context->mobile_phone = $model->mobilePhone;
        $context->role = $model->role;
        $context->name = $model->name;
        $context->surname = $model->surname;
        $context->patronymic = $model->patronymic;
        $context->date_of_birth = $model->dateOfBirth ? Carbon::parse($model->dateOfBirth) : null;
        $context->email = $model->email;
        if ($model->avatar){
            $context->avatar_x1 = $model->avatar->x1;
            $context->avatar_x2 = $model->avatar->x2;
        }
        $context->test_scenario = $model->testScenario;
        $context->remember_token = $model->rememberToken;
        if ($model->publicKey){
            $context->public_key_x509 = $model->publicKey->x509;
            $context->public_key_valid_from = $model->publicKey->validFrom;
            $context->public_key_valid_to = $model->publicKey->validTo;
        }
        $context->created_at = Carbon::parse($model->createdAt);
        $context->updated_at = Carbon::parse($model->updatedAt);
        return $context;
    }

    /**
     * @return HttpService
     * @throws BindingResolutionException
     */
    private function getHttpService(): HttpService
    {
        return app()->make(HttpService::class);
    }
}
