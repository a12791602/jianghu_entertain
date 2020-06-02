<?php

namespace App\Models\User\Logics;

trait FrontendUserLogics
{
    /**
     * 获取当前用户下级的rid
     * @return mixed[]
     */
    public function getRid(): array
    {
        return array_merge($this->rid, [$this->id]);
    }
}
