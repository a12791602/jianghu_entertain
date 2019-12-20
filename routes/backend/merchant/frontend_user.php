<?php

use App\Http\Controllers\BackendApi\Merchant\User\FrontendUserController;

//会员列表
Route::group(
    ['prefix' => 'frontend-user'],
    static function (): void {
        $namePrefix = 'merchant-api.frontend-user.';
        //会员列表查询
        Route::match(
            ['post', 'options'],
            'index',
            [FrontendUserController::class, 'index'],
        )->name($namePrefix . 'index');
        //会员登陆记录
        Route::match(
            ['post', 'options'],
            'login-log',
            [FrontendUserController::class, 'loginLog'],
        )->name($namePrefix . 'login-log');
    },
);