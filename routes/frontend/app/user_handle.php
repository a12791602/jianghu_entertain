<?php

use App\Http\Controllers\FrontendApi\Common\FrontendAuthController;
use App\Http\Controllers\FrontendApi\Common\FrontendUserController;
use App\Http\Controllers\FrontendApi\Common\PasswordController;

Route::post('login', [FrontendAuthController::class, 'login'])->name('app-api.login');

//管理总代用户与玩家
Route::group(
    ['prefix' => 'user'],
    static function (): void {
        $namePrefix = 'app-api.user.';
        Route::get('logout', [FrontendAuthController::class, 'logout'])->name($namePrefix . 'logout');
        Route::put('reset-password', [PasswordController::class, 'password'])->name($namePrefix . 'reset-password');
        Route::post('security-code', [PasswordController::class, 'security'])->name($namePrefix . 'security-code');
        Route::put('refresh-token', [FrontendAuthController::class, 'refreshToken'])
            ->name($namePrefix . 'refresh-token');
        Route::get('information', [FrontendUserController::class, 'information'])->name($namePrefix . 'information');
        Route::get('dynamic-information', [FrontendUserController::class, 'dynamicInformation'])
            ->name($namePrefix . 'information');
        Route::post('information', [FrontendUserController::class, 'updateInformation'])
            ->name($namePrefix . 'update-information');
        Route::get('grades', [FrontendUserController::class, 'grades'])->name($namePrefix . 'grades');
        Route::post('promotion-gifts', [FrontendUserController::class, 'promotionGift'])
            ->name($namePrefix . 'promotion-gifts');
        Route::post('weekly-gifts', [FrontendUserController::class, 'weeklyGift'])
            ->name($namePrefix . 'weekly-gifts');
    },
);
