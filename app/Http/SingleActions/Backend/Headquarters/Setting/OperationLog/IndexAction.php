<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\OperationLog;

use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;

/**
 * 操作日志-列表
 */
class IndexAction extends MainAction
{

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $data = backendOperationLog($inputDatas);
        return msgOut($data);
    }
}
