<?php

use App\Http\Controllers\BackendApi\Merchant\User\CommissionController;

//洗码设置
Route::group(
    ['prefix' => 'commission'],
    static function (): void {
        $namePrefix = 'merchant-api.commission.';
        //列表
        Route::post(
            'index',
            [CommissionController::class, 'index'],
        )->name($namePrefix . 'index');
        //添加
        Route::post(
            'do-add',
            [CommissionController::class, 'doAdd'],
        )->name($namePrefix . 'do-add');
        //编辑
        Route::post(
            'edit',
            [CommissionController::class, 'edit'],
        )->name($namePrefix . 'edit');
        //删除
        Route::post(
            'delete',
            [CommissionController::class, 'delete'],
        )->name($namePrefix . 'delete');
    },
);
