<?php

use App\Http\Controllers\FrontendApi\Common\PasswordController;
use App\Http\Controllers\FrontendApi\Common\RegisterController;

Route::group(
    [
     'middleware' => ['frontend-api'],
     'prefix'     => 'app-api',
    ],
    static function (): void {
        $sRouteDir   = base_path() . '/routes/frontend/app/';
        $aRouteFiles = glob($sRouteDir . '*.php');
        foreach ($aRouteFiles as $sRouteFile) {
            include $sRouteFile;
        }
        unset($aRouteFiles);
    },
);

// Verification code
Route::group(
    [
     'middleware' => ['frontend-verification'],
     'prefix'     => 'h5-api',
    ],
    static function (): void {
        $namePrefix = 'h5-api.';
        Route::post('register/verification-code', [RegisterController::class, 'code'])
            ->name($namePrefix . 'register.verification-code');
        Route::post('password-reset/verification-code', [PasswordController::class, 'passwordResetCode'])
            ->name($namePrefix . 'reset-password.verification-code');
        Route::get('password/change-code', [PasswordController::class, 'passwordChangeCode'])
            ->name($namePrefix . 'password.change-code');
        Route::post('security-verification-code', [PasswordController::class, 'securityCode'])
            ->name($namePrefix . 'security-verification-code');
    },
);
Route::group(
    [
     'middleware' => ['frontend-verification'],
     'prefix'     => 'app-api',
    ],
    static function (): void {
        $namePrefix = 'app-api.';
        Route::post('register/verification-code', [RegisterController::class, 'code'])
            ->name($namePrefix . 'register.verification-code');
        Route::post('password-reset/verification-code', [PasswordController::class, 'passwordResetCode'])
            ->name($namePrefix . 'reset-password.verification-code');
        Route::get('password/change-code', [PasswordController::class, 'passwordChangeCode'])
            ->name($namePrefix . 'password.change-code');
        Route::post('security-verification-code', [PasswordController::class, 'securityCode'])
            ->name($namePrefix . 'security-verification-code');
    },
);



// Login & register
Route::group(
    [
     'middleware' => ['frontend-registration'],
     'prefix'     => 'app-api',
    ],
    static function (): void {
        Route::post('register', [RegisterController::class, 'store'])->name('app-api.register');
    },
);
Route::group(
    [
     'middleware' => ['frontend-registration'],
     'prefix'     => 'h5-api',
    ],
    static function (): void {
        Route::post('register', [RegisterController::class, 'store'])->name('h5-api.register');
    },
);

Route::group(
    [
     'middleware' => ['frontend-h5-api'],
     'prefix'     => 'h5-api',
    ],
    static function (): void {
        $sRouteDir   = base_path() . '/routes/frontend/h5/';
        $aRouteFiles = glob($sRouteDir . '*.php');
        foreach ($aRouteFiles as $sRouteFile) {
            include $sRouteFile;
        }
        unset($aRouteFiles);
    },
);
