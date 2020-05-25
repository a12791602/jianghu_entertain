<?php

use App\Http\Controllers\BackendApi\Merchant\Statistic\StatisticController;

//总控主页统计
Route::group(
    ['prefix' => 'statistics'],
    static function (): void {
        $namePrefix = 'merchant-api.statistics.';
        Route::get('index', [StatisticController::class, 'index'])
            ->name($namePrefix . 'index');
    },
);
