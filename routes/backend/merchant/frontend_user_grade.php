<?php

use App\Http\Controllers\BackendApi\Merchant\User\UserGradeController;

//会员等级
Route::group(
    ['prefix' => 'user-grade'],
    static function (): void {
        $namePrefix = 'merchant-api.user-grade.';
        //会员等级-配置
        Route::post(
            'config',
            [
             UserGradeController::class,
             'gradeConfig',
            ],
        )->name($namePrefix . 'config');
        //会员等级-列表
        Route::get(
            'index',
            [
             UserGradeController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //会员等级-添加
        Route::post(
            'do-add',
            [
             UserGradeController::class,
             'doAdd',
            ],
        )->name($namePrefix . 'do-add');
        //会员等级-编辑
        Route::post(
            'edit',
            [
             UserGradeController::class,
             'edit',
            ],
        )->name($namePrefix . 'config');
        //会员等级-删除
        Route::post(
            'delete',
            [
             UserGradeController::class,
             'delete',
            ],
        )->name($namePrefix . 'delete');
    },
);
