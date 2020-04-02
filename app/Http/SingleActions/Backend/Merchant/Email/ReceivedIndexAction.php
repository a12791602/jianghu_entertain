<?php

namespace App\Http\SingleActions\Backend\Merchant\Email;

use App\ModelFilters\Email\SystemEmailOfMerchantFilter;
use App\Models\Email\SystemEmailOfMerchant;
use Illuminate\Http\JsonResponse;

/**
 * Class ReceivedIndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Email
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
        $systemEmailOfMerchant = new SystemEmailOfMerchant();
        if (isset($inputDatas['pageSize'])) {
            $systemEmailOfMerchant->setPerPage($inputDatas['pageSize']);
        }
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $emails                      = $systemEmailOfMerchant
            ->select(
                [
                 'id',
                 'email_id',
                 'merchant_id',
                 'is_read',
                 'created_at',
                ],
            )
            ->filter($inputDatas, SystemEmailOfMerchantFilter::class)
            ->with('email.headquarters')
            ->orderByDesc('created_at')
            ->paginate()
            ->toArray();

        $datas = [];
        foreach ($emails['data'] as $item) {
            $datas[] = [
                        'id'         => $item['id'],
                        'is_read'    => $item['is_read'],
                        'created_at' => $item['created_at'],
                        'title'      => $item['email->title'] ?? '',
                        'content'    => $item['email']['content'] ?? '',
                        'sender'     => $item['email']['headquarters']['name'] ?? '',
                       ];
        }

        $emails['data'] = $datas;
        return msgOut($emails);
    }
}
