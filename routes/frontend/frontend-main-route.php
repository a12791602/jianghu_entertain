<?php

use App\Http\Controllers\FrontendApi\App\RegisterController as AppRegister;
use App\Http\Controllers\FrontendApi\H5\RegisterController as H5Register;

Route::group(
    [
        'middleware' => ['frontend-api'],
        'prefix' => 'app-api',
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
        'middleware' => ['registration'],
        'prefix'    => 'h5-api',
    ],
    static function (): void {
        Route::match(['post', 'options'], 'register/verification-code', [H5Register::class, 'code'])
            ->name('h5-api.register.verification-code');
    },
);
Route::group(
    [
        'middleware' => ['registration'],
        'prefix'     => 'app-api',
    ],
    static function (): void {
        Route::match(['post', 'options'], 'register/verification-code', [AppRegister::class, 'code'])
            ->name('app-api.register.verification-code');
    },
);

// Login & register
Route::group(
    [
        'middleware' => ['frontend-auth'],
        'prefix'     => 'app-api',
    ],
    static function (): void {
        Route::match(['post', 'options'], 'register', [AppRegister::class, 'store'])->name('app-api.register');
    },
);
Route::group(
    [
        'middleware' => ['frontend-auth'],
        'prefix'     => 'h5-api',
    ],
    static function (): void {
        Route::match(['post', 'options'], 'register', [H5Register::class, 'store'])->name('h5-api.register');
    },
);

Route::group(
    [
        'middleware' => ['frontend-h5-api'],
        'prefix' => 'h5-api',
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
