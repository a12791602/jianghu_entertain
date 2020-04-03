<?php

namespace App\Http\SingleActions\Backend\Merchant\Email;

use App\Events\SystemEmailEvent;
use App\Jobs\Email\MerchantSendMail;
use App\Models\Email\SystemEmail;
use App\Models\Email\SystemEmailSend;
use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;

/**
 * Class SendAction
 * @package App\Http\SingleActions\Backend\Merchant\Email
 */
class SendAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if ((int) $inputDatas['is_head'] === 0) {
            $inputDatas['receiver_ids'] = FrontendUser::whereIn('guid', $inputDatas['receivers'])
                ->where('platform_sign', $this->currentPlatformEloq->sign)->get()->pluck('id')->toJson();
            $inputDatas['type']         = SystemEmail::TYPE_MER_TO_USER;
        } elseif ((int) $inputDatas['is_head'] === 1) {
            $inputDatas['type'] = SystemEmail::TYPE_MER_TO_HEAD;
        }
        unset($inputDatas['is_head']);
        $inputDatas['sender_id']     = $this->user->id;
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $send_timestamp              = strtotime($inputDatas['send_time']) - now()->timestamp;
        if ((int) $inputDatas['is_timing'] === SystemEmail::IS_TIMING_YES) {
            $inputDatas['is_send'] = SystemEmail::IS_SEND_NO;
        }
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('303000');
        }
        if ((int) $inputDatas['is_timing'] === SystemEmail::IS_TIMING_NO) {
            SystemEmailSend::create(
                [
                 'email_id'  => $this->model->id,
                 'sender_id' => $this->user->id,
                ],
            );
            event(new SystemEmailEvent($this->model->id));
        } else {
            dispatch(new MerchantSendMail($this->model, (int) $send_timestamp));
        }
        return msgOut();
    }
}
