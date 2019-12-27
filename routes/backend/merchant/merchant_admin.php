<?php

use App\Http\Controllers\BackendApi\Merchant\Admin\MerchantAdminUserController;
use App\Http\Controllers\BackendApi\Merchant\MerchantAuthController;

//登录
Route::post('login', [MerchantAuthController::class, 'login'])
    ->name('merchant-api.login');
//退出登录
Route::get('logout', [MerchantAuthController::class, 'logout'])
    ->name('merchant-api.logout');
//管理员相关
Route::group(
    ['prefix' => 'merchant-admin-user'],
    static function (): void {
        $namePrefix = 'merchant-api.merchant-admin-user.';
        Route::post('create', [MerchantAdminUserController::class, 'create'])
            ->name($namePrefix . 'create');
        Route::get('get-all-admins', [MerchantAdminUserController::class, 'allAdmins'])
            ->name($namePrefix . 'get-all-admins');
        Route::post(
            'update-admin-group',
            [MerchantAdminUserController::class, 'updateAdminGroup'],
        )->name($namePrefix . 'update-admin-group');
        Route::post(
            'delete-admin',
            [MerchantAdminUserController::class, 'deletePartnerAdmin'],
        )->name($namePrefix . 'delete-admin');
        Route::post('search-admin', [MerchantAdminUserController::class, 'searchAdmin'])
            ->name($namePrefix . 'search-admin');
    },
);
