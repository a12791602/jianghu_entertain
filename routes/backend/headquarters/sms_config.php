<?php

use App\Http\Controllers\BackendApi\Headquarters\Setting\SmsConfigController;

//短信配置
Route::group(
    ['prefix' => 'sms-config'],
    static function (): void {
        $namePrefix = 'headquarters-api.sms-config.';
        //短信配置-列表
        Route::post(
            'index',
            [SmsConfigController::class, 'index'],
        )->name($namePrefix . 'index');
        //短信配置-添加
        Route::post(
            'do-add',
            [SmsConfigController::class, 'doAdd'],
        )->name($namePrefix . 'do-add');
        //短信配置-编辑
        Route::post(
            'edit',
            [SmsConfigController::class, 'edit'],
        )->name($namePrefix . 'edit');
        //短信配置-删除
        Route::post(
            'delete',
            [SmsConfigController::class,  'delete'],
        )->name($namePrefix . 'delete');
        //短信配置-修改状态
        Route::post(
            'status',
            [SmsConfigController::class,  'status'],
        )->name($namePrefix . 'status');
    },
);
