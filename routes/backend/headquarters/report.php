<?php

use App\Http\Controllers\BackendApi\Headquarters\Report\ReportController;

//报表管理
Route::group(
    ['prefix' => 'report'],
    static function (): void {
        $namePrefix = 'headquarters-api.report.';
        //厅主注单-列表
        route::post(
            'game-project',
            [
             ReportController::class,
             'gameProject',
            ],
        )->name($namePrefix . 'game-project');
    },
);
