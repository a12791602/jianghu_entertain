<?php

namespace App\Http\SingleActions\Backend\Merchant\Email;

use App\Http\Resources\Backend\Merchant\Email\IndexResource;
use App\ModelFilters\Email\SystemEmailSendFilter;
use App\Models\Email\SystemEmailSend;
use Illuminate\Http\JsonResponse;

/**
 * Class SendIndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Email
 */
class SendIndexAction extends BaseAction
{

    /**
     * @var object $model
     */
    protected $model;

    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $pageSize                    = SystemEmailSend::getPageSize();
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;

        $item = SystemEmailSend::with('email')->where(['sender_id' => $this->user->id])
            ->filter($inputDatas, SystemEmailSendFilter::class)
            ->orderByDesc('created_at')->paginate($pageSize);
        return msgOut(IndexResource::collection($item));
    }
}
