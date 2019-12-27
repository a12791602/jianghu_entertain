<?php

use App\Http\Controllers\BackendApi\Merchant\User\UserBlackListController;

//黑名单管理
Route::group(
    ['prefix' => 'frontend-user-black-list'],
    static function (): void {
        $namePrefix = 'merchant-api.frontend-user-black-list.';
        //黑名单列表
        Route::post(
            'index',
            [UserBlackListController::class, 'index'],
        )->name($namePrefix . 'index');
        //黑名单详情
        Route::post(
            'detail',
            [UserBlackListController::class, 'detail'],
        )->name($namePrefix . 'detail');
        //解除黑名单
        Route::post(
            'remove',
            [UserBlackListController::class, 'remove'],
        )->name($namePrefix . 'remove');
    },
);
