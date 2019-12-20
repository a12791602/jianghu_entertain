<?php

use App\Http\Controllers\FrontendApi\H5\FrontendAuthController;

Route::match(['post', 'options'], 'login', [FrontendAuthController::class, 'login'])->name('h5-api.login');

//管理总代用户与玩家
Route::group(
    ['prefix' => 'user'],
    static function (): void {
        $namePrefix = 'h5-api.user.';
        Route::match(
            ['get', 'options'],
            'logout',
            [FrontendAuthController::class, 'logout'],
        )->name($namePrefix . 'logout');
        Route::match(
            ['put', 'options'],
            'refresh-token',
            [FrontendAuthController::class,'refreshToken'],
        )->name($namePrefix . 'refresh-token');
    },
);
