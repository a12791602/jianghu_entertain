<?php

namespace App\Http\SingleActions\Backend\Headquarters\Email;

use App\ModelFilters\Email\SystemEmailOfHeadFilter;
use App\Models\Email\SystemEmailOfHead;
use Illuminate\Http\JsonResponse;

/**
 * Class ReceivedIndexAction
 * @package App\Http\SingleActions\Backend\Headquarters\Email
 */
class ReceivedIndexAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $systemEmailOfHead = new SystemEmailOfHead();
        if (isset($inputDatas['pageSize'])) {
            $systemEmailOfHead->setPerPage($inputDatas['pageSize']);
        }
        $datas = $systemEmailOfHead->filter($inputDatas, SystemEmailOfHeadFilter::class)
            ->with('email.platform:sign,en_name,cn_name')
            ->orderByDesc('created_at')
            ->paginate();
        return msgOut($datas);
    }
}
