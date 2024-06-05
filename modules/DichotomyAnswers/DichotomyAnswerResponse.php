<?php

/**
 * Easy Module library
 * Packagist: https://packagist.org/packages/kascat/easy-module
 * GitHub: https://github.com/kascat/easy-module
 */

namespace DichotomyAnswers;

use Kascat\EasyModule\Core\Response;

/**
 * Response interceptor
 *
 * Trait DichotomyAnswerResponse
 * @package DichotomyAnswers
 */
trait DichotomyAnswerResponse
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
