<?php

namespace App\Http\SingleActions\Backend\Headquarters\SystemBank;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemBank;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\SystemBank
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemBank $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param SystemBank $systemBank SystemBank.
     */
    public function __construct(SystemBank $systemBank)
    {
        $this->model = $systemBank;
    }
}
