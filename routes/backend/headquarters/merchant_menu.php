<?php

/**
 * Created by PhpStorm.
 * author: Harris
 * Date: 4/11/2019
 * Time: 12:24 PM
 */

use App\Http\Controllers\BackendApi\Headquarters\DeveloperUsage\Merchant\MenuController;

//代理后台菜单相关
Route::group(
    ['prefix' => 'merchant-menu'],
    static function (): void {
        $namePrefix = 'headquarters-api.merchant-menu.';
        //获取运营后台的所有菜单
        Route::get(
            'get-all-menu',
            [MenuController::class, 'getAllMenu'],
        )->name($namePrefix . 'get-all-menu');
        Route::post(
            'change-parent',
            [MenuController::class, 'changeParent'],
        )->name($namePrefix . 'change-parent');
        Route::post(
            'add',
            [MenuController::class, 'doAdd'],
        )->name($namePrefix . 'add');
        Route::post(
            'edit',
            [MenuController::class, 'edit'],
        )->name($namePrefix . 'edit');
        Route::post(
            'delete',
            [MenuController::class, 'delete'],
        )->name($namePrefix . 'delete');
    },
);
