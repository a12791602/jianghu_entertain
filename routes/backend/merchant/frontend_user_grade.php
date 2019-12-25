<?php

use App\Http\Controllers\BackendApi\Merchant\User\UserGradeController;

//会员等级
Route::group(
    ['prefix' => 'user-grade'],
    static function (): void {
        $namePrefix = 'merchant-api.user-grade.';
        //会员等级-配置
        Route::match(
            ['post', 'options'],
            'config',
            [UserGradeController::class, 'gradeConfig'],
        )->name($namePrefix . 'config');
        //会员等级-列表
        Route::match(
            ['get', 'options'],
            'index',
            [UserGradeController::class, 'index'],
        )->name($namePrefix . 'index');
        //会员等级-添加
        Route::match(
            ['post', 'options'],
            'do-add',
            [UserGradeController::class, 'doAdd'],
        )->name($namePrefix . 'do-add');
        //会员等级-编辑
        Route::match(
            ['post', 'options'],
            'edit',
            [UserGradeController::class, 'edit'],
        )->name($namePrefix . 'config');
        //会员等级-删除
        Route::match(
            ['post', 'options'],
            'delete',
            [UserGradeController::class, 'delete'],
        )->name($namePrefix . 'delete');
    },
);
