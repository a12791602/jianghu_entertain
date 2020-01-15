<?php

use App\Http\Controllers\BackendApi\Headquarters\BackendGameController;
use App\Http\Controllers\BackendApi\Headquarters\BackendGameTypeController;
use App\Http\Controllers\BackendApi\Headquarters\BackendGameVendorController;

//游戏种类
Route::group(
    ['prefix' => 'game-type'],
    static function (): void {
        $namePrefix = 'headquarters-api.game-type.';
        Route::post('add-do', [BackendGameTypeController::class, 'addDo'])
            ->name($namePrefix . 'add-do');
        Route::post('edit-do', [BackendGameTypeController::class, 'editDo'])
            ->name($namePrefix . 'edit-do');
        Route::get('index-do', [BackendGameTypeController::class, 'indexDo'])
            ->name($namePrefix . 'index-do');
        Route::get('opt-index-do', [BackendGameTypeController::class, 'indexDo'])
            ->name($namePrefix . 'opt-index-do');
        Route::post('del-do', [BackendGameTypeController::class, 'delDo'])
            ->name($namePrefix . 'del-do');
        Route::post('status-do', [BackendGameTypeController::class, 'statusDo'])
            ->name($namePrefix . 'status-do');
        Route::post('opt-status-do', [BackendGameTypeController::class, 'statusDo'])
            ->name($namePrefix . 'opt-status-do');
    },
);

//游戏厂商
Route::group(
    ['prefix' => 'game-vendor'],
    static function (): void {
        $namePrefix = 'headquarters-api.game-vendor.';
        Route::post('add-do', [BackendGameVendorController::class, 'addDo'])
            ->name($namePrefix . 'add-do');
        Route::post('edit-do', [BackendGameVendorController::class, 'editDo'])
            ->name($namePrefix . 'edit-do');
        Route::get('index-do', [BackendGameVendorController::class, 'indexDo'])
            ->name($namePrefix . 'index-do');
        Route::get('opt-index-do', [BackendGameVendorController::class, 'indexDo'])
            ->name($namePrefix . 'opt-index-do'); //运营使用
        Route::post('del-do', [BackendGameVendorController::class, 'delDo'])
            ->name($namePrefix . 'del-do');
        Route::post('status-do', [BackendGameVendorController::class, 'statusDo'])
            ->name($namePrefix . 'status-do');
        Route::post('opt-status-do', [BackendGameVendorController::class, 'statusDo'])
            ->name($namePrefix . 'opt-status-do');//运营使用
    },
);

//游戏管理
Route::group(
    ['prefix' => 'game'],
    static function (): void {
        $namePrefix = 'headquarters-api.game.';
        Route::post('add-do', [BackendGameController::class, 'addDo'])
            ->name($namePrefix . 'add-do');
        Route::post('edit-do', [BackendGameController::class, 'editDo'])
            ->name($namePrefix . 'edit-do');
        Route::post('opt-edit-do', [BackendGameController::class, 'optEditDo'])
            ->name($namePrefix . 'opt-edit-do');
        Route::get('index-do', [BackendGameController::class, 'indexDo'])
            ->name($namePrefix . 'index-do');
        Route::get('opt-index-do', [BackendGameController::class, 'indexDo'])
            ->name($namePrefix . 'opt-index-do');
        Route::post('del-do', [BackendGameController::class, 'delDo'])
            ->name($namePrefix . 'del-do');
        Route::get(
            'get-search-condition',
            [
             BackendGameController::class,
             'getSearchCondition',
            ],
        )->name($namePrefix . 'get-search-condition');
        Route::post('status-do', [BackendGameController::class, 'statusDo'])
            ->name($namePrefix . 'status-do');
        Route::post('opt-status-do', [BackendGameController::class, 'statusDo'])
            ->name($namePrefix . 'opt-status-do');
    },
);
