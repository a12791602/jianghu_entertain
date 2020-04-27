<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\OperationLog;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemLogsMerchant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 操作日志-列表
 */
class IndexAction extends MainAction
{

    /**
     * Comment
     * @var SystemLogsMerchant
     */
    protected $model;

    /**
     * @param Request            $request            Request.
     * @param SystemLogsMerchant $systemLogsMerchant 后台操作日志.
     */
    public function __construct(
        Request $request,
        SystemLogsMerchant $systemLogsMerchant
    ) {
        parent::__construct($request);
        $this->model = $systemLogsMerchant;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $data = backendOperationLog($this->model, $inputDatas);
        return msgOut($data);
    }
}
