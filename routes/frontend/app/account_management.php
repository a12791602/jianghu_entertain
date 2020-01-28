<?php

use App\Http\Controllers\FrontendApi\Common\AccountManagementController;

Route::group(
    ['prefix' => 'account'],
    static function (): void {
        $namePrefix = 'app-api.account.';
        Route::get('list', [AccountManagementController::class, 'accountList'])->name($namePrefix . 'account-list');
        Route::post('bank-card/save', [AccountManagementController::class, 'bankCardSave'])
            ->name($namePrefix . 'bank-card.save');
        Route::post('alipay/save', [AccountManagementController::class, 'aliPaySave'])
            ->name($namePrefix . 'alipay.save');
        Route::post('destroy', [AccountManagementController::class, 'accountDestroy'])->name($namePrefix . 'destroy');
    },
);
