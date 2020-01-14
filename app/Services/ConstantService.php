<?php

namespace App\Services;

/**
 * Class ConstantService
 * @package App\Services
 */
class ConstantService
{

    /**
     * 私有化 __clone 方法 禁止克隆
     * @return void
     */
    private function __clone()
    {
    }

    //pc端
    public const DEVICE_PC = 1;
    //h5端
    public const DEVICE_H5 = 2;
    //app端
    public const DEVICE_APP = 3;
    //启用状态
    public const STATUS_NORMAL = 1;
    //禁用状态
    public const STATUS_DISABLE = 0;
}
