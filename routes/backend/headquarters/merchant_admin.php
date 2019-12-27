<?php

use App\Http\Controllers\BackendApi\Merchant\Admin\MerchantAdminUserController;

//管理员相关
Route::group(
    ['prefix' => 'merchant-admin-user', 'namespace' => 'Admin'],
    static function (): void {
        $namePrefix = 'headquarters-api.merchant-admin-user.';
        Route::post(
            'create',
            [MerchantAdminUserController::class, 'create'],
        )->name($namePrefix . 'create');
        Route::get(
            'get-all-admins',
            [MerchantAdminUserController::class, 'allAdmins'],
        )->name($namePrefix . 'get-all-admins');
        Route::post(
            'update-admin-group',
            [MerchantAdminUserController::class, 'updateAdminGroup'],
        )->name($namePrefix . 'update-admin-group');
        Route::post(
            'delete-admin',
            [MerchantAdminUserController::class, 'deletePartnerAdmin'],
        )->name($namePrefix . 'delete-admin');
        Route::post(
            'search-admin',
            [MerchantAdminUserController::class, 'searchAdmin'],
        )->name($namePrefix . 'search-admin');
    },
);
