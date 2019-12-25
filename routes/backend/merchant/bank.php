<?php

use App\Http\Controllers\BackendApi\Merchant\Bank\BankController;

//游戏种类
Route::group(
    ['prefix' => 'bank'],
    static function (): void {
        $namePrefix = 'merchant-api.bank.';
        //添加线下金流
        Route::match(
            ['get', 'options'],
            'get-system-banks',
            [BankController::class, 'getSystemBanks'],
        )->name($namePrefix . 'get-system-banks');
    },
);
