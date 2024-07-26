<?php

use Illuminate\Support\Facades\Route;

Route::group([
     'middleware' => ['auth:sanctum']
], function () {
    Route::apiResource('strategies', Strategies\StrategyController::class);
    Route::post('strategies/{strategy}/image', [Strategies\StrategyController::class, 'uploadImage']);
});
