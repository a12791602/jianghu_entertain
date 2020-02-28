<?php

use App\Http\Controllers\FrontendApi\Common\FrontendAuthController;
use App\Http\Controllers\FrontendApi\Common\FrontendUserController;
use App\Http\Controllers\FrontendApi\Common\PasswordController;

Route::post('login', [FrontendAuthController::class, 'login'])->name('h5-api.login');

//管理总代用户与玩家
Route::group(
    ['prefix' => 'user'],
    static function (): void {
        $namePrefix = 'h5-api.user.';
        Route::get('logout', [FrontendAuthController::class, 'logout'])->name($namePrefix . 'logout');
        Route::put('password-reset', [PasswordController::class, 'passwordReset'])
            ->name($namePrefix . 'password.reset');
        Route::put('password-change', [PasswordController::class, 'passwordChange'])
            ->name($namePrefix . 'password.change');
        Route::post('security-code', [PasswordController::class, 'security'])->name($namePrefix . 'security-code');
        Route::put('refresh-token', [FrontendAuthController::class, 'refreshToken'])
            ->name($namePrefix . 'refresh-token');
        Route::get('information', [FrontendUserController::class, 'information'])->name($namePrefix . 'information');
        Route::get('dynamic-information', [FrontendUserController::class, 'dynamicInformation'])
            ->name($namePrefix . 'information');
        Route::post('information', [FrontendUserController::class, 'updateInformation'])
            ->name($namePrefix . 'information');
        Route::post('claim-gifts', [FrontendUserController::class, 'claimGift'])
            ->name($namePrefix . 'claim-gifts');
        Route::post('check-gifts', [FrontendUserController::class, 'checkGift'])
            ->name($namePrefix . 'check-gifts');
    },
);
