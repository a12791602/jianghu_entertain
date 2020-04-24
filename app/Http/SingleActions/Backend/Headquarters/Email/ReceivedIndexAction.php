<?php

namespace App\Http\SingleActions\Backend\Headquarters\Email;

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
        $datas = $systemEmailOfHead->filter($inputDatas)
            ->with(
                [
                 'email.platform:sign,en_name,cn_name',
                 'email.merchant:id,email',
                ],
            )
            ->orderByDesc('created_at')
            ->paginate();
        return msgOut($datas);
    }
}
