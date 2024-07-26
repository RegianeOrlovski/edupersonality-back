<?php

/**
 * Easy Module library
 * Packagist: https://packagist.org/packages/kascat/easy-module
 * GitHub: https://github.com/kascat/easy-module
 */

namespace Strategies;

use Kascat\EasyModule\Core\Request;

/**
 * Class StrategyRequest
 * @package Strategies
 */
class StrategyRequest extends Request
{
    /**
     * @return array
     */
    public function validateToIndex(): array
    {
        return [
            // Allowed properties to filter:
            // 'name' => '',
        ];
    }

    /**
     * @return array
     */
    public function validateToStore(): array
    {
        return [
            Strategy::NAME => ['required', 'string'],
            Strategy::FOCUS => ['required', 'string'],
            Strategy::CHARACTERISTICS => ['required', 'string'],
            Strategy::ACTIVITIES => ['required', 'string'],
            Strategy::APPLIED_RESOURCES => ['required', 'string'],
            Strategy::REFERENCE => ['required', 'string'],
            Strategy::DESCRIPTION => ['nullable', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function validateToUpdate(): array
    {
        return [
            Strategy::NAME => ['required', 'string'],
            Strategy::FOCUS => ['required', 'string'],
            Strategy::CHARACTERISTICS => ['required', 'string'],
            Strategy::ACTIVITIES => ['required', 'string'],
            Strategy::APPLIED_RESOURCES => ['required', 'string'],
            Strategy::REFERENCE => ['required', 'string'],
            Strategy::DESCRIPTION => ['nullable', 'string'],
        ];
    }

    public function validateToUploadImage(): array
    {
        return [
            Strategy::IMAGE => [ 'file', 'required', 'max:10240', 'mimes:jpg,jpeg,png'],
        ];
    }
}
