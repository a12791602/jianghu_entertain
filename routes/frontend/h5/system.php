<?php

use App\Http\Controllers\FrontendApi\Common\SystemPublicController;

Route::group(
    ['prefix' => 'system'],
    static function (): void {
        $namePrefix = 'h5-api.system.';
        Route::get('banks', [SystemPublicController::class, 'bank'])->name($namePrefix . 'banks');
        Route::get('avatar', [SystemPublicController::class, 'avatar'])->name($namePrefix . 'avatar');
    },
);
