<?php

use App\Http\Controllers\BackendApi\Headquarters\Setting\LoginLogController;
use App\Http\Controllers\BackendApi\Headquarters\Setting\OperationLogController;

//设置管理
Route::group(
    ['prefix' => 'login-log'],
    static function (): void {
        $namePrefix = 'headquarters-api.login-log.';
        Route::post(
            'index',
            [
             LoginLogController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
    },
);

//操作日志
Route::post(
    'operation-log/index',
    [
     OperationLogController::class,
     'index',
    ],
)->name('headquarters-api.operation-log.index');
