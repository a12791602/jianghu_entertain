<?php

use App\Http\Controllers\BackendApi\Merchant\Finance\OfflineFinanceController;
use App\Http\Controllers\BackendApi\Merchant\Finance\OnlineFinanceController;

//线下金流
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
        //获取线下金流分类
        Route::match(
            ['get', 'options'],
            'types',
            [OfflineFinanceController::class, 'types'],
        )->name($namePrefix . 'types');
        //删除线下金流
        Route::match(
            ['post', 'options'],
            'del-do',
            [OfflineFinanceController::class, 'delDo'],
        )->name($namePrefix . 'del-do');
        //编辑线下金流
        Route::match(
            ['post', 'get', 'options'],
            'edit',
            [OfflineFinanceController::class, 'edit'],
        )->name($namePrefix . 'edit');
    },
);

//线上金流
Route::group(
    ['prefix' => 'online-finance'],
    static function (): void {
        $namePrefix = 'merchant-api.online-finance.';
        //线上金流列表
        Route::get('index', [OnlineFinanceController::class, 'index'])
            ->name($namePrefix . 'index');
        //获取可配置的支付渠道
        Route::get('get-channels', [OnlineFinanceController::class, 'getChannels'])
            ->name($namePrefix . 'get-channels');
        //添加支付方式
        Route::post('add-do', [OnlineFinanceController::class, 'addDo'])
            ->name($namePrefix . 'add-do');
        //获取编辑支付方式的前置数据
        Route::get('edit', [OnlineFinanceController::class, 'edit'])
            ->name($namePrefix . 'edit');
        //编辑支付方式
        Route::post('edit', [OnlineFinanceController::class, 'edit'])
            ->name($namePrefix . 'edit');
        //删除支付方式
        Route::post('del-do', [OnlineFinanceController::class, 'delDo'])
            ->name($namePrefix . 'del-do');
        //支付方式修改状态
        Route::post('status', [OnlineFinanceController::class, 'status'])
            ->name($namePrefix . 'status');
    },
);
