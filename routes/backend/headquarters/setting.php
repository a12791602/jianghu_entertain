<?php

use App\Http\Controllers\BackendApi\Headquarters\SettingController;

//设置管理
Route::group(
    ['prefix' => 'setting'],
    static function (): void {
        $namePrefix = 'headquarters-api.setting.';
        Route::post('login-log-detail', [SettingController::class, 'loginLogDetail'])
            ->name($namePrefix . 'login-log-detail');
    },
);
