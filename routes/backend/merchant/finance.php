<?php

use App\Http\Controllers\BackendApi\Merchant\Finance\HandleSaveBuckleRecordController;
use App\Http\Controllers\BackendApi\Merchant\Finance\OfflineFinanceController;
use App\Http\Controllers\BackendApi\Merchant\Finance\OnlineFinanceController;
use App\Http\Controllers\BackendApi\Merchant\Finance\RechargeOrderController;
use App\Http\Controllers\BackendApi\Merchant\Finance\WithdrawOrderController;

//线下金流
Route::group(
    ['prefix' => 'offline-finance'],
    static function (): void {
        $namePrefix = 'merchant-api.offline-finance.';
        //添加线下金流
        Route::post(
            'add-do',
            [
             OfflineFinanceController::class,
             'addDo',
            ],
        )->name($namePrefix . 'add-do');
        //线下金流列表
        Route::get(
            'index',
            [
             OfflineFinanceController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //更改线下金流状态
        Route::post(
            'status',
            [
             OfflineFinanceController::class,
             'status',
            ],
        )->name($namePrefix . 'status');
        //获取线下金流分类
        Route::get(
            'types',
            [
             OfflineFinanceController::class,
             'types',
            ],
        )->name($namePrefix . 'types');
        //删除线下金流
        Route::post(
            'del-do',
            [
             OfflineFinanceController::class,
             'delDo',
            ],
        )->name($namePrefix . 'del-do');
        //编辑线下金流
        Route::post(
            'edit',
            [
             OfflineFinanceController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit');
        Route::get(
            'edit-get',
            [
             OfflineFinanceController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit-get');
    },
);

//线上金流
Route::group(
    ['prefix' => 'online-finance'],
    static function (): void {
        $namePrefix = 'merchant-api.online-finance.';
        //线上金流列表
        Route::get(
            'index',
            [
             OnlineFinanceController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //获取可配置的支付渠道
        Route::get(
            'get-channels',
            [
             OnlineFinanceController::class,
             'getChannels',
            ],
        )->name($namePrefix . 'get-channels');
        //添加支付方式
        Route::post(
            'add-do',
            [
             OnlineFinanceController::class,
             'addDo',
            ],
        )->name($namePrefix . 'add-do');
        //获取编辑支付方式的前置数据
        Route::get(
            'edit-get',
            [
             OnlineFinanceController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit-get');
        //编辑支付方式
        Route::post(
            'edit',
            [
             OnlineFinanceController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit');
        //删除支付方式
        Route::post(
            'del-do',
            [
             OnlineFinanceController::class,
             'delDo',
            ],
        )->name($namePrefix . 'del-do');
        //支付方式修改状态
        Route::post(
            'status',
            [
             OnlineFinanceController::class,
             'status',
            ],
        )->name($namePrefix . 'status');
        //接收回调 platform 系统的平台 order 订单号
        Route::match(
            [
             'get',
             'post',
            ],
            'callback/{platform}/{order}',
            [
             OnlineFinanceController::class,
             'callback',
            ],
        )->name($namePrefix . 'callback');
    },
);

Route::group(
    ['prefix' => 'recharge-order'],
    static function (): void {
        $namePrefix = 'merchant-api.recharge-order.';
        //入款订单列表
        Route::get(
            'index',
            [
             RechargeOrderController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //获取支付方式
        Route::get(
            'get-finance-types',
            [
             RechargeOrderController::class,
             'getFinanceTypes',
            ],
        )->name($namePrefix . 'get-finance-types');
        //手动入款
        Route::post(
            'handle-success',
            [
             RechargeOrderController::class,
             'handleSuccess',
            ],
        )->name($namePrefix . 'handle-success');
        //审核通过
        Route::post(
            'check-pass',
            [
             RechargeOrderController::class,
             'checkPass',
            ],
        )->name($namePrefix . 'check-pass');
        //审核拒绝
        Route::post(
            'check-refuse',
            [
             RechargeOrderController::class,
             'checkRefuse',
            ],
        )->name($namePrefix . 'check-refuse');
    },
);

Route::group(
    ['prefix' => 'handle-save-buckle'],
    static function (): void {
        $namePrefix = 'merchant-api.handle-save-buckle.';
        //人工充值
        Route::post(
            'handle-save',
            [
             HandleSaveBuckleRecordController::class,
             'handleSave',
            ],
        )->name($namePrefix . 'handle-save');
        //人工充值列表
        Route::get(
            'save-index',
            [
             HandleSaveBuckleRecordController::class,
             'saveIndex',
            ],
        )->name($namePrefix . 'save-index');
        //人工扣款
        Route::post(
            'handle-buckle',
            [
             HandleSaveBuckleRecordController::class,
             'handleBuckle',
            ],
        )->name($namePrefix . 'handle-buckle');
        //人工扣款列表
        Route::get(
            'buckle-index',
            [
             HandleSaveBuckleRecordController::class,
             'buckleIndex',
            ],
        )->name($namePrefix . 'buckle-index');
    },
);

//出款审核
Route::group(
    ['prefix' => 'withdraw-order'],
    static function (): void {
        $namePrefix = 'merchant-api.withdraw-order.';
        //出款审核列表
        Route::get(
            'check-index',
            [
             WithdrawOrderController::class,
             'checkIndex',
            ],
        )->name($namePrefix . 'check-index');
        //审核通过
        Route::post(
            'check-pass',
            [
             WithdrawOrderController::class,
             'checkPass',
            ],
        )->name($namePrefix . 'check-pass');
        //审核通过
        Route::post(
            'check-refuse',
            [
             WithdrawOrderController::class,
             'checkRefuse',
            ],
        )->name($namePrefix . 'check-refuse');
        //出款列表
        Route::get(
            'out-index',
            [
             WithdrawOrderController::class,
             'outIndex',
            ],
        )->name($namePrefix . 'out-index');
        //出款成功
        Route::post(
            'out-success',
            [
             WithdrawOrderController::class,
             'outSuccess',
            ],
        )->name($namePrefix . 'out-success');
        //出款拒绝
        Route::post(
            'out-refuse',
            [
             WithdrawOrderController::class,
             'outRefuse',
            ],
        )->name($namePrefix . 'out-refuse');
    },
);
