<?php

namespace App\Http\SingleActions\Backend\Headquarters\Email;

use App\Events\SystemEmailEvent;
use App\Models\Admin\MerchantAdminUser;
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
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['receiver_ids'] = MerchantAdminUser::whereIn('email', $inputDatas['receivers'])
            ->get()->pluck('id')->toJson();
        $inputDatas['type']         = SystemEmail::TYPE_HEAD_TO_MER;
        $inputDatas['sender_id']    = $this->currentAdmin->id;
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
