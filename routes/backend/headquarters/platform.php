<?php

use App\Http\Controllers\BackendApi\Headquarters\Merchant\PlatformController;

//运营商管理
Route::group(
    ['prefix' => 'platform', 'namespace' => 'Merchant'],
    static function (): void {
        $namePrefix = 'headquarters-api.platform.';
        //运营商列表
        Route::match(
            ['get', 'options'],
            'detail',
            [PlatformController::class, 'detail'],
        )->name($namePrefix . 'detail');
        //添加运营商
        Route::match(
            ['post', 'options'],
            'do-add',
            [PlatformController::class, 'doAdd'],
        )->name($namePrefix . 'do-add');
        //运营商站点配置（编辑）
        Route::match(
            ['post', 'options'],
            'edit',
            [PlatformController::class, 'edit'],
        )->name($namePrefix . 'edit');
        //运营商状态开关
        Route::match(
            ['post', 'options'],
            'switch',
            [PlatformController::class, 'switch'],
        )->name($namePrefix . 'switch');
        //运营商域名列表
        Route::match(
            ['post', 'options'],
            'domain-detail',
            [PlatformController::class, 'domainDetail'],
        )->name($namePrefix . 'domain-detail');
        //添加运营商域名
        Route::match(
            ['post', 'options'],
            'domain-add',
            [PlatformController::class, 'domainAdd'],
        )->name($namePrefix . 'domain-add');
        //删除已分配的游戏
        Route::match(
            ['post', 'options'],
            'assigned-game-cancel',
            [PlatformController::class, 'assignedGameCancel'],
        )->name($namePrefix . 'assigned-game-cancel');
        //分配游戏
        Route::match(
            ['post', 'options'],
            'assign-games',
            [PlatformController::class, 'assignGames'],
        )->name($namePrefix . 'assign-games');
        //已分配的游戏
        Route::match(
            ['get', 'options'],
            'assigned-games',
            [PlatformController::class, 'assignedGames'],
        )->name($namePrefix . 'assigned-games');
        //未分配的游戏
        Route::match(
            ['get', 'options'],
            'unassign-games',
            [PlatformController::class, 'unassignGames'],
        )->name($namePrefix . 'unassign-games');
        //获取分配游戏接口的查询条件
        Route::match(
            ['get', 'options'],
            'get-search-data-of-assign-game',
            [PlatformController::class, 'getSearchDataOfAssignGame'],
        )->name($namePrefix . 'get-search-data-of-assign-game');
    },
);
