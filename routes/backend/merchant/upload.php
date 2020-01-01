<?php

use App\Http\Controllers\CommonApi\UploadController;

//上传图片
Route::post('upload', [UploadController::class, 'upload'])->name('merchant-api.upload');
