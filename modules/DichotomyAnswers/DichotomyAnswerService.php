<?php

/**
 * Easy Module library
 * Packagist: https://packagist.org/packages/kascat/easy-module
 * GitHub: https://github.com/kascat/easy-module
 */

namespace DichotomyAnswers;

use Kascat\EasyModule\Core\Service;
use Strategies\Strategy;

/**
 * Class DichotomyAnswerService
 * @package DichotomyAnswers
 */
class DichotomyAnswerService extends Service
{
    /**
     * @param array $filters
     * @return array
     */
    public function index(array $filters): array
    {
        $dichotomyAnswersQuery = DichotomyAnswerRepository::index($filters);

        return self::buildReturn(
            $dichotomyAnswersQuery
                ->with(\request()->with ?? [])
                ->paginate(\request()->perPage)
        );
    }

    /**
     * @param DichotomyAnswer $dichotomyAnswer
     * @return array
     */
    public function show(DichotomyAnswer $dichotomyAnswer): array
    {
        return self::buildReturn(
            $dichotomyAnswer
                ->load(\request('with') ?? [])
                ->toArray()
        );
    }

    /**
     * @param array $data
     * @return array
     */
    public function store(array $data): array
    {
        $data = self::prepareData($data, [
            DichotomyAnswer::DICHOTOMY_EI => fn($value) => array_map(fn ($answer) => $answer ?: '', $value),
            DichotomyAnswer::DICHOTOMY_SN => fn($value) => array_map(fn ($answer) => $answer ?: '', $value),
            DichotomyAnswer::DICHOTOMY_TF => fn($value) => array_map(fn ($answer) => $answer ?: '', $value),
            DichotomyAnswer::DICHOTOMY_JP => fn($value) => array_map(fn ($answer) => $answer ?: '', $value),
        ]);

        $letterResult = $this->resolveLetterResult(
            $data[DichotomyAnswer::DICHOTOMY_EI],
            $data[DichotomyAnswer::DICHOTOMY_SN],
            $data[DichotomyAnswer::DICHOTOMY_TF],
            $data[DichotomyAnswer::DICHOTOMY_JP]
        );

        $data[DichotomyAnswer::LETTER_RESULT] = $letterResult;

        $personalities = $this->resolvePersonalities($letterResult);

        /** @var DichotomyAnswer $dichotomyAnswer */
        $dichotomyAnswer = DichotomyAnswer::query()->create($data);

        $dichotomyAnswer->strategy->update([
            Strategy::PERSONALITIES => $personalities
        ]);

        return self::buildReturn($dichotomyAnswer);
    }

    /**
     * @param DichotomyAnswer $dichotomyAnswer
     * @param array $data
     * @return array
     */
    public function update(DichotomyAnswer $dichotomyAnswer, array $data): array
    {
        $data = self::prepareData($data, [
            DichotomyAnswer::DICHOTOMY_EI => fn($value) => array_map(fn ($answer) => $answer ?: '', $value),
            DichotomyAnswer::DICHOTOMY_SN => fn($value) => array_map(fn ($answer) => $answer ?: '', $value),
            DichotomyAnswer::DICHOTOMY_TF => fn($value) => array_map(fn ($answer) => $answer ?: '', $value),
            DichotomyAnswer::DICHOTOMY_JP => fn($value) => array_map(fn ($answer) => $answer ?: '', $value),
        ]);

        $letterResult = $this->resolveLetterResult(
            $data[DichotomyAnswer::DICHOTOMY_EI],
            $data[DichotomyAnswer::DICHOTOMY_SN],
            $data[DichotomyAnswer::DICHOTOMY_TF],
            $data[DichotomyAnswer::DICHOTOMY_JP]
        );

        $data[DichotomyAnswer::LETTER_RESULT] = $letterResult;

        $personalities = $this->resolvePersonalities($letterResult);

        $dichotomyAnswer->update($data);

        $dichotomyAnswer->strategy->update([
            Strategy::PERSONALITIES => $personalities
        ]);

        return self::buildReturn($dichotomyAnswer);
    }

    /**
     * @param DichotomyAnswer $dichotomyAnswer
     * @return array
     */
    public function destroy(DichotomyAnswer $dichotomyAnswer): array
    {
        $dichotomyAnswer->delete();

        return self::buildReturn();
    }

    private function resolveLetterResult(array $dichotomy_ei, array $dichotomy_sn, array $dichotomy_tf, array $dichotomy_jp): array
    {
        $result = array_merge(
            array_intersect(str_split($dichotomy_ei[0]),str_split($dichotomy_ei[1])),
            array_intersect(str_split($dichotomy_sn[0]),str_split($dichotomy_sn[1])),
            array_intersect(str_split($dichotomy_tf[0]),str_split($dichotomy_tf[1])),
            array_intersect(str_split($dichotomy_jp[0]),str_split($dichotomy_jp[1]))
        );

        return array_unique($result);
    }

    private function resolvePersonalities(array $letterResult): array
    {
        $allPersonalities = ['ESFJ', 'ISFJ', 'ESTJ', 'ISTJ', 'ESFP', 'ISFP', 'ESTP', 'ISTP', 'ENFP', 'INFP', 'ENFJ', 'INFJ', 'ENTP', 'INTP', 'ENTJ', 'INTJ'];

        $allMatches = [];

        foreach ($letterResult as $letter) {
            $allMatches = array_merge(
                $allMatches,
                array_filter($allPersonalities, function ($personality) use ($letter) {
                    return false !== stripos($personality, $letter);
                })
            );
        }


        $eligiblePersonalities = array_filter(array_count_values($allMatches), function ($quantity) {
            $matchLetterQuantityToChoose = 2;

            return $quantity >= $matchLetterQuantityToChoose;
        });

        return array_keys($eligiblePersonalities);
    }
}
