<?php

use App\Http\Controllers\BackendApi\Merchant\Activity\ActivityStaticController;

Route::group(
    ['prefix' => 'activity-static'],
    static function (): void {
        $namePrefix = 'merchant-api.activity-static.';
        //列表
        Route::get(
            'index',
            [
             ActivityStaticController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //添加
        Route::post(
            'add-do',
            [
             ActivityStaticController::class,
             'addDo',
            ],
        )->name($namePrefix . 'add-do');
        //编辑
        Route::post(
            'edit',
            [
             ActivityStaticController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit');
        //删除
        Route::post(
            'del-do',
            [
             ActivityStaticController::class,
             'delDo',
            ],
        )->name($namePrefix . 'del-do');
        //改变状态
        Route::post(
            'status',
            [
             ActivityStaticController::class,
             'status',
            ],
        )->name($namePrefix . 'status');
    },
);
