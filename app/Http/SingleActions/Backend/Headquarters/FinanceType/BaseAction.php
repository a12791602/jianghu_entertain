<?php

namespace App\Http\SingleActions\Backend\Headquarters\FinanceType;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceType;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\FinanceType
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemFinanceType
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param SystemFinanceType $systemFinanceType SystemFinanceType.
     */
    public function __construct(SystemFinanceType $systemFinanceType)
    {
        $this->model = $systemFinanceType;
    }
}
