<?php

use App\Http\Controllers\FrontendApi\App\FrontendAuthController;
use App\Http\Controllers\FrontendApi\App\FrontendUserController;

Route::match(['post', 'options'], 'login', [FrontendAuthController::class, 'login'])->name('app-api.login');

//管理总代用户与玩家
Route::group(
    ['prefix' => 'user'],
    static function (): void {
        $namePrefix = 'app-api.user.';
        Route::match(
            ['get', 'options'],
            'logout',
            [FrontendAuthController::class, 'logout'],
        )->name($namePrefix . 'logout');
        Route::match(
            ['put', 'options'],
            'refresh-token',
            [FrontendAuthController::class, 'refreshToken'],
        )->name($namePrefix . 'refresh-token');
        Route::match(
            ['get', 'options'],
            'information',
            [FrontendUserController::class, 'information'],
        )->name($namePrefix . 'information');
    },
);
