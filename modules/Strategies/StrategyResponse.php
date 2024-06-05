<?php

/**
 * Easy Module library
 * Packagist: https://packagist.org/packages/kascat/easy-module
 * GitHub: https://github.com/kascat/easy-module
 */

namespace Strategies;

use Kascat\EasyModule\Core\Response;

/**
 * Response interceptor
 *
 * Trait StrategyResponse
 * @package Strategies
 */
trait StrategyResponse
{
    use Response;

    /**
     * @param mixed $data
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseToIndex($data = [], int $statusCode = 200)
    {
        return response()->json($data, $statusCode);
    }
}
