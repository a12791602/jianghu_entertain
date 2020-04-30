<?php

use App\Http\Controllers\BackendApi\Headquarters\DeveloperUsage\ScheduleController;

//定时任务
Route::group(
    ['prefix' => 'schedule'],
    static function (): void {
        $namePrefix = 'headquarters-api.schedule.';
        //定时任务-列表
        Route::post(
            'index',
            [
             ScheduleController::class,
             'index',
            ],
        )->name($namePrefix . 'index');
        //定时任务-添加
        Route::post(
            'do-add',
            [
             ScheduleController::class,
             'doAdd',
            ],
        )->name($namePrefix . 'do-add');
        //定时任务-编辑
        Route::post(
            'edit',
            [
             ScheduleController::class,
             'edit',
            ],
        )->name($namePrefix . 'edit');
        //定时任务-删除
        Route::post(
            'delete',
            [
             ScheduleController::class,
             'delete',
            ],
        )->name($namePrefix . 'delete');
    },
);
