<?php

use App\Http\Controllers\BackendApi\Merchant\System\CostomerServiceController;

//客服设置
Route::group(
    ['prefix' => 'costomer-service'],
    static function (): void {
        $namePrefix = 'merchant-api.costomer-service.';
        //客服设置-列表
        Route::post(
            'index',
            [
             CostomerServiceController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //客服设置-添加
        Route::post(
            'do-add',
            [
             CostomerServiceController::class,
             'doAdd',
            ],
        )->name($namePrefix . 'do-add');
        //客服设置-编辑
        Route::post(
            'edit',
            [
             CostomerServiceController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit');
        //客服设置-删除
        Route::post(
            'delete',
            [
             CostomerServiceController::class,
             'delete',
            ],
        )->name($namePrefix . 'delete');
    },
);
