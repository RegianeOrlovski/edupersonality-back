<?php

/**
 * Easy Module library
 * Packagist: https://packagist.org/packages/kascat/easy-module
 * GitHub: https://github.com/kascat/easy-module
 */

namespace DichotomyAnswers;

/**
 * Class DichotomyAnswerRepository
 * @package DichotomyAnswers
 *
 * Build module query here.
 */
class DichotomyAnswerRepository
{
    /**
     * @param $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function index($filters)
    {
        return DichotomyAnswer::query();
    }
}
