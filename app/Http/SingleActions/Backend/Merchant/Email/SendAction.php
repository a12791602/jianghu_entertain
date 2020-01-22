<?php

namespace App\Http\SingleActions\Backend\Merchant\Email;

use App\Events\SystemEmailEvent;
use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Email\SystemEmail;
use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;

/**
 * Class SendAction
 * @package App\Http\SingleActions\Backend\Merchant\Email
 */
class SendAction extends BaseAction
{
    /**
     * @param BackEndApiMainController $contll     Contll.
     * @param array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        if ((int) $inputDatas['is_head'] === 0) {
            $inputDatas['receiver_ids'] = FrontendUser::whereIn('uid', $inputDatas['receivers'])
                ->where('platform_sign', $contll->currentPlatformEloq->sign)->get()->pluck('id')->toJson();
            $inputDatas['type']         = SystemEmail::TYPE_MER_TO_USER;
        } elseif ((int) $inputDatas['is_head'] === 1) {
            $inputDatas['type'] = SystemEmail::TYPE_MER_TO_HEAD;
        }
        unset($inputDatas['is_head']);
        $inputDatas['sender_id']     = $contll->currentAdmin->id;
        $inputDatas['platform_sign'] = $contll->currentPlatformEloq->sign;
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('303000');
        }
        if ((int) $inputDatas['is_timing'] === SystemEmail::IS_TIMING_NO) {
            event(new SystemEmailEvent($this->model->id));
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
