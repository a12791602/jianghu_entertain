<?php

namespace App\Models\Logics;

use DateTimeInterface;

trait BaseModelLogics
{

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  DateTimeInterface $date DateTimeInterface.
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        $date = $date->format('Y-m-d H:i:s');
        return $date;
    }

    /**
     * @return string
     */
    public function modelFilter(): string
    {
        $modelPath = static::class;
        $needle    = 'Models';
        $filter    = substr_replace(
            $modelPath,
            'ModelFilters',
            strpos($modelPath, $needle),
            strlen($needle),
        ) . 'Filter';
        if (!class_exists($filter)) {
            $filter = 'App\ModelFilters\DefaultFilter';
        }
        return $filter;
    }
}
