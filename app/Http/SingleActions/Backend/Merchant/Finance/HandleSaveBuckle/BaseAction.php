<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceHandleSaveBuckleRecord;
use Illuminate\Http\Request;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemFinanceHandleSaveBuckleRecord $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     * @param SystemFinanceHandleSaveBuckleRecord $systemFinanceHandleSaveBuckleRecord 模型.
     * @param Request                             $request                             请求.
     */
    public function __construct(
        SystemFinanceHandleSaveBuckleRecord $systemFinanceHandleSaveBuckleRecord,
        Request $request
    ) {
        parent::__construct($request);
        $this->model = $systemFinanceHandleSaveBuckleRecord;
    }
}
