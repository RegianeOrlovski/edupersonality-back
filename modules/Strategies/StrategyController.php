<?php

/**
 * Easy Module library
 * Packagist: https://packagist.org/packages/kascat/easy-module
 * GitHub: https://github.com/kascat/easy-module
 */

namespace Strategies;

use App\Http\Controllers\Controller;

/**
 * Class StrategyController
 * @package Strategies
 */
class StrategyController extends Controller
{
    use StrategyResponse;

    /** @var StrategyService */
    private StrategyService $strategyService;

    /**
     * StrategyController constructor.
     * @param StrategyService $strategyService
     */
    public function __construct(StrategyService $strategyService)
    {
        $this->strategyService = $strategyService;
    }

    /**
     * @param StrategyRequest $request
     * @return mixed
     */
    public function index(StrategyRequest $request): mixed
    {
        $result = $this->strategyService->index($request->validated());

        return $this->response($result['response'], $result['status']);
    }

    /**
     * @param StrategyRequest $request
     * @return mixed
     */
    public function store(StrategyRequest $request): mixed
    {
        $result = $this->strategyService->store($request->validated());

        return $this->response($result['response'], $result['status']);
    }

    /**
     * @param Strategy $strategy
     * @return mixed
     */
    public function show(Strategy $strategy): mixed
    {
        $result = $this->strategyService->show($strategy);

        return $this->response($result['response'], $result['status']);
    }

    /**
     * @param StrategyRequest $request
     * @param Strategy $strategy
     * @return mixed
     */
    public function update(StrategyRequest $request, Strategy $strategy): mixed
    {
        $result = $this->strategyService->update($strategy, $request->validated());

        return $this->response($result['response'], $result['status']);
    }

    /**
     * @param Strategy $strategy
     * @return mixed
     */
    public function destroy(Strategy $strategy): mixed
    {
        $result = $this->strategyService->destroy($strategy);

        return $this->response($result['response'], $result['status']);
    }

    public function uploadImage(StrategyRequest $request, Strategy $strategy)
    {
        $result = $this->strategyService->uploadImage($strategy, $request->validated('image'));

        return $this->response($result['response'], $result['status']);
    }
}
