<?php

use App\Http\Controllers\FrontendApi\Common\FrontendAuthController;
use App\Http\Controllers\FrontendApi\Common\PasswordController;
use App\Http\Controllers\FrontendApi\H5\UserCenterController;

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
        Route::get('information', [UserCenterController::class, 'information'])->name($namePrefix . 'information');
        Route::get('dynamic-information', [UserCenterController::class, 'dynamicInformation'])
            ->name($namePrefix . 'information');
        Route::post('information', [UserCenterController::class, 'updateInformation'])
            ->name($namePrefix . 'update-information');
        Route::post('claim-benefits', [UserCenterController::class, 'claimBenefits'])
            ->name($namePrefix . 'claim-benefits');
        Route::post('check-benefits', [UserCenterController::class, 'checkBenefits'])
            ->name($namePrefix . 'check-gifts');
    },
);
