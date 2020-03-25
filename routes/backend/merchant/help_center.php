<?php

use App\Http\Controllers\BackendApi\Merchant\Setting\HelpCenterController;

//帮助设置
Route::group(
    ['prefix' => 'help-center'],
    static function (): void {
        $namePrefix = 'merchant-api.help-center.';
        //列表
        Route::post(
            'index',
            [
             HelpCenterController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //添加
        Route::post(
            'do-add',
            [
             HelpCenterController::class,
             'doAdd',
            ],
        )->name($namePrefix . 'do-add');
        //编辑
        Route::post(
            'edit',
            [
             HelpCenterController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit');
        //删除
        Route::post(
            'delete',
            [
             HelpCenterController::class,
             'delete',
            ],
        )->name($namePrefix . 'delete');
    },
);
