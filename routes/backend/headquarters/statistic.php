<?php

use App\Http\Controllers\BackendApi\Headquarters\Statistic\StatisticController;

//总控主页统计
Route::group(
    ['prefix' => 'statistics'],
    static function (): void {
        $namePrefix = 'headquarters-api.statistics.';
        Route::get('index', [StatisticController::class, 'index'])
            ->name($namePrefix . 'index');
        Route::get('header', [StatisticController::class, 'header'])
            ->name($namePrefix . 'header');
    },
);
