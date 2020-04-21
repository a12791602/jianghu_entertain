<?php

use App\Http\Controllers\BackendApi\Merchant\Activity\ActivityDynController;
use App\Http\Controllers\BackendApi\Merchant\Activity\ActivityStaticController;

Route::group(
    ['prefix' => 'activity-static'],
    static function (): void {
        $namePrefix = 'merchant-api.activity-static.';
        //列表
        Route::post(
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

Route::group(
    ['prefix' => 'activity-dyn'],
    static function (): void {
        $namePrefix = 'merchant-api.activity-dyn.';
        //列表
        Route::post(
            'index',
            [
             ActivityDynController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //改变状态
        Route::post(
            'status',
            [
             ActivityDynController::class,
             'status',
            ],
        )->name($namePrefix . 'status');
        //保存图片
        Route::post(
            'save-pic',
            [
             ActivityDynController::class,
             'savePic',
            ],
        )->name($namePrefix . 'save-pic');
    },
);
