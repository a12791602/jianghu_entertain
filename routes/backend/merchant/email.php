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
        Route::post('send-index', [SystemEmailController::class, 'sendIndex'])
            ->name($namePrefix . 'send-index');
        //已收邮件
        Route::get('received-index', [SystemEmailController::class, 'receivedIndex'])
            ->name($namePrefix . 'received-index');
        //读邮件
        Route::post('read-email', [SystemEmailController::class, 'readEmail'])
            ->name($namePrefix . 'read-email');
        //删除已收邮件
        Route::post('destroy-incoming-email', [SystemEmailController::class, 'destroyIncomingEmail'])
            ->name($namePrefix . 'destroy.incoming.email');
        //删除已发邮件
        Route::post('destroy-sent-email', [SystemEmailController::class, 'destroySentEmail'])
            ->name($namePrefix . 'destroy.sent.email');
    },
);
