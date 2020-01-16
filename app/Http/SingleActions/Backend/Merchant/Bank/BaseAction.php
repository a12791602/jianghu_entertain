<?php

namespace App\Http\SingleActions\Backend\Merchant\Bank;

use App\Models\Finance\SystemPlatformBank;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Carousel
 */
class BaseAction
{

    /**
     * @var SystemPlatformBank $model
     */
    public $model;

    /**
     * BaseAction constructor.
     * @param SystemPlatformBank $systemPlatformBank SystemPlatformBank.
     */
    public function __construct(SystemPlatformBank $systemPlatformBank)
    {
        $this->model = $systemPlatformBank;
    }
}
