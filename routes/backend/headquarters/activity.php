<?php

use App\Http\Controllers\BackendApi\Headquarters\Activity\BackendSystemDynActivityController;

//金融分类管理
Route::group(
    ['prefix' => 'activity'],
    static function (): void {
        $namePrefix = 'headquarters-api.activity.';
        Route::get('index-do', [BackendSystemDynActivityController::class, 'index'])
            ->name($namePrefix . 'index-do');
        Route::post('status-do', [BackendSystemDynActivityController::class, 'status'])
            ->name($namePrefix . 'status-do');
    },
);
