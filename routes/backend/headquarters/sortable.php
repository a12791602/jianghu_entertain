<?php

use App\Http\Controllers\CommonApi\SortableController;

// 更新模型的排序
Route::group(
    ['prefix' => 'sortable'],
    static function (): void {
        $namePrefix = 'headquarters-api.sortable.';
        Route::post('update-sortable', [SortableController::class, 'updateSortable'])
            ->name($namePrefix . 'update-sortable');
    },
);
