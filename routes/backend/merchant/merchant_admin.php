<?php

use App\Http\Controllers\BackendApi\Merchant\MerchantAuthController;
use App\Http\Controllers\BackendApi\Merchant\Setting\AdminController;

//登录
Route::post('login', [MerchantAuthController::class, 'login'])
    ->name('merchant-api.login');
//退出登录
Route::get('logout', [MerchantAuthController::class, 'logout'])
    ->name('merchant-api.logout');

//管理员角色相关
Route::group(
    ['prefix' => 'merchant-admin-group'],
    static function (): void {
        $namePrefix = 'merchant-api.merchant-admin-group.';
        //添加管理员角色
        Route::post('create', [AdminController::class, 'groupCreate'])
            ->name($namePrefix . 'create');
        //获取管理员角色
        Route::get('detail', [AdminController::class, 'groupIndex'])
            ->name($namePrefix . 'detail');
        //编辑管理员角色
        Route::post('edit', [AdminController::class, 'edit'])
            ->name($namePrefix . 'edit');
        //删除管理员角色
        Route::post('delete', [AdminController::class, 'destroy'])
            ->name($namePrefix . 'delete');
        //获取管理员角色
        Route::post(
            'specific-group-users',
            [
             AdminController::class,
             'specificGroupUsers',
            ],
        )->name($namePrefix . 'specific-group-users');
    },
);

//管理员相关
Route::group(
    ['prefix' => 'merchant-admin-user'],
    static function (): void {
        $namePrefix = 'merchant-api.merchant-admin-user.';
        //创建管理员
        Route::post(
            'create',
            [
             AdminController::class,
             'create',
            ],
        )->name($namePrefix . 'create');
        //获取所有管理员
        Route::get(
            'get-all-admins',
            [
             AdminController::class,
             'allAdmins',
            ],
        )->name($namePrefix . 'get-all-admins');
        //修改管理员所属组
        Route::post(
            'update-admin-group',
            [
             AdminController::class,
             'updateAdminGroup',
            ],
        )->name($namePrefix . 'update-admin-group');
        //删除管理员
        Route::post(
            'delete-admin',
            [
             AdminController::class,
             'deleteAdmin',
            ],
        )->name($namePrefix . 'delete-admin');
        //查找管理员
        Route::post(
            'search-admin',
            [
             AdminController::class,
             'searchAdmin',
            ],
        )->name($namePrefix . 'search-admin');
        //管理员开关
        Route::post(
            'switch-admin',
            [
             AdminController::class,
             'switchAdmin',
            ],
        )->name($namePrefix . 'switch-admin');
    },
);
