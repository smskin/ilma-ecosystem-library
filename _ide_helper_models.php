<?php /** @noinspection PhpUndefinedClassInspection */

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */

namespace Ilma\Ecosystem\Services\UserService\DBContext{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Notifications\DatabaseNotification;
    use Illuminate\Notifications\DatabaseNotificationCollection;
    use Illuminate\Support\Carbon;

    /**
     * Ilma\Ecosystem\Services\UserService\DBContext\DBContextUser
     *
     *@property int $id
     * @property string $uid
     * @property string $mobile_phone
     * @property string $role
     * @property string|null $name
     * @property string|null $surname
     * @property string|null $patronymic
     * @property Carbon|null $date_of_birth
     * @property string|null $email
     * @property string|null $avatar_x1
     * @property string|null $avatar_x2
     * @property int $test_scenario
     * @property string|null $public_key_x509
     * @property string|null $public_key_valid_from
     * @property string|null $public_key_valid_to
     * @property string|null $remember_token
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property string|null $password
     * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
     * @property-read int|null $notifications_count
     * @method static Builder|DBContextUser newModelQuery()
     * @method static Builder|DBContextUser newQuery()
     * @method static Builder|DBContextUser query()
     * @method static Builder|DBContextUser whereAvatarX1($value)
     * @method static Builder|DBContextUser whereAvatarX2($value)
     * @method static Builder|DBContextUser wherePublicKeyValidFrom($value)
     * @method static Builder|DBContextUser wherePublicKeyValidTo($value)
     * @method static Builder|DBContextUser wherePublicKeyX509($value)
     * @method static Builder|DBContextUser whereCreatedAt($value)
     * @method static Builder|DBContextUser whereDateOfBirth($value)
     * @method static Builder|DBContextUser whereEmail($value)
     * @method static Builder|DBContextUser whereId($value)
     * @method static Builder|DBContextUser whereMobilePhone($value)
     * @method static Builder|DBContextUser whereName($value)
     * @method static Builder|DBContextUser wherePassword($value)
     * @method static Builder|DBContextUser wherePatronymic($value)
     * @method static Builder|DBContextUser whereRememberToken($value)
     * @method static Builder|DBContextUser whereRole($value)
     * @method static Builder|DBContextUser whereSurname($value)
     * @method static Builder|DBContextUser whereTestScenario($value)
     * @method static Builder|DBContextUser whereUid($value)
     * @method static Builder|DBContextUser whereUpdatedAt($value)
     */
    class DBContextUser extends Eloquent {}
}