<?php

use App\Http\Controllers\CommonApi\SortableController;

// Model sort
Route::group(
    ['prefix' => 'sortable'],
    static function (): void {
        $namePrefix = 'headquarters-api.sortable.';
        Route::post('update', [SortableController::class, 'update'])->name($namePrefix . 'update');
    },
);
