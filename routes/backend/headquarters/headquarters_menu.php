<?php

/**
 * Created by PhpStorm.
 * author: Harris
 * Date: 4/11/2019
 * Time: 12:24 PM
 */

use App\Http\Controllers\BackendApi\Headquarters\DeveloperUsage\Backend\MenuController;

//菜单相关
Route::group(
    ['prefix' => 'menu'],
    static function (): void {
        $namePrefix = 'headquarters-api.menu.';
        //获取商户用户的所有菜单
        Route::get(
            'get-all-menu',
            [
             MenuController::class,
             'getAllMenu',
            ],
        )->name($namePrefix . 'get-all-menu');
        //获取当前商户用户的菜单
        Route::get(
            'current-admin-menu',
            [
             MenuController::class,
             'currentAdminMenu',
            ],
        )->name($namePrefix . 'current-admin-menu');
        //所有菜单需要参数 【父级，路由名，可编辑菜单信息】
        Route::post(
            '/',
            [
             MenuController::class,
             'allRequireInfos',
            ],
        )->name($namePrefix . 'all-require-infos');
        Route::post(
            '/change-parent',
            [
             MenuController::class,
             'changeParent',
            ],
        )->name($namePrefix . 'change-parent');
        Route::post(
            '/add',
            [
             MenuController::class,
             'doAdd',
            ],
        )->name($namePrefix . 'add');
        Route::post(
            '/edit',
            [
             MenuController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit');
        Route::post(
            '/delete',
            [
             MenuController::class,
             'delete',
            ],
        )->name($namePrefix . 'delete');
    },
);
