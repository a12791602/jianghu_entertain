<?php

namespace App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel;

use App\Models\Systems\SystemLogsBackend;
use Illuminate\Http\JsonResponse;

/**
 * Class EditDetailAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel
 */
class EditDetailAction extends BaseAction
{

    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['route_name'] = [
                                     'headquarters-api.finance-channel.edit-do',
                                     'headquarters-api.finance-channel.status-do',
                                    ];
        $data                     = backendOperationLog(new SystemLogsBackend(), $inputDatas);
        return msgOut($data);
    }
}
