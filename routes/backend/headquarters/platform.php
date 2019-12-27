<?php

use App\Http\Controllers\BackendApi\Headquarters\Merchant\PlatformController;

//运营商管理
Route::group(
    ['prefix' => 'platform', 'namespace' => 'Merchant'],
    static function (): void {
        $namePrefix = 'headquarters-api.platform.';
        //运营商列表
        Route::get(
            'detail',
            [PlatformController::class, 'detail'],
        )->name($namePrefix . 'detail');
        //添加运营商
        Route::post(
            'do-add',
            [PlatformController::class, 'doAdd'],
        )->name($namePrefix . 'do-add');
        //运营商站点配置（编辑）
        Route::post(
            'edit',
            [PlatformController::class, 'edit'],
        )->name($namePrefix . 'edit');
        //运营商状态开关
        Route::post(
            'switch',
            [PlatformController::class, 'switch'],
        )->name($namePrefix . 'switch');
        //运营商域名列表
        Route::post(
            'domain-detail',
            [PlatformController::class, 'domainDetail'],
        )->name($namePrefix . 'domain-detail');
        //添加运营商域名
        Route::post(
            'domain-add',
            [PlatformController::class, 'domainAdd'],
        )->name($namePrefix . 'domain-add');
        //删除已分配的游戏
        Route::post(
            'assigned-game-cancel',
            [PlatformController::class, 'assignedGameCancel'],
        )->name($namePrefix . 'assigned-game-cancel');
        //分配游戏
        Route::post(
            'assign-games',
            [PlatformController::class, 'assignGames'],
        )->name($namePrefix . 'assign-games');
        //已分配的游戏
        Route::get(
            'assigned-games',
            [PlatformController::class, 'assignedGames'],
        )->name($namePrefix . 'assigned-games');
        //未分配的游戏
        Route::get(
            'unassign-games',
            [PlatformController::class, 'unassignGames'],
        )->name($namePrefix . 'unassign-games');
        //获取分配游戏接口的查询条件
        Route::get(
            'get-search-data-of-assign-game',
            [PlatformController::class, 'getSearchDataOfAssignGame'],
        )->name($namePrefix . 'get-search-data-of-assign-game');
    },
);
