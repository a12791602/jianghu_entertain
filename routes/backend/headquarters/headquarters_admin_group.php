<?php

/**
 * Created by PhpStorm.
 * author: Harris
 * Date: 4/11/2019
 * Time: 12:25 PM
 */

use App\Http\Controllers\BackendApi\Headquarters\Admin\BackendAdminGroupController;

//管理员角色相关
Route::group(
    ['prefix' => 'backend-admin-group'],
    static function (): void {
        $namePrefix = 'headquarters-api.backend-admin-group.';
        //添加管理员角色
        Route::post('create', [BackendAdminGroupController::class, 'create'])
            ->name($namePrefix . 'create');
        //获取管理员角色
        Route::get('detail', [BackendAdminGroupController::class, 'index'])
            ->name($namePrefix . 'detail');
        //编辑管理员角色
        Route::post('edit', [BackendAdminGroupController::class, 'edit'])
            ->name($namePrefix . 'edit');
        //删除管理员角色
        Route::post(
            'delete-access-group',
            [
            BackendAdminGroupController::class,  'destroy'],
        )->name($namePrefix . 'delete-access-group');
        //获取管理员角色
        Route::post(
            'specific-group-users',
            [BackendAdminGroupController::class, 'specificGroupUsers'],
        )->name($namePrefix . 'specific-group-users');
    },
);
