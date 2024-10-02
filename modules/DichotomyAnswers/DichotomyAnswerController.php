<?php

/**
 * Easy Module library
 * Packagist: https://packagist.org/packages/kascat/easy-module
 * GitHub: https://github.com/kascat/easy-module
 */

namespace DichotomyAnswers;

use App\Http\Controllers\Controller;

/**
 * Class DichotomyAnswerController
 * @package DichotomyAnswers
 */
class DichotomyAnswerController extends Controller
{
    use DichotomyAnswerResponse;

    /** @var DichotomyAnswerService */
    private DichotomyAnswerService $dichotomyAnswerService;

    /**
     * DichotomyAnswerController constructor.
     * @param DichotomyAnswerService $dichotomyAnswerService
     */
    public function __construct(DichotomyAnswerService $dichotomyAnswerService)
    {
        $this->dichotomyAnswerService = $dichotomyAnswerService;
    }

    /**
     * @param DichotomyAnswerRequest $request
     * @return mixed
     */
    public function index(DichotomyAnswerRequest $request): mixed
    {
        $result = $this->dichotomyAnswerService->index($request->validated());

        return $this->response($result['response'], $result['status']);
    }

    public function inferDichotomyAnswers(DichotomyAnswerRequest $request): mixed
    {
        $result = $this->dichotomyAnswerService->inferDichotomyAnswers($request->validated());

        return $this->response($result['response'], $result['status']);
    }

    /**
     * @param DichotomyAnswerRequest $request
     * @return mixed
     */
    public function store(DichotomyAnswerRequest $request): mixed
    {
        $result = $this->dichotomyAnswerService->store($request->validated());

        return $this->response($result['response'], $result['status']);
    }

    /**
     * @param DichotomyAnswer $dichotomyAnswer
     * @return mixed
     */
    public function show(DichotomyAnswer $dichotomyAnswer): mixed
    {
        $result = $this->dichotomyAnswerService->show($dichotomyAnswer);

        return $this->response($result['response'], $result['status']);
    }

    /**
     * @param DichotomyAnswerRequest $request
     * @param DichotomyAnswer $dichotomyAnswer
     * @return mixed
     */
    public function update(DichotomyAnswerRequest $request, DichotomyAnswer $dichotomyAnswer): mixed
    {
        $result = $this->dichotomyAnswerService->update($dichotomyAnswer, $request->validated());

        return $this->response($result['response'], $result['status']);
    }

    /**
     * @param DichotomyAnswer $dichotomyAnswer
     * @return mixed
     */
    public function destroy(DichotomyAnswer $dichotomyAnswer): mixed
    {
        $result = $this->dichotomyAnswerService->destroy($dichotomyAnswer);

        return $this->response($result['response'], $result['status']);
    }
}
