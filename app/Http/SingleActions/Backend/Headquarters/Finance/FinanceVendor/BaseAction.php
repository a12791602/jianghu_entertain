<?php

namespace App\Http\SingleActions\Backend\Headquarters\Finance\FinanceVendor;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceVendor;
use Illuminate\Http\Request;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Finance\FinanceVendor
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
     * @param Request             $request             Request.
     * @param SystemFinanceVendor $systemFinanceVendor SystemFinanceVendor.
     */
    public function __construct(
        Request $request,
        SystemFinanceVendor $systemFinanceVendor
    ) {
        parent::__construct($request);
        $this->model = $systemFinanceVendor;
    }
}
