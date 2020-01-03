<?php

use App\Http\Controllers\FrontendApi\Common\FrontendAuthController;
use App\Http\Controllers\FrontendApi\Common\FrontendUserController;
use App\Http\Controllers\FrontendApi\Common\PasswordController;

Route::post('login', [FrontendAuthController::class,'login'])->name('h5-api.login');

//管理总代用户与玩家
Route::group(
    ['prefix' => 'user'],
    static function (): void {
        $namePrefix = 'h5-api.user.';
        Route::get('logout', [FrontendAuthController::class,'logout'])->name($namePrefix . 'logout');
        Route::post('reset-password', [PasswordController::class,'password'])->name($namePrefix . 'reset-password');

        Route::patch('security-code', [PasswordController::class,'security'])->name($namePrefix . 'security-code');

        Route::put('refresh-token', [FrontendAuthController::class,'refreshToken'])
            ->name($namePrefix . 'refresh-token');
        Route::get('information', [FrontendUserController::class,'information'])->name($namePrefix . 'information');
        Route::get('home-information', [FrontendUserController::class,'homeInformation'])
            ->name($namePrefix . 'information');
    },
);
