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
            [
             BankController::class,
             'getSystemBanks',
            ],
        )->name($namePrefix . 'get-system-banks');
        //列表
        Route::get(
            'index',
            [
             BankController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //改变状态
        Route::post(
            'status',
            [
             BankController::class,
             'status',
            ],
        )->name($namePrefix . 'status');
    },
);
