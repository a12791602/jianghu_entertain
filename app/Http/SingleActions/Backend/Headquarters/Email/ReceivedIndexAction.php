<?php

namespace App\Http\SingleActions\Backend\Headquarters\Email;

use App\ModelFilters\Email\SystemEmailOfHeadFilter;
use App\Models\Email\SystemEmailOfHead;
use Illuminate\Http\JsonResponse;

/**
 * Class ReceivedIndexAction
 * @package App\Http\SingleActions\Backend\Headquarters\Email
 */
class ReceivedIndexAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $pageSize = SystemEmailOfHead::getPageSize();
        $datas    = SystemEmailOfHead::with('email.platform:sign,name')
            ->filter($inputDatas, SystemEmailOfHeadFilter::class)
            ->orderByDesc('created_at')
            ->paginate($pageSize);
        $msgOut   = msgOut($datas);
        return $msgOut;
    }
}
