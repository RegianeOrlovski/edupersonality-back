<?php

namespace Permissions;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * @package Permissions
 */
class Permission extends Model
{
    const DEFAULT_PERMISSION = 2;

    protected $fillable = [
        'name',
        'abilities',
    ];

    protected $casts = [
        'abilities' => 'array',
    ];
}
