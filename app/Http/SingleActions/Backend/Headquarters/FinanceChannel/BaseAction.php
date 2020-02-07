<?php

namespace App\Http\SingleActions\Backend\Headquarters\FinanceChannel;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceChannel;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\FinanceChannel
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
     * @param SystemFinanceChannel $systemFinanceChannel SystemFinanceChannel.
     */
    public function __construct(SystemFinanceChannel $systemFinanceChannel)
    {
        $this->model = $systemFinanceChannel;
    }
}
