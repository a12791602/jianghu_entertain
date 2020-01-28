<?php

use App\Http\Controllers\FrontendApi\Common\AccountManagementController;

Route::group(
    ['prefix' => 'account'],
    static function (): void {
        $namePrefix = 'h5-api.account.';
        Route::get('list', [AccountManagementController::class, 'list'])->name($namePrefix . 'account-list');
        Route::post('store', [AccountManagementController::class, 'store'])->name($namePrefix . 'account-list');
    },
);
