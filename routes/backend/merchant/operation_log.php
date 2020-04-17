<?php

use App\Http\Controllers\BackendApi\Merchant\Setting\OperationLogController;

//操作日志
Route::post(
    'operation-log/index',
    [
     OperationLogController::class,
     'index',
    ],
)->name('merchant-api.operation-log.index');
