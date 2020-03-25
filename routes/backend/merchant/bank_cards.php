<?php

use App\Http\Controllers\BackendApi\Merchant\Setting\BankCardsController;

//银行卡反查
Route::group(
    ['prefix' => 'bank-cards'],
    static function (): void {
        $namePrefix = 'merchant-api.bank-cards.';
        //银行-列表
        Route::get(
            'bank-list',
            [
             BankCardsController::class,
             'bankList',
            ],
        )->name($namePrefix . 'bank-list');
        //会员银行卡-列表
        Route::post(
            'index',
            [
             BankCardsController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //会员银行卡-删除
        Route::post(
            'delete',
            [
             BankCardsController::class,
             'delete',
            ],
        )->name($namePrefix . 'delete');
    },
);
