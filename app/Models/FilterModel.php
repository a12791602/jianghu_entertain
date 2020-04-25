<?php

namespace App\Models;

/**
 * Class BaseModel
 * @package App\Models
 */
class FilterModel extends BaseModel
{

    /**
     * @return string
     */
    public function modelFilter(): string
    {
        return getFilter($this);
    }
}
