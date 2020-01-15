<?php

use App\Http\Controllers\BackendApi\Merchant\Admin\MerchantAdminGroupController;

//管理员角色相关
Route::group(
    ['prefix' => 'merchant-admin-group'],
    static function (): void {
        $namePrefix = 'merchant-api.merchant-admin-group.';
        //添加管理员角色
        Route::post('create', [MerchantAdminGroupController::class, 'create'])
            ->name($namePrefix . 'create');
        //获取管理员角色
        Route::get('detail', [MerchantAdminGroupController::class, 'index'])
            ->name($namePrefix . 'detail');
        //编辑管理员角色
        Route::post('edit', [MerchantAdminGroupController::class, 'edit'])
            ->name($namePrefix . 'edit');
        //删除管理员角色
        Route::post('delete', [MerchantAdminGroupController::class, 'destroy'])
            ->name($namePrefix . 'delete');
        //获取管理员角色
        Route::post(
            'specific-group-users',
            [
             MerchantAdminGroupController::class,
             'specificGroupUsers',
            ],
        )->name($namePrefix . 'specific-group-users');
    },
);
