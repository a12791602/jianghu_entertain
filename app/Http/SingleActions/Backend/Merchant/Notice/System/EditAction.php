<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\System;

use App\Events\FrontendAnnouncementEvent;
use App\Lib\Constant\JHHYCnst;
use Arr;
use Illuminate\Http\JsonResponse;

/**
 * Class EditAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\System
 */
class EditAction extends BaseAction
{
    /**
     * ***
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $inputData['last_editor_id'] = $this->user->id;
        $inputData['device']         = $this->model->getDevice($inputData);
        $modelResult                 = $this->model->find($inputData['id']);
        if (!$modelResult instanceof $this->model) {
            throw new \Exception('201704');
        }
        $modelResult->cleanResource($inputData);
        $modelResult->fill($inputData);
        $result = $modelResult->save();
        if ($result) {
            $broadcast_data = Arr::only($inputData, ['title', 'device']);
            broadcast(new FrontendAnnouncementEvent(JHHYCnst::ANNOUNCEMENT_SYSTEM, $broadcast_data));
            return msgOut();
        }
        throw new \Exception('201701');
    }
}
