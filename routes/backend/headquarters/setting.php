<?php

use App\Http\Controllers\BackendApi\Headquarters\Setting\LoginLogController;

//设置管理
Route::group(
    ['prefix' => 'login-log'],
    static function (): void {
        $namePrefix = 'headquarters-api.login-log.';
        Route::post(
            'index',
            [LoginLogController::class, 'index'],
        )->name($namePrefix . 'index');
    },
);
