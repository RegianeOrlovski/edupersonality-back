<?php

/**
 * Easy Module library
 * Packagist: https://packagist.org/packages/kascat/easy-module
 * GitHub: https://github.com/kascat/easy-module
 */

namespace Strategies;

use Illuminate\Contracts\Database\Eloquent\Builder;

/**
 * Class StrategyRepository
 * @package Strategies
 *
 * Build module query here.
 */
class StrategyRepository
{
    /**
     * @param $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function index($filters)
    {
        return Strategy::query()
            ->when($filters[Strategy::USER_ID] ?? null, function (Builder $query, $value) {
                $query->where(Strategy::USER_ID, $value);
            });
    }
}
