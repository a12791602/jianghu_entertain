<?php

use App\Http\Controllers\BackendApi\Merchant\User\UserGradeController;

//会员等级
Route::group(
    ['prefix' => 'user-grade'],
    static function (): void {
        $namePrefix = 'merchant-api.user-grade.';
        //会员等级配置
        Route::match(
            ['post', 'options'],
            'config',
            [UserGradeController::class, 'gradeConfig'],
        )->name($namePrefix . 'config');
    },
);
