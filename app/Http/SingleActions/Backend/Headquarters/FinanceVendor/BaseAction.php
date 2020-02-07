<?php

namespace App\Http\SingleActions\Backend\Headquarters\FinanceVendor;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceVendor;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\FinanceVendor
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemFinanceVendor
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param SystemFinanceVendor $systemFinanceVendor SystemFinanceVendor.
     */
    public function __construct(SystemFinanceVendor $systemFinanceVendor)
    {
        $this->model = $systemFinanceVendor;
    }
}
