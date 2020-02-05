<?php

namespace App\Http\SingleActions\Backend\Merchant\Bank;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemPlatformBank;
use Illuminate\Http\Request;

/**
 * Class MainAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Carousel
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemPlatformBank $model
     */
    public $model;

    /**
     * MainAction constructor.
     * @param SystemPlatformBank $systemPlatformBank SystemPlatformBank.
     * @param Request            $request            Request.
     * @throws \Exception Exception.
     */
    public function __construct(SystemPlatformBank $systemPlatformBank, Request $request)
    {
        parent::__construct($request);
        $this->model = $systemPlatformBank;
    }
}
