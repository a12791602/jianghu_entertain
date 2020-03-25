<?php

use App\Http\Controllers\BackendApi\Merchant\Setting\ConfigController;

//全域设置
Route::group(
    ['prefix' => 'config'],
    static function (): void {
        $namePrefix = 'merchant-api.config.';
        //全域设置-列表
        Route::get(
            'index',
            [
             ConfigController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //全域设置-保存
        Route::post(
            'edit',
            [
             ConfigController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit');
    },
);
