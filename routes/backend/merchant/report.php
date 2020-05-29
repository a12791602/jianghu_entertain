<?php

use App\Http\Controllers\BackendApi\Merchant\Report\ReportController;

//报表管理
Route::group(
    ['prefix' => 'report'],
    static function (): void {
        $namePrefix = 'merchant-api.report.';
        //个人报表-列表
        Route::post(
            'user',
            [
             ReportController::class,
             'user',
            ],
        )->name($namePrefix . 'user');
        //游戏报表-列表
        Route::post(
            'game',
            [
             ReportController::class,
             'game',
            ],
        )->name($namePrefix . 'game');
        //游戏报表-详情
        Route::post(
            'game-detail',
            [
             ReportController::class,
             'gameDetail',
            ],
        )->name($namePrefix . 'game-detail');
        //公司报表
        Route::post(
            'platform',
            [
             ReportController::class,
             'platform',
            ],
        )->name($namePrefix . 'platform');
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
        //会员洗码-列表
        Route::post(
            'commission',
            [
             ReportController::class,
             'commission',
            ],
        )->name($namePrefix . 'commission');
        //会员洗码-详情
        Route::post(
            'commission-detail',
            [
             ReportController::class,
             'commissionDetail',
            ],
        )->name($namePrefix . 'commission-detail');
    },
);
