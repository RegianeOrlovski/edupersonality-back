<?php

use Illuminate\Support\Facades\Route;

Route::group([
    // 'middleware' => ['auth:sanctum']
], function () {
    Route::apiResource('dichotomy_answers', DichotomyAnswers\DichotomyAnswerController::class);
    Route::post('infer_dichotomy_answers', [DichotomyAnswers\DichotomyAnswerController::class, 'inferDichotomyAnswers']);
});
