<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\System;

use App\Events\AnnouncementEvent;
use App\Lib\Constant\JHHYCnst;
use Arr;
use Illuminate\Http\JsonResponse;

/**
 * Class AddDoAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\System
 */
class AddDoAction extends BaseAction
{
    /**
     * ***
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $inputData['author_id']   = $this->user->id;
        $inputData['platform_id'] = $this->currentPlatformEloq->id;
        $inputData['device']      = $this->model->getDevice($inputData);
        $this->model->fill($inputData);
        $result = $this->model->save();
        if ($result) {
            $broadcast_data = Arr::only($inputData, ['title', 'device']);
            broadcast(new AnnouncementEvent(JHHYCnst::ANNOUNCEMENT_SYSTEM, $broadcast_data));
            return msgOut();
        }
        throw new \Exception('201700');
    }
}
