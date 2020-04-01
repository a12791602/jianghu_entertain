<?php

namespace App\Http\SingleActions\Backend\Merchant\Email;

use App\Models\Email\SystemEmailSend;
use Illuminate\Http\JsonResponse;
use Log;

/**
 * Class DestroySentMailAction
 * @package App\Http\SingleActions\Backend\Merchant\Email
 */
class DestroySentEmailAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        try {
            SystemEmailSend::where('sender_id', $this->user->id)
                ->whereIn('email_id', $inputDatas['email_id'])->delete();
            return msgOut();
        } catch (\RuntimeException $exception) {
            Log::error($exception->getMessage());
        }
        throw new \RuntimeException('303003');
    }
}
