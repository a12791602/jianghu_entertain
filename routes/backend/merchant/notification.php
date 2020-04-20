<?php

use App\Http\Controllers\BackendApi\Merchant\Notification\NotificationController;

Route::group(
    ['prefix' => 'notification'],
    static function (): void {
        $namePrefix = 'merchant-api.notification.';
        // 顶部通知统计
        Route::get('statistic', [NotificationController::class, 'statistic'])
            ->name($namePrefix . 'statistic');
    },
);
