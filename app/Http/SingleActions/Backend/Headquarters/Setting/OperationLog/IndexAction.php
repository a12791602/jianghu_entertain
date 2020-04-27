<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\OperationLog;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemLogsBackend;
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
        $data = backendOperationLog(new SystemLogsBackend(), $inputDatas);
        return msgOut($data);
    }
}
