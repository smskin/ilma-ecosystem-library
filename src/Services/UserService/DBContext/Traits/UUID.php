<?php
/**
 * Created by PhpStorm.
 * User: Mikhaylov Sergey Sergeevich ( @smskin )
 * Date: 02.12.2019
 * Time: 20:13
 */

namespace App\DBContext\Traits\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

trait UUID
{
    public static function bootUUID(): void
    {
        /** @noinspection PhpUndefinedMethodInspection */
        static::creating(function (Model $model) {
            if (!array_key_exists('uid',$model->attributes)){
                $model->attributes['uid'] = self::generateUid()->toString();
            }
        });
    }

    public static function generateUid(): UuidInterface
    {
        $uuid =  Str::uuid();
        /** @noinspection PhpUndefinedMethodInspection */
        $test =  self::where('uid',$uuid->toString())->exists();
        if (!$test){
            return $uuid;
        }
        return self::generateUid();
    }

    /**
     * @param string $uid
     * @return Model|null
     */
    public static function getByUid(string $uid): ?Model
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return self::where('uid',$uid)->first();
    }
}
