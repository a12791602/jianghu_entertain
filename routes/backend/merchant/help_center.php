<?php

use App\Http\Controllers\BackendApi\Merchant\System\HelpCenterController;

//帮助设置
Route::group(
    ['prefix' => 'help-center'],
    static function (): void {
        $namePrefix = 'merchant-api.help-center.';
        //列表
        Route::match(
            ['post', 'options'],
            'index',
            [HelpCenterController::class, 'index'],
        )->name($namePrefix . 'index');
        //添加
        Route::match(
            ['post', 'options'],
            'do-add',
            [HelpCenterController::class, 'doAdd'],
        )->name($namePrefix . 'do-add');
        //编辑
        Route::match(
            ['post', 'options'],
            'edit',
            [HelpCenterController::class, 'edit'],
        )->name($namePrefix . 'edit');
        //删除
        Route::match(
            ['post', 'options'],
            'delete',
            [HelpCenterController::class, 'delete'],
        )->name($namePrefix . 'delete');
    },
);
