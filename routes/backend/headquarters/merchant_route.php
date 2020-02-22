<?php

use App\Http\Controllers\BackendApi\Headquarters\DeveloperUsage\Merchant\RouteController;

//代理后台路由相关
Route::group(
    ['prefix' => 'merchant-route'],
    static function (): void {
        $namePrefix = 'headquarters-api.merchant-route.';
        //路由-列表
        Route::get(
            'index',
            [
             RouteController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //路由-添加
        Route::post(
            'do-add',
            [
             RouteController::class,
             'doAdd',
            ],
        )->name($namePrefix . 'do-add');
        //路由-编辑
        Route::post(
            'edit',
            [
             RouteController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit');
        //路由-删除
        Route::post(
            'delete',
            [
             RouteController::class,
             'delete',
            ],
        )->name($namePrefix . 'delete');
        //路由-是否开放
        Route::post(
            'is-open',
            [
             RouteController::class,
             'isOpen',
            ],
        )->name($namePrefix . 'is-open');
    },
);
