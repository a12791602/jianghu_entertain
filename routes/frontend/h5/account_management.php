<?php

use App\Http\Controllers\FrontendApi\Common\AccountManagementController;

Route::group(
    ['prefix' => 'account'],
    static function (): void {
        $namePrefix = 'h5-api.account.';
        Route::get('list', [AccountManagementController::class, 'accountList'])->name($namePrefix . 'account-list');
        Route::post('bank-card/first-binding', [AccountManagementController::class, 'bankCardFirstBinding'])
            ->name($namePrefix . 'bank-card.first-binding');
        Route::post('alipay/first-binding', [AccountManagementController::class, 'aliPayFirstBinding'])
            ->name($namePrefix . 'alipay.first-binding');
        Route::post('bank-card/binding', [AccountManagementController::class, 'bankCardBinding'])
            ->name($namePrefix . 'bank-card.binding');
        Route::post('alipay/binding', [AccountManagementController::class, 'aliPayBinding'])
            ->name($namePrefix . 'alipay.binding');
        Route::get('fund-password/check', [AccountManagementController::class, 'fundPasswordCheck'])
            ->name($namePrefix . 'fund-password.check');
        Route::post('destroy', [AccountManagementController::class, 'accountDestroy'])->name($namePrefix . 'destroy');
        Route::post('destroy/verification-code', [AccountManagementController::class, 'accountDestroyVerificationCode'])
            ->name($namePrefix . 'destroy.verification-code');
        Route::post('withdrawal', [AccountManagementController::class, 'withdrawal'])->name($namePrefix . 'withdrawal');
        //用户报表（账变明细 充值记录 提现记录）
        Route::post('report', [AccountManagementController::class, 'report'])->name($namePrefix . 'report');
    },
);
