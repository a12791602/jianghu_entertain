<?php

namespace App\Http\SingleActions\Backend\Headquarters\Email;

use App\Events\SystemEmailEvent;
use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Email\SystemEmail;
use Illuminate\Http\JsonResponse;

/**
 * Class SendAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Email
 */
class SendAction extends BaseAction
{
    /**
     * @param  BackEndApiMainController $contll     Contll.
     * @param  array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $receivers                   = $inputDatas['receivers'];
        $inputDatas['receivers']     = json_encode($inputDatas['receivers']);
        $inputDatas['sender_type']   = SystemEmail::SENDER_TYPE_HEADQUARTERS;
        $inputDatas['sender_id']     = $contll->currentAdmin->id;
        $inputDatas['platform_sign'] = '';
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('303000');
        }
        if ((int) $inputDatas['is_timing'] === SystemEmail::IS_TIMING_NO) {
            event(
                new SystemEmailEvent(
                    $this->model->id,
                    $inputDatas['receiver_type'],
                    $receivers,
                ),
            );
        }
        $msgOut = msgOut(true);
        return $msgOut;
    }
}
