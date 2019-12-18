<?php

use App\Http\Controllers\BackendApi\Merchant\User\FrontendUserController;

//会员列表
Route::group(
    ['prefix' => 'frontend-user'],
    static function (): void {
        $namePrefix = 'merchant-api.frontend-user.';
        Route::match(
            ['post', 'options'],
            'index',
            [FrontendUserController::class, 'index'],
        )->name($namePrefix . 'index');
    },
);
