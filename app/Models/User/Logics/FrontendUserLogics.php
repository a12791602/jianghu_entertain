<?php

namespace App\Models\User\Logics;

trait FrontendUserLogics
{
    /**
     * 获取当前用户下级的rid
     * @return string
     */
    public function getRid(): string
    {
        return $this->id . ',' . $this->rid;
    }
}
