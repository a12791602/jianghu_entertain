<?php

namespace App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceChannel;
use Illuminate\Http\Request;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemFinanceChannel $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param Request              $request              Request.
     * @param SystemFinanceChannel $systemFinanceChannel SystemFinanceChannel.
     */
    public function __construct(
        Request $request,
        SystemFinanceChannel $systemFinanceChannel
    ) {
        parent::__construct($request);
        $this->model = $systemFinanceChannel;
    }
}
