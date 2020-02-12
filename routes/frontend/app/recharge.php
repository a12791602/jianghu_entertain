<?php

use App\Http\Controllers\FrontendApi\App\RechargeController;

Route::group(
    ['prefix' => 'recharge'],
    static function (): void {
        $namePrefix = 'app-api.recharge.';
        //获取充值分类
        Route::post(
            'types',
            [
             RechargeController::class,
             'types',
            ],
        )->name($namePrefix . 'types');
        //获取充值渠道
        Route::post(
            'channels',
            [
             RechargeController::class,
             'channels',
            ],
        )->name($namePrefix . 'channels');
        //发起充值
        Route::post(
            'recharge',
            [
             RechargeController::class,
             'recharge',
            ],
        )->name($namePrefix . 'recharge');
        //获取分类与渠道
        Route::get(
            'get-finance-info',
            [
             RechargeController::class,
             'getFinanceInfo',
            ],
        )->name($namePrefix . 'get-finance-info');
    },
);
