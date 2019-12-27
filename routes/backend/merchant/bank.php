<?php

use App\Http\Controllers\BackendApi\Merchant\Bank\BankController;

//游戏种类
Route::group(
    ['prefix' => 'bank'],
    static function (): void {
        $namePrefix = 'merchant-api.bank.';
        //获取系统银行
        Route::get(
            'get-system-banks',
            [BankController::class, 'getSystemBanks'],
        )->name($namePrefix . 'get-system-banks');
    },
);
