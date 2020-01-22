<?php

use App\Http\Controllers\BackendApi\Merchant\Email\SystemEmailController;

//总控邮件管理
Route::group(
    ['prefix' => 'email'],
    static function (): void {
        $namePrefix = 'merchant-api.email.';
        //发邮件
        Route::post('send', [SystemEmailController::class, 'send'])
            ->name($namePrefix . 'send');
        //已发邮件
        Route::get('send-index', [SystemEmailController::class, 'sendIndex'])
            ->name($namePrefix . 'send-index');
        //已收邮件
        Route::get('received-index', [SystemEmailController::class, 'receivedIndex'])
            ->name($namePrefix . 'received-index');
    },
);
