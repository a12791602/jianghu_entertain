<?php

use App\Http\Controllers\CommonApi\UploadController;

//上传图片
Route::group(
    ['prefix' => 'merchant'],
    static function (): void {
        $namePrefix = 'merchant-api.';
        Route::post(
            'upload',
            [UploadController::class, 'upload'],
        )->name($namePrefix . 'upload');
    },
);
