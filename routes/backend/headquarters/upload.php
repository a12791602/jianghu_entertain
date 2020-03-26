<?php

// 上传图片
use App\Http\Controllers\BackendApi\Headquarters\Upload\UploadController;

Route::group(
    ['prefix' => 'uploads'],
    static function (): void {
        $namePrefix = 'headquarters-api.uploads.';
        Route::post('images', [UploadController::class, 'uploadImage'])->name($namePrefix . 'uploads.images');
    },
);
