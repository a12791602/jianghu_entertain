<?php

use App\Http\Controllers\BackendApi\Merchant\User\FrontendUserController;

//会员列表
Route::group(
    ['prefix' => 'frontend-user'],
    static function (): void {
        $namePrefix = 'merchant-api.frontend-user.';
        //会员列表查询
        Route::post(
            'index',
            [
             FrontendUserController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //会员添加
        Route::post(
            'store',
            [
             FrontendUserController::class,
             'store',
            ],
        )->name($namePrefix . 'store');
        //会员详情
        Route::post(
            'detail',
            [
             FrontendUserController::class,
             'detail',
            ],
        )->name($namePrefix . 'detail');
        //加入黑名单
        Route::post(
            'black',
            [
             FrontendUserController::class,
             'black',
            ],
        )->name($namePrefix . 'black');
        //会员重置密码
        Route::post(
            'password/reset',
            [
             FrontendUserController::class,
             'password',
            ],
        )->name($namePrefix . 'password.reset');
        //修改会员标签
        Route::post(
            'label',
            [
             FrontendUserController::class,
             'label',
            ],
        )->name($namePrefix . 'label');
        //会员重置取款密码
        Route::post(
            'withdrawals-password/reset',
            [
             FrontendUserController::class,
             'withdrawalsPassword',
            ],
        )->name($namePrefix . 'withdrawals-password.reset');
        //会员清空支付宝
        Route::post(
            'alipay/destroy',
            [
             FrontendUserController::class,
             'alipayDestroy',
            ],
        )->name($namePrefix . 'alipay.destroy');
        //会员解锁
        Route::post(
            'unlock',
            [
             FrontendUserController::class,
             'unlock',
            ],
        )->name($namePrefix . 'unlock');
        //会员登陆记录
        Route::post(
            'login-log',
            [
             FrontendUserController::class,
             'loginLog',
            ],
        )->name($namePrefix . 'login-log');
    },
);
