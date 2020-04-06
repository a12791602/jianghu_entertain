<?php

use App\Http\Controllers\BackendApi\Merchant\Setting\PromotionPicController;

//推广图片
Route::group(
    ['prefix' => 'promotion-pic'],
    static function (): void {
        $namePrefix = 'merchant-api.promotion-pic.';
        //推广图片-列表
        Route::post(
            'index',
            [
             PromotionPicController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //推广图片-添加
        Route::post(
            'do-add',
            [
             PromotionPicController::class,
             'doAdd',
            ],
        )->name($namePrefix . 'do-add');
        //推广图片-编辑
        Route::post(
            'edit',
            [
             PromotionPicController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit');
        //推广图片-删除
        Route::post(
            'delete',
            [
             PromotionPicController::class,
             'delete',
            ],
        )->name($namePrefix . 'delete');
    },
);
