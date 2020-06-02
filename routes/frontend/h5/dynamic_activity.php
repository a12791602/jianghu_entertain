<?php

//管理总代用户与玩家
use App\Http\Controllers\FrontendApi\Common\DynamicActivityController;

Route::group(
    ['prefix' => 'dynamic-activity'],
    static function (): void {
        $namePrefix = 'dynamic-activity.';
        Route::get(
            '/{activity_dyn_id}',
            [
             DynamicActivityController::class,
             'participate',
            ],
        )->name($namePrefix . 'participate');
    },
);
