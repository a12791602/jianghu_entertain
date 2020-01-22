<?php

use App\Http\Controllers\BackendApi\Headquarters\BackendSystemEmailController;

//总控邮件管理
Route::group(
    ['prefix' => 'email'],
    static function (): void {
        $namePrefix = 'headquarters-api.email.';
        //发邮件
        Route::post('send', [BackendSystemEmailController::class, 'send'])
            ->name($namePrefix . 'send');
        //已发邮件
        Route::get('send-index', [BackendSystemEmailController::class, 'sendIndex'])
            ->name($namePrefix . 'send-index');
        //已收邮件
        Route::get('received-index', [BackendSystemEmailController::class, 'receivedIndex'])
            ->name($namePrefix . 'received-index');
    },
);
