<?php

use App\Http\Controllers\BackendApi\Merchant\MenuController;

//菜单相关
Route::group(
    ['prefix' => 'menu'],
    static function (): void {
        $namePrefix = 'merchant-api.menu.';
        //获取当前商户的菜单
        Route::get(
            'current-admin-menu',
            [MenuController::class, 'currentAdminMenu'],
        )->name($namePrefix . 'current-admin-menu');
    },
);
