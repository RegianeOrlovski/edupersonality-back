<?php

/**
 * Easy Module library
 * Packagist: https://packagist.org/packages/kascat/easy-module
 * GitHub: https://github.com/kascat/easy-module
 */

namespace DichotomyAnswers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Strategies\Strategy;

/**
 * @property int           $id
 * @property int           $strategy_id
 * @property string        $name
 * @property array|null    $dichotomy_ei
 * @property array|null    $dichotomy_sn
 * @property array|null    $dichotomy_tf
 * @property array|null    $dichotomy_jp
 * @property array|null    $letter_result
 * @property Carbon|null   $created_at
 * @property Carbon|null   $updated_at
 *
 * @property-read Strategy $strategy
 */
class DichotomyAnswer extends Model
{
    const ID = 'id';
    const STRATEGY_ID = 'strategy_id';
    const DICHOTOMY_EI = 'dichotomy_ei';
    const DICHOTOMY_SN = 'dichotomy_sn';
    const DICHOTOMY_TF = 'dichotomy_tf';
    const DICHOTOMY_JP = 'dichotomy_jp';
    const LETTER_RESULT = 'letter_result';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const TABLE = 'dichotomy_answers';

    protected $table = self::TABLE;

    protected $guarded = [
        self::ID,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    protected $casts = [
        self::DICHOTOMY_EI => 'array',
        self::DICHOTOMY_SN => 'array',
        self::DICHOTOMY_TF => 'array',
        self::DICHOTOMY_JP => 'array',
        self::LETTER_RESULT => 'array',
    ];

    public function strategy(): BelongsTo
    {
        return $this->belongsTo(Strategy::class, self::STRATEGY_ID, Strategy::ID);
    }
}
