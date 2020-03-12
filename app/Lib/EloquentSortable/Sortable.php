<?php

namespace App\Lib\EloquentSortable;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface Sortable
 * @package App\Lib\EloquentSortable
 */
interface Sortable
{
    /**
     * Modify the order column value.
     * @return void
     */
    public function setHighestOrderNumber(): void;

    /**
     * Let's be nice and provide an ordered scope.
     * @param \Illuminate\Database\Eloquent\Builder $query Builder.
     * @return Builder
     */
    public function scopeOrdered(Builder $query): Builder;
}
