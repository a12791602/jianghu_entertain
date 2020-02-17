<?php

use App\Http\Controllers\BackendApi\Merchant\Game\AcknowledgementController;
use App\Http\Controllers\BackendApi\Merchant\Game\GameController;
use App\Http\Controllers\BackendApi\Merchant\Game\GameTypeController;
use App\Http\Controllers\BackendApi\Merchant\Game\GameVendorController;

//游戏种类
Route::group(
    ['prefix' => 'game-type'],
    static function (): void {
        $namePrefix = 'merchant-api.game-type.';
        Route::get(
            'index',
            [
             GameTypeController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        Route::post(
            'status',
            [
             GameTypeController::class,
             'status',
            ],
        )->name($namePrefix . 'status');
    },
);


//游戏厂商
Route::group(
    ['prefix' => 'game-vendor'],
    static function (): void {
        $namePrefix = 'merchant-api.game-vendor.';
        Route::get(
            'index',
            [
             GameVendorController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        Route::post(
            'status',
            [
             GameVendorController::class,
             'status',
            ],
        )->name($namePrefix . 'status');
        Route::post(
            'sort',
            [
             GameVendorController::class,
             'sort',
            ],
        )->name($namePrefix . 'sort');
        //上传图片
        Route::post(
            'upload',
            [
             GameVendorController::class,
             'upload',
            ],
        )->name($namePrefix . 'upload');
    },
);


//游戏
Route::group(
    ['prefix' => 'game'],
    static function (): void {
        $namePrefix = 'merchant-api.game.';
        //app端游戏列表
        Route::get(
            'app-index',
            [
             GameController::class,
             'appIndex',
            ],
        )->name($namePrefix . 'app-index');
        //pc端游戏列表
        Route::get(
            'pc-index',
            [
             GameController::class,
             'pcIndex',
            ],
        )->name($namePrefix . 'pc-index');
        //H5端游戏列表
        Route::get(
            'h5-index',
            [
             GameController::class,
             'h5Index',
            ],
        )->name($namePrefix . 'h5-index');
        //游戏状态改变
        Route::post(
            'status',
            [
             GameController::class,
             'status',
            ],
        )->name($namePrefix . 'status');
        //游戏排序
        Route::post(
            'sort',
            [
             GameController::class,
             'sort',
            ],
        )->name($namePrefix . 'sort');
        //更改热门属性
        Route::post(
            'do-hot',
            [
             GameController::class,
             'doHot',
            ],
        )->name($namePrefix . 'do-hot');
        //更改是否维护
        Route::post(
            'maintain',
            [
             GameController::class,
             'maintain',
            ],
        )->name($namePrefix . 'maintain');
        //更改是否推荐
        Route::post(
            'recommend',
            [
             GameController::class,
             'recommend',
            ],
        )->name($namePrefix . 'recommend');
        //获取查询条件
        Route::get(
            'get-search-condition-data',
            [
             GameController::class,
             'getSearchConditionData',
            ],
        )->name($namePrefix . 'get-search-condition-data');

        //图片上传
        Route::post(
            'upload',
            [
             GameController::class,
             'upload',
            ],
        )->name($namePrefix . 'upload');


        Route::match(['post', 'get'], 'acknowledge-in', [AcknowledgementController::class, 'ackIn'])
            ->name($namePrefix . 'ackIn');
        Route::match(['post', 'get'], 'acknowledge-out', [AcknowledgementController::class, 'ackOut'])
            ->name($namePrefix . 'ackOut');
    },
);
