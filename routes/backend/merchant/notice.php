<?php

use App\Http\Controllers\BackendApi\Merchant\Notice\MarqueeNoticeController;
use App\Http\Controllers\BackendApi\Merchant\Notice\SystemNoticeController;

Route::group(
    ['prefix' => 'marquee-notice'],
    static function (): void {
        $namePrefix = 'merchant-api.marquee-notice.';
        //列表
        Route::get(
            'index',
            [
             MarqueeNoticeController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //添加
        Route::post(
            'add-do',
            [
             MarqueeNoticeController::class,
             'addDo',
            ],
        )->name($namePrefix . 'add-do');
        //编辑
        Route::post(
            'edit',
            [
             MarqueeNoticeController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit');
        //删除
        Route::post(
            'del-do',
            [
             MarqueeNoticeController::class,
             'delDo',
            ],
        )->name($namePrefix . 'del-do');
        //改变状态
        Route::post(
            'status',
            [
             MarqueeNoticeController::class,
             'status',
            ],
        )->name($namePrefix . 'status');
    },
);

Route::group(
    ['prefix' => 'system-notice'],
    static function (): void {
        $namePrefix = 'merchant-api.system-notice.';
        //列表
        Route::get(
            'index',
            [
             SystemNoticeController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //添加
        Route::post(
            'add-do',
            [
             SystemNoticeController::class,
             'addDo',
            ],
        )->name($namePrefix . 'add-do');
        //编辑
        Route::post(
            'edit',
            [
             SystemNoticeController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit');
        //删除
        Route::post(
            'del-do',
            [
             SystemNoticeController::class,
             'delDo',
            ],
        )->name($namePrefix . 'del-do');
        //改变状态
        Route::post(
            'status',
            [
             SystemNoticeController::class,
             'status',
            ],
        )->name($namePrefix . 'status');
    },
);
