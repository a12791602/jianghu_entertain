<?php

use App\Http\Controllers\BackendApi\Headquarters\DeveloperUsage\BackendSystemBankController;
use App\Http\Controllers\BackendApi\Headquarters\Finance\BackendFinanceChannelController;
use App\Http\Controllers\BackendApi\Headquarters\Finance\BackendFinanceTypeController;
use App\Http\Controllers\BackendApi\Headquarters\Finance\BackendFinanceVendorController;

//金融分类管理
Route::group(
    ['prefix' => 'finance-type'],
    static function (): void {
        $namePrefix = 'headquarters-api.finance-type.';
        Route::post('add-do', [BackendFinanceTypeController::class, 'addDo'])
            ->name($namePrefix . 'add-do');
        Route::post('edit-do', [BackendFinanceTypeController::class, 'editDo'])
            ->name($namePrefix . 'edit-do');
        Route::get('index-do', [BackendFinanceTypeController::class, 'indexDo'])
            ->name($namePrefix . 'index-do');
        Route::get('opt-index-do', [BackendFinanceTypeController::class, 'indexDo'])
            ->name($namePrefix . 'opt-index-do');
        Route::post('del-do', [BackendFinanceTypeController::class, 'delDo'])
            ->name($namePrefix . 'del-do');
        Route::post('status-do', [BackendFinanceTypeController::class, 'statusDo'])
            ->name($namePrefix . 'status-do');
        Route::post('opt-status-do', [BackendFinanceTypeController::class, 'statusDo'])
            ->name($namePrefix . 'opt-status-do');
    },
);

//金融厂商管理
Route::group(
    ['prefix' => 'finance-vendor'],
    static function (): void {
        $namePrefix = 'headquarters-api.finance-vendor.';
        Route::post('add-do', [BackendFinanceVendorController::class, 'addDo'])
            ->name($namePrefix . 'add-do');
        Route::post('edit-do', [BackendFinanceVendorController::class, 'editDo'])
            ->name($namePrefix . 'edit-do');
        Route::get('index-do', [BackendFinanceVendorController::class, 'indexDo'])
            ->name($namePrefix . 'index-do');
        Route::get('opt-index-do', [BackendFinanceVendorController::class, 'indexDo'])
            ->name($namePrefix . 'opt-index-do');
        Route::post('del-do', [BackendFinanceVendorController::class, 'delDo'])
            ->name($namePrefix . 'del-do');
        Route::post('status-do', [BackendFinanceVendorController::class, 'statusDo'])
            ->name($namePrefix . 'status-do');
        Route::post('opt-status-do', [BackendFinanceVendorController::class, 'statusDo'])
            ->name($namePrefix . 'opt-status-do');
    },
);

//金融通道管理
Route::group(
    ['prefix' => 'finance-channel'],
    static function (): void {
        $namePrefix = 'headquarters-api.finance-channel.';
        Route::post('add-do', [BackendFinanceChannelController::class, 'addDo'])
            ->name($namePrefix . 'add-do');
        Route::post('edit-do', [BackendFinanceChannelController::class, 'editDo'])
            ->name($namePrefix . 'edit-do');
        Route::post('opt-edit-do', [BackendFinanceChannelController::class, 'optEditDo'])
            ->name($namePrefix . 'opt-edit-do');
        Route::get('index-do', [BackendFinanceChannelController::class, 'indexDo'])
            ->name($namePrefix . 'index-do');
        Route::get('opt-index-do', [BackendFinanceChannelController::class, 'indexDo'])
            ->name($namePrefix . 'opt-index-do');
        Route::post('del-do', [BackendFinanceChannelController::class, 'delDo'])
            ->name($namePrefix . 'del-do');
        Route::get(
            'get-search-condition',
            [
             BackendFinanceChannelController::class,
             'getSearchCondition',
            ],
        )->name($namePrefix . 'get-search-condition');
        Route::post('status-do', [BackendFinanceChannelController::class, 'statusDo'])
            ->name($namePrefix . 'status-do');
        Route::post('opt-status-do', [BackendFinanceChannelController::class, 'statusDo'])
            ->name($namePrefix . 'opt-status-do');
        Route::post('edit-detail', [BackendFinanceChannelController::class, 'editDetail'])
            ->name($namePrefix . 'edit-detail');
    },
);

//系统银行卡管理
Route::group(
    ['prefix' => 'bank'],
    static function (): void {
        $namePrefix = 'headquarters-api.bank.';
        Route::post('add-do', [BackendSystemBankController::class, 'addDo'])
            ->name($namePrefix . 'add-do');
        Route::post('edit-do', [BackendSystemBankController::class, 'edit'])
            ->name($namePrefix . 'edit-do');
        Route::get('index-do', [BackendSystemBankController::class, 'index'])
            ->name($namePrefix . 'index-do');
        Route::get('opt-index-do', [BackendSystemBankController::class, 'index'])
            ->name($namePrefix . 'opt-index-do');
        Route::post('del-do', [BackendSystemBankController::class, 'delDo'])
            ->name($namePrefix . 'del-do');
        Route::post('status-do', [BackendSystemBankController::class, 'status'])
            ->name($namePrefix . 'status-do');
        Route::post('opt-status-do', [BackendSystemBankController::class, 'status'])
            ->name($namePrefix . 'opt-status-do');
    },
);
