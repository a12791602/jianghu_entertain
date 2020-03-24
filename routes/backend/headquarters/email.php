<?php

use App\Http\Controllers\BackendApi\Headquarters\Email\BackendSystemEmailController;

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
        //最近联系人
        Route::get('recent-contact', [BackendSystemEmailController::class, 'recentContact'])
            ->name($namePrefix . 'recent-contact');
        //联系人
        Route::get('contact', [BackendSystemEmailController::class, 'contact'])
            ->name($namePrefix . 'contact');
        //读邮件
        Route::post('read-email', [BackendSystemEmailController::class, 'readEmail'])
            ->name($namePrefix . 'read-email');
    },
);
