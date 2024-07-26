<?php

/**
 * Easy Module library
 * Packagist: https://packagist.org/packages/kascat/easy-module
 * GitHub: https://github.com/kascat/easy-module
 */

namespace Strategies;

use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Kascat\EasyModule\Core\Service;

/**
 * Class StrategyService
 * @package Strategies
 */
class StrategyService extends Service
{
    /**
     * @param array $filters
     * @return array
     */
    public function index(array $filters): array
    {
        $strategiesQuery = StrategyRepository::index($filters);

        return self::buildReturn(
            $strategiesQuery
                ->with(\request()->with ?? [])
                ->paginate(\request()->perPage)
        );
    }

    /**
     * @param Strategy $strategy
     * @return array
     */
    public function show(Strategy $strategy): array
    {
        return self::buildReturn(
            $strategy
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
        $data[Strategy::USER_ID] = request()->user()->id;

        $strategy = Strategy::create($data);

        return self::buildReturn($strategy);
    }

    /**
     * @param Strategy $strategy
     * @param array $data
     * @return array
     */
    public function update(Strategy $strategy, array $data): array
    {
        if (request()->user()->id !== $strategy->user_id) {
            return self::buildReturn([], Response::HTTP_NOT_FOUND);
        }

        $strategy->update($data);

        return self::buildReturn($strategy);
    }

    /**
     * @param Strategy $strategy
     * @return array
     */
    public function destroy(Strategy $strategy): array
    {
        if (request()->user()->id !== $strategy->user_id) {
            return self::buildReturn([], Response::HTTP_NOT_FOUND);
        }

        $strategy->delete();

        return self::buildReturn();
    }

    public function uploadImage(Strategy $strategy, UploadedFile $image): array
    {
        $fileContent = file_get_contents($image->getRealPath());
        $mimeType = $image->getMimeType();

        $base64Image = 'data:' . $mimeType . ';base64,' . base64_encode($fileContent);

        $strategy->update([
            Strategy::IMAGE => $base64Image,
        ]);

        return self::buildReturn([
            Strategy::IMAGE => $base64Image,
        ]);
    }
}
