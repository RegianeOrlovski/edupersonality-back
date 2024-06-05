<?php

namespace Users;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Permissions\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @property int             $id
 * @property int             $permission_id
 * @property string          $name
 * @property string          $email
 * @property string          $role
 * @property Carbon|null     $email_verified_at
 * @property string          $password
 * @property string          $status
 * @property Carbon|null     $expires_in
 * @property int|null        $login_time
 * @property string|null     $remember_token
 * @property Carbon|null     $created_at
 * @property Carbon|null     $updated_at
 *
 * @property-read Permission $permission
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_COMMON = 'common';

    const STATUS_PENDING_PASSWORD = 'pending_password';
    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';
    const STATUS_BLOCKED_BY_TIME = 'blocked_by_time';

    const ID = 'id';
    const PERMISSION_ID = 'permission_id';
    const NAME = 'name';
    const EMAIL = 'email';
    const ROLE = 'role';
    const EMAIL_VERIFIED_AT = 'email_verified_at';
    const PASSWORD = 'password';
    const STATUS = 'status';
    const EXPIRES_IN = 'expires_in';
    const LOGIN_TIME = 'login_time';
    const REMEMBER_TOKEN = 'remember_token';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const RELATION_PERMISSION = 'permission';

    protected $guarded = [
        self::ID,
        self::EMAIL_VERIFIED_AT,
        self::REMEMBER_TOKEN,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    protected $hidden = [
        self::PASSWORD,
        self::REMEMBER_TOKEN,
    ];

    protected $casts = [
        self::EMAIL_VERIFIED_AT => 'datetime',
        self::EXPIRES_IN => 'datetime:d/m/Y H:i',
    ];

    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class);
    }
}
