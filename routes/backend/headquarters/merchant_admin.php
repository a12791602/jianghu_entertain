<?php

use App\Http\Controllers\BackendApi\Merchant\Admin\MerchantAdminUserController;

//管理员相关
Route::group(
    ['prefix' => 'merchant-admin-user', 'namespace' => 'Admin'],
    static function (): void {
        $namePrefix = 'headquarters-api.merchant-admin-user.';
        Route::match(
            ['post', 'options'],
            'create',
            [MerchantAdminUserController::class, 'create'],
        )->name($namePrefix . 'create');
        Route::match(
            ['get', 'options'],
            'get-all-admins',
            [MerchantAdminUserController::class, 'allAdmins'],
        )->name($namePrefix . 'get-all-admins');
        Route::match(
            ['post', 'options'],
            'update-admin-group',
            [MerchantAdminUserController::class, 'updateAdminGroup'],
        )->name($namePrefix . 'update-admin-group');
        Route::match(
            ['post', 'options'],
            'delete-admin',
            [MerchantAdminUserController::class, 'deletePartnerAdmin'],
        )->name($namePrefix . 'delete-admin');
        Route::match(
            ['post', 'options'],
            'search-admin',
            [MerchantAdminUserController::class, 'searchAdmin'],
        )->name($namePrefix . 'search-admin');
    },
);
