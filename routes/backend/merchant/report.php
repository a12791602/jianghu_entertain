<?php

use App\Http\Controllers\BackendApi\Merchant\Report\ReportController;

//报表管理
Route::group(
    ['prefix' => 'report'],
    static function (): void {
        $namePrefix = 'merchant-api.report.';
        //平台注单
        Route::post(
            'game-project',
            [
             ReportController::class,
             'gameProject',
            ],
        )->name($namePrefix . 'game-project');
        //会员稽核列表
        Route::post(
            'user-audit',
            [
             ReportController::class,
             'userAudit',
            ],
        )->name($namePrefix . 'user-audit');
    },
);
