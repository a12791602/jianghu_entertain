<?php

use App\Http\Controllers\BackendApi\Merchant\User\UsersTagController;

//标签管理
Route::group(
    ['prefix' => 'user-tags'],
    static function (): void {
        $namePrefix = 'merchant-api.user-tags.';
        //会员标签列表
        Route::post(
            'index',
            [
             UsersTagController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //添加会员标签
        Route::post(
            'do-add',
            [
             UsersTagController::class,
             'doAdd',
            ],
        )->name($namePrefix . 'do-add');
        //编辑会员标签
        Route::post(
            'edit',
            [
             UsersTagController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit');
        //删除会员标签
        Route::post(
            'delete',
            [
             UsersTagController::class,
             'delete',
            ],
        )->name($namePrefix . 'delete');
    },
);
