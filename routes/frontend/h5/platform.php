<?php

use App\Http\Controllers\FrontendApi\Common\PlatformController;

// 平台相关
Route::group(
    ['prefix' => 'platform'],
    static function (): void {
        $namePrefix = 'app-api.platform.';
        Route::get('current-ssl', [PlatformController::class, 'currentSsl'])->name($namePrefix . 'current-ssl-h5');
    },
);
