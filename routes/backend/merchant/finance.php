<?php

use App\Http\Controllers\BackendApi\Merchant\Finance\OfflineFinanceController;

//游戏种类
Route::group(
    ['prefix' => 'offline-finance'],
    static function (): void {
        $namePrefix = 'merchant-api.offline-finance.';
        //添加线下金流
        Route::match(
            ['post', 'options'],
            'add-do',
            [OfflineFinanceController::class, 'addDo'],
        )->name($namePrefix . 'add-do');
        //线下金流列表
        Route::match(
            ['get', 'options'],
            'index',
            [OfflineFinanceController::class, 'index'],
        )->name($namePrefix . 'index');
        //更改线下金流状态
        Route::match(
            ['post', 'options'],
            'status',
            [OfflineFinanceController::class, 'status'],
        )->name($namePrefix . 'status');
    },
);
