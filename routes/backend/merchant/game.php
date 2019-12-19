<?php

use App\Http\Controllers\BackendApi\Merchant\Game\GameController;
use App\Http\Controllers\BackendApi\Merchant\Game\GameTypeController;
use App\Http\Controllers\BackendApi\Merchant\Game\GameVendorController;

//游戏种类
Route::group(
    ['prefix' => 'game-type'],
    static function (): void {
        $namePrefix = 'merchant-api.game-type.';
        Route::match(
            ['get', 'options'],
            'index',
            [GameTypeController::class, 'index'],
        )->name($namePrefix . 'index');
        Route::match(
            ['post', 'options'],
            'status',
            [GameTypeController::class, 'status'],
        )->name($namePrefix . 'status');
    },
);


//游戏种类
Route::group(
    ['prefix' => 'game-vendor'],
    static function (): void {
        $namePrefix = 'merchant-api.game-vendor.';
        Route::match(
            ['get', 'options'],
            'index',
            [GameVendorController::class, 'index'],
        )->name($namePrefix . 'index');
        Route::match(
            ['post', 'options'],
            'status',
            [GameVendorController::class, 'status'],
        )->name($namePrefix . 'status');
        Route::match(
            ['post', 'options'],
            'sort',
            [GameVendorController::class, 'sort'],
        )->name($namePrefix . 'sort');
    },
);


//游戏
Route::group(
    ['prefix' => 'game'],
    static function (): void {
        $namePrefix = 'merchant-api.game.';
        //app端游戏列表
        Route::match(
            ['get', 'options'],
            'app-index',
            [GameController::class, 'appIndex'],
        )->name($namePrefix . 'app-index');
        //pc端游戏列表
        Route::match(
            ['get', 'options'],
            'pc-index',
            [GameController::class, 'pcIndex'],
        )->name($namePrefix . 'pc-index');
        //H5端游戏列表
        Route::match(
            ['get', 'options'],
            'h5-index',
            [GameController::class, 'h5Index'],
        )->name($namePrefix . 'h5-index');
        //游戏状态改变
        Route::match(
            ['post', 'options'],
            'status',
            [GameController::class, 'status'],
        )->name($namePrefix . 'status');
        //游戏排序
        Route::match(
            ['post', 'options'],
            'sort',
            [GameController::class, 'sort'],
        )->name($namePrefix . 'sort');
        //更改热门属性
        Route::match(
            ['post', 'options'],
            'do-hot',
            [GameController::class, 'doHot'],
        )->name($namePrefix . 'do-hot');
        //更改是否维护
        Route::match(
            ['post', 'options'],
            'maintain',
            [GameController::class, 'maintain'],
        )->name($namePrefix . 'maintain');
        //更改是否推荐
        Route::match(
            ['post', 'options'],
            'recommend',
            [GameController::class, 'recommend'],
        )->name($namePrefix . 'recommend');
        //获取查询条件
        Route::match(
            ['get', 'options'],
            'get-search-condition-data',
            [GameController::class, 'getSearchConditionData'],
        )->name($namePrefix . 'get-search-condition-data');
    },
);
