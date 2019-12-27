<?php

use App\Http\Controllers\FrontendApi\Common\FrontendAuthController;
use App\Http\Controllers\FrontendApi\Common\FrontendUserController;

Route::post('login', [FrontendAuthController::class,'login'])->name('app-api.login');

//管理总代用户与玩家
Route::group(
    ['prefix' => 'user'],
    static function (): void {
        $namePrefix = 'app-api.user.';
        Route::get('logout', [FrontendAuthController::class,'logout'])->name($namePrefix . 'logout');
        Route::put('refresh-token', [FrontendAuthController::class,'refreshToken'])
            ->name($namePrefix . 'refresh-token');
        Route::get('information', [FrontendUserController::class,'information'])->name($namePrefix . 'information');
    },
);
