<?php

/**
 * Easy Module library
 * Packagist: https://packagist.org/packages/kascat/easy-module
 * GitHub: https://github.com/kascat/easy-module
 */

namespace DichotomyAnswers;

use Illuminate\Validation\Rule;
use Kascat\EasyModule\Core\Request;
use Strategies\Strategy;

/**
 * Class DichotomyAnswerRequest
 * @package DichotomyAnswers
 */
class DichotomyAnswerRequest extends Request
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

    public function validateToInferDichotomyAnswers(): array
    {
        return [
            DichotomyAnswer::DICHOTOMY_EI => ['required', 'array'],
            DichotomyAnswer::DICHOTOMY_SN => ['required', 'array'],
            DichotomyAnswer::DICHOTOMY_TF => ['required', 'array'],
            DichotomyAnswer::DICHOTOMY_JP => ['required', 'array'],
        ];
    }

    public function validateToStore(): array
    {
        return [
            DichotomyAnswer::STRATEGY_ID => [
                'required',
                Rule::exists(Strategy::TABLE, Strategy::ID),
                Rule::unique(DichotomyAnswer::TABLE, DichotomyAnswer::STRATEGY_ID)
            ],
            DichotomyAnswer::DICHOTOMY_EI => ['required', 'array'],
            DichotomyAnswer::DICHOTOMY_SN => ['required', 'array'],
            DichotomyAnswer::DICHOTOMY_TF => ['required', 'array'],
            DichotomyAnswer::DICHOTOMY_JP => ['required', 'array'],
        ];
    }

    /**
     * @return array
     */
    public function validateToUpdate(): array
    {
        return [
            DichotomyAnswer::STRATEGY_ID => [
                'required',
                Rule::exists(Strategy::TABLE, Strategy::ID),
                Rule::unique(DichotomyAnswer::TABLE, DichotomyAnswer::STRATEGY_ID)->ignore($this->route('dichotomy_answer'))
            ],
            DichotomyAnswer::DICHOTOMY_EI => ['required', 'array'],
            DichotomyAnswer::DICHOTOMY_SN => ['required', 'array'],
            DichotomyAnswer::DICHOTOMY_TF => ['required', 'array'],
            DichotomyAnswer::DICHOTOMY_JP => ['required', 'array'],
        ];
    }
}
