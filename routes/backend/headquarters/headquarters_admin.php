<?php

use App\Http\Controllers\BackendApi\Headquarters\BackendAuthController;
use App\Http\Controllers\BackendApi\Headquarters\Setting\AdminController;

//登录
Route::post('login', [BackendAuthController::class, 'login'])
    ->name('headquarters-api.login');
//退出登录
Route::get('logout', [BackendAuthController::class, 'logout'])
    ->name('headquarters-api.logout');

//管理员角色相关
Route::group(
    ['prefix' => 'backend-admin-group'],
    static function (): void {
        $namePrefix = 'headquarters-api.backend-admin-group.';
        //添加管理员角色
        Route::post('create', [AdminController::class, 'groupCreate'])
            ->name($namePrefix . 'create');
        //获取管理员角色
        Route::get('detail', [AdminController::class, 'groupList'])
            ->name($namePrefix . 'detail');
        //编辑管理员角色
        Route::post('edit', [AdminController::class, 'groupEdit'])
            ->name($namePrefix . 'edit');
        //删除管理员角色
        Route::post(
            'delete-access-group',
            [
             AdminController::class,
             'groupDestroy',
            ],
        )->name($namePrefix . 'delete-access-group');
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
    [
     'prefix'    => 'headquarters-admin-user',
     'namespace' => 'Admin',
    ],
    static function (): void {
        //生成管理员
        Route::post(
            'create',
            [
             AdminController::class,
             'create',
            ],
        )->name('headquarters-api.headquarters-admin-user.create');
        //修改管理员的归属组
        Route::post(
            'update-admin-group',
            [
             AdminController::class,
             'updateAdminGroup',
            ],
        )->name('headquarters-api.headquarters-admin-user.update-admin-group');
        //删除管理员
        Route::post(
            'delete-admin',
            [
             AdminController::class,
             'deleteAdmin',
            ],
        )->name('headquarters-api.headquarters-admin-user.delete-admin');
        //修改管理员密码
        Route::post(
            'update-password',
            [
             AdminController::class,
             'updatePassword',
            ],
        )->name('headquarters-api.headquarters-admin-user.update-password');
        //管理员自己修改密码
        Route::post(
            'self-update-password',
            [
             AdminController::class,
             'selfUpdatePassword',
            ],
        )->name('headquarters-api.headquarters-admin-user.self-update-password');
        //模糊查询管理员
        Route::post(
            'search-admin',
            [
             AdminController::class,
             'searchAdmin',
            ],
        )->name('headquarters-api.headquarters-admin-user.search-admin');
        //管理员开关
        Route::post(
            'switch-admin',
            [
             AdminController::class,
             'switchAdmin',
            ],
        )->name('headquarters-api.headquarters-admin-user.switch-admin');
    },
);
