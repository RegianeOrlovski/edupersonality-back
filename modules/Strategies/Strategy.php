<?php

/**
 * Easy Module library
 * Packagist: https://packagist.org/packages/kascat/easy-module
 * GitHub: https://github.com/kascat/easy-module
 */

namespace Strategies;

use Carbon\Carbon;
use DichotomyAnswers\DichotomyAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Users\User;

/**
 * @property int                       $id
 * @property int                       $user_id
 * @property string                    $name
 * @property string|null               $focus
 * @property string|null               $characteristics
 * @property string|null               $activities
 * @property string|null               $applied_resources
 * @property array|null                $personalities
 * @property string|null               $course
 * @property string|null               $discipline
 * @property Carbon|null               $created_at
 * @property Carbon|null               $updated_at
 *
 * @property-read User                 $user
 * @property-read DichotomyAnswer|null $dichotomyAnswer
 */
class Strategy extends Model
{
    const ID = 'id';
    const USER_ID = 'user_id';
    const NAME = 'name';
    const FOCUS = 'focus';
    const CHARACTERISTICS = 'characteristics';
    const ACTIVITIES = 'activities';
    const APPLIED_RESOURCES = 'applied_resources';
    const PERSONALITIES = 'personalities';
    const COURSE = 'course';
    const DISCIPLINE = 'discipline';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const TABLE = 'strategies';

    protected $table = self::TABLE;

    protected $guarded = [
        self::ID,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    protected $casts = [
        self::PERSONALITIES => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::USER_ID, User::ID);
    }

    public function dichotomyAnswer(): HasOne
    {
        return $this->hasOne(DichotomyAnswer::class, DichotomyAnswer::STRATEGY_ID, self::ID);
    }
}
