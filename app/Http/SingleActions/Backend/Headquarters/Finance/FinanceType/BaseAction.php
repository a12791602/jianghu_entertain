<?php

namespace App\Http\SingleActions\Backend\Headquarters\Finance\FinanceType;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceType;
use Illuminate\Http\Request;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Finance\FinanceType
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
     * @param Request           $request           Request.
     * @param SystemFinanceType $systemFinanceType SystemFinanceType.
     */
    public function __construct(
        Request $request,
        SystemFinanceType $systemFinanceType
    ) {
        parent::__construct($request);
        $this->model = $systemFinanceType;
    }
}
